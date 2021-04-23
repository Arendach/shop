<?php

namespace App\Http\Requests\Admin\Page;

use Illuminate\Foundation\Http\FormRequest;

class PageStoreRequest extends FormRequest
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
            'name_ru' => 'required',
            'uri_name' => 'alpha_num|unique:pages,uri_name'
        ];
    }

    public function messages()
    {
        return [
            'name_uk.required' => __('pages.errors.name'),
            'name_ru.required' => __('pages.errors.name'),
            'uri_name.alpha_num' => __('pages.errors.uri_name_alpha_num'),
            'uri_name.unique' => __('pages.errors.uri_name_unique')
        ];
    }
}
