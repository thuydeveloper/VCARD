<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateFrontCmsRequest extends FormRequest
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
        return [
            'home_page_title' => 'required',
            'sub_text' => 'required',
            'home_page_banner' => 'mimes:jpg,jpeg,png',
            'website_link' => 'nullable|url',
            'facebook_link' => 'nullable|url',
            'youtube_link' => 'nullable|url',
            'reddit_link' => 'nullable|url',
            'whatsapp_link' => 'nullable|url',
            'tiktok_link' => 'nullable|url',
            'twitter_link' => 'nullable|url',
            'instagram_link' => 'nullable|url',
            'tumbir_link' => 'nullable|url',
            'linkedin_link' => 'nullable|url',
            'pinterest_link' => 'nullable|url',
        ];
    }
}
