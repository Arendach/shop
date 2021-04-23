<?php

namespace App\Nova;

use DKulyk\Nova\Tabs;
use Eminiarts\Tabs\TabsOnEdit;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Panel;
use Waynestate\Nova\CKEditor;

class Faqs extends Resource
{
    use TabsOnEdit;

    public static $model = 'App\Models\Faq';

    public static $title = 'question_uk';

    public static $search = [
        'question_uk', 'question_ru'
    ];

    public static function label()
    {
        return 'FAQ';
    }

    public function fields(Request $request)
    {
        return [
            new Tabs('Часті запитання', [
                new Panel('Українська локалізація', [
                    Text::make('Запитання', 'question_uk'),
                    CKEditor::make('Відповідь', 'answer_uk')->hideFromIndex()
                ]),

                new Panel('Російська локалізація', [
                    Text::make('Запитання', 'question_ru')->hideFromIndex(),
                    CKEditor::make('Відповідь', 'answer_ru')->hideFromIndex()
                ]),
            ])
        ];
    }
}
