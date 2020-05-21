<?php

namespace App\Http\Requests\Catalog\Customer;

use Illuminate\Foundation\Http\FormRequest;

class UpdateContactsRequest extends FormRequest
{
    public function authorize()
    {
        return isAuth();
    }

    public function rules()
    {
        return [
            'first_name' => 'required|max:64',
            'last_name'  => 'required|max:64',
        ];
    }

    public function attributes()
    {
        return [
            'first_name' => translate('Імя'),
            'last_name'  => translate('Прізвище'),
        ];
    }
}
