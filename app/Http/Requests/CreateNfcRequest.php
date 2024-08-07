<?php

namespace App\Http\Requests;

use App\Models\Nfc;
use Illuminate\Foundation\Http\FormRequest;

class CreateNfcRequest extends FormRequest
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
        return Nfc::$rules;
    }

    public function messages(): array
    {
        return [
            'nfc_img' =>  (__('messages.nfc.nfc_image_required')),
            'nfc_back_img' =>  (__('messages.nfc.nfc_back_image_required')),
        ];
    }
}
