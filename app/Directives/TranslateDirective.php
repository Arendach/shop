<?php

namespace App\Directives;

use Blade;
use Translate;

class TranslateDirective
{
    public function register()
    {
        Blade::directive('translate', function ($expression){
            return "<?php echo \App\Directives\TranslateDirective::apply($expression); ?>";
        });
    }

    public static function apply($text)
    {
        return Translate::get($text);
    }
}