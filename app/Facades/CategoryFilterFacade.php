<?php


namespace App\Facades;


use App\Services\CategoryFilterService;
use Illuminate\Support\Facades\Facade;

class CategoryFilterFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return CategoryFilterService::class;
    }
}