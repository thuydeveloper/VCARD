<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Iframe;


class UpdateiframeRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $rules = Iframe::$rules;

        return $rules;
    }

    public function messages(): array
    {
        return [
            'url.required' => (('messages.flash.url_required')),
            'url.url' => (('messages.flash.url_is_valid')),
        ];
    }
}
