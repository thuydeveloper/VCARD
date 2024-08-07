<?php

namespace App\Http\Controllers;

use Exception;
use Razorpay\Api\Api;
use App\Models\NfcOrders;
use Illuminate\View\View;
use Laracasts\Flash\Flash;
use App\Models\Nfc;
use App\Models\Vcard;
use App\Models\Transaction;
use App\Models\Subscription;
use Illuminate\Http\Request;
use App\Models\AffiliateUser;
use App\Mail\AdminNfcOrderMail;
use Illuminate\Http\JsonResponse;
use App\Models\NfcOrderTransaction;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\AppBaseController;
use App\Models\Product;
use App\Models\ProductTransaction;
use App\Repositories\SubscriptionRepository;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use App\Mail\SubscriptionPaymentSuccessMail;
use App\Models\Currency;

class RazorpayController extends AppBaseController
{
    /**
     * @var SubscriptionRepository
     */
    private $subscriptionRepository;

    public function __construct(SubscriptionRepository $subscriptionRepository)
    {
        $this->subscriptionRepository = $subscriptionRepository;
    }

    public function onBoard(Request $request): JsonResponse
    {
        $data = $this->subscriptionRepository->manageSubscription($request->all());

        $subscription = $data['subscription'];
        $api = new Api(getSelectedPaymentGateway('razorpay_key'), getSelectedPaymentGateway('razorpay_secret'));
        $orderData = [
            'receipt' => 1,
            'amount' => $data['amountToPay'] * 100,
            'currency' => $subscription->plan->currency->currency_code,
            'notes' => [
                'email' => Auth::user()->email,
                'name' => Auth::user()->full_name,
                'subscriptionId' => $subscription->id,
                'amountToPay' => $data['amountToPay'],
            ],
        ];

        session(['payment_type' => request()->get('payment_type')]);

        $razorpayOrder = $api->order->create($orderData);
        $data['id'] = $razorpayOrder->id;
        $data['amount'] = $data['amountToPay'];
        $data['name'] = Auth::user()->full_name;
        $data['email'] = Auth::user()->email;
        $data['contact'] = Auth::user()->contact;

        return $this->sendResponse($data, 'Order created successfully');
    }

