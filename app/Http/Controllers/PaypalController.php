<?php

namespace App\Http\Controllers;

use Throwable;
use App\Models\Plan;
use App\Models\Vcard;
use App\Models\Currency;
use App\Models\NfcOrders;
use Laracasts\Flash\Flash;
use App\Models\Appointment;
use App\Models\Product;
use App\Models\ProductTransaction;
use App\Models\Transaction;
use App\Models\Subscription;
use Illuminate\Http\Request;
use App\Models\AffiliateUser;
use App\Models\Nfc;
use App\Mail\AdminNfcOrderMail;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Redirector;
use App\Models\NfcOrderTransaction;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\RedirectResponse;
use App\Models\AppointmentTransaction;
use Illuminate\Contracts\View\Factory;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\AppBaseController;
use App\Repositories\AppointmentRepository;
use App\Repositories\SubscriptionRepository;
use Illuminate\Contracts\Foundation\Application;
use Srmklive\PayPal\Services\PayPal as PayPalClient;
use Symfony\Component\HttpKernel\Exception\HttpException;
use App\Mail\SubscriptionPaymentSuccessMail;

class PaypalController extends AppBaseController
{
    private SubscriptionRepository $subscriptionRepository;

    public function __construct(SubscriptionRepository $subscriptionRepository)
    {
        $this->subscriptionRepository = $subscriptionRepository;
    }

    /**
     * @throws Throwable
     * @throws HttpException
     */
    public function onBoard(Request $request): JsonResponse
    {
        $plan = Plan::with('currency')->findOrFail($request->planId);

        if ($plan->currency->currency_code != null && ! in_array(strtoupper($plan->currency->currency_code),
            getPayPalSupportedCurrencies())) {
            return $this->sendError(__('messages.placeholder.this_currency_is_not_supported'));
        }

        $data = $this->subscriptionRepository->manageSubscription($request->all());

        if (! isset($data['plan'])) { // 0 amount plan or try to switch the plan if it is in trial mode
            // returning from here if the plan is free.
            if (isset($data['status']) && $data['status'] == true) {
                return $this->sendSuccess($data['subscriptionPlan']->name.' '.__('messages.subscription_pricing_plans.has_been_subscribed'));
            } else {
                if (isset($data['status']) && $data['status'] == false) {
                    return $this->sendError(__('messages.placeholder.cannot_switch_to_zero'));
                }
            }
        }

        $subscriptionsPricingPlan = $data['plan'];
        $subscription = $data['subscription'];

        $mode = getSelectedPaymentGateway('paypal_mode');
        $clientId = getSelectedPaymentGateway('paypal_client_id');
        $clientSecret = getSelectedPaymentGateway('paypal_secret');

        config([
            'paypal.mode' => $mode,
            'paypal.sandbox.client_id' => $clientId,
            'paypal.sandbox.client_secret' => $clientSecret,
            'paypal.live.client_id' => $clientId,
            'paypal.live.client_secret' => $clientSecret,
        ]);

        $provider = new PayPalClient();
        $provider->getAccessToken();

        $data = [
            'intent' => 'CAPTURE',
            'purchase_units' => [
                [
                    'reference_id' => $subscription->id,
                    'amount' => [
                        'value' => $data['amountToPay'],
                        'currency_code' => $subscription->plan->currency->currency_code,
                    ],
                ],
            ],
            'application_context' => [
                'cancel_url' => route('paypal.failed'),
                'return_url' => route('paypal.success'),
            ],
        ];

        $order = $provider->createOrder($data);

        return response()->json(['link' => $order['links'][1]['href'], 'status' => 200]);

    }

