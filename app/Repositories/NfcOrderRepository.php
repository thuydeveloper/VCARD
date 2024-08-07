<?php

namespace App\Repositories;

use App\Models\NfcOrders;
use Illuminate\Support\Facades\Mail;
use Razorpay\Api\Api;
use Stripe\Checkout\Session;
use Symfony\Component\HttpKernel\Exception\UnprocessableEntityHttpException;

/**
 * Class AppointmentRepository
 */
class NfcOrderRepository extends BaseRepository
{
    public function model(): string
    {
        return NfcOrders::class;
    }

    public function getFieldsSearchable()
    {
        //
    }

    /**
     * @param $appointment
     */
    public function userCreateSession($orderId, $email, $nfc, $currency)
    {
        setStripeApiKey();

        $successUrl = route('nfc.stripe.sucess');
        $cancelUrl = route('nfc.stripe.failed');

        $session = Session::create([
            'payment_method_types' => ['card'],
            'customer_email' => $email,
            'line_items' => [
                [
                    'price_data' => [
                        'product_data' => [
                            'name' => $nfc->nfcCard->name,
                        ],

                        'unit_amount' => $nfc->nfcCard->price * $nfc->quantity * 100,
                        'currency' => $currency,
                    ],
                    'quantity' => 1,
                ],
            ],
            'client_reference_id' => $orderId,
            'mode' => 'payment',
            'success_url' => url($successUrl) . '?session_id={CHECKOUT_SESSION_ID}&order_id=' . $orderId,
            'cancel_url' => url($cancelUrl . '?session_id={CHECKOUT_SESSION_ID}&order_id=' . $orderId),
        ]);

        session()->put([
            'order_details' => $nfc,
            'order_id' => $orderId,
        ]);

        $result = [
            'sessionId' => $session['id'],
        ];

        return $result;
    }
    public function userCreateRazorPaySession($input, $nfc, $currency)
    {

        $api = new Api(getSelectedPaymentGateway('razorpay_key'), getSelectedPaymentGateway('razorpay_secret'));
        $amount = $nfc->price * $input['quantity'] * 100;

        $orderData = [
            'receipt' => 1,
            'amount' => $amount,
            'currency' => $currency,
            'notes' => [
                'email' => $input['email'],
                'name' => $nfc->name,
                'customer_name' => $input['name'],
                'designation' => $input['designation'],
                'region_code' => $input['region_code'],
                'phone' => $input['phone'],
                'address' => $input['address'],
                'company_name' => $input['company_name'],
                'card_type' => $input['card_type'],
                'vcard_id' => $input['vcard_id'],
                'amountToPay' =>  $nfc->price * $input['quantity'],
                'payment_type' => NfcOrders::RAZOR_PAY,
            ],
        ];

        $razorpayOrder = $api->order->create($orderData);
        $data['id'] = $razorpayOrder->id;
        $data['amount'] = $amount;
        $data['name'] = $nfc->name;
        $data['email'] = $input['email'];
        $data['contact'] = $input['phone'];


        return $data;
    }
}
