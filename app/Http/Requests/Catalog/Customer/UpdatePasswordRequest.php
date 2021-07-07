<?php

namespace App\Http\Requests\Catalog\Customer;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePasswordRequest extends FormRequest
{
    public function authorize()
    {
        return isAuth();
    }

    public function rules()
    {
        return [
            'password' => ['required', 'min:6', 'confirmed']
        ];
    }
}
