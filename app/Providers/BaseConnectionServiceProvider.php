<?php

namespace App\Providers;

use App\Library\BaseConnection;
use Illuminate\Support\ServiceProvider;

class BaseConnectionServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('base_connection', function ($app) {
            return new BaseConnection($app);
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
