<?php

namespace App\Http\Requests\Catalog\Product;

use App\Models\Review;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Http\FormRequest;

class ReviewCreateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    protected function failedAuthorization(): void
    {
        throw new AuthenticationException(translate('Ви не можете залишити відгук'));
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
