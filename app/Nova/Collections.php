<?php

namespace App\Nova;

use App\Models\ProductCollection;
use Eminiarts\Tabs\Tabs;
use Eminiarts\Tabs\TabsOnEdit;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Image;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Trix;
use Laravel\Nova\Panel;
use NovaAttachMany\AttachMany;
use OptimistDigital\NovaSortable\Traits\HasSortableRows;
use Timothyasp\Color\Color;

class Collections extends Resource
{
    use TabsOnEdit;
    use HasSortableRows;

    public static $model = ProductCollection::class;

    public static $title = 'name';

    public static $search = [
        'id', 'name_uk', 'name_uk', 'slug'
    ];

    public static function label()
    {
        return 'Колекції';
    }

    public function fields(Request $request)
    {
        return [
            (new Tabs('Колекції', [
                new Panel('Основна інформація', [
                    ID::make()->sortable(),
                    Select::make('Батьківська категорія', 'parent_id')->options(function () {
                        return ProductCollection::where('parent_id', 0)->get()->mapWithKeys(function (ProductCollection $collection) {
                            return [$collection->id => $collection->name];
                        })->put(0, 'Коренева категорія')->toArray();
                    })->displayUsingLabels()->sortable(),
                    Text::make('Назва', 'name_uk')->onlyOnIndex()->sortable(),
                    Boolean::make('Показувати на головній', 'is_home'),
                    Boolean::make('Активна', 'is_active'),
                    Text::make('Slug', 'slug')->required(),
                    Image::make('Зображення', 'image')->path('images/collections'),
                    Color::make('Колір кнопки', 'button_color')->hideFromIndex(),
                ]),
                new Panel('Українська локалізація', [
                    Text::make('Назва', 'name_uk')->hideFromIndex(),
                    Text::make('Meta title', 'meta_title_uk')->hideFromIndex(),
                    Text::make('Meta keywords', 'meta_keywords_uk')->hideFromIndex(),
                    Text::make('Meta description', 'meta_description_uk')->hideFromIndex(),
                    Trix::make('Опис', 'description_uk')->withFiles()->hideFromIndex(),
                ]),
                new Panel('Російська локалізація', [
                    Text::make('Назва', 'name_ru')->hideFromIndex(),
                    Text::make('Meta title', 'meta_title_ru')->hideFromIndex(),
                    Text::make('Meta keywords', 'meta_keywords_ru')->hideFromIndex(),
                    Text::make('Meta description', 'meta_description_ru')->hideFromIndex(),
                    Trix::make('Опис', 'description_ru')->withFiles(),
                ]),
                new Panel('Товари', [
                    AttachMany::make('Товари', 'products', Products::class)->hideFromIndex()->showPreview()->showCounts()
                ])
            ]))->withToolbar()
        ];
    }
}
