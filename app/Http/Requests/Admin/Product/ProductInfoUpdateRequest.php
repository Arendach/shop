<?php

namespace App\Http\Requests\Admin\Product;

use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Http\FormRequest;
use App\Rules\CategoryValidate;
use App\Rules\Price;

class ProductInfoUpdateRequest extends FormRequest
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
            'category_id' => new CategoryValidate,
            'article' => 'required',
            'price' => new Price,
            'discount' => ['nullable', new Price],
            'name_ru' => 'required',
            'name_uk' => 'required',

        ];
    }

    /*public function messages()
    {

    }*/
}
