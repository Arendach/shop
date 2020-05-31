<?php

namespace App\Http\Composers;

use App\Models\Menu;
use Illuminate\View\View;
use Cache;

class MenuComposer
{
    public function compose(View $view)
    {
        $menu = Cache::rememberForever('menu', function () {
            return Menu::with('items')->get();
        });

        $view->with(compact('menu'));
    }
}