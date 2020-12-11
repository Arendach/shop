<?php


namespace App\Nova;

use Laravel\Nova\Fields\Textarea;


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
use Laravel\Nova\Fields\KeyValue;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Trix;
use Laravel\Nova\Panel;
use Media24si\NovaYoutubeField\Youtube;
use OptimistDigital\NovaSortable\Traits\HasSortableRows;
use Waynestate\Nova\CKEditor;

class Products extends Resource
{
    use HasSortableRows;
    use TabsOnEdit;

    public static $model = 'App\Models\Product';

    public static $title = 'name';

    public static $search = [
        'id', 'article', 'name_uk', 'name_ru'
    ];

    public static $with = ['category'];

    public static function label()
    {
        return translate('Товари');
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
            (new Tabs(translate('Товари'), [
                new Panel(translate('Основна інформація'), [
                    ID::make()->sortable(),
                    Text::make(translate('Артикул'), 'article')->sortable(),
                    Text::make(translate('Слаг'), 'slug')->sortable()->hideFromIndex(),
                    Text::make(translate('Стара адреса(url)'), 'old_url')->hideFromIndex(),
                    Text::make(translate('Назва'), 'name_uk')->onlyOnIndex(),
                    Text::make(translate('Ціна'), 'price')->sortable(),
                    Text::make(translate('Знижка'), 'discount')->sortable()->hideFromIndex(),
                    Boolean::make(translate('На складі'), 'on_storage')->sortable(),
                    Boolean::make(translate('Новинка'), 'is_new')->hideFromIndex(),
                    Boolean::make(translate('Рекомендовано'), 'is_recommended')->hideFromIndex(),
                    Boolean::make(translate('Показувати на головній'), 'is_home')->hideFromIndex(),
                    BelongsTo::make(translate('Категорія'), 'category', Categories::class)->onlyOnIndex()->sortable(),
                    BelongsTo::make(translate('Виробник'), 'manufacturer', Products::class)->onlyOnIndex()->sortable(),
                    Select::make(translate('Категорія'), 'category_id')->options($this->categoryList())->onlyOnForms(),
                    NovaPackingField::make('Пакування', 'packing')->placeholders()->hideFromIndex(),
                    NovaPackingField::make(translate('Розміри'), 'volume')->placeholders([
                        'Висота', 'Ширина', 'Довжина'
                    ])->hideFromIndex(),
                    Text::make('Вага', 'weight')->hideFromIndex()
                ]),

                new Panel(translate('Українська локалізація'), [
                    Text::make(translate('Назва'), 'name_uk')->hideFromIndex(),
                    Text::make(translate('Модель'), 'model_uk')->hideFromIndex(),
                    Text::make(translate('Заголовок (title)'), 'meta_title_uk')->hideFromIndex(),
                    Text::make(translate('Ключові слова(keywords)'), 'meta_keywords_uk')->hideFromIndex(),
                    Text::make(translate('Опис(description)'), 'meta_description_uk')->hideFromIndex(),
                    CKEditor::make('Опис', 'description_uk')->hideFromIndex(),
                ]),

                new Panel(translate('Російська локалізація'), [
                    Text::make(translate('Назва'), 'name_ru')->hideFromIndex(),
                    Text::make(translate('Модель'), 'model_ru')->hideFromIndex(),
                    Text::make(translate('Заголовок (title)'), 'meta_title_ru')->hideFromIndex(),
                    Text::make(translate('Ключові слова(keywords)'), 'meta_keywords_ru')->hideFromIndex(),
                    Text::make(translate('Опис(description)'), 'meta_description_ru')->hideFromIndex(),
                    CKEditor::make('Опис', 'description_ru')->hideFromIndex()
                ]),

                new Panel(translate('Медіа'), [
                    Image::make(translate('Зображення'), 'big')->path('/images/products'),
                    Youtube::make(translate('Відео'), 'video')->hideFromIndex()
                ]),

                new Panel(translate('Повязані товари'), [
                    BelongsToMany::make(translate('Повязані товари'), 'related', Products::class)
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
}
