<?php

namespace App\Http\Requests\Catalog\Product;

use App\Models\Review;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Http\FormRequest;

class ReviewUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        $review = Review::findOrFail(request('id'));

        return $review->customer_id == customer()->id;
    }

    protected function failedAuthorization(): void
    {
        throw new AuthenticationException(translate('Ви не можете редагувати цей відгук'));
    }

    public function rules(): array
    {
        return [
            'title'   => 'required',
            'comment' => 'nullable|max:10000',
            'rating'  => 'required|max:1'
        ];
    }

    public function attributes(): array
    {
        return [];
    }
}
