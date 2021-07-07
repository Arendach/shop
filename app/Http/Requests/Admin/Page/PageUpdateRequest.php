<?php

namespace App\Http\Requests\Admin\Page;

use Illuminate\Foundation\Http\FormRequest;

class PageUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name_uk' => 'required',
            'name_ru' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'name_uk.required' => __('pages.errors.name'),
            'name_ru.required' => __('pages.errors.name')
        ];
    }
}
