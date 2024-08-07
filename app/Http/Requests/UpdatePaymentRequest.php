<?php

namespace App\Http\Requests;

use App\Models\Plan;
use Illuminate\Foundation\Http\FormRequest;

class UpdatePaymentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        $rules = [];
        $paymentGateways = request()->payment_gateway;

        if (isset($paymentGateways[Plan::STRIPE])) {
            $rules['stripe_key'] = 'required';
            $rules['stripe_secret'] = 'required';
        }
        if (isset($paymentGateways[Plan::PAYPAL])) {
            $rules['paypal_client_id'] = 'required';
            $rules['paypal_secret'] = 'required';
        }
        if (isset($paymentGateways[Plan::RAZORPAY])) {
            $rules['razorpay_key'] = 'required';
            $rules['razorpay_secret'] = 'required';
        }
        if (isset($paymentGateways[Plan::PAYSTACK])) {
            $rules['paystack_key'] = 'required';
            $rules['paystack_secret'] = 'required';
        }
        if (isset($paymentGateways[Plan::FLUTTERWAVE])) {
            $rules['flutterwave_key'] = 'required';
            $rules['flutterwave_secret'] = 'required';
        }
        if (isset($paymentGateways[Plan::PHONEPE])) {
            $rules['phonepe_merchant_id'] = 'required';
            $rules['phonepe_merchant_user_id'] = 'required';
            $rules['phonepe_env'] = 'required';
            $rules['phonepe_salt_key'] = 'required';
            $rules['phonepe_salt_index'] = 'required';
        }

        return $rules;
    }
}