    /**
     * @throws HttpException
     * @throws HttpException|Throwable
     */
    public function userOnBoard($userId, $vcard, $input): JsonResponse
    {
        $amount = $input['amount'];
        $currencyCode = $input['currency_code'];

        $mode = getUserSettingValue('paypal_mode',$userId);
        $clientId = getUserSettingValue('paypal_client_id',$userId);
        $clientSecret = getUserSettingValue('paypal_secret',$userId);

        config([
            'paypal.mode' => $mode,
            'paypal.sandbox.client_id' => $clientId,
            'paypal.sandbox.client_secret' => $clientSecret,
            'paypal.live.client_id' => $clientId,
            'paypal.live.client_secret' => $clientSecret,
        ]);

        $provider = new PayPalClient();
        $provider->getAccessToken();

        $data = [
            'intent' => 'CAPTURE',
            'purchase_units' => [
                [
                    'reference_id' => $vcard->id,
                    'amount' => [
                        'value' => $amount,
                        'currency_code' => $currencyCode,
                    ],
                ],
            ],
            'application_context' => [
                'cancel_url' => route('user.paypal.failed'),
                'return_url' => route('user.paypal.success'),
            ],
        ];

        $order = $provider->createOrder($data);
        session()->put(['appointment_details' => $input]);
        session(['vcard_user_id' => $userId, 'tenant_id' => $vcard->tenant->id, 'vcard_id' => $vcard->id]);

        return response()->json(['link' => $order['links'][1]['href'], 'status' => 200]);
    }

    /**
     * @return Application|RedirectResponse|Redirector|void
     *
     * @throws IOException
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface|Throwable
     */
    public function userSuccess(Request $request): RedirectResponse
    {
        $userId = session()->get('vcard_user_id');
        $clientId = getUserSettingValue('paypal_client_id', $userId);
        $clientSecret = getUserSettingValue('paypal_secret', $userId);
        $mode = getUserSettingValue('paypal_mode', $userId);
        $currencyCode = Currency::whereId(getUserSettingValue('currency_id', $userId))->first();
        $config = [
            'mode' => $mode, // Can only be 'sandbox' Or 'live'. If empty or invalid, 'live' will be used.
            $mode => [
                'client_id' => $clientId,
                'client_secret' => $clientSecret,
            ],
            'payment_action' => config('paypal.payment_action'), // Can only be 'Sale', 'Authorization' or 'Order'
            'currency' => $currencyCode->currency_code,
            'notify_url' => config('paypal.notify_url'), // Change this accordingly for your application.
            'locale' => config('paypal.locale'),
            // force gateway language  i.e. it_IT, es_ES, en_US ... (for express checkout only)
            'validate_ssl' => config('paypal.validate_ssl'), // Validate SSL when creating api client.
        ];

        config([
            'paypal.mode' => $mode,
            'paypal.sandbox.client_id' => $clientId,
            'paypal.sandbox.client_secret' => $clientSecret,
            'paypal.live.client_id' => $clientId,
            'paypal.live.client_secret' => $clientSecret,
        ]);

        $provider = new PayPalClient;
        $provider->getAccessToken();
        $token = $request->get('token');
        $orderInfo = $provider->showOrderDetails($token);
        try {
            // Call API with your client and get a response for your call
            $response = $provider->capturePaymentOrder($token);
            // If call returns body in response, you can get the deserialized version from the result attribute of the response
            $vcardId = $response['purchase_units'][0]['reference_id'];
            $tenantId = session()->get('tenant_id');
            $amount = $response['purchase_units'][0]['payments']['captures'][0]['amount']['value'];
            $currencyCode = $response['purchase_units'][0]['payments']['captures'][0]['amount']['currency_code'];
            $currencyId = Currency::whereCurrencyCode($currencyCode)->first()->id;
            $transactionId = $response['id'];
            $vcard = Vcard::with('tenant.user')->where('id', $vcardId)->first();

            $transactionDetails = [
                'vcard_id' => $vcardId,
                'transaction_id' => $transactionId,
                'currency_id' => $currencyId,
                'amount' => $amount,
                'tenant_id' => $tenantId,
                'type' => Appointment::PAYPAL,
                'status' => Transaction::SUCCESS,
                'meta' => json_encode($response),
            ];

            $appointmentTran = AppointmentTransaction::create($transactionDetails);
            $appointmentInput = session()->get('appointment_details');
            session()->forget('appointment_details');
            $appointmentInput['appointment_tran_id'] = $appointmentTran->id;

            /** @var AppointmentRepository $appointmentRepo */
            $appointmentRepo = App::make(AppointmentRepository::class);
            $vcardEmail = is_null($vcard->email) ? $vcard->tenant->user->email : $vcard->email;
            $appointmentRepo->appointmentStoreOrEmail($appointmentInput, $vcardEmail);

            session()->forget(['vcard_user_id', 'tenant_id', 'vcard_id']);

            Flash::success(__('messages.placeholder.payment_done'));
            App::setLocale(Session::get('languageChange_'. $vcard->url_alias));

            return redirect(route('vcard.show', [$vcard->url_alias, __('messages.placeholder.appointment_created')]));
        } catch (HttpException $ex) {
            print_r($ex->getMessage());
        }
    }

