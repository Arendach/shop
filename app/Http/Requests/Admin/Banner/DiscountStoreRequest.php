<?php

namespace App\Http\Requests\Admin\Banner;

use App\Rules\PageExists;
use Illuminate\Foundation\Http\FormRequest;

class DiscountStoreRequest extends FormRequest
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
            'page' => new PageExists,
            'name_uk' => 'required',
            'name_ru' => 'required',
            'image_min_uk' => 'dimensions:width=60,height=60',
            'image_min_ru' => 'dimensions:width=60,height=60',
            'image_second_uk' => 'dimensions:width=600,height=400',
            'image_second_ru' => 'dimensions:width=600,height=400',
            'image_max_uk' => 'dimensions:width=1200,height=600',
            'image_max_ru' => 'dimensions:width=1200,height=600',
        ];
    }

    public function messages()
    {
        return [
            'name_uk.required' => __('banner.admin.validation.name_required'),
            'name_ru.required' => __('banner.admin.validation.name_required'),
            'image_min_uk.dimensions' => __('banner.admin.validation.image_min'),
            'image_min_ru.dimensions' => __('banner.admin.validation.image_min'),
            'image_second_uk.dimensions' => __('banner.admin.validation.image_second'),
            'image_second_ru.dimensions' => __('banner.admin.validation.image_second'),
            'image_max_uk.dimensions' => __('banner.admin.validation.image_max'),
            'image_max_ru.dimensions' => __('banner.admin.validation.image_max'),
        ];
    }

}
