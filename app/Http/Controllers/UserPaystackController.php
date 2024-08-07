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
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Laracasts\Flash\Flash;
use Unicodeveloper\Paystack\Facades\Paystack;

class UserPaystackController extends Controller
{

    public function handleGatewayCallback(Request $request)
    {
        $userId = session()->get('vcard_user_id');
        $currencyCode = Currency::whereId(getUserSettingValue('currency_id', $userId))->first();
        $clientId = getUserSettingValue('paystack_key',$userId);
        $clientSecret = getUserSettingValue('paystack_secret',$userId);
        config([
            'paystack.publicKey' => $clientId,
            'paystack.secretKey' => $clientSecret,
            'paystack.paymentUrl' => "https://api.paystack.co",
        ]);

            $response = Paystack::getPaymentData();
            $tenantId = session()->get('tenant_id');
            $amount = $response['data']['requested_amount']/100;
            $currencyCode = $response['data']['currency'];
            $currencyId = Currency::whereCurrencyCode($currencyCode)->first()->id;
            $transactionId = $response['data']['id'];
            $vcardId = $response['data']['metadata']['vcard_id'] ?? null;
            $vcard = Vcard::with('tenant.user')->where('id', $vcardId)->first();

            if($vcardId){
                  $transactionDetails = [
                           'vcard_id' => $vcardId,
                           'transaction_id' => $transactionId,
                           'currency_id' => $currencyId,
                           'amount' => $amount,
                           'tenant_id' => $tenantId,
                           'type' => Appointment::PAYSTACK,
                           'status' => Transaction::SUCCESS,
                           'meta' => json_encode($response),
                       ];

                       $appointmentTran = AppointmentTransaction::create($transactionDetails);
                       $appointmentInput = session()->get('appointment_details');
                       session()->forget('appointment_details');
                       $appointmentInput['appointment_tran_id'] = $appointmentTran->id;
                       $appointmentInput['vcard_id'] = $vcardId;
                       /** @var AppointmentRepository $appointmentRepo */
                       $appointmentRepo = App::make(AppointmentRepository::class);
                       $vcardEmail = is_null($vcard->email) ? $vcard->tenant->user->email : $vcard->email;
                       $appointmentRepo->appointmentStoreOrEmail($appointmentInput, $vcardEmail);

                       session()->forget(['vcard_user_id', 'tenant_id', 'vcard_id']);

                       Flash::success(__('messages.placeholder.payment_done'));
                       App::setLocale(session::get('languageChange_'. $vcard->url_alias));

                       return redirect(route('vcard.show', [$vcard->url_alias, __('messages.placeholder.appointment_created')]));
            }
            else  {
                  $input = session()->get('input');
                  $product = Product::whereId($input['product_id'])->first();
                  $userId = $product->vcard->user->id;

                  $clientId = getUserSettingValue('paystack_key', $userId);
                  $clientSecret = getUserSettingValue('paystack_secret', $userId);
                  config([
                      'paystack.publicKey' => $clientId,
                      'paystack.secretKey' => $clientSecret,
                      'paystack.paymentUrl' => "https://api.paystack.co",
                  ]);

                  if (empty($product->currency_id)) {
                      $product->currency_id = getUserSettingValue('currency_id', $userId);
                  }
                  $currencyId = Currency::whereId($product->currency_id)->first()->id;
                  try {
                      $response = Paystack::getPaymentData();
                      $amount = $response['data']['requested_amount']/100;
                      $transactionId = $response['data']['id'];

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
                  } catch (\Exception $ex) {
                      print_r($ex->getMessage());
                  }

              }
}


    public function productBuy($input, $product)
    {
        $userId = $product->vcard->user->id;

        $clientId = getUserSettingValue('paystack_key', $userId);
        $clientSecret = getUserSettingValue('paystack_secret', $userId);
        config([
            'paystack.publicKey' => $clientId,
            'paystack.secretKey' => $clientSecret,
            'paystack.paymentUrl' => "https://api.paystack.co",
        ]);

        if (empty($product->currency_id)) {
            $product->currency_id = getUserSettingValue('currency_id', $userId);
        }
        $currencyCode = Currency::whereId($product->currency_id)->first()->currency_code;
        $email = $input['email'];
        $productId = $product->id;
        $productAmount = $product->price;
        try {
            $data = [
                'email' => $email,
                'orderID' => $productId,
                'amount' => $productAmount * 100,
                'quantity' => 1,
                'currency' => $currencyCode,
                'reference' => Paystack::genTranxRef(),
                'metadata' => json_encode(['product_id' => $productId]),
            ];
            $result = Paystack::getAuthorizationUrl($data)->redirectNow();
            session()->put([ 'input' => $input]);
            session()->put([ 'vcard_user_id' => $userId]);
            return $result;

        } catch (\Exception $e) {
            Flash::error(__('messages.setting.paystack_credential'));
            return Redirect()->back();
        }

    }
}
