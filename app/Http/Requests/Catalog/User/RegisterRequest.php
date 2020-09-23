<?php

namespace App\Http\Requests\Catalog\User;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    public function authorize(): bool
    {
        return !isAuth();
    }

    public function rules(): array
    {
        return [
            'name'     => 'required|min:2|max:64',
            'email'    => 'required|email|max:64|unique:customers,email',
            'phone'    => 'required|unique:customers,phone',
            'password' => 'required|min:8|max:32|confirmed',

        ];
    }

    public function messages(): array
    {
        return [
            'name.required'      => translate('Заповніть імя'),
            'email.email'        => translate('Заповніть Email'),
            'password.confirmed' => translate('Паролі не співпадають')
        ];
    }
}
