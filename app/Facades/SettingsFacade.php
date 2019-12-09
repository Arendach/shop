<?php

namespace App\Facades;

use App\Services\SettingsService;
use Illuminate\Support\Facades\Facade;

class SettingsFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        SettingsService::class;
    }
}