<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Password;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Panel;

class Customers extends Resource
{
    public static $model = 'App\Models\Customer';

    public static $title = 'first_name';

    public static $search = [
        'first_name',
        'last_name',
        'email',
        'phone'
    ];

    public function fields(Request $request)
    {
        return [
            new Panel(translate('Загальна інформація'), [
                ID::make()->sortable(),
                Text::make(translate('Електронна пошта'), 'email'),
                Text::make(translate('Номер телефону'), 'phone'),
                Password::make(translate('Пароль'), 'password')
            ]),

            new Panel(translate(''), [
                Text::make(translate('Імя'), 'first_name'),
                Text::make(translate('Прізвище'), 'last_name'),
            ]),


            new Panel(translate('Інше'), [
                Select::make(translate('Мова'), 'locale')->options([
                    'uk' => 'Українська',
                    'ru' => 'Російська'
                ])->hideFromIndex()
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
