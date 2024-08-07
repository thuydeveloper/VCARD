<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class CreateRegisterRequest extends FormRequest
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
        $rules = User::$rules;
        $rules['contact'] = 'required';
        $rules['password'] = 'required|same:password_confirmation|min:8';
        $rules['term_policy_check'] = 'required';

        if (getSuperAdminSettingValue('captcha_enable')) {
            $rules['g-recaptcha-response'] = 'required|recaptcha';
        }
        return $rules;
    }

    public function messages(): array
    {
        return [
            'term_policy_check.required' => __('messages.placeholder.agree_term'),
            'g-recaptcha-response.required' =>  __('messages.placeholder.required_captcha'),
        ];
    }
}
