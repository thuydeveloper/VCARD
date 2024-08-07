<?php

namespace App\Http\Controllers;

use App\Mail\SubscriptionPaymentSuccessMail;
use Laracasts\Flash\Flash;
use Illuminate\Support\Facades\Mail;
use App\Mail\AdminNfcOrderMail;
use App\Models\AffiliateUser;
use App\Models\Nfc;
use App\Models\NfcOrders;
use App\Models\NfcOrderTransaction;
use App\Models\Subscription;
use App\Models\Transaction;
use App\Models\Vcard;
use Illuminate\Http\Request;
use App\Repositories\SubscriptionRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpKernel\Exception\UnprocessableEntityHttpException;

class PhonepeController extends AppBaseController
{
    private SubscriptionRepository $subscriptionRepository;

    public function __construct(SubscriptionRepository $subscriptionRepository)
    {
        $this->subscriptionRepository = $subscriptionRepository;
    }

    public function phonePe(Request $request)
    {

        $data = $this->subscriptionRepository->manageSubscription($request->all());

        $subscription = $data['subscription'];

        $currency =$subscription->plan->currency->currency_code;
        if($currency != "INR") {
            Flash::error(__('messages.placeholder.this_currency_is_not_supported_phonepe'));
            return redirect()->back();
        }

        $email =  $request->user()->email;
        $amount = $data['amountToPay'];

        $redirectbackurl = route('phonepe-subscription-response'). '?' . http_build_query(['subscriptionId' => $subscription->id , 'userId' => getLogInUserId()]);

        $merchantId = getSelectedPaymentGateway('phonepe_merchant_id');
        $merchantUserId = getSelectedPaymentGateway('phonepe_merchant_id');
        $baseUrl = getSelectedPaymentGateway('phonepe_env') == 'production' ? 'https://api.phonepe.com/apis/hermes' : 'https://api-preprod.phonepe.com/apis/pg-sandbox';
        $saltKey = getSelectedPaymentGateway('phonepe_salt_key');
        $saltIndex = getSelectedPaymentGateway('phonepe_salt_index');
        $callbackurl = route('phonepe-subscription-response');

        config([
            'phonepe.merchantId' => $merchantId,
            'phonepe.merchantUserId' => $merchantUserId,
            'phonepe.env' => $baseUrl,
            'phonepe.saltKey' => $saltKey,
            'phonepe.saltIndex' => $saltIndex,
            'phonepe.redirectUrl' => $redirectbackurl,
            'phonepe.callBackUrl' => $callbackurl,
        ]);

        $transactionId = date('dmYhmi') . rand(111111, 999999);

        $data = array(
            'merchantId' => $merchantId,
            'merchantTransactionId' =>  $transactionId,
            'merchantUserId' => $merchantUserId,
            'amount' => $amount * 100,
            'redirectUrl' => $redirectbackurl,
            'redirectMode' => 'POST',
            'callbackUrl' => $callbackurl,
            'paymentInstrument' =>
            array(
                'type' => 'PAY_PAGE',
            ),
        );

        $encode = base64_encode(json_encode($data));

        $string = $encode . '/pg/v1/pay' . $saltKey;
        $sha256 = hash('sha256', $string);
        $finalXHeader = $sha256 . '###' . $saltIndex;

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => $baseUrl . '/pg/v1/pay',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => false,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => json_encode(['request' => $encode]),
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json',
                'X-VERIFY: ' . $finalXHeader
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);

        $rData = json_decode($response);
        $url = $rData->data->instrumentResponse->redirectInfo->url;

