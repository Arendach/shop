<?php

namespace App\Http\Requests\Catalog\User;

use App\Rules\PasswordValid;
use App\Rules\UserExists;
use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{
    public function authorize()
    {
        return !isAuth();
    }

    public function rules()
    {
        return [
            'login'    => new UserExists,
            'password' => new PasswordValid
        ];
    }
}
