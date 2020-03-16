<?php

namespace App\Observers;

use App\Models\Category;

class CategoryObserver
{
    public function creating(Category $category)
    {
        if (!empty($category->big)) {
            $category->small = $this->generateSmallImage($category->big);
        }
    }

    public function updating(Category $category)
    {
        if ($category->isDirty('big')) {
            $category->small = $this->generateSmallImage($category->big);
        }
    }

    public function generateSmallImage(string $bigImagePath): string
    {
        return $bigImagePath;
    }
}
