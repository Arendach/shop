<?php

namespace App\Http\Controllers\Catalog;

use App\Models\{Category, Product};
use Illuminate\Http\Request;
use CategoryFilter;

class CategoryController extends CatalogController
{
    public function show($slug, Request $request, Category $categoryModel)
    {
        $category = Category::with('parent', 'child')
            ->where(is_numeric($slug) ? 'id' : 'slug', $slug)
            ->firstOrFail();

        $data = [
            'title'            => $category->meta_title,
            'meta_description' => $category->meta_description,
            'meta_keywords'    => $category->meta_keywords,
            'category'         => $category
        ];

        if ($category->parent_id == 0) {
            $categories = Category::distinct()->where('parent_id', '=', $category->id)->get();
            $productsFromCategory = [];
            foreach ($categories as $category) {
                $productsFromCategory[] = [
                    'name' => $category->name,
                    'description' => $category->description_uk,
                    'products' => Product::where('category_id', '=', $category->id)->where(function($p) {
                        $p->where('is_new', 1)->orWhere('is_recommended', 1);
                    })->orderBy('on_storage', 'DESC')->get(),
                ];
            }
            $data['productsFromCategory'] = $productsFromCategory;
            return view('catalog.category.parent', $data);
        }

        $products = $categoryModel->filterProducts($category->id, $request);

        $data = array_merge($data, [
            'products'      => $products,
            'filter'        => CategoryFilter::get($category->id),
            'requestFields' => $request->all()
        ]);

        return view('catalog.category.show-products', $data);

    }
}
