<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;

class Translates extends Resource
{
    public static $model = 'App\Models\Translate';

    public static $title = 'original';

    public static $search = [
        'original', 'content_uk', 'content_ru'
    ];

    public static function label()
    {
        return 'Переклади';
    }

    public function fields(Request $request)
    {
        artisan('cache:clear');

        return [
            ID::make()->sortable(),
            Text::make('Оригінал', 'original')->readonly()->sortable(),
            Text::make('Українською', 'content_uk')->sortable(),
            Text::make('Російською', 'content_ru')->sortable(),
        ];
    }
}
