<?php

namespace App\Http\Controllers\Catalog;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;

class CategoryController extends CatalogController
{
    public function show($slug)
    {
        $category = Category::with('parent')
            ->with('child')
            ->where(is_integer($slug) ? 'id' : 'slug', $slug)
            ->firstOrFail();

        $data = [
            'title' => $category->meta_title,
            'meta_description' => $category->meta_description,
            'meta_keywords' => $category->meta_keywords,
            'category' => $category
        ];

        if ($category->parent_id == 0){
            $data = array_merge($data, [
                'breadcrumbs' => [[$category->name]]
            ]);

            return view('catalog.category.parent', $data);
        } else {
            $data = array_merge($data, [
                'breadcrumbs' =>  [
                    [$category->parent->name, route('category.show', $category->parent->slug)],
                    [$category->name]
                ],
                'products' => Product::where('category_id', $category->id)
                    ->orderBy('on_storage', 'desc')
                    ->orderBy('id', 'desc')
                    ->with('characteristics')
                    ->paginate(config('app.items'))
            ]);

             return view('catalog.category.child', $data);
        }
    }
}
