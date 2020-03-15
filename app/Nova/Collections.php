<?php

namespace App\Nova;

use App\Models\ProductCollection;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\BelongsToMany;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Image;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Trix;
use Laravel\Nova\Panel;

class Collections extends Resource
{
    public static $model = ProductCollection::class;

    public static $title = 'name';

    public static $search = [
        'id', 'name_uk', 'name_uk', 'slug'
    ];

    public static function label()
    {
        return translate('Колекції');
    }

    public function fields(Request $request)
    {
        return [
            new Panel(translate('Основна інформація'), [
                ID::make()->sortable(),
                BelongsTo::make(translate('Батьківська категорія'), 'parent', Collections::class),
                Text::make('Slug', 'slug')->required(),
                Image::make(translate('Зображення'), 'image')
            ]),
            new Panel(translate('Українська локалізація'), [
                Text::make(translate('Назва'), 'name_uk'),
                Text::make(translate('Meta title'), 'meta_title_uk'),
                Text::make(translate('Meta keywords'), 'meta_keywords_uk'),
                Text::make(translate('Meta description'), 'meta_description_uk'),
                Trix::make(translate('Опис (ук)'), 'description_uk')->withFiles(),
            ]),
            new Panel(translate('Російська локалізація'), [
                Text::make(translate('Назва (ru)'), 'name_ru'),
                Text::make(translate('Meta title'), 'meta_title_ru'),
                Text::make(translate('Meta keywords'), 'meta_keywords_ru'),
                Text::make(translate('Meta description'), 'meta_description_ru'),
                Trix::make(translate('Опис (ru)'), 'description_ru')->withFiles(),
            ]),
            new Panel(translate('Товари'), [
                BelongsToMany::make(translate('Товари'), 'products', Products::class)
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
