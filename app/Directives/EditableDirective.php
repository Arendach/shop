<?php

namespace App\Directives;

use Blade;
use Translate;

class EditableDirective
{
    public function register()
    {
        Blade::directive('editable', function ($expression){
            return "<?php echo \App\Directives\EditableDirective::apply($expression); ?>";
        });
    }

    public static function apply($text)
    {
        return Translate::editable($text);
    }
}