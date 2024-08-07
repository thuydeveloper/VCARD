<?php

namespace App\Http\Requests;

use App\Models\Nfc;
use Illuminate\Foundation\Http\FormRequest;

class UpdateNfcCardRequest extends FormRequest
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

            $rules = Nfc::$rules;
            $rules['nfc_img'] = 'nullable|mimes:jpg,jpeg,png';
            $rules['nfc_back_img'] = 'nullable|mimes:jpg,jpeg,png';

            return $rules;

    }
}
