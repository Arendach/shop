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
        return translate('Оплата');
    }

    public function fields(Request $request)
    {
                artisan('cache:clear');

        return [
            new Panel(translate('Загальна інформація'), [
                ID::make()->sortable(),
                Text::make(translate('Назва'), 'name'),
                Text::make(translate('Опис'), 'description'),
                Text::make(translate('Ключ'), 'key')->hideFromIndex(),
                Text::make(translate('Активація'), 'active')->hideFromIndex(),
                Text::make(translate('Показ'), 'simple')->hideFromIndex()
            ])

        ];
    }
}
