<?php

namespace App\Http\Requests\Catalog\User;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\EmailUnique;
use App\Rules\PhoneUnique;

class RegisterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return !isAuth();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|min:2|max:64',
            'email' => ['email', 'max:64', new EmailUnique],
            'phone' => ['phone', new PhoneUnique],
            'password' => 'min:8|max:32|confirmed'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => __('user.validation.name.required'),
            'name.min' => __('user.validation.name.min'),
            'name.max' => __('user.validation.name.max'),
            'email.email' => __('user.validation.email.email'),
            'email.max' => __('user.validation.email.max'),
            'password.min' => __('user.validation.password.min'),
            'password.max' => __('user.validation.password.max'),
            'password.confirmed' =>  __('user.validation.password.confirmed')
        ];
    }
}
