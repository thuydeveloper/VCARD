<?php

namespace App\Http\Controllers;

use App\Mail\AdminNfcOrderMail;
use App\Models\AffiliateUser;
use App\Models\NfcOrderTransaction;
use App\Models\Plan;
use App\Models\Setting;
use App\Models\Subscription;
use App\Models\Transaction;
use App\Utils\ResponseUtil;
use Illuminate\Http\Request;
use App\Repositories\SubscriptionRepository;
use AWS\CRT\HTTP\Response;
use Illuminate\Support\Facades\Mail;
use Exception;
use GeoIp2\Exception\HttpException;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Laracasts\Flash\Flash;
use Stripe\Exception\ApiErrorException;
use Unicodeveloper\Paystack\Facades\Paystack;
use App\Mail\SubscriptionPaymentSuccessMail;
use App\Models\Nfc;
use App\Models\NfcOrders;
use App\Models\Vcard;

class PaystackController extends AppBaseController
{
    private SubscriptionRepository $subscriptionRepository;

    public function __construct(SubscriptionRepository $subscriptionRepository)
    {
        $this->subscriptionRepository = $subscriptionRepository;
    }

    public function redirectToGateway(Request  $request)
     {
        $clientId = getSelectedPaymentGateway('paystack_key');
        $clientSecret = getSelectedPaymentGateway('paystack_secret');
        config([
            'paystack.publicKey' => $clientId,
            'paystack.secretKey' => $clientSecret,
            'paystack.paymentUrl' => "https://api.paystack.co",
        ]);
            $supportedCurrency = ['NGN', 'USD', 'GHS', 'ZAR', 'KES'];
            $plan = Plan::with('currency')->findOrFail($request->planId);

        if ($plan->currency->currency_code != null && !in_array(strtoupper($plan->currency->currency_code), getPayStackSupportedCurrencies())) {
            Flash::error(__('messages.placeholder.this_currency_is_not_supported_paystack'));
            return Redirect()->back();
        }
        $data = $this->subscriptionRepository->manageSubscription($request->all());

        if (!isset($data['plan'])) {
            if (isset($data['status']) && $data['status'] == true) {
                Flash::error(__('messages.subscription_pricing_plans.has_been_subscribed'));
                return Redirect()->back();
            } else {
                if (isset($data['status']) && $data['status'] == false) {
                    Flash::error(__('messages.placeholder.cannot_switch_to_zero'));
                    return Redirect()->back();
                }
            }
        }
        $subscriptionsPricingPlan = $data['plan'];
        $subscription = $data['subscription'];

        try {
            $request->merge([
                'email' => $request->user()->email,
                'orderID' => $subscription->id,
                'amount' => $data['amountToPay'] * 100,
                'quantity' => 1,
                'currency' => $plan->currency->currency_code,
                'reference' => Paystack::genTranxRef(),
                'metadata' => json_encode(['subscription_id' => $subscription->id]),
            ]);

            return Paystack::getAuthorizationUrl()->redirectNow();
        } catch (\Exception $e) {
            Flash::error(__('messages.setting.paystack_credential'));
            return Redirect()->back();
        }

    }

    public function handleGatewayCallback(Request $request)
    {
        $clientId = getSelectedPaymentGateway('paystack_key');
        $clientSecret = getSelectedPaymentGateway('paystack_secret');
        config([
            'paystack.publicKey' => $clientId,
            'paystack.secretKey' => $clientSecret,
            'paystack.paymentUrl' => "https://api.paystack.co",
        ]);
        $response = Paystack::getPaymentData();
        $transactionID = $response['data']['id'];
        $transactionAmount = $response['data']['requested_amount'] / 100;
        $subscriptionId = $response['data']['metadata']['subscription_id'] ?? null;

        try {
         if(isset($subscriptionId)){
                  Subscription::findOrFail($subscriptionId)->update([
                           'payment_type' => Subscription::PAYSTACK,
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
                           'type' => Transaction::PAYSTACK,
                           'amount' => $transactionAmount,
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
                $amount = $transactionAmount * $affiliateAmount / 100;
                AffiliateUser::whereUserId(getLogInUserId())->where('amount', 0)->withoutGlobalScopes()->update(['amount' => $amount,'is_verified' => 1]);
            }

                           $userEmail = getLogInUser()->email;
                           $firstName = getLogInUser()->first_name;
                           $lastName =  getLogInUser()->last_name;
                           $emailData = [
                               'first_name' => $firstName,
                               'last_name' => $lastName,
                               'planName' => $planName,
                           ];

                       manageVcards();
                       Mail::to($userEmail)->send(new SubscriptionPaymentSuccessMail($emailData));

                       return view('sadmin.plans.payment.paymentSuccess');
         }else{
                  $orderId = session()->get('order_id');
                  $type = NfcOrders::PAYSTACK;
                  $transactionId = $response['data']['id'];
                  $amount = $response['data']['requested_amount']/100;
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

                  NfcOrderTransaction::create($transactionDetails);

                  session()->forget(['vcard_user_id', 'tenant_id', 'vcard_id', 'order_details', 'order_id']);

                  $vcardName = Vcard::find($nfcOrder['vcard_id'])->name;
                  $cardType = Nfc::find($nfcOrder['card_type'])->name;

                  Mail::to(getSuperAdminSettingValue('email'))->send(new AdminNfcOrderMail($nfcOrder, $vcardName, $cardType));

                      Flash::success(__('messages.nfc.order_placed_success'));

                  return redirect(route('user.orders'));
         }
        } catch (HttpException $ex) {
            print_r($ex->getMessage());
        }
    }

    public function nfcOrder($orderId, $email, $nfc, $currency)
    {
        $clientId = getSelectedPaymentGateway('paystack_key');
        $clientSecret = getSelectedPaymentGateway('paystack_secret');
        config([
            'paystack.publicKey' => $clientId,
            'paystack.secretKey' => $clientSecret,
            'paystack.paymentUrl' => "https://api.paystack.co",
        ]);

        try {
            $data = [
                'email' => $nfc->email,
                'orderID' => $orderId,
                'amount' => $nfc->nfcCard->price * $nfc->quantity * 100,
                'quantity' => 1,
                'currency' => $currency,
                'reference' => Paystack::genTranxRef(),
                'metadata' => json_encode(['nfc_id' => $orderId]),
            ];
            $result = Paystack::getAuthorizationUrl($data)->redirectNow();

            session()->put(['order_details' => $nfc,'order_id' => $orderId]);
            return $result;

        } catch (\Exception $e) {
            Flash::error(__('messages.setting.paystack_credential'));
            return Redirect()->back();
        }

    }

}
