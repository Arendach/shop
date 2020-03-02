<?php

namespace App\Http\Requests\Catalog\User;

use App\Rules\PasswordValid;
use App\Rules\UserExists;
use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
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
            'login' => new UserExists,
            'password' => new PasswordValid
        ];
    }
}
