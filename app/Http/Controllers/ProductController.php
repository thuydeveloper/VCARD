<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Product;
use App\Models\ProductTransaction;
use App\Models\Currency;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use App\Http\Requests\ProductBuyRequest;
use App\Http\Requests\CreateProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Repositories\VcardProductRepository;
use App\Repositories\NfcOrderRepository;

class ProductController extends AppBaseController
{
    /**
     * @var VcardProductRepository
     */
    private $vcardProductRepo;

    public function __construct(VcardProductRepository $vcardProductRepo)
    {
        $this->vcardProductRepo = $vcardProductRepo;
    }

    /**
     * @param $id
     * @return mixed
     */
    public function store(CreateProductRequest $request): JsonResponse
    {
        $input = $request->all();

        $service = $this->vcardProductRepo->store($input);

        return $this->sendResponse($service, __('messages.flash.create_product'));
    }

    public function edit($id): JsonResponse
    {
        $product = Product::with('currency')->where('id', $id)->first();
        if ($product->currency) {
            $product['formatted_amount'] = getCurrencyAmount($product->price, $product->currency->currency_icon);
        }

        return $this->sendResponse($product, 'Product successfully retrieved.');
    }

    public function destroy($id): JsonResponse
    {
        $product = Product::where('id', $id)->first();
        $product->clearMediaCollection(Product::PRODUCT_PATH);
        $product->delete();

        return $this->sendSuccess('Product deleted successfully.');
    }

    public function update(UpdateProductRequest $request, $id): JsonResponse
    {
        $input = $request->all();

        $service = $this->vcardProductRepo->update($input, $id);

        return $this->sendResponse($service, __('messages.flash.update_product'));
    }

    public function buy(ProductBuyRequest $request)
    {
        $input = $request->all();

        $product = Product::with('currency','vcard.user')->whereId($input['product_id'])->first();
        $currency = isset($product->currency_id) ? $product->currency->currency_code : Currency::whereId(getUserSettingValue('currency_id', $product->vcard->user->id))->first()->currency_code;
        try {
            App::setLocale(Session::get('languageChange_' . $product->vcard->url_alias));
            DB::beginTransaction();

            if ($input['payment_method'] == Product::STRIPE) {
                /** @var VcardProductRepository $repo */
                $repo = App::make(VcardProductRepository::class);

                $result = $repo->productBuySession($input, $product);
                DB::commit();

                return $this->sendResponse([
                    'payment_method' => $input['payment_method'],
                    $result,
                ], __('messages.placeholder.stripe_created'));
            }
            // PhonePe
            if ($input['payment_method'] == Product::PHONEPE) {

                if($currency != "INR") {
                    return $this->sendError(__('messages.placeholder.this_currency_is_not_supported_phonepe'));
                }
                
                /** @var UserPhonepeController $phonepe */
                $phonepe = App::make(UserPhonepeController::class);
                $result = $phonepe->productBuy($input, $product);
                DB::commit();

                return $this->sendResponse([
                    'payment_method' => $input['payment_method'],
                    $result,
                ], __('messages.placeholder.phonepe_created'));
            }

            // Paystack
            if ($input['payment_method'] == Product::PAYSTACK) {

                if (isset($currency) && !in_array(strtoupper($currency), getPayStackSupportedCurrencies())) {
                    return $this->sendError(__('messages.placeholder.this_currency_is_not_supported_paystack'));
                }

                /** @var UserPaystackController $paystack */
                $paystack = App::make(UserPaystackController::class);
                $result = $paystack->productBuy($input, $product);
                $targetUrl = $result->getTargetUrl();
                DB::commit();
                return $this->sendResponse(['payment_method' => $input['payment_method'], $targetUrl], __('messages.placeholder.paystack_created'));
            }

            // Flutterwave
            if ($input['payment_method'] == Product::FLUTTERWAVE) {
                $supportedCurrency = ['GBP', 'CAD', 'XAF', 'CLP', 'COP', 'EGP', 'EUR', 'GHS', 'GNF', 'KES', 'MWK', 'MAD', 'NGN', 'RWF', 'SLL', 'STD', 'ZAR', 'TZS', 'UGX', 'USD', 'XOF', 'ZMW'];
                if (isset($currency) && !in_array(strtoupper($currency), $supportedCurrency)) {
                    return $this->sendError(__('messages.placeholder.this_currency_is_not_supported_flutterwave'));
                }

                /** @var UserFlutterwaveController $flutterwave */
                $flutterwave = App::make(UserFlutterwaveController::class);
                $targetUrl = $flutterwave->productBuy($input, $product);
                DB::commit();
                return $this->sendResponse(['payment_method' => $input['payment_method'], $targetUrl], __('messages.placeholder.flutterwave_created'));
            }

            // Razor Pay
            if ($input['payment_method'] == Product::RAZORPAY) {

                $repo = App::make(VcardProductRepository::class);

                $result = $repo->userCreateRazorPaySession($input, $product , $currency);
                $result['payment_method']=$input['payment_method'];
                $userId = $product->vcard->user->id;
                $product = Product::find($input['product_id']);
                Session::put('productId', $product);
                DB::commit();

                return $this->sendResponse([$result
                 ], __('messages.nfc.razorpay_session_success'));

            }

            //manually
            if ($input['payment_method'] == Product::MANUALLY) {

                $product = Product::find($input['product_id']);

                ProductTransaction::create([
                    'name' => $input['name'],
                    'email' => $input['email'],
                    'phone' => $input['phone'],
                    'address' => $input['address'],
                    'type' => $input['payment_method'],
                    'product_id' => $input['product_id'],
                    'currency_id' => $product->currency_id,
                    'amount' => $product->price,
                    'status'=> 1,
                ]);
                $result['payment_method']=$input['payment_method'];
                DB::commit();

                return $this->sendResponse([$result
                 ], __('messages.flash.product_purchase_success'));
            }

            //PayPal
            if ($input['payment_method'] == Product::PAYPAL) {
                if (isset($currency) && !in_array(strtoupper($currency), getPayPalSupportedCurrencies())) {

                    return $this->sendError(__('messages.placeholder.this_currency_is_not_supported'));
                }

                /** @var PaypalController $payPalCont */
                $payPalCont = App::make(PaypalController::class);

                $result = $payPalCont->buyProductOnboard($input, $product);

                DB::commit();

                return $this->sendResponse([
                    'payment_method' => $input['payment_method'],
                    $result,
                ], __('messages.placeholder.paypal_created'));
            }
        } catch (Exception $e) {
            DB::rollBack();

            return $this->sendError($e->getMessage());
        }
    }

        public function updateProductStatus($id, $status)
    {
        $product = ProductTransaction::find($id);

        if (!$product) {
            return redirect()->back()->with('error', 'Product not found.');
        }
        $product->status = $status;
        $product->save();

        return redirect()->back()->with('success',  __('messages.flash.product_status_change'));
    }
}
