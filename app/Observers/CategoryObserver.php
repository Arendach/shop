<?php

namespace App\Observers;

use App\Models\Category;
use App\Traits\Observers\DefaultTranslatableFields;

class CategoryObserver
{
    use DefaultTranslatableFields;

    public function creating(Category $category)
    {
        if (!empty($category->big)) {
            $category->small = $this->generateSmallImage($category->big);
        }

        $this->defaultTranslatableFields($category);
    }

    public function updating(Category $category)
    {
        if ($category->isDirty('big')) {
            $category->small = $this->generateSmallImage($category->big);
        }

        $this->defaultTranslatableFields($category);
    }

    public function generateSmallImage(string $bigImagePath): string
    {
        return $bigImagePath;
    }
}
