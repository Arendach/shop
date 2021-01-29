<?php

namespace App\Http\Composers;

use Illuminate\View\View;
use CategoryFilter;

class CategoryFilterComposer
{
    public function compose(View $view)
    {
        $filter = CategoryFilter::get($view->category->id);

        $manufacturers = $filter->getManufacturers();
        $characteristics = $filter->getCharacteristics();

        $categoryFilterData = [
            'minPrice'        => request('min_price') ? request('min_price') : $filter->getMinPrice(),
            'maxPrice'        => request('max_price') ? request('max_price') : $filter->getMaxPrice(),
            'manufacturers'   => $manufacturers,
            'characteristics' => $characteristics,
            'valueView'       => setting('Отображение цены в фильтре','1')
        ];

        $view->with(compact('categoryFilterData'));
    }
}