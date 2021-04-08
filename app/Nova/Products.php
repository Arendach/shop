<?php


namespace App\Nova;

use App\Models\Manufacturer;


use App\Models\Category;
use Arendach\NovaPackingField\NovaPackingField;
use Eminiarts\Tabs\Tabs;
use Eminiarts\Tabs\TabsOnEdit;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\BelongsToMany;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Image;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Panel;
use Media24si\NovaYoutubeField\Youtube;
use OptimistDigital\NovaSortable\Traits\HasSortableRows;
use Waynestate\Nova\CKEditor;

class Products extends Resource
{
    use HasSortableRows;
    use TabsOnEdit;


    public static $group = 'Відділ товарів';

    public static $model = 'App\Models\Product';

    public static $title = 'name';

    public static $search = [
        'id', 'article', 'name_uk', 'name_ru'
    ];

    public static $with = ['category'];

    public static function label()
    {
        return 'Товари';
    }

    public function filters(Request $request)
    {
        return [
            new Filters\Products,
        ];
    }

    public function fields(Request $request)
    {
        artisan('cache:clear');

        return [
            (new Tabs('Товари', [
                new Panel('Основна інформація', [
                    ID::make()->sortable(),
                    Text::make('Артикул', 'article')->sortable(),
                    Text::make('Слаг', 'slug')->sortable()->hideFromIndex(),
                    Text::make('Стара адреса(url)', 'old_url')->hideFromIndex(),
                    Text::make('Назва', 'name_uk')->onlyOnIndex(),
                    Text::make('Ціна', 'price')->sortable(),
                    Text::make('Знижка', 'discount')->sortable()->hideFromIndex(),
                    Boolean::make('На складі', 'on_storage')->sortable(),
                    Boolean::make('Новинка', 'is_new')->hideFromIndex(),
                    Boolean::make('Рекомендовано', 'is_recommended')->hideFromIndex(),
                    Boolean::make('Показувати на головній', 'is_home')->hideFromIndex(),
                    BelongsTo::make('Категорія', 'category', Categories::class)->onlyOnIndex()->sortable(),
                    BelongsTo::make('Виробник', 'manufacturer', Products::class)->onlyOnIndex()->sortable(),
                    Select::make('Виробник', 'manufacturer_id')->options($this->manufacturerList())->onlyOnForms(),
                    Select::make('Категорія', 'category_id')->options($this->categoryList())->onlyOnForms(),
                    NovaPackingField::make('Пакування', 'packing')->placeholders()->hideFromIndex(),
                    NovaPackingField::make('Розміри', 'volume')->placeholders([
                        'Висота', 'Ширина', 'Довжина'
                    ])->hideFromIndex(),
                    Text::make('Вага', 'weight')->hideFromIndex()
                ]),

                new Panel('Українська локалізація', [
                    Text::make('Назва', 'name_uk')->hideFromIndex(),
                    Text::make('Модель', 'model_uk')->hideFromIndex(),
                    Text::make('Заголовок (title)', 'meta_title_uk')->hideFromIndex(),
                    Text::make('Ключові слова(keywords)', 'meta_keywords_uk')->hideFromIndex(),
                    Text::make('Опис(description)', 'meta_description_uk')->hideFromIndex(),
                    CKEditor::make('Опис', 'description_uk')->hideFromIndex(),
                ]),

                new Panel('Російська локалізація', [
                    Text::make('Назва', 'name_ru')->hideFromIndex(),
                    Text::make('Модель', 'model_ru')->hideFromIndex(),
                    Text::make('Заголовок (title)', 'meta_title_ru')->hideFromIndex(),
                    Text::make('Ключові слова(keywords)', 'meta_keywords_ru')->hideFromIndex(),
                    Text::make('Опис(description)', 'meta_description_ru')->hideFromIndex(),
                    CKEditor::make('Опис', 'description_ru')->hideFromIndex()
                ]),

                new Panel('Медіа', [
                    Image::make('Зображення', 'big')->path('/images/products'),
                    Youtube::make('Відео', 'video')->hideFromIndex()
                ]),

                new Panel('Повязані товари', [
                    BelongsToMany::make('Повязані товари', 'related', Products::class)
                ]),

                new Panel('Теги', [
                    Text::make('name_uk')->hideFromIndex(),
                    HasMany::make('', 'tags', ProductTags::class)
                ])
            ]))->withToolbar()
        ];
    }

    private function categoryList()
    {
        $categories = Category::with('child')->where('parent_id', 0)->get();
        $result = [];
        foreach ($categories as $category) {
            $result[$category->id] = $category->name;

            foreach ($category->child as $childCategory) {
                $result[$childCategory->id] = " --- " . $childCategory->name;
            }
        }

        return $result;
    }

    private function manufacturerList()
    {
        $manufacturers = Manufacturer::get();
        $result = [];
        foreach ($manufacturers as $manufacturer) {
            $result[$manufacturer->id] = $manufacturer->name;
        }
        return $result;
    }
}
