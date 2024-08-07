<?php

namespace App\Http\Requests;

use App\Models\Enquiry;
use Illuminate\Foundation\Http\FormRequest;

class CreateEnquiryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        setLocalLang(getLocalLanguage());

        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        $dynamicRules = Enquiry::$rules;
        if (!empty($this->vcard->privacy_policy) || !empty($this->vcard->term_condition)) {
            $dynamicRules['terms_condition'] = 'required';
        }
        return $dynamicRules;
    }

    public function messages(): array
    {
        return [

            'terms_condition' =>  (__('messages.placeholder.agree_term')),
        ];
    }
}
