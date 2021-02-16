<?php

namespace App\Nova;

use App\Models\ProductCollection;
use Eminiarts\Tabs\Tabs;
use Eminiarts\Tabs\TabsOnEdit;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\BelongsToMany;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Image;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Trix;
use Laravel\Nova\Panel;
use NovaAttachMany\AttachMany;
use OptimistDigital\NovaSortable\Traits\HasSortableRows;

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
        return translate('Колекції');
    }

    public function fields(Request $request)
    {
        return [
            (new Tabs('Колекції', [
                new Panel(translate('Основна інформація'), [
                    ID::make()->sortable(),
                    Select::make(translate('Батьківська категорія'), 'parent_id')->options(function () {
                        return ProductCollection::where('parent_id', 0)->get()->mapWithKeys(function (ProductCollection $collection) {
                            return [$collection->id => $collection->name];
                        })->put(0, translate('Коренева категорія'))->toArray();
                    })->displayUsingLabels(),
                    Boolean::make(translate('Показувати на головній'), 'is_home')->sortable(),
                    Text::make('Slug', 'slug')->required(),
                    Image::make(translate('Зображення'), 'image')->path('images/collections')
                ]),
                new Panel(translate('Українська локалізація'), [
                    Text::make(translate('Назва'), 'name_uk'),
                    Text::make(translate('Meta title'), 'meta_title_uk')->hideFromIndex(),
                    Text::make(translate('Meta keywords'), 'meta_keywords_uk')->hideFromIndex(),
                    Text::make(translate('Meta description'), 'meta_description_uk')->hideFromIndex(),
                    Trix::make(translate('Опис'), 'description_uk')->withFiles()->hideFromIndex(),
                ]),
                new Panel(translate('Російська локалізація'), [
                    Text::make(translate('Назва'), 'name_ru')->hideFromIndex(),
                    Text::make(translate('Meta title'), 'meta_title_ru')->hideFromIndex(),
                    Text::make(translate('Meta keywords'), 'meta_keywords_ru')->hideFromIndex(),
                    Text::make(translate('Meta description'), 'meta_description_ru')->hideFromIndex(),
                    Trix::make(translate('Опис'), 'description_ru')->withFiles(),
                ]),
                new Panel(translate('Товари'), [
                    AttachMany::make(translate('Товари'), 'products', Products::class)->hideFromIndex()->showPreview()
                ])
            ]))->withToolbar()
        ];
    }
}
