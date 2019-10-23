<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

class Banner extends Facade
{
    public static function getFacadeAccessor()
    {
        return 'Banner';
    }
}