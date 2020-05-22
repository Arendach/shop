<?php

namespace App\Http\Controllers\Catalog;

use App\Http\Requests\Catalog\Product\DeleteReviewCommentRequest;
use App\Http\Requests\Catalog\Product\ReviewCommentUpdateRequest;
use App\Http\Requests\Catalog\Product\ReviewDeleteRequest;
use App\Http\Requests\Catalog\Product\ReviewUpdateRequest;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\Review;
use App\Models\ReviewComment;
use App\Models\ReviewThumb;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProductController extends CatalogController
{
    public function view($slug)
    {
        $product = Product::with([
            'images',
            'reviews',
            'related',
            'category',
            'category.parent',
            'characteristics'
        ])->where(is_numeric($slug) ? 'id' : 'slug', $slug)->firstOrFail();

        $data = [
            'title'            => $product->meta_title,
            'meta_keywords'    => $product->meta_keywords,
            'meta_description' => $product->meta_description,
            'product'          => $product,
            'breadcrumbs'      => [
                [$product->category->parent->name ?? '', $product->category->parent->url ?? ''],
                [$product->category->name ?? '', $product->category->url ?? ''],
                [$product->name]
            ]
        ];

        return view('catalog.product.detail', $data);
    }

    public function leaveReview($id)
    {
        $product = Product::where('id', $id)->firstOrFail();

        $data = [
            'id' => $id,
            'name' => $product->name_uk
        ];

        return view('catalog.product.page_review', $data);
    }

    public function action_create_review_comment_form(Request $request)
    {
        $data = ['review' => Review::find($request->id)];

        return view('catalog.product.forms.create_review_comment', $data);
    }

    public function action_create_review_comment(Request $request)
    {
        $review_comment = new ReviewComment;

        $review_comment->review_id = $request->review_id;
        $review_comment->user_id = 1; // TODO заглушка тимчасова
        $review_comment->comment = $request->comment;

        $review_comment->save();

        return view('catalog.product.forms.created_review_comment', [
            'comment' => ReviewComment::find($review_comment->id)
        ]);
    }

    public function action_create_review(Request $request)
    {
        $review = new Review;

        $review->user_id = customer()->id;
        $review->product_id = $request->product_id;
        $review->rating = $request->rating;
        $review->comment = $request->comment;
        $review->plus = $request->plus;
        $review->minus = $request->minus;

        $review->save();

        return view('catalog.product.forms.created_review', [
            'review' => Review::find($review->id)
        ]);
    }

    public function action_delete_review_comment(DeleteReviewCommentRequest $request)
    {
        ReviewComment::destroy($request->id);

        return response()->json([
            'title'   => 'Виконано!',
            'message' => 'Коментар успішно видалений!'
        ], 200);
    }

    public function action_review_comment_update_form(Request $request)
    {
        $comment = ReviewComment::findOrFail($request->id);

        return view('catalog.product.forms.update_review_comment', [
            'comment'    => $comment,
            'title'      => 'Редагувати коментар',
            'modal_size' => 'lg'
        ]);
    }

    public function action_review_update_form(Request $request)
    {
        $review = Review::findOrFail($request->id);

        return view('catalog.product.forms.update_review', [
            'review'     => $review,
            'title'      => 'Редагувати відгук',
            'modal_size' => 'xl'
        ]);
    }

    public function action_review_update(ReviewUpdateRequest $request)
    {
        Review::findOrFail($request->id)
            ->update($request->all());

        // TODO дописати логіку зміни рейтинга товара

        return response()->json([
            'title'   => 'Виконано!',
            'message' => 'Відгук вдало відредаговано!'
        ], 200);
    }

    public function action_review_comment_update(ReviewCommentUpdateRequest $request)
    {
        ReviewComment::find($request->id)
            ->update($request->all());

        return response()->json([
            'title'   => 'Виконано!',
            'message' => 'Коментар вдало оновлено!'
        ], 200);
    }

    public function action_delete_review(ReviewDeleteRequest $request)
    {
        Review::destroy($request->id);

        return response()->json([
            'title'   => __('common.delete.success_title'),
            'message' => __('common.delete.success_text')
        ]);
    }

    public function action_thumb(Request $request)
    {
        $review = Review::findOrFail($request->review_id);

        $review_thumb = ReviewThumb::where('user_id', customer()->id)
            ->where('review_id', $request->review_id)
            ->first();

        if ($review_thumb == null) {
            $review_thumb = new ReviewThumb;

            $review_thumb->user_id = customer()->id;
            $review_thumb->review_id = $request->review_id;
        }

        $review_thumb->quality = $request->quality;

        $review_thumb->save();

        $thumb_up = ReviewThumb::where('review_id', $request->review_id)
            ->where('quality', 1)
            ->count();

        $thumb_down = ReviewThumb::where('review_id', $request->review_id)
            ->where('quality', -1)
            ->count();

        $review->thumb_up = $thumb_up;
        $review->thumb_down = $thumb_down;

        $review->save();

        return response()->json([
            'thumb_up'           => $thumb_up,
            'thumb_down'         => $thumb_down,
            'thumb_up_quality'   => $review_thumb->quality == 1 ? 0 : 1,
            'thumb_down_quality' => $review_thumb->quality == -1 ? 0 : -1,
        ], 200);
    }

}