    /**
     * @return Application|RedirectResponse|Redirector
     */
    public function userFailed(): RedirectResponse
    {
        $vcardId = session('vcard_id');
        $vcard = Vcard::findOrFail($vcardId);
        session()->forget('appointment_details');
        session()->forget(['vcard_user_id', 'tenant_id', 'vcard_id']);

        Flash::error('Your Payment is Cancelled');

        return redirect(route('vcard.show', $vcard->url_alias));
    }

    /**
     * @return Application|Factory|View|void
     *
     * @throws IOException
     */
    public function success(Request $request): \Illuminate\View\View
    {
        $mode = getSelectedPaymentGateway('paypal_mode');
        $clientId = getSelectedPaymentGateway('paypal_client_id');
        $clientSecret = getSelectedPaymentGateway('paypal_secret');

        config([
            'paypal.mode' => $mode,
            'paypal.sandbox.client_id' => $clientId,
            'paypal.sandbox.client_secret' => $clientSecret,
            'paypal.live.client_id' => $clientId,
            'paypal.live.client_secret' => $clientSecret,
        ]);

        $provider = new PayPalClient;
        $provider->getAccessToken();
        $token = $request->get('token');
        $orderInfo = $provider->showOrderDetails($token);
        $subscriptionId = null;

        try {
            // Call API with your client and get a response for your call
            $response = $provider->capturePaymentOrder($token);
            if (isset($response['purchase_units'][0]['reference_id'])) {
                $subscriptionId = $response['purchase_units'][0]['reference_id'];
            }
            if (isset($response['purchase_units'][0]['payments']['captures'][0]['amount']['value'])) {
                $subscriptionAmount = $response['purchase_units'][0]['payments']['captures'][0]['amount']['value'];
            }
            if (isset($response['id'])) {
                $transactionID = $response['id'];
            }

            Subscription::findOrFail($subscriptionId)->update([
                'payment_type' => Subscription::PAYPAL,
                'status' => Subscription::ACTIVE
            ]);

            // De-Active all other subscription
            Subscription::whereTenantId(getLogInTenantId())
                ->where('id', '!=', $subscriptionId)
                ->where('status', '!=', Subscription::REJECT)
                ->update([
                    'status' => Subscription::INACTIVE,
                ]);

            $transaction = Transaction::create([
                'transaction_id' => $transactionID,
                'type' => Transaction::PAYPAL,
                'amount' => $subscriptionAmount,
                'status' => Subscription::ACTIVE,
                'meta' => json_encode($response),
            ]);
            // updating the transaction id on the subscription table
            $subscription = Subscription::findOrFail($subscriptionId);
            $planName = $subscription->plan->name;
            $subscription->update(['transaction_id' => $transaction->id]);


            $affiliateAmount = getSuperAdminSettingValue('affiliation_amount');
            $affiliateAmountType = getSuperAdminSettingValue('affiliation_amount_type');
            if($affiliateAmountType == 1){
                AffiliateUser::whereUserId(getLogInUserId())->where('amount', 0)->withoutGlobalScopes()->update(['amount' => $affiliateAmount,'is_verified' => 1]);
            }else if($affiliateAmountType == 2){
                $amount = $subscriptionAmount * $affiliateAmount / 100;
                AffiliateUser::whereUserId(getLogInUserId())->where('amount', 0)->withoutGlobalScopes()->update(['amount' => $amount,'is_verified' => 1]);
            }

            $userEmail = getLogInUser()->email;
            $firstName = getLogInUser()->first_name;
            $lastName =  getLogInUser()->last_name;
            $emailData = [
                'subscriptionId' => $subscriptionId,
                'subscriptionAmount' => $subscriptionAmount,
                'transactionID' => $transactionID,
                'planName' => $planName,
                'first_name' => $firstName,
                'last_name' => $lastName,
            ];
        manageVcards();
        Mail::to($userEmail)->send(new SubscriptionPaymentSuccessMail($emailData));


        return view('sadmin.plans.payment.paymentSuccess');

        } catch (HttpException $ex) {
            print_r($ex->getMessage());
        }
    }

