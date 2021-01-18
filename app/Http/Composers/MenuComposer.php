<?php

namespace App\Http\Composers;

use App\Models\Menu;
use Illuminate\View\View;
use Cache;
use Jenssegers\Agent\Agent;

class MenuComposer
{
    public function compose(View $view)
    {
        $menu = Cache::rememberForever('menu', function () {
            return Menu::with('items')->get();
        });
        $agent = new Agent();

        $view->with(compact('menu','agent'));
    }
}