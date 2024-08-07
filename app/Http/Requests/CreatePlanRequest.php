<?php

namespace App\Http\Requests;

use App\Models\Plan;
use AWS\CRT\HTTP\Request;
use Illuminate\Foundation\Http\FormRequest;

class CreatePlanRequest extends FormRequest
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
     */
    public function rules(): array
    {
        $rules = Plan::$rules;
        if (!$this->custom_select) {
            $rules['no_of_vcards'] = 'required|integer|min:1';

        }
        else{
         $rules['custom_vcard_number'] = 'required|min:1';
        }

        return $rules;
    }
    public function messages()
    {
        return [
         'custom_vcard_number.*.required' => 'The custom vcard number field is required.',
         'custom_vcard_number.*.numeric' => 'The custom vcard number must be a number.',
         'custom_vcard_price.*.required' => 'The custom vcard price field is required.',
         'custom_vcard_price.*.numeric' => 'The custom vcard price must be a number.',

        ];
    }
}
