<?php

namespace App\Http\Requests;

use App\Models\Plan;
use Illuminate\Foundation\Http\FormRequest;

class UpdatePlanRequest extends FormRequest
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
        $rules['name'] = $rules['name'].$this->route('plan');
        if (!$this->custom_select && !$this->custom_vcard_number) {
         $rules['price'] = 'required|numeric';
         $rules['no_of_vcards'] = 'required|integer|min:1';
     }
     else {
         $rules['custom_vcard_number'] = 'required|min:1';
     }
        return $rules;
    }
    public function messages()
    {
        return [
         'custom_vcard_number.*.required_if' => 'The custom vcard numbert is required.',
         'custom_vcard_price.*.required_if' => 'The custom vcard price is required.',
        ];
    }
}
