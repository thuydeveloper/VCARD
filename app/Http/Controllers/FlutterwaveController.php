<?php

namespace App\Http\Controllers;

use App\Mail\AdminNfcOrderMail;
use App\Mail\SubscriptionPaymentSuccessMail;
use App\Models\AffiliateUser;
use App\Models\Nfc;
use App\Models\NfcOrders;
use App\Models\NfcOrderTransaction;
use App\Models\Plan;
use App\Models\Subscription;
use App\Models\Transaction;
use App\Models\Vcard;
use App\Repositories\SubscriptionRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Laracasts\Flash\Flash;
use KingFlamez\Rave\Facades\Rave as FlutterWave;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpKernel\Exception\UnprocessableEntityHttpException;

class FlutterwaveController extends Controller
{
    private SubscriptionRepository $subscriptionRepository;

    public function __construct(SubscriptionRepository $subscriptionRepository)
    {
        $this->subscriptionRepository = $subscriptionRepository;
    }

    public function flutterwaveSubscription(Request $request)
    {
        $clientId = getSelectedPaymentGateway('flutterwave_key');
        $clientSecret = getSelectedPaymentGateway('flutterwave_secret');
        config([
            'flutterwave.publicKey' => $clientId,
            'flutterwave.secretKey' => $clientSecret,
        ]);

        $supportedCurrency = ['GBP', 'CAD', 'XAF', 'CLP', 'COP', 'EGP', 'EUR', 'GHS', 'GNF', 'KES', 'MWK', 'MAD', 'NGN', 'RWF', 'SLL', 'STD', 'ZAR', 'TZS', 'UGX', 'USD', 'XOF', 'ZMW'];

        $plan = Plan::with('currency')->findOrFail($request->planId);

        if ($plan->currency->currency_code != null && !in_array(strtoupper($plan->currency->currency_code), $supportedCurrency)) {
            Flash::error(__('messages.placeholder.this_currency_is_not_supported_flutterwave'));
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
        // FlutterWave
        $reference = FlutterWave::generateReference();
        $data = [
            'payment_options' => 'card,banktransfer',
            'amount' => $data['amountToPay'],
            'email' => $request->user()->email,
            'tx_ref' => $reference,
            'currency' => $plan->currency->currency_code,
            'redirect_url' => route('flutterwave.subscription.success'),
            'customer' => [
                'email' => getLogInUser()->email,
            ],
            'customizations' => [
                'title' => 'Purchase Subscription Payment',
            ],
            'meta' => [
                'subscription_id' =>  $subscription->id,
                'amount' => $data['amountToPay'] * 100,
                'payment_mode' => Subscription::FLUTTERWAVE,
            ],
        ];

        $payment = FlutterWave::initializePayment($data);

        if ($payment['status'] !== 'success') {
            return redirect(route('subscription.index'));
        }


        $url = $payment['data']['link'];
        return redirect()->away($url);
    }

    public function flutterwaveSubscriptionSuccess(Request $request)
    {
        $clientId = getSelectedPaymentGateway('flutterwave_key');
        $clientSecret = getSelectedPaymentGateway('flutterwave_secret');
        config([
            'flutterwave.publicKey' => $clientId,
            'flutterwave.secretKey' => $clientSecret,
        ]);
        $input = $request->all();
        if ($input['status'] == 'successful') {
            $transactionID = FlutterWave::getTransactionIDFromCallback();
            $flutterWaveData = FlutterWave::verifyTransaction($transactionID);
            $data = $flutterWaveData['data'];
            $amount = $data['amount'];
            $subscriptionId = $data['meta']['subscription_id'];
            Subscription::findOrFail($subscriptionId)->update([
                'payment_type' => Subscription::FLUTTERWAVE,
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
                'transaction_id' => $input['transaction_id'],
                'type' => Transaction::FLUTTERWAVE,
                'amount' => $amount,
                'status' => Subscription::ACTIVE,
                'meta' => json_encode($data),
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
            $amount = $amount * $affiliateAmount / 100;
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
        }
    }

    public function nfcOrder($orderId, $email, $nfc, $currency)
    {
        $clientId = getSelectedPaymentGateway('flutterwave_key');
        $clientSecret = getSelectedPaymentGateway('flutterwave_secret');
        config([
            'flutterwave.publicKey' => $clientId,
            'flutterwave.secretKey' => $clientSecret,
        ]);

        try {
            $reference = FlutterWave::generateReference();
            $data = [
                'payment_options' => 'card,banktransfer',
                'amount' => $nfc->nfcCard->price * $nfc->quantity,
                'email' => getLogInUser()->email,
                'tx_ref' => $reference,
                'currency' => $currency,
                'redirect_url' => route('flutterwave.nfcOrder.success'),
                'customer' => [
                    'email' => $nfc->email,
                ],
                'customizations' => [
                    'title' => 'Purchase NFC Order Payment',
                ],
                'meta' => [
                    'order_id' =>  $orderId,
                    'amount' => $nfc->nfcCard->price * $nfc->quantity,
                    'payment_mode' => Subscription::FLUTTERWAVE,
                ],
            ];

            $payment = FlutterWave::initializePayment($data);

            if ($payment['status'] !== 'success') {
                return redirect(route('user.orders'));
            }

            $url = $payment['data']['link'];
            return $url;
        } catch (\Exception $e) {
            Flash::error(__('messages.setting.paystack_credential'));
            return Redirect()->back();
        }
    }

    public function flutterwaveNfcOrderSuccess(Request $request)
    {
        $clientId = getSelectedPaymentGateway('flutterwave_key');
        $clientSecret = getSelectedPaymentGateway('flutterwave_secret');
        config([
            'flutterwave.publicKey' => $clientId,
            'flutterwave.secretKey' => $clientSecret,
        ]);
        $input = $request->all();
        if ($input['status'] == 'successful') {
            $transactionID = FlutterWave::getTransactionIDFromCallback();
            $flutterWaveData = FlutterWave::verifyTransaction($transactionID);
            $data = $flutterWaveData['data'];

            try {
                $orderId = $data['meta']['order_id'];
                $userId = NfcOrders::findOrFail($orderId)->user_id;
                $status = NfcOrders::SUCCESS;
                $nfcOrder = NfcOrders::get()->find($orderId);
                $type = NfcOrders::FLUTTERWAVE;
                $transactionId = $input['transaction_id'];
                $amount = $data['amount'];

                $transactionDetails = [
                    'nfc_order_id' => $orderId,
                    'type' => $type,
                    'transaction_id' => $transactionId,
                    'amount' => $amount,
                    'user_id' => $userId,
                    'status' =>  $status,
                ];

                NfcOrderTransaction::create($transactionDetails);

                $vcardName = Vcard::find($nfcOrder['vcard_id'])->name;
                $cardType = Nfc::find($nfcOrder['card_type'])->name;

                Mail::to(getSuperAdminSettingValue('email'))->send(new AdminNfcOrderMail($nfcOrder, $vcardName, $cardType));
                Flash::success(__('messages.nfc.order_placed_success'));
                return redirect(route('user.orders'));
            } catch (\Exception $e) {
                DB::rollBack();
                throw new UnprocessableEntityHttpException($e->getMessage());
            }
        }
    }

}
