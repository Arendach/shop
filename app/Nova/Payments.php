<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Panel;


class Payments extends Resource
{
    public static $model = 'App\Models\Payment';

    public static $title = 'name';

    public static $search = [
        'name'
    ];

    public static function label()
    {
        return 'Оплата';
    }

    public function fields(Request $request)
    {
                artisan('cache:clear');

        return [
            new Panel('Загальна інформація', [
                ID::make()->sortable(),
                Text::make('Назва', 'name'),
                Text::make('Опис', 'description'),
                Text::make('Ключ', 'key')->hideFromIndex(),
                Text::make('Активація', 'active')->hideFromIndex(),
                Text::make('Показ', 'simple')->hideFromIndex()
            ])

        ];
    }
}
