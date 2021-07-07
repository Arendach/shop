<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;
use App\Services\DeliveryService;

class Delivery extends Facade
{
    protected static function getFacadeAccessor()
    {
        return DeliveryService::class;
    }
}