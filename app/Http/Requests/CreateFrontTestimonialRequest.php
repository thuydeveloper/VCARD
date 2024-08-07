<?php

namespace App\Http\Requests;

use App\Models\FrontTestimonial;
use Illuminate\Foundation\Http\FormRequest;

class CreateFrontTestimonialRequest extends FormRequest
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
        return FrontTestimonial::$rules;
    }

    public function messages(): array
    {
        return [
            'name.string' => 'The name field is required.',
            'description.string' => 'The description field is required.',
        ];
    }
}
