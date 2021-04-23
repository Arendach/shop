<?php

namespace App\Http\Requests\Admin\Product;

use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Http\FormRequest;

class ImageUploadRequest extends FormRequest
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
            'priority' => 'integer'
        ];
    }

    public function messages()
    {
        return [
            'priority.integer' => __('products.admin.validation.priority_integer')
        ];
    }
}
