<?php

namespace App\Facades;

use App\Services\StaticPageService;
use Illuminate\Support\Facades\Facade;

class StaticPageFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return StaticPageService::class;
    }

}