<?php


namespace App\Nova;


use App\Models\Category;
use Eminiarts\Tabs\Tabs;
use Eminiarts\Tabs\TabsOnEdit;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Image;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Fields\Trix;
use Laravel\Nova\Panel;
use OptimistDigital\NovaSortable\Traits\HasSortableRows;
use Waynestate\Nova\CKEditor;

class Categories extends Resource
{
    use HasSortableRows;
    use TabsOnEdit;

    public static $model = 'App\Models\Category';

    public static $title = 'name_uk';

    public static function label()
    {
        return translate('Категорії');
    }

    public function fields(Request $request): array
    {
        return [
            (new Tabs(translate('Товари'), [
                new Panel(translate('Загальна інформація'), [
                    ID::make()->sortable(),
                    Select::make(translate('Батьківська категорія'), 'parent_id')->options($this->rootCategories())->displayUsingLabels(),
                    Text::make('Slug', 'slug'),
                    Boolean::make(translate('Активна'), 'is_active'),
                    Image::make(translate('Зображення'), 'big')->path('images/categories')
                ]),

                new Panel(translate('Українська локалізація'), [
                    Text::make(translate('Назва'), 'name_uk'),
                    Text::make(translate('Заголовок (title)'), 'meta_title_uk')->hideFromIndex(),
                    Text::make(translate('Опис (description)'), 'meta_description_uk')->hideFromIndex(),
                    Text::make(translate('Ключові слова (keywords)'), 'meta_keywords_uk')->hideFromIndex(),
                    CKEditor::make('Опис', 'description_uk')->hideFromIndex(),
                ]),

                new Panel(translate('Російська локалізація'), [
                    Text::make(translate('Назва'), 'name_ru')->hideFromIndex(),
                    Text::make(translate('Заголовок (title)'), 'meta_title_ru')->hideFromIndex(),
                    Text::make(translate('Опис (description)'), 'meta_description_ru')->hideFromIndex(),
                    Text::make(translate('Ключові слова (keywords)'), 'meta_keywords_ru')->hideFromIndex(),
                    CKEditor::make('Опис', 'description_ru')->hideFromIndex(),
                ]),

                new Panel(translate('Шаблони(uk)'), [
                    Textarea::make(translate('Назва'), 'name_template_uk')->hideFromIndex(),
                    Textarea::make(translate('Опис'), 'description_template_uk')->hideFromIndex(),
                    Textarea::make('Title', 'meta_title_template_uk')->hideFromIndex(),
                    Textarea::make('Description', 'meta_description_template_uk')->hideFromIndex(),
                    Textarea::make('Keywords', 'meta_keywords_template_uk')->hideFromIndex(),
                ]),

                new Panel(translate('Шаблони(ru)'), [
                    Textarea::make(translate('Назва'), 'name_template_ru')->hideFromIndex(),
                    Textarea::make(translate('Опис'), 'description_template_ru')->hideFromIndex(),
                    Textarea::make('Title', 'meta_title_template_ru')->hideFromIndex(),
                    Textarea::make('Description', 'meta_description_template_ru')->hideFromIndex(),
                    Textarea::make('Keywords', 'meta_keywords_template_ru')->hideFromIndex(),
                ])
            ]))->withToolbar()
        ];
    }

    private function rootCategories(): array
    {
        $categories = Category::where('parent_id', 0)->get();
        $result = [translate('Коренева категорія')];
        foreach ($categories as $item) {
            $result[$item->id] = $item->name;
        }

        return $result;
    }
}