<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

class Locale extends Facade
{
    public static function getFacadeAccessor()
    {
        return 'Locale';
    }
}