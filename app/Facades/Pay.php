<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

class Pay extends Facade
{
    public static function getFacadeAccessor()
    {
        return 'Pay';
    }
}