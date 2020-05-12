<?php

namespace App\Nova;

use App\Nova\Actions\ExportSearchLogs;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Fields\Text;

class SearchLogs extends Resource
{
    public static $model = 'App\Models\SearchLog';

    public static function label()
    {
        return 'Лог пошуків';
    }

    public function fields(Request $request)
    {
        return [
            Text::make('Запит', 'query')->readonly(),
            DateTime::make('Дата', 'created_at')->readonly(),
            Text::make('Юзер Агент', 'user_agent')->readonly(),
            Boolean::make('Проаналізовано', 'is_show')
        ];
    }

    public function actions(Request $request)
    {
        return [
            (new ExportSearchLogs())->onlyOnIndex()->canSee(function (){
                return true;
            })
        ];
    }
}
