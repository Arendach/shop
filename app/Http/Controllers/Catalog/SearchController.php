<?php

namespace App\Http\Controllers\Catalog;

use App\Models\Product;
use Illuminate\Http\Request;

class SearchController extends CatalogController
{
    public function index(Product $productModel, $value)
    {
        $products = $productModel->getSearchProducts($value);

        $data = [
            'title' => __('search.title'),
            'meta_keywords' => __('search.meta_keywords'),
            'meta_description' => __('search.meta_description'),
            'breadcrumbs' => [[__('search.title')]],
            'products' => $products,
            'search_string' => $value,
        ];

        return view('catalog.search.index', $data);
    }
}
