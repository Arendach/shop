<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Panel;
use Waynestate\Nova\CKEditor;

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
        return 'Сторінки';
    }

    public function fields(Request $request)
    {
        return [
            new Panel('Загальна інформація', [
                ID::make()->sortable(),
                Text::make('Адреса(url slug)', 'uri_name'),
                Boolean::make('Швидка навігація', 'is_fast_navigation'),
            ]),

            new Panel('Українська локалізація', [
                Text::make('Назва', 'name_uk'),
                Text::make('Заголовок(title)', 'meta_title_uk')->hideFromIndex(),
                Text::make('Ключові слова(keywords)', 'meta_keywords_uk')->hideFromIndex(),
                Text::make('Опис(description)', 'meta_description_uk')->hideFromIndex(),
                CKEditor::make('Контент', 'content_uk')->hideFromIndex(),
            ]),

            new Panel('Російська локалізація', [
                Text::make('Назва', 'name_ru')->hideFromIndex(),
                Text::make('Заголовок(title)', 'meta_title_ru')->hideFromIndex(),
                Text::make('Ключові слова(keywords)', 'meta_keywords_ru')->hideFromIndex(),
                Text::make('Опис(description)', 'meta_description_ru')->hideFromIndex(),
                CKEditor::make('Контент', 'content_ru')->hideFromIndex(),
            ])
        ];
    }
}
