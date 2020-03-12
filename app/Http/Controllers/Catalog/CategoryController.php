<?php

namespace App\Http\Controllers\Catalog;

use App\Models\Category;
use Illuminate\Http\Request;
use CategoryFilter;

class CategoryController extends CatalogController
{
    public function show($slug, Request $request, Category $categoryModel)
    {
        $category = Category::with('parent', 'child')
            ->where('slug', $slug)
            ->firstOrFail();

        abort_if($category->parent_id == 0, 404);

        $data = [
            'title' => $category->meta_title,
            'meta_description' => $category->meta_description,
            'meta_keywords' => $category->meta_keywords,
            'category' => $category
        ];

        if ($category->parent_id == 0) {
            $data = array_merge($data, [
                'breadcrumbs' => [[$category->name]]
            ]);

            return view('catalog.category.parent', $data);
        } else {
            $products = $categoryModel->filterProducts($category->id, $request);

            $data = array_merge($data, [
                'breadcrumbs' => [
                    [$category->parent->name, route('category.show', $category->parent->slug)],
                    [$category->name]
                ],
                'products' => $products,
                'filter' => CategoryFilter::get($category->id),
                'requestFields' => $request->all()
            ]);

            return view('catalog.category.show-products', $data);
        }
    }
}
