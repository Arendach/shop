<?php

namespace App\Providers;

use App\Directives\AdminDirective;
use App\Directives\TranslateDirective;
use Illuminate\Support\ServiceProvider;

class BladeExtendsServiceProvider extends ServiceProvider
{
    private $directives = [
        TranslateDirective::class,
        AdminDirective::class
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
