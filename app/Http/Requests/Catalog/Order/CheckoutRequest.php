<?php

namespace App\Http\Requests\Catalog\Order;

use Illuminate\Foundation\Http\FormRequest;

class CheckoutRequest extends FormRequest
{
    public function authorize()
    {
        return isAuth();
    }

    public function rules()
    {
        return [
            'first_name' => 'required',
            'phone'      => 'required',
            //'phone'      => 'regex:/[0-9]{3}-[0-9]{3}-[0-9]{2}-[0-9]{2}/',
            'email'      => 'email',
            'comment'    => 'max:1024'
        ];
    }
}
