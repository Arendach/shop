<?php

namespace App\Facades;

use App\Services\NewPostService;
use Illuminate\Support\Facades\Facade;

class NewPost extends Facade
{
    protected static function getFacadeAccessor()
    {
        return NewPostService::class;
    }
}