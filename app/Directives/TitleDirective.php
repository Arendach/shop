<?php

namespace App\Directives;

use Blade;

class TitleDirective 
{
    public function register(): void
    {
        Blade::directive('title', function ($expression) {
            return "<?php echo \App\Directives\TitleDirective::apply($expression)); ?>";
        });
    }

    public static function apply()
    {

    }
}