<?php

namespace App\Observers;

use Artisan;
use App\Models\Product;

class ProductObserver
{
    public function created(Product $product): void
    {
        if ($product->isDirty('big')) {
            $product->small = $this->generateSmallImage($product->big);
        }

        $this->clear();
        $this->generateRedirects();
    }

    public function updated(Product $page)
    {
        $this->clear();
        $this->generateRedirects();
    }

    public function deleted(Product $page)
    {
        $this->clear();
        $this->generateRedirects();
    }

    public function restored(Product $page)
    {
        $this->clear();
        $this->generateRedirects();
    }

    public function forceDeleted(Product $page)
    {
        $this->clear();
        $this->generateRedirects();
    }

    private function generateSmallImage($bigImagePath): ?string
    {
        return $bigImagePath;
    }

    public function updating(Product $product)
    {
        if ($product->isDirty('big')) {
            $product->small = $this->generateSmallImage($product->big);
        }
    }

    public function creating(Product $product)
    {
        $product->small = $this->generateSmallImage($product->big);
    }

    private function clear(): void
    {
        Artisan::call('cache:clear');
    }

    protected function generateRedirects(): void
    {
        Artisan::call('generate:redirect-routes');
    }
}
