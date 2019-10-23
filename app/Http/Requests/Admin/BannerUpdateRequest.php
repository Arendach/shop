<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class BannerUpdateRequest extends FormRequest
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
            'title_uk' => 'required|min:3',
            'title_ru' => 'required|min:3'
        ];
    }

    public function messages()
    {
        return [
            'title_uk.required' => __('banner.admin.validation.title_required'),
            'title_uk.min' => __('banner.admin.validation.title_min'),
            'title_ru.required' => __('banner.admin.validation.title_required'),
            'title_ru.min' => __('banner.admin.validation.title_min'),
        ];
    }
}
