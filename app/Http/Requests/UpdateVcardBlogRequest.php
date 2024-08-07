<?php

namespace App\Http\Requests;

use App\Models\VcardBlog;
use Illuminate\Foundation\Http\FormRequest;

class UpdateVcardBlogRequest extends FormRequest
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
        $rules = VcardBlog::$rules;
        $rules['blog_icon'] = 'nullable|mimes:jpg,jpeg,png';

        return $rules;
    }

    public function messages(): array
    {
        return [
            'title.string' => 'The name field is required.',
            'description.string' => 'The description field is required.',
        ];
    }
}
