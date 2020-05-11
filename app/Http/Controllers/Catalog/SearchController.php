<?php

namespace App\Http\Controllers\Catalog;

use App\Models\Product;
use App\Models\SearchLog;
use App\Repositories\ProductsRepository;

class SearchController extends CatalogController
{
    private $productsRepository;

    public function __construct(ProductsRepository $productsRepository)
    {
        $this->productsRepository = $productsRepository;
    }

    public function index()
    {
        abort_if(!request('query'), 404);

        $products = $this->productsRepository->searchProducts(request('query'));

        $data = [
            'meta_keywords'    => __('search.meta_keywords'),
            'meta_description' => __('search.meta_description'),
            'products'         => $products,
            'searchString'     => request('query'),
        ];

        return view('catalog.search.index', $data);
    }

    private function saveLog()
    {
        SearchLog::create();
    }
}
