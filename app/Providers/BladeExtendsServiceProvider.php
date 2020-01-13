<?php

namespace App\Providers;

use App\Directives\TranslateDirective;
use Illuminate\Support\ServiceProvider;
use Blade;

class BladeExtendsServiceProvider extends ServiceProvider
{
    private $directives = [
        TranslateDirective::class
    ];

    public function register()
    {
    }

    public function boot()
    {
        foreach ($this->directives as $directive){
            (new $directive)->register();
        }

    }
}