    /**
     * @return Application|Factory|View
     */
    public function failed(): \Illuminate\View\View
    {
        return view('sadmin.plans.payment.paymentcancel');
    }

    public function buyProductOnboard($input, $product): JsonResponse
    {

        $userId = $product->vcard->user->id;
        if (empty($product->currency_id)) {
            $product->currency_id = getUserSettingValue('currency_id', $userId);
        }
        $currencyCode = Currency::whereId($product->currency_id)->first()->currency_code;

        $clientId = getUserSettingValue('paypal_client_id', $userId);
        $clientSecret = getUserSettingValue('paypal_secret', $userId);
        $mode = getUserSettingValue('paypal_mode', $userId);

        config([
            'paypal.mode' => $mode,
            'paypal.sandbox.client_id' => $clientId,
            'paypal.sandbox.client_secret' => $clientSecret,
            'paypal.live.client_id' => $clientId,
            'paypal.live.client_secret' => $clientSecret,
        ]);

        $provider = new PayPalClient();
        $provider->getAccessToken();

        $data = [
            'intent' => 'CAPTURE',
            'purchase_units' => [
                [
                    'reference_id' => $product->id,
                    'amount' => [
                        'value' => $product->price,
                        'currency_code' => $currencyCode,
                    ],
                ],
            ],
            'application_context' => [
                'cancel_url' => route('paypal.buy.product.failed'),
                'return_url' => route('paypal.buy.product.success'),
            ],
        ];

        $order = $provider->createOrder($data);

        session()->put([
            'input' => $input,
        ]);

        return response()->json(['link' => $order['links'][1]['href'], 'status' => 200]);
    }

    public function productBuySuccess(Request $request)
    {
        $input = session()->get('input');
        $product = Product::whereId($input['product_id'])->first();
        $userId = $product->vcard->user->id;

        if (empty($product->currency_id)) {
            $product->currency_id = getUserSettingValue('currency_id', $userId);
        }
        $currencyId = Currency::whereId($product->currency_id)->first()->id;

        $clientId = getUserSettingValue('paypal_client_id', $userId);
        $clientSecret = getUserSettingValue('paypal_secret', $userId);
        $mode = getUserSettingValue('paypal_mode', $userId);

        config([
            'paypal.mode' => $mode,
            'paypal.sandbox.client_id' => $clientId,
            'paypal.sandbox.client_secret' => $clientSecret,
            'paypal.live.client_id' => $clientId,
            'paypal.live.client_secret' => $clientSecret,
        ]);

        $provider = new PayPalClient;
        $provider->getAccessToken();
        $token = $request->get('token');

        try {
            $response = $provider->capturePaymentOrder($token);
            $amount = $response['purchase_units'][0]['payments']['captures'][0]['amount']['value'];

            DB::beginTransaction();

            ProductTransaction::create([
                'product_id' => $input['product_id'],
                'name' => $input['name'],
                'email' => $input['email'],
                'phone' => $input['phone'],
                'address' => $input['address'],
                'currency_id' => $currencyId,
                'meta' => json_encode($response),
                'type' =>  $input['payment_method'],
                'transaction_id' => $response['id'],
                'amount' => $amount,
        ]);

        $vcard = $product->vcard;
        App::setLocale(Session::get('languageChange_'. $vcard->url_alias));
        session()->forget('input');
        DB::commit();

        return redirect(route('showProducts', [$vcard->id, $vcard->url_alias, __('messages.placeholder.product_purchase')]));
        } catch (HttpException $ex) {
            print_r($ex->getMessage());
        }
    }

    public function productBuyFailed()
    {
        $input = session()->get('input');
        session()->forget('input');
        $product = Product::whereId($input['product_id'])->first();
        $vcard = $product->vcard;
        Flash::error(__('messages.placeholder.payment_cancel'));

        return redirect(route('showProducts', [$vcard->id, $vcard->url_alias]));
    }



