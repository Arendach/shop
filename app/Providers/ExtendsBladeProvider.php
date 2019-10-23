<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Blade;

class ExtendsBladeProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        Blade::if('login', function () {
            return is_auth();
        });

        Blade::directive('user', function ($field){
            return "<?php echo user()->$field; ?>";
        });
    }
}
