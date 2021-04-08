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
        return 'Магазини';
    }

    public function fields(Request $request)
    {
        return [
            new Panel('Загальна інформація', [
                ID::make()->sortable(),
                Text::make('url')->hideFromIndex(),
                Text::make('base_id')->hideFromIndex()
            ]),

            new Panel('Українська локалізація', [
                Text::make('Назва', 'name_uk'),
                Text::make('Адреса', 'address_uk')
            ]),

            new Panel('Російська локалізація', [
                Text::make('Назва', 'name_ru')->hideFromIndex(),
                Text::make('Адреса', 'address_ru')->hideFromIndex()
            ])
        ];
    }
}
