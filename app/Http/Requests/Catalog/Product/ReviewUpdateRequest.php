<?php

namespace App\Http\Requests\Catalog\Product;

use App\Models\Review;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Http\FormRequest;

class ReviewUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $review = Review::findOrFail($this->request->get('id'));

        return ($review->user_id == customer()->id) || access('products');
    }

    /**
     * @throws AuthenticationException
     */
    protected function failedAuthorization()
    {
        throw new AuthenticationException('Ви не можете редагувати цей відгук!');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'plus' => 'nullable|max:2000',
            'minus' => 'nullable|max:2000',
            'comment' => 'nullable|max:10000',
            'rating' => 'required|max:1'
        ];
    }

    public function messages()
    {
        return [
            'plus.max' => 'Максимум 2000 символів!',
            'minus.max' => 'Максимум 2000 символів!',
            'comment.max' => 'Максимум 10000 символів!',
            'rating.required' => 'Рейтинг обовязковий!'
        ];
    }
}
