<?php

namespace App\Http\Requests\Admin\Banner;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\Color;
use App\Rules\PageExists;

class TopUpdateRequest extends FormRequest
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
            'color' => ['nullable', new Color],
            'is_active' => 'boolean',
            'page' => ['nullable', new PageExists],
            'photo' => 'nullable'
            // 'photo' => 'nullable|dimensions:max_height=50px'
        ];
    }

    public function messages()
    {
        return [
            'photo.dimensions' => 'Фото не відповідного розміру'
        ];
    }
}
