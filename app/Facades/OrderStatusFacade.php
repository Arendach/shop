<?php

namespace App\Facades;

use App\Services\OrderStatusService;
use Illuminate\Support\Facades\Facade;

class OrderStatusFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return OrderStatusService::class;
    }
}