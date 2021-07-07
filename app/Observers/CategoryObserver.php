<?php

namespace App\Observers;

use App\Models\Category;
use App\Traits\Observers\DefaultTranslatableFields;
use Artisan;

class CategoryObserver
{
    use DefaultTranslatableFields;

    public function creating(Category $category)
    {
//        if (!empty($category->big) AND empty($category->small)) {
//            $category->small = $this->generateSmallImage($category->big);
//        }

        $this->defaultTranslatableFields($category);
    }

    public function updating(Category $category)
    {
//        if ($category->isDirty('big') AND !$category->small) {
//            $category->small = $this->generateSmallImage($category->big);
//        }

        $this->defaultTranslatableFields($category);
    }

    public function generateSmallImage(string $bigImagePath): string
    {
        return $bigImagePath;
    }

    public function created(Category $model)
    {
        $this->clear();
    }

    public function deleted(Category $model)
    {
        $this->clear();
    }

    public function updated(Category $model)
    {
        $this->clear();
    }

    private function clear(): void
    {
        Artisan::call('cache:clear');
    }
}
