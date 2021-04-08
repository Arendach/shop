<?php

namespace App\Nova;

use Eminiarts\Tabs\Tabs;
use Eminiarts\Tabs\TabsOnEdit;
use Illuminate\Http\Request;
use JoshMoreno\Html\Html;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Image;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Panel;
use Waynestate\Nova\CKEditor;

class Indexes extends Resource
{
    use TabsOnEdit;

    public static $model = 'App\Models\Index';

    public static $title = 'name';

    public static function label()
    {
        return 'Налаштування сайту';
    }

    public function fields(Request $request)
    {
        return [
            (new Tabs('Налаштування сайту', [
                new Panel('Загальна інформація', [
                    ID::make()->sortable(),
                    Text::make('Назва', 'name'),
                    Boolean::make('За замовчуванням', 'is_main')
                ]),

                new Panel('Шапка сайту', [
                    Image::make('Логотип', 'logo')->path('images/logo'),
                    Text::make('Номер телефону', 'header_phone')->hideFromIndex()
                ]),

                new Panel('Низ сайту', [
                    Text::make('Номер телефону', 'footer_phone')->hideFromIndex(),
                    Text::make('Адреса магазину(uk)', 'footer_address_uk')->hideFromIndex(),
                    Text::make('Адреса магазину(ru)', 'footer_address_ru')->hideFromIndex(),
                    Text::make('Електронна пошта', 'footer_email')->hideFromIndex(),

                ]),

                new Panel('Сео', [
                    Html::make('')->html('<h2 style="margin: 30px">' . 'Українська локалізація' . '</h2>'),
                    Text::make('Заголовок (title)', 'meta_title_uk')->hideFromIndex(),
                    Text::make('Ключові слова (keywords)', 'meta_keywords_uk')->hideFromIndex(),
                    Text::make('Опис (description)', 'meta_description_uk')->hideFromIndex(),
                    CKEditor::make('Стаття', 'article_uk'),

                    Html::make('')->html('<h2 style="margin: 30px">' . 'Російська локалізація' . '</h2>'),
                    Text::make('Заголовок (title)', 'meta_title_ru')->hideFromIndex(),
                    Text::make('Ключові слова (keywords)', 'meta_keywords_ru')->hideFromIndex(),
                    Text::make('Опис (description)', 'meta_description_ru')->hideFromIndex(),
                    CKEditor::make('Стаття', 'article_ru'),
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
