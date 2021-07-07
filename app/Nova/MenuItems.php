<?php

namespace App\Nova;

use Artisan;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Text;
use \App\Models\Menu as Menuq;

class MenuItems extends Resource
{
    public static $model = 'App\Models\MenuItem';

    public static $title = 'id';

    public static $search = ['id', 'name_uk', 'name_ru'];

    public static $displayInNavigation = false;

    public static function label()
    {
        return 'Підпункти меню';
    }

    public function fields(Request $request)
    {
        Artisan::call('cache:clear');

        return [
            ID::make()->sortable(),
            BelongsTo::make('БАТЬКІВСЬКА КАТЕГОРІЯ', 'menu', Menu::class)->onlyOnIndex()->sortable(),
            Select::make('БАТЬКІВСЬКА КАТЕГОРІЯ', 'menu_id')->options($this->MenuList())->displayUsingLabels()->onlyOnForms(),
            Text::make('Назва (ук)', 'name_uk'),
            Text::make('Назва (ру)', 'name_ru')->hideFromIndex(),
            Text::make('Колонка (ук)', 'column_uk'),
            Text::make('Колонка (ру)', 'column_ru')->hideFromIndex(),
            Text::make('Посилання', 'url')
        ];
    }
    private function MenuList()
    {
        $result = [];
        $products = Menuq::get();
        foreach ($products as $product)
        {
            $result[$product->id] = $product->name;
        }

        return $result;
    }

}
