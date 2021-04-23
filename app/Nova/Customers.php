<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\Boolean;
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

    public static function label()
    {
        return 'Покупці';
    }

    public function fields(Request $request)
    {
        return [
            new Panel('Загальна інформація', [
                ID::make()->sortable(),
                Text::make('Електронна пошта', 'email'),
                Text::make('Номер телефону', 'phone'),
                Password::make('Пароль', 'password'),
                Boolean::make('Можливість редагувати контент', 'is_editable')->hideFromIndex()
            ]),

            new Panel('ФІО', [
                Text::make('Імя', 'first_name'),
                Text::make('Прізвище', 'last_name'),
            ]),


            new Panel('Інше', [
                Select::make('Мова', 'locale')->options([
                    'uk' => 'Українська',
                    'ru' => 'Російська'
                ])->hideFromIndex()
            ])
        ];
    }
}
