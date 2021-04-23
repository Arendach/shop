<?php

namespace App\Observers;

use App\Models\ProductCollection;
use App\Traits\Observers\DefaultTranslatableFields;

class ProductCollectionObserver
{
    use DefaultTranslatableFields;

    public function creating(ProductCollection $productCollection)
    {
        $this->defaultTranslatableFields($productCollection);
    }

    public function updating(ProductCollection $productCollection)
    {
        $this->defaultTranslatableFields($productCollection);
    }

    public function deleting(ProductCollection $productCollection)
    {
        $productCollection->products()->detach();
    }
}
