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

    public function fields(Request $request)
    {
        return [
            new Panel(translate('Основна інформація'), [
                ID::make()->sortable(),
                Text::make(translate('Артикул'), 'article')->sortable(),
                Text::make(translate('Слаг'), 'slug')->sortable(),
                Text::make(translate('Ціна'), 'price')->sortable(),
                Text::make(translate('Знижка'), 'discount')->sortable(),
                Boolean::make(translate('На складі'), 'on_storage'),
                Boolean::make(translate('Новинка'), 'is_new'),
                Boolean::make(translate('Рекомендовано'), 'is_recommended'),
                Boolean::make(translate('Показувати на головній'), 'is_home'),
                BelongsTo::make(translate('Категорія'), 'category', Categories::class)
            ]),

            new Panel(translate('Українська локалізація'), [
                Text::make(translate('Назва'), 'name_uk'),
                Text::make(translate('Заголовок (title)'), 'meta_title_uk'),
                Text::make(translate('Ключові слова(keywords)'), 'meta_keywords_uk'),
                Text::make(translate('Опис(description)'), 'meta_description_uk'),
                Trix::make(translate('Опис'), 'description_uk'),
            ]),

            new Panel(translate('Російська локалізація'), [
                Text::make(translate('Назва'), 'name_ru'),
                Text::make(translate('Заголовок (title)'), 'meta_title_ru'),
                Text::make(translate('Ключові слова(keywords)'), 'meta_keywords_ru'),
                Text::make(translate('Опис(description)'), 'meta_description_ru'),
                Trix::make(translate('Опис'), 'description_ru')
            ]),

            new Panel(translate('Зображення'), [
                Image::make(translate('Зображення'), 'big')
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
