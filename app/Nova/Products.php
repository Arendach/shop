<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\BelongsToMany;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Image;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Trix;
use Laravel\Nova\Panel;

class Products extends Resource
{
    public static $model = 'App\Models\Product';

    public static $title = 'name_uk';

    public static $search = [
        'id', 'article', 'name_uk', 'name_ru'
    ];

    public static $with = ['category'];

    public function fields(Request $request)
    {
        return [
            new Panel(translate('Основна інформація'), [
                ID::make()->sortable(),
                Text::make(translate('Артикул'), 'article')->sortable(),
                Text::make(translate('Слаг'), 'slug')->sortable()->hideFromIndex(),
                Text::make(translate('Ціна'), 'price')->sortable(),
                Text::make(translate('Знижка'), 'discount')->sortable()->hideFromIndex(),
                Boolean::make(translate('На складі'), 'on_storage')->sortable(),
                Boolean::make(translate('Новинка'), 'is_new')->hideFromIndex(),
                Boolean::make(translate('Рекомендовано'), 'is_recommended')->hideFromIndex(),
                Boolean::make(translate('Показувати на головній'), 'is_home')->hideFromIndex(),
                BelongsTo::make(translate('Категорія'), 'category', Categories::class)
            ]),

            new Panel(translate('Українська локалізація'), [
                Text::make(translate('Назва'), 'name_uk'),
                Text::make(translate('Заголовок (title)'), 'meta_title_uk')->hideFromIndex(),
                Text::make(translate('Ключові слова(keywords)'), 'meta_keywords_uk')->hideFromIndex(),
                Text::make(translate('Опис(description)'), 'meta_description_uk')->hideFromIndex(),
                Trix::make(translate('Опис'), 'description_uk')->hideFromIndex(),
            ]),

            new Panel(translate('Російська локалізація'), [
                Text::make(translate('Назва'), 'name_ru')->hideFromIndex(),
                Text::make(translate('Заголовок (title)'), 'meta_title_ru')->hideFromIndex(),
                Text::make(translate('Ключові слова(keywords)'), 'meta_keywords_ru')->hideFromIndex(),
                Text::make(translate('Опис(description)'), 'meta_description_ru')->hideFromIndex(),
                Trix::make(translate('Опис'), 'description_ru')->hideFromIndex()
            ]),

            new Panel(translate('Зображення'), [
                Image::make(translate('Зображення'), 'big')->path('/images/products')
            ]),

            new Panel(translate('Повязані товари'), [
                BelongsToMany::make(translate('Повязані товари'), 'related', Products::class)
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
