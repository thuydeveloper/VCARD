<?php

namespace App\Http\Requests;

use App\Models\FrontTestimonial;
use Illuminate\Foundation\Http\FormRequest;

class UpdateFrontTestimonialRequest extends FormRequest
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
        $rules = FrontTestimonial::$rules;
        $rules['image'] = 'nullable|mimes:jpg,jpeg,png';

        return $rules;
    }

    public function messages(): array
    {
        return [
            'name.string' => 'The name field is required.',
            'description.string' => 'The description field is required.',
        ];
    }
}
