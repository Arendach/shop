<?php

namespace App\Nova;

use App\Models\Characteristic;
use App\Models\Product;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\HasOne;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;

class ProductsCharacteristic extends Resource
{


    public static $group = 'Відділ товарів';

    public static $model = 'App\Models\ProductCharacteristic';

    public static $title = 'id';

    //public static $with = ['Product'];

    public static function showColumnBorders()
    {
        return true;
    }

    public static function label()
    {
        return translate('Характеристики товарів');
    }

    public static $search = [
        'product_id'
    ];

    public function fields(Request $request)
    {
        return [
            ID::make()->sortable(),
            BelongsTo::make(translate('Характеристика'), 'characteristic', Products::class)->onlyOnIndex()->sortable(),
            BelongsTo::make(translate('Продукт'), 'product', Products::class)->onlyOnIndex()->sortable(),
            Select::make(translate('Характеристика'), 'characteristic_id')->options($this->CharacteristicsList())->displayUsingLabels()->onlyOnForms(),
            Select::make(translate('Продукт'), 'product_id')->options($this->ProductList())->displayUsingLabels()->onlyOnForms(),
            Text::make(translate('value_uk'), 'value_uk')->sortable(),
            Text::make(translate('value_ru'), 'value_ru')->sortable(),
            Text::make(translate('filter_uk'), 'filter_uk')->sortable(),
            Text::make(translate('filter_ru'), 'filter_ru')->sortable()
        ];
    }

    private function ProductList()
    {
        $result = [];
        $products = Product::get();
        foreach ($products as $product)
        {
            $result[$product->id] = $product->name;
        }

        return $result;
    }

    private function CharacteristicsList()
    {
        $characteristics = Characteristic::get();
        //dd($characteristics);
        $result = [];
        foreach ($characteristics as $character) {
            $result[$character->id] = $character->name;

        }

        return $result;
    }
}
