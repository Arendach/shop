<?php

namespace App\Facades;

use App\Services\CustomerService;
use Illuminate\Support\Facades\Facade;

class User extends Facade
{
    protected static function getFacadeAccessor()
    {
        return CustomerService::class;
    }
}