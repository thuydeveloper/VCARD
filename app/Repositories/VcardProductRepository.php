<?php

namespace App\Repositories;

use App\Models\Currency;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Stripe\Checkout\Session;
use Razorpay\Api\Api;
use Symfony\Component\HttpKernel\Exception\UnprocessableEntityHttpException;

class VcardProductRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
    ];

    /**
     * Return searchable fields
     */
    public function getFieldsSearchable(): array
    {
        return $this->fieldSearchable;
    }

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Product::class;
    }

    /**
     * @return mixed
     */
    public function store($input)
    {
        try {
            DB::beginTransaction();

            $vcardProduct = Product::create($input);

            if (isset($input['product_icon']) && ! empty($input['product_icon'])) {
                $vcardProduct->newAddMedia($input['product_icon'])->toMediaCollection(Product::PRODUCT_PATH,
                    config('app.media_disc'));
            }

            DB::commit();

            return $vcardProduct;
        } catch (Exception $e) {
            DB::rollBack();

            throw new UnprocessableEntityHttpException($e->getMessage());
        }
    }

    /**
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model
     */
    public function update($input,$id)
    {
        try {
            DB::beginTransaction();

            $vcardProduct = Product::findOrFail($id);
            $vcardProduct->update($input);

            if (isset($input['product_icon']) && ! empty($input['product_icon'])) {
                $vcardProduct->newClearMediaCollection($input['product_icon'],Product::PRODUCT_PATH);
                $vcardProduct->newAddMedia($input['product_icon'])->toMediaCollection(Product::PRODUCT_PATH,
                    config('app.media_disc'));
            }

            DB::commit();

            return $vcardProduct;
        } catch (Exception $e) {
            DB::rollBack();

            throw new UnprocessableEntityHttpException($e->getMessage());
        }
    }

    public function productBuySession($input, $product){
        try {
            $userId = $product->vcard->user->id;
            if (empty($product->currency_id)) {
                $product->currency_id = getUserSettingValue('currency_id', $userId);
            }
            $currencyCode = Currency::whereId($product->currency_id)->first()->currency_code;
            setUserStripeApiKey($userId);

            $successUrl = route('buy.product.success');
            $cancelUrl = route('buy.product.failed');

            $session = Session::create([
                'payment_method_types' => ['card'],
                'customer_email' => $input['email'],
                'line_items' => [
                    [
                        'price_data' => [
                            'product_data' => [
                                'name' => $product->name,
                            ],
                            'unit_amount' => $product->price * 100,
                            'currency' => $currencyCode,
                        ],
                        'quantity' => 1,
                    ],
                ],
                'client_reference_id' => $product->id,
                'mode' => 'payment',
                'success_url' => url($successUrl).'?session_id={CHECKOUT_SESSION_ID}',
                'cancel_url' => url($cancelUrl).'?error=payment_cancelled',
            ]);

            session()->put(['input' => $input]);

            $result = [
                'sessionId' => $session['id'],
            ];

            return $result;
        } catch (\Exception $e) {
            throw new UnprocessableEntityHttpException($e->getMessage());
        }
    }

    public function userCreateRazorPaySession($input, $product, $currency)
    {
        $userId = $product->vcard->user->id;
        $api = new Api(getUserSettingValue('razorpay_key', $userId), getUserSettingValue('razorpay_secret', $userId));
        $amount = $product->price * 100;
        $orderData = [
            'receipt' => 1,
            'amount' => $amount,
            'currency' => $currency,
            'notes' => [
                'email' => $input['email'],
                'name' => $input['name'],
                'phone' => $input['phone'],
                'address' => $input['address'],
                'amountToPay' => $product->price,
                'payment_type' => Product::RAZORPAY,
            ],
        ];
        $razorpayOrder = $api->order->create($orderData);
        $data['id'] = $razorpayOrder->id;
        $data['amount'] = $product->price;
        $data['name'] = $input['name'];
        $data['email'] = $input['email'];
        $data['contact'] = $input['phone'];

        return $data;
    }
}

