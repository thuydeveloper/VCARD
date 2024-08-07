<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Nfc;
use App\Models\Plan;
use App\Models\Vcard;
use App\Models\Currency;
use App\Models\NfcOrders;
use Illuminate\View\View;
use Laracasts\Flash\Flash;
use App\Models\Appointment;
use App\Models\Product;
use App\Models\ProductTransaction;
use App\Models\Transaction;
use App\Models\Subscription;
use Illuminate\Http\Request;
use Stripe\Checkout\Session;
use App\Models\AffiliateUser;
use App\Mail\AdminNfcOrderMail;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\DB;
use App\Models\NfcOrderTransaction;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\RedirectResponse;
use App\Models\AppointmentTransaction;
use Stripe\Exception\ApiErrorException;
use App\Http\Controllers\AppBaseController;
use App\Repositories\AppointmentRepository;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Support\Facades\Session as FacadesSession;
use Symfony\Component\HttpKernel\Exception\UnprocessableEntityHttpException;

class StripeController extends AppBaseController
{
    /**
     * @throws ApiErrorException
     */
    public function purchase(Request $request): JsonResponse
    {

        $plan = Plan::with('currency')->findOrFail($request->plan_id);

        setStripeApiKey();

        $session = Session::create([
            'payment_method_types' => ['card'],
            'customer_email' => getLogInUser()->email,
            'line_items' => [
                [
                    'name' => $plan->name,
                    'amount' => ! in_array($plan->currency->currency_code,
                        zeroDecimalCurrencies()) ? removeCommaFromNumbers($plan->price) * 100 : removeCommaFromNumbers($plan->price),
                    'currency' => $plan->currency->currency_code,
                    'quantity' => 1,
                ],
            ],
            'success_url' => route('stripe.success', $plan->id).'?session_id={CHECKOUT_SESSION_ID}',
            'cancel_url' => route('stripe.failed').'?error=payment_cancelled',
        ]);
        $result = [
            'sessionId' => $session['id'],
        ];

        return $this->sendResponse($result, 'Subscription resumed successfully.');
    }

    /**
     * @return Application|RedirectResponse|Redirector
     *
     * @throws Exception
     */
    public function paymentSuccess(Request $request, Plan $plan): View
    {

        $sessionId = $request->get('session_id');
        if (empty($sessionId)) {
            throw new UnprocessableEntityHttpException('session_id required');
        }

        try {
            setStripeApiKey();
            $sessionData = Session::retrieve($sessionId);

            DB::beginTransaction();

            Transaction::create([
                'transaction_id' => $sessionData->payment_intent,
                'amount' => $sessionData->amount_total / 100,
                'type' => Transaction::STRIPE,
            ]);

            Subscription::whereTenantId(getLogInTenantId())
                ->whereIsActive(true)->update(['is_active' => false]);

            $expiryDate = setExpiryDate($plan);

            Subscription::create([
                'plan_id' => $plan->id,
                'expiry_at' => $expiryDate,
                'is_active' => true,
            ]);

            AffiliateUser::whereUserId(getLogInUserId())->withoutGlobalScopes()
                ->update(['is_verified' => 1]);

            DB::commit();

            Flash::success(__('messages.placeholder.purchased_plan'));

            return view('sadmin.plans.payment.paymentSuccess');

        } catch (ApiErrorException $e) {
            DB::rollBack();
            throw new Exception($e->getMessage(), $e->getCode());
        }
    }

    public function paymentFailed(Request $request): View
    {
        return view('sadmin.plans.payment.paymentcancel');
    }

    /**
     * @return Application|RedirectResponse|Redirector
     *
     * @throws Exception
     */
    public function userPaymentSuccess(Request $request): RedirectResponse
    {
        $sessionId = $request->get('session_id');
        if (empty($sessionId)) {
            throw new UnprocessableEntityHttpException('session_id required');
        }

        $vcard = Vcard::with('tenant.user', 'template')->where('id', $request->get('vcard_id'))->first();

        $userId = $vcard->tenant->user->id;

        try {
            setUserStripeApiKey($userId);
            $sessionData = Session::retrieve($sessionId);
            $currencyId = Currency::whereCurrencyCode($sessionData->currency)->first()->id;

            DB::beginTransaction();

            $appointmentTran = AppointmentTransaction::create([
                'vcard_id' => $vcard->id,
                'transaction_id' => $sessionData->payment_intent,
                'currency_id' => $currencyId,
                'amount' => $sessionData->amount_total / 100,
                'tenant_id' => $vcard->tenant->id,
                'type' => Appointment::STRIPE,
                'status' => Transaction::SUCCESS,
                'meta' => json_encode($sessionData),
            ]);

            $appointmentInput = session()->get('appointment_details');
            session()->forget('appointment_details');
            $appointmentInput['appointment_tran_id'] = $appointmentTran->id;

            /** @var AppointmentRepository $appointmentRepo */
            $appointmentRepo = App::make(AppointmentRepository::class);
            $vcardEmail = is_null($vcard->email) ? $vcard->tenant->user->email : $vcard->email;
            $appointmentRepo->appointmentStoreOrEmail($appointmentInput, $vcardEmail);
            $url = ($vcard->template->name == 'vcard11') ? $vcard->url_alias.'/contact' : $vcard->url_alias;

            App::setLocale(FacadesSession::get('languageChange_'. $vcard->url_alias));

            DB::commit();

            Flash::success('Payment successfully done');

            return redirect(route('vcard.show', [$url, __('messages.placeholder.appointment_created')]));
        } catch (ApiErrorException $e) {
            DB::rollBack();

            throw new Exception($e->getMessage(), $e->getCode());
        }
    }

