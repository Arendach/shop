<?php

namespace App\Providers;

use App\Http\Composers\ActionInfoComposer;
use App\Http\Composers\CategoriesComposer;
use App\Http\Composers\CategoryFilterComposer;
use App\Http\Composers\CheckoutPageComposer;
use App\Http\Composers\MenuComposer;
use App\Http\Composers\ProductComposer;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ComposerServiceProvider extends ServiceProvider
{
    public function boot()
    {
        View::composer('catalog.layout', MenuComposer::class);
        View::composer('catalog.layout', ActionInfoComposer::class);
        View::composer('catalog.layout', CategoriesComposer::class);
        View::composer('catalog.category.filter', CategoryFilterComposer::class);
        View::composer('catalog.pages.checkout', CheckoutPageComposer::class);
        View::composer('catalog.product.detail', ProductComposer::class);
    }

    public function register(){}
}
