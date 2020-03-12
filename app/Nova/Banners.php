<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Image;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Panel;
use Timothyasp\Color\Color;

class Banners extends Resource
{
    public static $model = 'App\Models\BannerImage';

    public static $title = 'title_uk';

    public static $search = [
        'title_uk',
        'title_ru',
        'url_uk',
        'url_ru'
    ];

    public function fields(Request $request)
    {
        return [
            new Panel(translate('Основна інформація'), [
                ID::make()->hideFromIndex(),
                Image::make(translate('Зображення'), 'image')->path('/images/banner'),
                Color::make(translate('Колір тексту'), 'color'),
                Text::make(translate('Посилання'), 'url'),
                Select::make(translate('Позиція тексту'), 'position')->options([
                    'left'   => 'Зліва',
                    'right'  => 'Зправа',
                    'center' => 'По центру'
                ])
            ]),

            new Panel(translate('Українська локалізація'), [
                Text::make(translate('Заголовок'), 'title_uk'),
                Textarea::make(translate('Опис'), 'description_uk'),
                Text::make(translate('Текст кнопки'), 'button_uk')
            ]),

            new Panel(translate('Російська локалізація'), [
                Text::make(translate('Заголовок'), 'title_ru')->hideFromIndex(),
                Textarea::make(translate('Опис'), 'description_ru')->hideFromIndex(),
                Text::make(translate('Текст кнопки'), 'button_ru')->hideFromIndex()
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
