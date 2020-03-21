<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Panel;

class Shops extends Resource
{
    public static $model = 'App\Models\Shop';

    public static $title = 'name_uk';

    public static $search = [
        'name_uk', 'name_ru'
    ];

    public static function label()
    {
        return translate('Магазини');
    }

    public function fields(Request $request)
    {
        return [
            new Panel(translate('Загальна інформація'), [
                ID::make()->sortable(),
                Text::make('url')->hideFromIndex(),
                Text::make('base_id')->hideFromIndex()
            ]),

            new Panel(translate('Українська локалізація'), [
                Text::make(translate('Назва'), 'name_uk'),
                Text::make(translate('Адреса'), 'address_uk')
            ]),

            new Panel(translate('Російська локалізація'), [
                Text::make(translate('Назва'), 'name_ru')->hideFromIndex(),
                Text::make(translate('Адреса'), 'address_ru')->hideFromIndex()
            ])
        ];
    }
}
