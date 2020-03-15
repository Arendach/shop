<?php

namespace App\Http\Composers;

use App\Models\Menu;
use Illuminate\View\View;

class MenuComposer
{
    public function compose(View $view)
    {
        $menu = Menu::with('items')->get();

        $view->with(compact($menu));
    }
}