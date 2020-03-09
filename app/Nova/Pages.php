<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Trix;
use Laravel\Nova\Panel;

class Pages extends Resource
{
    public static $model = 'App\Models\Page';

    public static $title = 'name_uk';

    public static $search = [
        'name_uk',
        'name_ru'
    ];

    public static function label()
    {
        return translate('Сторінки');
    }

    public function fields(Request $request)
    {
        return [
            new Panel('Загальна інформація', [
                ID::make()->sortable(),
                Text::make(translate('Адреса(url slug)'), 'uri_name'),
                Boolean::make(translate('Швидка навігація'), 'is_fast_navigation'),
            ]),

            new Panel(translate('Українська локалізація'), [
                Text::make(translate('Назва'), 'name_uk'),
                Text::make(translate('Заголовок(title)'), 'meta_title_uk')->hideFromIndex(),
                Text::make(translate('Ключові слова(keywords)'), 'meta_keywords_uk')->hideFromIndex(),
                Text::make(translate('Опис(description)'), 'meta_description_uk')->hideFromIndex(),
                Trix::make(translate('Контент'), 'content_uk')->hideFromIndex(),
            ]),

            new Panel(translate('Російська локалізація'), [
                Text::make(translate('Назва'), 'name_ru')->hideFromIndex(),
                Text::make(translate('Заголовок(title)'), 'meta_title_ru')->hideFromIndex(),
                Text::make(translate('Ключові слова(keywords)'), 'meta_keywords_ru')->hideFromIndex(),
                Text::make(translate('Опис(description)'), 'meta_description_ru')->hideFromIndex(),
                Trix::make(translate('Контент'), 'content_ru')->hideFromIndex(),
            ])
        ];
    }
}
