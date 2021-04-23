<?php

namespace App\Providers;

use App\Directives\AdminDirective;
use App\Directives\CheckedDirective;
use App\Directives\DisabledDirective;
use App\Directives\DisplayIfDirective;
use App\Directives\EditableDirective;
use App\Directives\SelectedDirective;
use App\Directives\TooltipDirective;
use App\Directives\TranslateDirective;
use Illuminate\Support\ServiceProvider;

class BladeExtendsServiceProvider extends ServiceProvider
{
    private $directives = [
        TranslateDirective::class,
        AdminDirective::class,
        TooltipDirective::class,
        CheckedDirective::class,
        SelectedDirective::class,
        DisabledDirective::class,
        EditableDirective::class,
        DisplayIfDirective::class
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
