<?php

namespace App\Http\Requests;

use App\Models\NfcOrders;
use Illuminate\Foundation\Http\FormRequest;

class NfcOrderRequest extends FormRequest
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
        return NfcOrders::$rules;
    }

    public function messages(): array
    {
        return [
            'card_type.required' => (__('messages.nfc.select_card')),
            'vcard_id.required' => (__('messages.nfc.required_vcard')),
            'vcard_id.integer' => (__('messages.nfc.required_vcard')),
            'logo' => (__('messages.nfc.required_logo')),
            'phone.integer' => (__('message.nfc.required_phone')),
        ];
    }
}