    public function nfcOrderOnboard($orderId, $email,$nfc,$currency){

        $mode = getSelectedPaymentGateway('paypal_mode');
        $clientId = getSelectedPaymentGateway('paypal_client_id');
        $clientSecret = getSelectedPaymentGateway('paypal_secret');

        config([
            'paypal.mode' => $mode,
            'paypal.sandbox.client_id' => $clientId,
            'paypal.sandbox.client_secret' => $clientSecret,
            'paypal.live.client_id' => $clientId,
            'paypal.live.client_secret' => $clientSecret,
        ]);

        $provider = new PayPalClient();
        $provider->getAccessToken();

        $data = [
            'intent' => 'CAPTURE',
            'purchase_units' => [
                [
                    'reference_id' => $orderId,
                    'amount' => [
                        'value' => $nfc->nfcCard->price * $nfc->quantity,
                        'currency_code' => $currency,
                    ],
                ],
            ],
            'application_context' => [
                'cancel_url' => route('nfc.paypal.failed'),
                'return_url' => route('nfc.paypal.success'),
            ],
        ];

        $order = $provider->createOrder($data);
        session()->put(['order_details' => $nfc,'order_id' => $orderId]);

        return response()->json(['link' => $order['links'][1]['href'], 'status' => 200]);

    }

    public function nfcPurchaseSuccess(Request $request){

        $mode = getSelectedPaymentGateway('paypal_mode');
        $clientId = getSelectedPaymentGateway('paypal_client_id');
        $clientSecret = getSelectedPaymentGateway('paypal_secret');


        config([
            'paypal.mode' => $mode,
            'paypal.sandbox.client_id' => $clientId,
            'paypal.sandbox.client_secret' => $clientSecret,
            'paypal.live.client_id' => $clientId,
            'paypal.live.client_secret' => $clientSecret,
        ]);

        $provider = new PayPalClient;
        $provider->getAccessToken();
        $token = $request->get('token');
        $orderInfo = $provider->showOrderDetails($token);

        try {
            // Call API with your client and get a response for your call
            $response = $provider->capturePaymentOrder($token);
            // If call returns body in response, you can get the deserialized version from the result attribute of the response
            $orderId = session()->get('order_id');
            $type = NfcOrders::PAYPAL;
            $transactionId = $response['id'];
            $amount = $response['purchase_units'][0]['payments']['captures'][0]['amount']['value'];
            $userId = NfcOrders::findOrFail($orderId)->user_id;
            $status = NfcOrders::SUCCESS;
            $nfcOrder = NfcOrders::get()->find($orderId);

            $transactionDetails = [
                'nfc_order_id' => $orderId,
                'type' => $type,
                'transaction_id' => $transactionId,
                'amount' => $amount,
                'user_id' => $userId,
                'status' =>  $status,
            ];

            $vcardName = VCard::find($nfcOrder['vcard_id'])->name;
            $cardType = Nfc::find($nfcOrder['card_type'])->name;

            NfcOrderTransaction::create($transactionDetails);

            session()->forget(['vcard_user_id', 'tenant_id', 'vcard_id', 'order_details', 'order_id']);

            Mail::to(getSuperAdminSettingValue('email'))->send(new AdminNfcOrderMail($nfcOrder, $vcardName, $cardType));

                Flash::success(__('messages.nfc.order_placed_success'));

            return redirect(route('user.orders'));

        } catch (HttpException $ex) {
            print_r($ex->getMessage());
        }
    }

    public function nfcPurchaseFailed()
    {
        $orderId = session()->get('order_id');
        $type = NfcOrders::PAYPAL;
        $amount = session('order_details')->nfcCard->price;
        $userId = NfcOrders::findOrFail($orderId)->user_id;

        $transactionDetails = [
            'nfc_order_id' => $orderId,
            'type' => $type,
            'amount' => $amount,
            'user_id' => $userId,
            'status' =>   NfcOrders::FAIL,
        ];

        NfcOrderTransaction::create($transactionDetails);
        session()->forget(['vcard_user_id', 'tenant_id', 'vcard_id', 'order_details', 'order_id']);

        Flash::error(__('messages.placeholder.payment_cancel'));

        return redirect(route('user.orders'));
    }
}
