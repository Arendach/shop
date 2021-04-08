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
use OptimistDigital\NovaSortable\Traits\HasSortableRows;

class Banners extends Resource
{
    use HasSortableRows;
    public static $model = 'App\Models\BannerImage';

    public static $title = 'title_uk';

    public static $search = [
        'title_uk',
        'title_ru',
        'url_uk',
        'url_ru'
    ];

    public static function label()
    {
        return 'Банери';
    }

    public function fields(Request $request)
    {
        return [
            new Panel('Основна інформація', [
                ID::make()->hideFromIndex(),
                Image::make('Зображення', 'image')->path('/images/banner'),
                Color::make('Колір тексту', 'color'),
                Text::make('Посилання', 'url'),
                Select::make('Позиція тексту', 'position')->options([
                    'left'   => 'Зліва',
                    'right'  => 'Зправа',
                    'center' => 'По центру'
                ])
            ]),

            new Panel('Українська локалізація', [
                Text::make('Заголовок', 'title_uk'),
                Textarea::make('Опис', 'description_uk'),
                Text::make('Текст кнопки', 'button_uk')
            ]),

            new Panel('Російська локалізація', [
                Text::make('Заголовок', 'title_ru')->hideFromIndex(),
                Textarea::make('Опис', 'description_ru')->hideFromIndex(),
                Text::make('Текст кнопки', 'button_ru')->hideFromIndex()
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
