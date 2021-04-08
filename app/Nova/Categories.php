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
        return 'Категорії';
    }

    public function fields(Request $request): array
    {
        return [
            (new Tabs('Товари', [
                new Panel('Загальна інформація', [
                    ID::make()->sortable(),
                    Select::make('Батьківська категорія', 'parent_id')->options($this->rootCategories())->displayUsingLabels(),
                    Text::make('Slug', 'slug'),
                    Boolean::make('Вибрати як кореневе посилання', 'is_link')->hideFromIndex(),
                    Text::make('Адреса посилання', 'root_link')->hideFromIndex(),
                    Boolean::make('Активна', 'is_active'),
                    Image::make('Зображення банеру', 'big')->path('images/categories'),
                    Image::make('Зображення', 'small')->path('images/categories')
                ]),

                new Panel('Українська локалізація', [
                    Text::make('Назва', 'name_uk'),
                    Text::make('Заголовок (title)', 'meta_title_uk')->hideFromIndex(),
                    Text::make('Опис (description)', 'meta_description_uk')->hideFromIndex(),
                    Text::make('Ключові слова (keywords)', 'meta_keywords_uk')->hideFromIndex(),
                    CKEditor::make('Опис', 'description_uk')->hideFromIndex(),
                ]),

                new Panel('Російська локалізація', [
                    Text::make('Назва', 'name_ru')->hideFromIndex(),
                    Text::make('Заголовок (title)', 'meta_title_ru')->hideFromIndex(),
                    Text::make('Опис (description)', 'meta_description_ru')->hideFromIndex(),
                    Text::make('Ключові слова (keywords)', 'meta_keywords_ru')->hideFromIndex(),
                    CKEditor::make('Опис', 'description_ru')->hideFromIndex(),
                ]),

                new Panel('Шаблони(uk)', [
                    Textarea::make('Назва', 'name_template_uk')->hideFromIndex(),
                    Textarea::make('Опис', 'description_template_uk')->hideFromIndex(),
                    Textarea::make('Title', 'meta_title_template_uk')->hideFromIndex(),
                    Textarea::make('Description', 'meta_description_template_uk')->hideFromIndex(),
                    Textarea::make('Keywords', 'meta_keywords_template_uk')->hideFromIndex(),
                ]),

                new Panel('Шаблони(ru)', [
                    Textarea::make('Назва', 'name_template_ru')->hideFromIndex(),
                    Textarea::make('Опис', 'description_template_ru')->hideFromIndex(),
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
        $result = ['Коренева категорія'];
        foreach ($categories as $item) {
            $result[$item->id] = $item->name;
        }

        return $result;
    }
}