<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Text;

class ProductTags extends Resource
{
    public static $model = 'App\Models\ProductTag';

    public static $title = 'title_uk';

    public static function label()
    {
        return 'Теги';
    }

    public function fields(Request $request)
    {
        return [
            Text::make('Українською', 'title_uk'),
            Text::make('Російською', 'title_ru'),
            BelongsTo::make('Товар', 'product_id')
        ];
    }
}
