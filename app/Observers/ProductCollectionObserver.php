<?php

namespace App\Observers;

use App\Models\ProductCollection;

class ProductCollectionObserver
{
    public function deleting(ProductCollection $productCollection)
    {
        $productCollection->products()->detach();
    }
}
