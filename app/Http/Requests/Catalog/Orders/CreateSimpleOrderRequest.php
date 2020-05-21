<?php

namespace App\Http\Requests\Catalog\Orders;

use Illuminate\Foundation\Http\FormRequest;

class CreateSimpleOrderRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name'  => 'required',
            'phone' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'name'  => translate('Вкажіть ваше імя'),
            'phone' => translate('Заповніть номер телефону')
        ];
    }
}
