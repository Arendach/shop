<?php

namespace App\Http\Composers;

use App\Models\Category;
use Illuminate\View\View;
use Cache;

class CategoriesComposer
{
    public function compose(View $view)
    {
        $categories = Cache::rememberForever('parentCategories', function () {
            return Category::where('parent_id', 0)
                ->with('child')
                ->get();
        });

        $view->with(compact('categories'));
    }
}