<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Image;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Panel;

class Indexes extends Resource
{
    public static $model = 'App\Models\Index';

    public static $title = 'name';

    public static function label()
    {
        return translate('Налаштування сайту');
    }

    public function fields(Request $request)
    {
        return [
            new Panel(translate('Загальна інформація'), [
                ID::make()->sortable(),
                Text::make(translate('Назва'), 'name'),
                Boolean::make(translate('За замовчуванням'), 'is_main')
            ]),

            new Panel(translate('Шапка сайту'), [
                Image::make(translate('Логотип'), 'logo')->path('images/logo'),
                Text::make(translate('Номер телефону'), 'header_phone')->hideFromIndex()
            ]),

            new Panel(translate('Низ сайту'), [
                Text::make(translate('Номер телефону'), 'footer_phone')->hideFromIndex(),
                Text::make(translate('Адреса магазину(uk)'), 'footer_address_uk')->hideFromIndex(),
                Text::make(translate('Адреса магазину(ru)'), 'footer_address_ru')->hideFromIndex(),
                Text::make(translate('Електронна пошта'), 'footer_email')->hideFromIndex(),

            ])
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