    /**
     * @return Application|RedirectResponse|Redirector
     */
    public function userHandleFailedPayment(Request $request): RedirectResponse
    {
        session()->forget('appointment_details');
        $vcardId = $request->get('vcard_id');
        $vcard = Vcard::findOrFail($vcardId);
        Flash::error(__('messages.placeholder.payment_cancel'));

        return redirect(route('vcard.show', $vcard->url_alias));
    }

    public function productBuySuccess(Request $request): RedirectResponse
    {
        $sessionId = $request->get('session_id');
        if (empty($sessionId)) {
            throw new UnprocessableEntityHttpException('session_id required');
        }
        $input = session()->get('input');
        session()->forget('input');
        $product = Product::whereId($input['product_id'])->first();
        $userId = $product->vcard->user->id;

        if (empty($product->currency_id)) {
            $product->currency_id = getUserSettingValue('currency_id', $userId);
        }
        $currencyId = Currency::whereId($product->currency_id)->first()->id;

        try {
            setUserStripeApiKey($userId);
            $sessionData = Session::retrieve($sessionId);

            DB::beginTransaction();

                ProductTransaction::create([
                    'product_id' => $input['product_id'],
                    'name' => $input['name'],
                    'email' => $input['email'],
                    'phone' => $input['phone'],
                    'address' => $input['address'],
                    'currency_id' => $currencyId,
                    'meta' => json_encode($sessionData),
                    'type' =>  $input['payment_method'],
                    'transaction_id' => $sessionData->payment_intent,
                    'amount' => $sessionData->amount_total / 100,
            ]);

            $vcard = $product->vcard;
            App::setLocale(FacadesSession::get('languageChange_'. $vcard->url_alias));
            DB::commit();

            return redirect(route('showProducts', [$vcard->id, $vcard->url_alias, __('messages.placeholder.product_purchase')]));
        } catch (ApiErrorException $e) {
            DB::rollBack();

            throw new Exception($e->getMessage(), $e->getCode());
        }
    }

    public function productBuyFailed(): RedirectResponse
    {
        $input = session()->get('input');
        session()->forget('input');
        $product = Product::whereId($input['product_id'])->first();
        $vcard = $product->vcard;

        return redirect(route('showProducts', [$vcard->id, $vcard->url_alias]));
    }


    public function nfcPurchaseSuccess(Request $request){

        $input = $request->all();

        $nfcOrder = NfcOrders::get()->find($input['order_id']);
        $sessionId = $input['session_id'];

        setStripeApiKey();
        $sessionData = Session::retrieve($sessionId);

        if (empty($sessionId)) {
            throw new UnprocessableEntityHttpException('session_id required');
        }

        NfcOrderTransaction::create([
            'nfc_order_id' => $input['order_id'],
            'type' => NfcOrders::STRIPE,
            'transaction_id' => $sessionData->payment_intent,
            'amount' => $sessionData->amount_total / 100,
            'user_id' => getLogInUser()->id,
            'status' => NfcOrders::SUCCESS,
        ]);

        $vcardName = VCard::find($nfcOrder['vcard_id'])->name;
        $cardType = Nfc::find($nfcOrder['card_type'])->name;
        App::setLocale(getLogInUser()->language);

        Mail::to(getSuperAdminSettingValue('email'))->send(new AdminNfcOrderMail($nfcOrder, $vcardName, $cardType));

        Flash::success(__('messages.nfc.order_placed_success'));

        return redirect(route('user.orders'));
    }

    public function nfcPurchaseFailed(Request $request)
    {
        $input = $request->all();
        $sessionId = $input['session_id'];

        setStripeApiKey();
        $sessionData = Session::retrieve($sessionId);

        NfcOrderTransaction::create([
            'nfc_order_id' => $input['order_id'],
            'type' => NfcOrders::STRIPE,
            'amount' => $sessionData->amount_total / 100,
            'user_id' => getLogInUser()->id,
            'status' => NfcOrders::FAIL,
        ]);

        Flash::error(__('messages.placeholder.payment_cancel'));

        return redirect(route('user.orders'));
    }

}
