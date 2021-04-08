<?php

namespace App\Nova;

use App\Models\Characteristic;
use App\Models\Product;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Text;

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
        return 'Характеристики товарів';
    }

    public static $search = [
        'product_id',
        'filter_uk',
        'filter_ru',
        'value_uk',
        'value_ru'
    ];

    public function fields(Request $request)
    {
        return [
            ID::make()->sortable(),
            BelongsTo::make('Характеристика', 'characteristic', Products::class)->onlyOnIndex()->sortable(),
            BelongsTo::make('Продукт', 'product', Products::class)->onlyOnIndex()->sortable(),
            Select::make('Характеристика', 'characteristic_id')->options($this->CharacteristicsList())->displayUsingLabels()->onlyOnForms(),
            Select::make('Продукт', 'product_id')->options($this->ProductList())->displayUsingLabels()->onlyOnForms(),
            Text::make('value_uk', 'value_uk')->sortable(),
            Text::make('value_ru', 'value_ru')->sortable(),
            Text::make('filter_uk', 'filter_uk')->sortable(),
            Text::make('filter_ru', 'filter_ru')->sortable()
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
