<?php


namespace App\Nova;


use App\Models\Category;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Image;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Trix;
use Laravel\Nova\Panel;
use OptimistDigital\NovaSortable\Traits\HasSortableRows;

class Categories extends Resource
{
    use HasSortableRows;

    public static $model = 'App\Models\Category';

    public static $title = 'name_uk';

    public static function label()
    {
        return translate('Категорії');
    }

    public function fields(Request $request): array
    {
        return [
            new Panel(translate('Загальна інформація'), [
                ID::make()->sortable(),
                 Select::make(translate('Батьківська категорія'), 'parent_id')->options(function () {
                     return (Category::where('parent_id', 0)->get()->mapWithKeys(function (Category $category) {
                         return [$category->id => $category->name];
                     })->prepend(translate('Коренева категорія')));
                 })->displayUsingLabels(),
                Text::make(translate('Шаблон імені товара'), 'name_template'),
                Text::make('Slug', 'slug'),
                Boolean::make(translate('Активна'), 'is_active'),
                Image::make(translate('Зображення'), 'big')->path('images/categories')
            ]),

            new Panel(translate('Українська локалізація'), [
                Text::make(translate('Назва'), 'name_uk'),
                Text::make(translate('Заголовок (title)'), 'meta_title_uk')->hideFromIndex(),
                Text::make(translate('Опис (description)'), 'meta_description_uk')->hideFromIndex(),
                Text::make(translate('Ключові слова (keywords)'), 'meta_keywords_uk')->hideFromIndex(),
                Trix::make(translate('Опис'), 'description_uk')->hideFromIndex(),
            ]),

            new Panel(translate('Російська локалізація'), [
                Text::make(translate('Назва'), 'name_ru')->hideFromIndex(),
                Text::make(translate('Заголовок (title)'), 'meta_title_ru')->hideFromIndex(),
                Text::make(translate('Опис (description)'), 'meta_description_ru')->hideFromIndex(),
                Text::make(translate('Ключові слова (keywords)'), 'meta_keywords_ru')->hideFromIndex(),
                Trix::make(translate('Опис'), 'description_ru')->hideFromIndex(),
            ]),
        ];
    }
}