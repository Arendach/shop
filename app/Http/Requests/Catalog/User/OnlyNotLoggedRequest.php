<?php

namespace App\Http\Requests\Catalog\User;

use Illuminate\Foundation\Http\FormRequest;

class OnlyNotLoggedRequest extends FormRequest
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

    public function rules()
    {
        return [];
    }
}
