<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

class Cart extends Facade
{

    /**
     * @return array
     */
    public static function getResolvedInstance(): array
    {
        return self::$resolvedInstance;
    }

    public static function getFacadeAccessor()
    {
        return 'App\\Services\\CartService';
    }
}