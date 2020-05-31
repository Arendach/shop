<?php

namespace App\Providers;

use App\Http\Composers\ActionInfoComposer;
use App\Http\Composers\CategoriesComposer;
use App\Http\Composers\MenuComposer;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ComposerServiceProvider extends ServiceProvider
{
    public function boot()
    {
        View::composer('catalog.layout', MenuComposer::class);
        View::composer('catalog.layout', ActionInfoComposer::class);
        View::composer('catalog.layout', CategoriesComposer::class);
    }

    public function register(){}
}
