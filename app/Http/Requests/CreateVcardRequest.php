<?php

namespace App\Http\Requests;

use App\Models\Vcard;
use Illuminate\Foundation\Http\FormRequest;

class CreateVcardRequest extends FormRequest
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
        $rules = Vcard::$rules;
        $rules['profile_img'] = 'mimes:jpg,bmp,png,apng,avif,jpeg,';
        $rules['cover_img'] = 'mimes:jpg,bmp,png,apng,avif,jpeg,mp4,mpeg,ogg,webm,3gp,mov,flv,avi,wmv,ts|max:10240';
        return $rules;
    }

    /**
     * @return string[]
     */
    public function messages(): array
    {
        return [
            'url_alias.string' => __('messages.vcard.alias_url_required'),
            'name.string' => __('messages.vcard.vcard_name_required'),
            'url_alias.min' => __('messages.vcard.alias_url_min'),
            'url_alias.max' => __('messages.vcard.alias_url_max'),
            'url_alias.unique' => __('messages.vcard.alias_url_unique'),
            'cover_img.max' => __('messages.vcard.cover_img_max'),
        ];
    }
}
