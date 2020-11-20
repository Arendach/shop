<?php

namespace App\Http\Requests\Catalog\Orders;

use Illuminate\Foundation\Http\FormRequest;

class CreateSimpleOrderRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'id'    => 'required|exists:products,id',
            'name'  => 'required',
            'phone' => 'required'
        ];
    }

    public function messages(): array
    {
        return [
            'name'  => translate('Вкажіть ваше імя'),
            'phone' => translate('Заповніть номер телефону')
        ];
    }
}
