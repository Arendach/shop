<?php

namespace App\Http\Requests\Catalog\Product;

use App\Models\Review;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Http\FormRequest;

class ReviewDeleteRequest extends FormRequest
{
    public function authorize()
    {
        $review = Review::findOrFail(request('id'));

        return $review->customer_id == customer()->id;
    }

    public function rules()
    {
        return [
            'id' => 'required'
        ];
    }

    protected function failedAuthorization()
    {
        throw new AuthenticationException(translate('Ви не можете видалити цей відгук'));
    }
}
