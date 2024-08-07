<?php

namespace App\Http\Requests;
use App\Models\Banner;
use Illuminate\Foundation\Http\FormRequest;

class HomeBannerRequest extends FormRequest
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
            'banner_url' => 'url',
            'banner_title' => 'required|string',
            'banner_description' => 'required|string',
            'banner_button' => 'required|string',
        ];
        return $rules;
    }
    public function messages(): array
    {
        return [
            'banner_url.url' => (__('messages.flash.url_required')),
        ];
    }
}

