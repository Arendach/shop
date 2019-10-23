<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Blade;

class BladeExtendsServiceProvider extends ServiceProvider
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
        /*Blade::directive('choice', function ($key, $count) {
            return "<?php echo trans_choice($key, $count); ?>";
        });*/
    }
}
