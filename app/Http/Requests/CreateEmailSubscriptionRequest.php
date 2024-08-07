<?php

namespace App\Http\Requests;

use App\Models\EmailSubscription;
use Illuminate\Foundation\Http\FormRequest;

class CreateEmailSubscriptionRequest extends FormRequest
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
        return EmailSubscription::$rules;
    }

    public function messages(): array
    {
        return [
            'email.unique' => __('messages.placeholder.email_already_subscribed'),
        ];
    }
}
