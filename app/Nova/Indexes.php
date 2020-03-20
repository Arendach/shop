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
        return translate('Налаштування сайту');
    }

    public function fields(Request $request)
    {
        return [
            (new Tabs(translate('Налаштування сайту'), [
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

                ]),

                new Panel(translate('Сео'), [
                    Html::make('')->html('<h2 style="margin: 30px">' . translate('Українська локалізація') . '</h2>'),
                    Text::make(translate('Заголовок (title)'), 'meta_title_uk')->hideFromIndex(),
                    Text::make(translate('Ключові слова (keywords)'), 'meta_keywords_uk')->hideFromIndex(),
                    Text::make(translate('Опис (description)'), 'meta_description_uk')->hideFromIndex(),
                    CKEditor::make(translate('Стаття'), 'article_uk'),

                    Html::make('')->html('<h2 style="margin: 30px">' . translate('Російська локалізація') . '</h2>'),
                    Text::make(translate('Заголовок (title)'), 'meta_title_ru')->hideFromIndex(),
                    Text::make(translate('Ключові слова (keywords)'), 'meta_keywords_ru')->hideFromIndex(),
                    Text::make(translate('Опис (description)'), 'meta_description_ru')->hideFromIndex(),
                    CKEditor::make(translate('Стаття'), 'article_ru'),
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
