<?php

namespace App\Http\Requests\Admin\Product;

use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Http\FormRequest;

class UpdateSeoRequest extends FormRequest
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
            'meta_title_uk' => 'required',
            'meta_keywords_uk' => 'required',
            'meta_description_uk' => 'required',
            'meta_title_ru' => 'required',
            'meta_keywords_ru' => 'required',
            'meta_description_ru' => 'required',
        ];
    }

    public function messages()
    {
        return [];
    }
}
