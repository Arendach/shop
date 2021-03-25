<?php

namespace App\Nova;

use App\Models\Category;
use App\Models\Product;
use App\Models\ProductCollection;
use App\Models\Question;
use Eminiarts\Tabs\Tabs;
use Eminiarts\Tabs\TabsOnEdit;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Trix;
use Laravel\Nova\Panel;
use NovaAttachMany\AttachMany;
use OptimistDigital\NovaSortable\Traits\HasSortableRows;

class Questions extends Resource
{
    use TabsOnEdit;
    use HasSortableRows;

    public static $model = Question::class;

    public static $title = 'question_uk';

    public static $search = [
        'id',
        'question_ru',
        'question_uk',
        'answer_ru',
        'answer_uk'
    ];

    public static function label()
    {
        return translate('FAQ нова версія');
    }

    public function fields(Request $request)
    {
        return [
            (new Tabs('FAQ нова версія', [
                new Panel(translate('Де показувати?'), [
                    ID::make()->sortable(),
                    Boolean::make(translate('Показувати на головній'), 'is_home')->hideFromIndex(),
                    Boolean::make(translate('Показувати в категоріях'), 'is_category')->hideFromIndex(),
                    Boolean::make(translate('Показувати в колекціях'), 'is_collection')->hideFromIndex(),
                    Boolean::make(translate('Показувати на інших сторінках'), 'is_other')->hideFromIndex(),
                ]),
                new Panel(translate('Російська локалізація'), [
                    Text::make(translate('Питання РУС'), 'question_ru')->sortable(),
                    Trix::make(translate('Відповідь РУС'), 'answer_ru')->sortable()->hideFromIndex()
                ]),
                new Panel(translate('Українська локалізація'), [
                    Text::make(translate('Питання УКР'), 'question_uk')->sortable(),
                    Trix::make(translate('Відповідь УКР'), 'answer_uk')->sortable()->hideFromIndex(),
                ]),
                new Panel(translate('Категорії'), [
                    AttachMany::make(translate('Категорії'), 'categories', Categories::class)
                        ->hideFromIndex()
                        ->showPreview()
                        ->showCounts()
                        ->help(translate('Якщо не стоїть чекбокс, показуватись все рівно не будуть, не залежно вибрані Категорії чи ні'))
                ]),
                new Panel(translate('Колекції'), [
                    AttachMany::make(translate('Колекції'), 'collections', Collections::class)
                        ->hideFromIndex()
                        ->showPreview()
                        ->showCounts()
                        ->help(translate('Якщо не стоїть чекбокс, показуватись все рівно не будуть, не залежно вибрані Колекції чи ні'))
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
