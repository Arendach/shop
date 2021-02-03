<?php

namespace App\Http\Composers;

use App\Models\Menu;
use App\Models\ProductCollection;
use App\Models\Shop;
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

        $shopsHeader = Shop::get();
        $collectionMenu = ProductCollection::pars()->active()->limit(5)->get();
        $view->with(compact('menu','agent', 'shopsHeader','collectionMenu'));
    }
}