        return redirect()->away($url);
    }

    public function callbackPhonePe(Request $request)
    {
        $merchantId = getSelectedPaymentGateway('phonepe_merchant_id');
        $merchantUserId = getSelectedPaymentGateway('phonepe_merchant_id');
        $baseUrl = getSelectedPaymentGateway('phonepe_env') == 'production' ? 'https://api.phonepe.com/apis/hermes' : 'https://api-preprod.phonepe.com/apis/pg-sandbox';
        $saltKey = getSelectedPaymentGateway('phonepe_salt_key');
        $saltIndex = getSelectedPaymentGateway('phonepe_salt_index');
        $callbackurl = route('phonepe-subscription-response');

        config([
            'phonepe.merchantId' => $merchantId,
            'phonepe.merchantUserId' => $merchantUserId,
            'phonepe.env' => $baseUrl,
            'phonepe.saltKey' => $saltKey,
            'phonepe.saltIndex' => $saltIndex,
            'phonepe.callBackUrl' => $callbackurl,
        ]);

        $finalXHeader = hash('sha256','/pg/v1/status/'.$request['merchantId'].'/'.$request['transactionId'].$saltKey).'###'.$saltIndex;

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => $baseUrl.'/pg/v1/status/'.$request['merchantId'].'/'.$request['transactionId'],
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => false,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json',
                'accept: application/json',
                'X-VERIFY: '.$finalXHeader,
                'X-MERCHANT-ID: '.$request['merchantId']
            ),
        ));

        $responses = curl_exec($curl);
        $response = json_decode($responses);
        curl_close($curl);

        try {
            $transactionID = $response->data->transactionId;
            $transactionAmount = $response->data->amount / 100;
            $subscriptionId = request()->input('subscriptionId');
            $userId = request()->input('userId');
            Auth::loginUsingId($userId);
            Subscription::findOrFail($subscriptionId)->update([
                'payment_type' => Subscription::PHONEPE,
                'status' => Subscription::ACTIVE
            ]);
            Subscription::findOrFail($subscriptionId)->get();
            // De-Active all other subscription
            Subscription::whereTenantId(getLogInTenantId())
                ->where('id', '!=', $subscriptionId)
                ->where('status', '!=', Subscription::REJECT)
                ->update([
                    'status' => Subscription::INACTIVE,
                ]);

            $transaction = Transaction::create([
                'transaction_id' => $transactionID,
                'type' => Transaction::PHONEPE,
                'amount' => $transactionAmount,
                'status' => Subscription::ACTIVE,
                'meta' => json_encode($response),
            ]);

            // updating the transaction id on the subscription table
            $subscription = Subscription::findOrFail($subscriptionId);
            $subscription->update(['transaction_id' => $transaction->id]);

            $affiliateAmount = getSuperAdminSettingValue('affiliation_amount');
            $affiliateAmountType = getSuperAdminSettingValue('affiliation_amount_type');
            if($affiliateAmountType == 1){
                AffiliateUser::whereUserId(getLogInUserId())->where('amount', 0)->withoutGlobalScopes()->update(['amount' => $affiliateAmount,'is_verified' => 1]);
            }else if($affiliateAmountType == 2){
                $amount = $transactionAmount * $affiliateAmount / 100;
                AffiliateUser::whereUserId(getLogInUserId())->where('amount', 0)->withoutGlobalScopes()->update(['amount' => $amount,'is_verified' => 1]);
            }

            $planName = $subscription->plan->name;
            $userEmail = getLogInUser()->email;
            $firstName = getLogInUser()->first_name;
            $lastName =  getLogInUser()->last_name;
            $emailData = [
                'subscriptionId' => $subscriptionId,
                'subscriptionAmount' => $transactionAmount,
                'transactionID' => $transactionID,
                'planName' => $planName,
                'first_name' => $firstName,
                'last_name' => $lastName,
            ];

            manageVcards();
            Mail::to($userEmail)->send(new SubscriptionPaymentSuccessMail($emailData));

            return view('sadmin.plans.payment.paymentSuccess');
        } catch (\Exception $e) {
            DB::rollBack();
            throw new UnprocessableEntityHttpException($e->getMessage());
        }
    }

    public function nfcOrder($orderId, $email, $nfc, $currency)
    {
        $amount = $nfc->nfcCard->price * $nfc->quantity;
        $redirectbackurl = route('phonepe-nfcorder-response'). '?' . http_build_query(['nfcorderId' => $orderId]);


        $merchantId = getSelectedPaymentGateway('phonepe_merchant_id');
        $merchantUserId = getSelectedPaymentGateway('phonepe_merchant_id');
        $baseUrl = getSelectedPaymentGateway('phonepe_env') == 'production' ? 'https://api.phonepe.com/apis/hermes' : 'https://api-preprod.phonepe.com/apis/pg-sandbox';
        $saltKey = getSelectedPaymentGateway('phonepe_salt_key');
        $saltIndex = getSelectedPaymentGateway('phonepe_salt_index');
        $callbackurl = route('phonepe-nfcorder-response');

        config([
            'phonepe.merchantId' => $merchantId,
            'phonepe.merchantUserId' => $merchantUserId,
            'phonepe.env' => $baseUrl,
            'phonepe.saltKey' => $saltKey,
            'phonepe.saltIndex' => $saltIndex,
            'phonepe.redirectUrl' => $redirectbackurl,
            'phonepe.callBackUrl' => $callbackurl,
        ]);
        $transactionId = date('dmYhmi') . rand(111111, 999999);
        $data = array(
            'merchantId' => $merchantId,
            'merchantTransactionId' => $transactionId,
            'merchantUserId' => $merchantUserId,
            'amount' => $amount * 100,
            'redirectUrl' => $redirectbackurl,
            'redirectMode' => 'POST',
            'callbackUrl' => $callbackurl,
            'paymentInstrument' =>
            array(
                'type' => 'PAY_PAGE',
            ),
        );

        $encode = base64_encode(json_encode($data));

        $string = $encode . '/pg/v1/pay' . $saltKey;
        $sha256 = hash('sha256', $string);
        $finalXHeader = $sha256 . '###' . $saltIndex;

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => $baseUrl . '/pg/v1/pay',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => false,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => json_encode(['request' => $encode]),
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json',
                'X-VERIFY: ' . $finalXHeader
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);

        $rData = json_decode($response);
        $url = $rData->data->instrumentResponse->redirectInfo->url;

        return response()->json(['link' => $url, 'status' => 200]);

    }

    public function nfcOrderSuccess(Request $request)
    {
        $merchantId = getSelectedPaymentGateway('phonepe_merchant_id');
        $merchantUserId = getSelectedPaymentGateway('phonepe_merchant_id');
        $baseUrl = getSelectedPaymentGateway('phonepe_env') == 'production' ? 'https://api.phonepe.com/apis/hermes' : 'https://api-preprod.phonepe.com/apis/pg-sandbox';
        $saltKey = getSelectedPaymentGateway('phonepe_salt_key');
        $saltIndex = getSelectedPaymentGateway('phonepe_salt_index');
        $callbackurl = route('phonepe-subscription-response');

        config([
            'phonepe.merchantId' => $merchantId,
            'phonepe.merchantUserId' => $merchantUserId,
            'phonepe.env' => $baseUrl,
            'phonepe.saltKey' => $saltKey,
            'phonepe.saltIndex' => $saltIndex,
            'phonepe.callBackUrl' => $callbackurl,
        ]);

        $finalXHeader = hash('sha256','/pg/v1/status/'.$request['merchantId'].'/'.$request['transactionId'].$saltKey).'###'.$saltIndex;

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => $baseUrl.'/pg/v1/status/'.$request['merchantId'].'/'.$request['transactionId'],
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => false,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json',
                'accept: application/json',
                'X-VERIFY: '.$finalXHeader,
                'X-MERCHANT-ID: '.$request['merchantId']
            ),
        ));

        $responses = curl_exec($curl);
        $response = json_decode($responses);
        curl_close($curl);

        try {
            $orderId = request()->input('nfcorderId');
            $userId = NfcOrders::findOrFail($orderId)->user_id;
            Auth::loginUsingId($userId);
            $status = NfcOrders::SUCCESS;
            $nfcOrder = NfcOrders::get()->find($orderId);
            $type = NfcOrders::PHONEPE;
            $transactionId = $response->data->transactionId ;
            $amount = $response->data->amount / 100;

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
            Auth::loginUsingId($userId);
            return redirect(route('user.orders'));
        } catch (\Exception $e) {
            DB::rollBack();
            throw new UnprocessableEntityHttpException($e->getMessage());
        }
    }

}
