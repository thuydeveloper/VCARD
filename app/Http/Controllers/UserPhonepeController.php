<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\AppointmentTransaction;
use App\Models\Currency;
use App\Models\Product;
use App\Models\ProductTransaction;
use App\Models\Transaction;
use App\Models\Vcard;
use App\Repositories\AppointmentRepository;
use Illuminate\Http\Request;
use GeoIp2\Exception\HttpException;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Laracasts\Flash\Flash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpKernel\Exception\UnprocessableEntityHttpException;


class UserPhonepeController extends Controller
{
    public function appointmentBook($userId, $vcard, $input)
    {
        $amount = $input['amount'];
        $phone = $input['phone'];

        $redirectbackurl = route('phonepe-appointmentbook-response'). '?' . http_build_query(['input' => $input]);

        $merchantId = getUserSettingValue('phonepe_merchant_id', $userId);
        $merchantUserId = getUserSettingValue('phonepe_merchant_id', $userId);
        $baseUrl = getUserSettingValue('phonepe_env', $userId) == 'production' ? 'https://api.phonepe.com/apis/hermes' : 'https://api-preprod.phonepe.com/apis/pg-sandbox';
        $saltKey = getUserSettingValue('phonepe_salt_key', $userId);
        $saltIndex = getUserSettingValue('phonepe_salt_index', $userId);
        $callbackurl = route('phonepe-appointmentbook-response');

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
            'mobileNumber' => $phone,
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

    public function appointmentBookSuccess(Request $request)
    {

        $input = request()->input('input');
        $vcard = Vcard::with('tenant.user')->where('id', $input['vcard_id'])->first();
        $userId = $vcard->tenant->user->id;

        $merchantId = getUserSettingValue('phonepe_merchant_id', $userId);
        $merchantUserId = getUserSettingValue('phonepe_merchant_id', $userId);
        $baseUrl = getUserSettingValue('phonepe_env', $userId) == 'production' ? 'https://api.phonepe.com/apis/hermes' : 'https://api-preprod.phonepe.com/apis/pg-sandbox';
        $saltKey = getUserSettingValue('phonepe_salt_key', $userId);
        $saltIndex = getUserSettingValue('phonepe_salt_index', $userId);
        $callbackurl = route('phonepe-appointmentbook-response');

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

            $transactionId = $response->data->transactionId;
            // Auth::loginUsingId($userId);
            $currencyId = Currency::whereCurrencyCode($input['currency_code'])->first()->id;
            $tenantId = $vcard->tenant->id;
            $amount = $input['amount'];

            $transactionDetails = [
                'vcard_id' => $vcard->id,
                'transaction_id' => $transactionId,
                'currency_id' => $currencyId,
                'amount' => $amount,
                'tenant_id' => $tenantId,
                'type' => Appointment::PHONEPE,
                'status' => Transaction::SUCCESS,
                'meta' => json_encode($response),
            ];

            $appointmentTran = AppointmentTransaction::create($transactionDetails);

            $appointmentInput = [
                'name' => $input['name'],
                'email' => $input['email'],
                'date' => $input['date'],
                'phone' => $input['phone'],
                'from_time' => $input['from_time'],
                'to_time' => $input['to_time'],
                'vcard_id' => $input['vcard_id'],
                'appointment_tran_id'=> $appointmentTran->id,
                'toName' => $vcard->fullName > 1 ? $vcard->fullName : $vcard->tenant->user->fullName,
                'vcard_name' => $vcard->name,
            ];

            /** @var AppointmentRepository $appointmentRepo */
            $appointmentRepo = App::make(AppointmentRepository::class);
            $vcardEmail = is_null($vcard->email) ? $vcard->tenant->user->email : $vcard->email;
            $appointmentRepo->appointmentStoreOrEmail($appointmentInput, $vcardEmail);

            Flash::success(__('messages.placeholder.payment_done'));
            App::setLocale(session::get('languageChange_'. $vcard->url_alias));
            return redirect(route('vcard.show', [$vcard->url_alias, __('messages.placeholder.appointment_created')]));

        } catch (\Exception $e) {
            DB::rollBack();
            throw new UnprocessableEntityHttpException($e->getMessage());
        }

    }

    public function productBuy($input, $product)
    {
        $amount = $product->price;
        $phone = $input['phone'];
        $userId = $product->vcard->user->id;
        $redirectbackurl = route('phonepe-Product-response'). '?' . http_build_query(['input' => $input]);

        $merchantId = getUserSettingValue('phonepe_merchant_id', $userId);
        $merchantUserId = getUserSettingValue('phonepe_merchant_id', $userId);
        $baseUrl = getUserSettingValue('phonepe_env', $userId) == 'production' ? 'https://api.phonepe.com/apis/hermes' : 'https://api-preprod.phonepe.com/apis/pg-sandbox';
        $saltKey = getUserSettingValue('phonepe_salt_key', $userId);
        $saltIndex = getUserSettingValue('phonepe_salt_index', $userId);
        $callbackurl = route('phonepe-Product-response');

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
            'mobileNumber' => $phone,
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

    public function productBuySuccess(Request $request)
    {

        $input = request()->input('input');
        $product = Product::whereId($input['product_id'])->first();
        $currencyId = isset($product->currency) ? $product->currency->id : Currency::whereId(getUserSettingValue('currency_id', $product->vcard->user->id))->first()->id;
        $userId = $product->vcard->user->id;

        $merchantId = getUserSettingValue('phonepe_merchant_id', $userId);
        $merchantUserId = getUserSettingValue('phonepe_merchant_id', $userId);
        $baseUrl = getUserSettingValue('phonepe_env', $userId) == 'production' ? 'https://api.phonepe.com/apis/hermes' : 'https://api-preprod.phonepe.com/apis/pg-sandbox';
        $saltKey = getUserSettingValue('phonepe_salt_key', $userId);
        $saltIndex = getUserSettingValue('phonepe_salt_index', $userId);
        $callbackurl = route('phonepe-Product-response');

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
            $transactionId = $response->data->transactionId;
            $amount =  $response->data->amount /100;
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
                'transaction_id' => $transactionId,
                'amount' => $amount,
        ]);

        $vcard = $product->vcard;
        App::setLocale(Session::get('languageChange_'. $vcard->url_alias));
        session()->forget('input');
        DB::commit();

        return redirect(route('showProducts', [$vcard->id, $vcard->url_alias, __('messages.placeholder.product_purchase')]));
        } catch (\Exception $e) {
            DB::rollBack();
            throw new UnprocessableEntityHttpException($e->getMessage());
        }

    }
}
