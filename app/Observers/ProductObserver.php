<?php

namespace App\Observers;

use Cache;
use App\Models\Product;

class ProductObserver
{
    public function created(Product $product): void
    {
        if ($product->isDirty('big')) {
            $product->small = $this->generateSmallImage($product->big);
        }
    }

    public function updated(Product $page)
    {
    }

    public function deleted(Product $page)
    {
    }

    public function restored(Product $page)
    {
    }

    public function forceDeleted(Product $page)
    {
    }

    private function generateSmallImage($bigImagePath): string
    {
        return $bigImagePath;
    }
}
