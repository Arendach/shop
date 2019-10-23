<?php

namespace App\Http\Requests\Admin\Category;

use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Http\FormRequest;

class DeleteCategoryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return access('categories');
    }

    /**
     * @throws AuthenticationException
     */
    protected function failedAuthorization()
    {
        throw new AuthenticationException(__('category.admin.errors.not_deleted'));
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            //
        ];
    }
}
