<?php

namespace App\Http\Requests\Catalog\Product;

use App\Models\Review;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Http\FormRequest;

class ReviewDeleteRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $review = Review::findOrFail($this->request->get('id'));

        return ($review->user_id == user()->id) || access('products');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [];
    }

    /**
     * @throws AuthenticationException
     */
    protected function failedAuthorization()
    {
        throw new AuthenticationException(__('products.validation.review_delete_denied'));
    }
}
