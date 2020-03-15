<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;

class MenuItems extends Resource
{
    public static $model = 'App\Models\MenuItem';

    public static $title = 'id';

    public static $search = ['id', 'name_uk', 'name_ru'];

    public static $displayInNavigation = false;

    public static function label()
    {
        return translate('Підпункти меню');
    }

    public function fields(Request $request)
    {
        return [
            ID::make()->sortable(),
            Text::make(translate('Назва (ук)'), 'name_uk'),
            Text::make(translate('Назва (ру)'), 'name_ru')->hideFromIndex(),
            Text::make(translate('Колонка (ук)'), 'column_uk'),
            Text::make(translate('Колонка (ру)'), 'column_ru')->hideFromIndex(),
            Text::make(translate('Посилання'), 'url')
        ];
    }
}
