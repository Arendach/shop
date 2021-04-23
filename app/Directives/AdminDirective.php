<?php

namespace App\Directives;

use Blade;

class AdminDirective
{
    public function register(): void
    {
        Blade::directive('admin', function ($expression) {
            return "<?php if(\App\Directives\AdminDirective::apply($expression)): ?>";
        });

        Blade::directive('endadmin', function () {
            return "<?php endif; ?>";
        });
    }

    public static function apply(string $key = null): bool
    {
        if (is_null($key))
            return is_admin();

        return access($key);
    }

}