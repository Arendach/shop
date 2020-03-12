<?php

namespace App\Providers;

use App\Models\Customer;
use App\Models\Index;
use App\Models\Page;
use App\Observers\CustomerObserver;
use App\Observers\IndexObserver;
use App\Observers\PageObserver;
use Illuminate\Support\ServiceProvider;

class EloquentServiceProvider extends ServiceProvider
{
    public function register()
    {
    }

    public function boot()
    {
        Customer::observe(CustomerObserver::class);
        Page::observe(PageObserver::class);
        Index::observe(IndexObserver::class);
    }
}
