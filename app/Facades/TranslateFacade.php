<?php

namespace App\Facades;

use App\Services\TranslateService;
use Illuminate\Support\Facades\Facade;

class TranslateFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return TranslateService::class;
    }
}