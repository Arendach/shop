<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class GlobalDataServiceProvider extends ServiceProvider
{
    public function register()
    {
    }

    public function boot()
    {
//        $data = [
//            'globalData'     => Cache::rememberForever('globalData', function () {
//                return Index::where('is_main', true)->first();
//            }),
//            'fastNavigation' => Cache::rememberForever('fastNavigation', function () {
//                return Page::where('is_fast_navigation', true)->get();
//            })
//        ];
//
//        view()->share($data);
    }
}
