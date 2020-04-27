<?php

namespace App\Nova;

use Arendach\NovaPackingField\NovaPackingField;
use Eminiarts\Tabs\Tabs;
use Eminiarts\Tabs\TabsOnEdit;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\BelongsToMany;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Image;
use Laravel\Nova\Fields\KeyValue;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Trix;
use Laravel\Nova\Panel;
use Media24si\NovaYoutubeField\Youtube;

class Products extends Resource
{
    use TabsOnEdit;

    public static $model = 'App\Models\Product';

    public static $title = 'name_uk';

    public static $search = [
        'id', 'article', 'name_uk', 'name_ru'
    ];

    public static $with = ['category'];

    public static function label()
    {
        return translate('Товари');
    }

    public function fields(Request $request)
    {
        return [
            (new Tabs(translate('Товари'), [
                new Panel(translate('Основна інформація'), [
                    ID::make()->sortable(),
                    Text::make(translate('Артикул'), 'article')->sortable(),
                    Text::make(translate('Слаг'), 'slug')->sortable()->hideFromIndex(),
                    Text::make(translate('Стара адреса(url)'), 'old_url')->hideFromIndex(),
                    Text::make(translate('Ціна'), 'price')->sortable(),
                    Text::make(translate('Знижка'), 'discount')->sortable()->hideFromIndex(),
                    Boolean::make(translate('На складі'), 'on_storage')->sortable(),
                    Boolean::make(translate('Новинка'), 'is_new')->hideFromIndex(),
                    Boolean::make(translate('Рекомендовано'), 'is_recommended')->hideFromIndex(),
                    Boolean::make(translate('Показувати на головній'), 'is_home')->hideFromIndex(),
                    BelongsTo::make(translate('Категорія'), 'category', Categories::class),
                    NovaPackingField::make('Пакування', 'packing')
                ]),

                new Panel(translate('Українська локалізація'), [
                    Text::make(translate('Назва'), 'name_uk'),
                    Text::make(translate('Модель'), 'model_uk')->hideFromIndex(),
                    Text::make(translate('Заголовок (title)'), 'meta_title_uk')->hideFromIndex(),
                    Text::make(translate('Ключові слова(keywords)'), 'meta_keywords_uk')->hideFromIndex(),
                    Text::make(translate('Опис(description)'), 'meta_description_uk')->hideFromIndex(),
                    Trix::make(translate('Опис'), 'description_uk')->hideFromIndex(),
                ]),

                new Panel(translate('Російська локалізація'), [
                    Text::make(translate('Назва'), 'name_ru')->hideFromIndex(),
                    Text::make(translate('Модель'), 'model_ru')->hideFromIndex(),
                    Text::make(translate('Заголовок (title)'), 'meta_title_ru')->hideFromIndex(),
                    Text::make(translate('Ключові слова(keywords)'), 'meta_keywords_ru')->hideFromIndex(),
                    Text::make(translate('Опис(description)'), 'meta_description_ru')->hideFromIndex(),
                    Trix::make(translate('Опис'), 'description_ru')->hideFromIndex()
                ]),

                new Panel(translate('Медіа'), [
                    Image::make(translate('Зображення'), 'big')->path('/images/products'),
                    Youtube::make(translate('Відео'), 'video')->hideFromIndex()
                ]),

                new Panel(translate('Повязані товари'), [
                    BelongsToMany::make(translate('Повязані товари'), 'related', Products::class)
                ])
            ]))->withToolbar()
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