    /**
     * @return false|\Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse
     */
    public function paymentSuccess(Request $request)
    {
        $input = $request->all();
        Log::info('RazorPay Payment Successfully');
        Log::info($input);
        $api = new Api(getSelectedPaymentGateway('razorpay_key'), getSelectedPaymentGateway('razorpay_secret'));
        if (count($input) && ! empty($input['razorpay_payment_id'])) {
            try {
                $payment = $api->payment->fetch($input['razorpay_payment_id']);
                $generatedSignature = hash_hmac(
                    'sha256',
                    $payment['order_id'].'|'.$input['razorpay_payment_id'],
                    getSelectedPaymentGateway('razorpay_secret')
                );
                if ($generatedSignature != $input['razorpay_signature']) {
                    return redirect()->back();
                }
                // Create Transaction Here

                $subscriptionID = $payment['notes']['subscriptionId'];
                $amountToPay = $payment['notes']['amountToPay'];
                $subscription = Subscription::findOrFail($subscriptionID);


                Subscription::findOrFail($subscriptionID)->update([
                    'payment_type' => Subscription::RAZORPAY,
                    'status' => Subscription::ACTIVE
                ]);

                // De-Active all other subscription
                Subscription::whereTenantId(getLogInTenantId())
                    ->where('id', '!=', $subscriptionID)
                    ->where('status', '!=', Subscription::REJECT)
                    ->update([
                        'status' => Subscription::INACTIVE,
                    ]);

                $transaction = Transaction::create([
                    'tenant_id' => $subscription->tenant_id,
                    'transaction_id' => $payment->id,
                    'type' => session('payment_type'),
                    'amount' => $amountToPay,
                    'status' => Subscription::ACTIVE,
                    'meta' => json_encode($payment->toArray()),
                ]);

                $subscription = Subscription::findOrFail($subscriptionID);
                $planName = $subscription->plan->name;
                $subscription->update(['transaction_id' => $transaction->id]);

                $affiliateAmount = getSuperAdminSettingValue('affiliation_amount');
                $affiliateAmountType = getSuperAdminSettingValue('affiliation_amount_type');
                if($affiliateAmountType == 1){
                    AffiliateUser::whereUserId(getLogInUserId())->where('amount', 0)->withoutGlobalScopes()->update(['amount' => $affiliateAmount,'is_verified' => 1]);
                }else if($affiliateAmountType == 2){
                    $amount = $amountToPay * $affiliateAmount / 100;
                    AffiliateUser::whereUserId(getLogInUserId())->where('amount', 0)->withoutGlobalScopes()->update(['amount' => $amount,'is_verified' => 1]);
                }

                    $userEmail = getLogInUser()->email;
                    $firstName = getLogInUser()->first_name;
                    $lastName =  getLogInUser()->last_name;
                    $emailData = [
                        'subscriptionID' => $subscriptionID,
                        'amountToPay' => $amountToPay,
                        'planName' => $planName,
                        'first_name' => $firstName,
                        'last_name' => $lastName,
                    ];

                    manageVcards();
                    Mail::to($userEmail)->send(new SubscriptionPaymentSuccessMail($emailData));

                return view('sadmin.plans.payment.paymentSuccess');
            } catch (Exception $e) {
                return false;
            }
        }

        return redirect()->back();
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function paymentFailed(): View
    {
        return view('sadmin.plans.payment.paymentcancel');
    }

    public function nfcPaymentSuccess(Request $request){
        $input = $request->all();

        $api = new Api(getSelectedPaymentGateway('razorpay_key'), getSelectedPaymentGateway('razorpay_secret'));
        if (count($input) && ! empty($input['razorpay_payment_id'])) {
            try {
                $payment = $api->payment->fetch($input['razorpay_payment_id']);
                                $generatedSignature = hash_hmac(
                    'sha256',
                    $payment['order_id'].'|'.$input['razorpay_payment_id'],
                    getSelectedPaymentGateway('razorpay_secret')
                );

                if ($generatedSignature != $input['razorpay_signature']) {
                    return redirect()->back();
                }

                // $nfcOrder = NfcOrders::create([
                //     'name' => $payment['notes']['customer_name'],
                //     'designation' => $payment['notes']['designation'],
                //     'phone' => $payment['notes']['phone'],
                //     'email' => $payment['notes']['email'],
                //     'address' => $payment['notes']['address'],
                //     'company_name' => $payment['notes']['company_name'],
                //     'order_status' => NfcOrders::PENDING,
                //     'card_type' => $payment['notes']['card_type'],
                //     'user_id' => getLogInUserId(),
                //     'vcard_id' => $payment['notes']['vcard_id'],

                // ]);

                $id = session()->get('orderid');
                NfcOrders::where('id', $id)->update(['order_status' => NfcOrders::PENDING]);
                $nfcOrder = NfcOrders::where('id', $id)->get();

                $vcardName = VCard::find($nfcOrder[0]->vcard_id)->name;
                $cardType = Nfc::find($nfcOrder[0]->card_type)->name;

                NfcOrderTransaction::create([
                    'nfc_order_id' => $id,
                    'type' => NfcOrders::RAZOR_PAY,
                    'transaction_id' => $payment->id,
                    'amount' => $payment['notes']['amountToPay'],
                    'user_id' => getLogInUser()->id,
                    'status' => NfcOrders::SUCCESS,
                ]);

                Mail::to(getSuperAdminSettingValue('email'))->send(new AdminNfcOrderMail($nfcOrder[0], $vcardName, $cardType));

                Flash::success(__('messages.nfc.order_placed_success'));

                return redirect(route('user.orders'));
            } catch (Exception $e) {
                Log::info($e->getMessage());
                return false;
            }
        }

        return redirect()->back();
    }

    public function nfcPaymentFailed(Request $request): View
    {
        $input = $request->all();
        $api = new Api(getSelectedPaymentGateway('razorpay_key'), getSelectedPaymentGateway('razorpay_secret'));
        $payment = $api->payment->fetch($input['razorpay_payment_id']);

        $id = session()->get('orderid');
        NfcOrders::where('id', $id)->update(['order_status' => NfcOrders::PENDING]);
        $nfcOrder = NfcOrders::where('id', $id)->get();


        NfcOrderTransaction::create([
            'nfc_order_id' => $id,
            'type' => NfcOrders::RAZOR_PAY,
            'transaction_id' => $payment->id,
            'amount' => $payment['notes']['amountToPay'],
            'user_id' => getLogInUser()->id,
            'status' => NfcOrders::FAIL,
        ]);

        return view('sadmin.plans.payment.paymentcancel');
    }

    public function productPaymentSuccess(Request $request){
        $input = $request->all();
        $product = Session::get('productId');
        $userId = $product->vcard->user->id;
        $api = new Api(getUserSettingValue('razorpay_key', $userId), getUserSettingValue('razorpay_secret', $userId));
        $payment = $api->payment->fetch($input['razorpay_payment_id']);
                                $generatedSignature = hash_hmac(
                    'sha256',
                    $payment['order_id'].'|'.$input['razorpay_payment_id'],
                    getSelectedPaymentGateway('razorpay_secret')
                );

                if ($generatedSignature != $input['razorpay_signature']) {
                    return redirect()->back();
                }
                if (empty($product->currency_id)) {
                    $product->currency_id = getUserSettingValue('currency_id', $userId);
                }
                $currencyId = Currency::whereId($product->currency_id)->first()->id;
                $name = $payment['notes']['name'];
                $email = $payment['notes']['email'];
                $contact = $payment['contact'];
                $address = $payment['notes']['address'];
                $currency = $payment['currency'];
                $payment_type = $payment['notes']['payment_type'];
                $amount = $payment['amount']/100;
                $transaction_id = $payment['id'];
        try {
            DB::beginTransaction();

            ProductTransaction::create([
                'product_id' => $product->id,
                'name' => $name,
                'email' => $email,
                'phone' => $contact,
                'address' => $address,
                'currency_id' => $currencyId,
                'meta' => json_encode($payment),
                'type' =>  $payment_type,
                'transaction_id' => $transaction_id,
                'amount' => $amount,
        ]);

        $vcard = $product->vcard;
        App::setLocale(Session::get('languageChange_'. $vcard->url_alias));
        session()->forget('productId');
        DB::commit();

        return redirect(route('showProducts', [$vcard->id, $vcard->url_alias, __('messages.placeholder.product_purchase')]));
        } catch (HttpException $ex) {
            print_r($ex->getMessage());
        }
    }

    public function productPaymentFailed(Request $request): View
    {
        $input = $request->all();
        $product = Session::get('productId');
        $userId = $product->vcard->user->id;
        $api = new Api(getUserSettingValue('razorpay_key', $userId), getUserSettingValue('razorpay_secret', $userId));
        $vcard = $product->vcard;
        session()->forget('productId');
        Flash::error(__('messages.placeholder.payment_cancel'));

        return redirect(route('showProducts', [$vcard->id, $vcard->url_alias]));

    }

}
