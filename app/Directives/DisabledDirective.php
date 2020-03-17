<?php

namespace App\Directives;

use Blade;

class DisabledDirective
{
    public function register(): void
    {
        Blade::directive('disabled', function ($expression){
            return "<?php echo ($expression) ? 'disabled' : ''; ?>";
        });
    }
}