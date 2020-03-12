<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;

class Translates extends Resource
{
    public static $model = 'App\Models\Translate';

    public static $title = 'original';

    public function fields(Request $request)
    {
        return [
            ID::make()->sortable(),
            Text::make(translate('Оригінал'), 'original')->readonly(),
            Text::make(translate('Українською'), 'content_uk'),
            Text::make(translate('Російською'), 'content_ru'),
        ];
    }

    public function cards(Request $request)
    {
        return [];
    }

    public function filters(Request $request)
    {
        return [];
    }

    public function lenses(Request $request)
    {
        return [];
    }

    public function actions(Request $request)
    {
        return [];
    }
}
