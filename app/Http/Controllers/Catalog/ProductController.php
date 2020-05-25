<?php

namespace App\Http\Controllers\Catalog;

use App\Http\Requests\Catalog\Product\ReviewCreateRequest;
use App\Http\Requests\Catalog\Product\ReviewDeleteRequest;
use App\Http\Requests\Catalog\Product\ReviewUpdateRequest;
use App\Models\Product;
use App\Models\Review;
use Illuminate\Http\Request;

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
        $product = Product::findOrFail($id);

        return view('catalog.product.page_review', compact('product'));
    }

    public function action_create_review(ReviewCreateRequest $request)
    {
        Review::create($request->merge([
            'customer_id' => customer()->id,
        ]));

        return response()->json([
            'message' => translate('Ваш відгук прийнятий')
        ]);
    }

    public function action_review_update(ReviewUpdateRequest $request)
    {
        Review::findOrFail($request->id)
            ->update($request->all());

        // TODO дописати логіку зміни рейтинга товара

        return response()->json([
            'message' => translate('Відгук вдало відредаговано')
        ]);
    }

    public function action_delete_review(ReviewDeleteRequest $request)
    {
        Review::destroy($request->id);

        return response()->json([
            'message' => translate('Відгук вдало видалений')
        ]);
    }
}
