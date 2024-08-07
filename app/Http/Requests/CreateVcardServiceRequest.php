<?php

namespace App\Http\Requests;

use App\Models\VcardService;
use Illuminate\Foundation\Http\FormRequest;

class CreateVcardServiceRequest extends FormRequest
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
        return VcardService::$rules;
    }

    public function messages(): array
    {
        return [
            'name.string' => 'The name field is required.',
            'description.string' => 'The description field is required.',
            //            'service_url.url'     => 'The Service URL must be a valid URL'
            'service_icon' => (__('messages.flash.vcard_service_icon')),
        ];
    }
}
