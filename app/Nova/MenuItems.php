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


    public function fields(Request $request)
    {
        return [
            ID::make()->sortable(),
            Text::make('name_uk'),
            Text::make('name_ru')->hideFromIndex(),
            Text::make('column_uk'),
            Text::make('column_ru')->hideFromIndex(),
            Text::make('url')
        ];
    }
}
