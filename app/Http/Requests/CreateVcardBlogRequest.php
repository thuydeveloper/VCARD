<?php

namespace App\Http\Requests;

use App\Models\VcardBlog;
use Illuminate\Foundation\Http\FormRequest;

class CreateVcardBlogRequest extends FormRequest
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
        return VcardBlog::$rules;
    }

    public function messages(): array
    {
        return [
            'title.string' => 'The name field is required.',
            'description.string' => 'The description field is required.',
        ];
    }
}
