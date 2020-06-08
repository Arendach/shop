<?php

namespace App\Repositories;

use App\Models\Product;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class ProductsRepository
{
    public function searchProducts(string $query): LengthAwarePaginator
    {
        return Product::where('name_uk', 'like', "%$query%")
            ->orWhere('name_ru', 'like', "%$query%")
            ->orWhere('article', 'like', "%$query%")
            ->orderBy('on_storage', 'desc')
            ->paginate(config('app.items'));
    }

    public function searchProductsLive(string $query)
    {
        return Product::where('name_uk', 'like', "%$query%")
            ->orWhere('name_ru', 'like', "%$query%")
            ->orWhere('article', 'like', "%$query%")
            ->orderBy('on_storage', 'desc');
    }
}