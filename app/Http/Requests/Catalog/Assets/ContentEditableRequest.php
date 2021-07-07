<?php

namespace App\Http\Requests\Catalog\Assets;

use Illuminate\Foundation\Http\FormRequest;

class ContentEditableRequest extends FormRequest
{
    public function authorize()
    {
        return customer()->is_editable;
    }

    public function rules()
    {
        return [
            'model' => 'required',
            'id'    => 'required|numeric',
            'field' => 'required'
        ];
    }
}
