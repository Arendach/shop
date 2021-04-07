<?php

namespace App\Providers;

use App\Http\Composers\ActionInfoComposer;
use App\Http\Composers\CategoriesComposer;
use App\Http\Composers\CategoryFilterComposer;
use App\Http\Composers\CheckoutPageComposer;
use App\Http\Composers\MenuComposer;
use App\Http\Composers\ProductComposer;
use App\Http\Composers\QuestionComposer;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ComposerServiceProvider extends ServiceProvider
{
    public function boot()
    {
        View::composer(['catalog.layout','catalog.parts.product-card'], MenuComposer::class);
        View::composer('catalog.layout', ActionInfoComposer::class);
        View::composer(['catalog.layout','catalog.category.parent', 'catalog.parts.dropdown-category'], CategoriesComposer::class);
        View::composer('catalog.category.filter', CategoryFilterComposer::class);
        View::composer('catalog.pages.checkout', CheckoutPageComposer::class);
        View::composer('catalog.product.detail', ProductComposer::class);
        View::composer('catalog.partials.footer.question', QuestionComposer::class);
    }

    public function register(){}
}
