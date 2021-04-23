<?php

namespace App\Directives;

use Blade;

class TooltipDirective 
{
    public function register(): void
    {
        Blade::directive('tooltip', function ($expression) {
            return "<?php echo \App\Directives\TooltipDirective::apply($expression); ?>";
        });
    }

    public static function apply(string $text, string $placement = 'top'): string
    {
        return "title='$text' data-toggle='tooltip' data-placement='$placement'";
    }
}