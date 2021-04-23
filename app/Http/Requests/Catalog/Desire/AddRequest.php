<?php

namespace App\Http\Requests\Catalog\Desire;

use Illuminate\Foundation\Http\FormRequest;

class AddRequest extends FormRequest
{
    public function authorize()
    {
        return isAuth();
    }

    public function rules()
    {
        return [
            'id' => 'required'
        ];
    }
}
