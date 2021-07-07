<?php

namespace App\Directives;

use Blade;

class DisplayIfDirective
{
    public function register(): void
    {
        Blade::directive('displayIf', function ($expression) {
            return "<?= \App\Directives\DisplayIfDirective::apply($expression) ?>";
        });
    }

    public static function apply(bool $boolean, $statement): string
    {
        return $boolean ? $statement : '';
    }
}
