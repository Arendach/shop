<?php

namespace App\Directives;

use Blade;

class CheckedDirective
{
    public function register(): void
    {
        Blade::directive('checked', function ($expression) {
            return "<?php echo \App\Directives\CheckedDirective::apply($expression); ?>";
        });
    }

    public static function apply($param1, $param2 = null): ?string
    {
        if (is_bool($param1)) {
            return $param1 ? 'checked' : '';
        } else {
            return request()->get($param1) == $param2 ? 'checked' : '';
        }
    }
}