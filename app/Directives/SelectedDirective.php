<?php

namespace App\Directives;

use Blade;

class SelectedDirective
{
    public function register(): void
    {
        Blade::directive('selected', function ($expression) {
            return "<?php echo \App\Directives\SelectedDirective::apply($expression); ?>";
        });
    }

    public static function apply($param1, $param2 = null): string
    {
        if (is_bool($param1)) {
            return $param1 ? 'selected' : '';
        } else {
            return request()->get($param1) === $param2 ? 'selected' : '';
        }
    }
}