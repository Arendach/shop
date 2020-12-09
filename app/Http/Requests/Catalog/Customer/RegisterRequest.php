<?php

namespace App\Http\Requests\Catalog\Customer;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'email'    => 'nullable|email|max:256',
            'password' => ['required', 'min:6', 'confirmed'],
            'phone'    => 'required|max:32'
            ];
    }
}