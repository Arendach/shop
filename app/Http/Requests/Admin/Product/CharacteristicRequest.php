<?php

namespace App\Http\Requests\Admin\Product;

use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Http\FormRequest;

class CharacteristicRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return access('products');
    }

    /**
     * @throws AuthenticationException
     */
    protected function failedAuthorization()
    {
        throw  new AuthenticationException(__('products.admin.failed_authorization'));
    }


    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'value_uk' => 'required',
            'value_ru' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'value_uk.required' => __('products.admin.validation.characteristic_value_required'),
            'value_ru.required' => __('products.admin.validation.characteristic_value_required')
        ];
    }
}
