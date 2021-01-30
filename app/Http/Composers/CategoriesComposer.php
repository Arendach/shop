<?php

namespace App\Http\Composers;

use App\Models\Category;
use Illuminate\View\View;
use Cache;
use Jenssegers\Agent\Agent;

class CategoriesComposer
{
    public function compose(View $view)
    {
        $agent = new Agent();

        $categories = Cache::rememberForever('parentCategories', function () {
            return Category::where('parent_id', 0)
                ->where('is_active',1)
                ->with('child')
                ->get();
        });

        $view->with(compact('categories','agent'));
    }
}