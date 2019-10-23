<?php

namespace App\Http\Requests\Catalog\Product;

use App\Models\ReviewComment;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Foundation\Http\FormRequest;

class ReviewCommentUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $comment = ReviewComment::find($this->request->get('id'));

        return (isset($comment->user_id) && $comment->user_id == user()->id) || access('products');
    }

    /**
     * @throws AuthorizationException
     */
    protected function failedAuthorization()
    {
        throw new AuthorizationException(__('products.validation.review_comment_update_denied'));
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'comment' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'comment.required' => __('products.validation.review_comment_required')
        ];
    }
}
