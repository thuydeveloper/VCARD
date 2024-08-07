<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MobileRequest extends FormRequest
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
        $rules = [
            'mobile_app_enable' => 'boolean',
        ];

        if ($this->input('mobile_app_enable')) {
            if ($this->input('play_store_link') == null && $this->input('app_store_link') == null) {
                $rules['play_store_link'] = 'required';
            } else {
                $rules['play_store_link'] = '';
            }
            if ($this->input('play_store_link') != null) {
                $rules['play_store_link'] .= '|url';
            }
            if ($this->input('app_store_link') != null) {
                if (!isset($rules['app_store_link'])) {
                    $rules['app_store_link'] = '';
                }
                $rules['app_store_link'] .= '|url';
            }
        }

        return $rules;
    }


    public function messages()
    {
        return [
            'play_store_link.url' => __('messages.play_store_url'),
            'app_store_link.url' => __('messages.app_store_url'),
        ];
    }
}
