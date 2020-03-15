<?php

namespace App\Providers;

use App\Http\Composers\MenuComposer;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ComposerServiceProvider extends ServiceProvider
{
    public function boot()
    {
        View::composer('catalog.layout', MenuComposer::class);
    }

    public function register()
    {

    }
}
