<?php

namespace App\Http\Requests\Catalog\User;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\EmailUnique;
use App\Rules\PhoneUnique;

class RegisterRequest extends FormRequest
{
    public function authorize()
    {
        return !isAuth();
    }

    public function rules()
    {
        return [
            'first_name' => 'required|min:2|max:64',
            'last_name'  => 'required|min:2|max:64',
            'email'      => 'required|email|max:64|unique:customers,email',
            'phone'      => 'required|unique:customers,phone',
            'password'   => 'required|min:8|max:32|confirmed'
        ];
    }

    public function messages()
    {
        return [
            'first_name.required' => translate('Заповніть імя'),
            'last_name.required'  => translate('Заповніть прізвище'),
            'email.email'         => translate('Заповніть Email'),
            'password.confirmed'  => translate('Паролі не співпадають')
        ];
    }
}
