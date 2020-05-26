<?php

namespace App\Nova;

use Cache;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Textarea;

class Settings extends Resource
{
    public static $model = 'App\Models\Setting';

    public static $title = 'key';

    public static $search = ['key',];

    public static function label()
    {
        return 'Налаштування';
    }

    public function fields(Request $request)
    {
        Cache::forget('settings');

        return [
            Text::make('Ключ', 'key'),
            Textarea::make('Значення', 'value_uk')->showOnIndex(),
            Textarea::make('Значення (ru)', 'value_ru')
        ];
    }
}
