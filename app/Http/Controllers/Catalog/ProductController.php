<?php

namespace App\Http\Controllers\Catalog;

use App\Http\Requests\Catalog\Product\ReviewCreateRequest;
use App\Http\Requests\Catalog\Product\ReviewDeleteRequest;
use App\Http\Requests\Catalog\Product\ReviewUpdateRequest;
use App\Http\Resources\ReviewResource;
use App\Models\Product;
use App\Models\Review;
use App\Services\Business\ReviewService;

class ProductController extends CatalogController
{
    public function view($slug)
    {
        $reviewTab = (isset($_GET['rev'])) ? true : false;

        $product = Product::with([
            'images',
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
            ],
            'reviewTab'        => $reviewTab
        ];

        return view('catalog.product.detail', $data);
    }

    public function leaveReview($id)
    {
        $product = Product::findOrFail($id);

        return view('catalog.product.page_review', compact('product'));
    }

    public function action_create_review(ReviewCreateRequest $request): ReviewResource
    {
        $review = Review::create($request->validated());

        return new ReviewResource($review);
    }

    public function updateReview(ReviewUpdateRequest $request, ReviewService $reviewService): ReviewResource
    {
        $review = $reviewService->updateReview($request->get('id'), $request->validated());

        return new ReviewResource($review);
    }

    public function action_delete_review(ReviewDeleteRequest $request)
    {
        Review::destroy($request->id);

        return response()->json([
            'message' => translate('Відгук вдало видалений')
        ]);
    }
}
