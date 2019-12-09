<?php

namespace App\Http\Requests\Admin\Product;

use App\Models\ProductCollection;
use App\Rules\SlugUnique;
use Illuminate\Foundation\Http\FormRequest;

class CollectionInfoUpdateRequest extends FormRequest
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
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name_uk' => 'required',
            'name_ru' => 'required',
            'slug' => new SlugUnique(ProductCollection::getTableName())
        ];
    }

    public function messages()
    {
        return [
            
        ];
    }
}
