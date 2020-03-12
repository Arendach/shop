<?php


namespace App\Nova;


use App\Models\Category;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\ID;

class Categories extends Resource
{
    public static $model = Category::class;

    public static $title = 'name_uk';

    public static $search = [
        'id', 'name_uk', 'name_ru'
    ];

    public function fields(Request $request): array
    {
        return [
            ID::make()->sortable()
        ];
    }
}