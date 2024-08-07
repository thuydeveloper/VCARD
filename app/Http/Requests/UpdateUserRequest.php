<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
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
        $requestId = $this->route('user') !== null ? $this->route('user')->id : $this->route('admin');
        $rules = User::$rules;
        $rules['profile'] = 'mimes:jpg,bmp,png,apng,avif,jpeg,';
        $rules['email'] = 'required|email|regex:/(.*)@(.*)\.(.*)/|unique:users,email,'.$requestId;

        return $rules;
    }
}
