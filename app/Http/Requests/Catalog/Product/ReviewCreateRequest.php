<?php

namespace App\Http\Requests\Catalog\Product;

use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Http\FormRequest;

class ReviewCreateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return isAuth();
    }

    protected function failedAuthorization(): void
    {
        throw new AuthenticationException(translate('Ви не можете залишити відгук'));
    }

    public function rules(): array
    {
        return [
            'product_id' => 'required|exists:products,id',
            'comment'    => 'nullable|max:10000',
            'rating'     => 'required|integer'
        ];
    }

    public function attributes(): array
    {
        return [];
    }
}
