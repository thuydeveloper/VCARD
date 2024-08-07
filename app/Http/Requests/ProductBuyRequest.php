<?php

namespace App\Http\Requests;

use App\Models\Product;
use Illuminate\Foundation\Http\FormRequest;

class ProductBuyRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        $product = Product::whereId($this->product_id)->first();

        $dynamicRules = [
            'name' => 'required',
            'email' => 'required|email:filter',
            'address' => 'required',
            'payment_method' => 'required',
        ];

        if (!empty($product->vcard->privacy_policy) || !empty($product->vcard->term_condition)) {
            $dynamicRules['product_terms'] = 'required';
        }

        return $dynamicRules;
    }
    public function messages(): array
    {
        return [

            'product_terms' =>  (__('messages.placeholder.agree_term')),
        ];
    }
}
