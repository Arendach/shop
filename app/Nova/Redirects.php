<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;

class Redirects extends Resource
{
    public static $model = 'App\Models\Redirect';

    public static $title = 'old_url';

    public static function label()
    {
        return 'Редиректи';
    }

    public function fields(Request $request)
    {
        return [
            ID::make()->sortable(),
            Text::make('Старе посилання', 'old_link')->required(),
            Text::make('Нове посилання', 'new_link')->required(),
            Text::make('Статус', 'status')->required(),
        ];
    }
}
