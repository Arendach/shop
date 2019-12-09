<?php

namespace App\Services;

use App\Models\Product;
use Cache;
use Illuminate\Support\Collection;

class CategoryFilterService
{

    /**
     * @var array
     */
    private $filters = [];

    public function __construct()
    {
        $this->boot();
    }

    private function boot()
    {

    }

    /**
     * @param int $category_id
     * @return mixed
     */
    public function get(int $category_id)
    {
        if (isset($this->filters[$category_id]))
            return $this->filters[$category_id];
        else
            if (!Cache::has("category.filters.$category_id"))
                $this->make($category_id);
            else
                $this->filters[$category_id] = Cache::get("category.filters.$category_id");

        return $this->filters[$category_id];
    }

    /**
     * @param int $category_id
     * @return void
     */
    public function make(int $category_id): void
    {
        if (Cache::has("category.filters.$category_id"))
            return;

        $products = Product::with('manufacturer')
            ->with('characteristics')
            ->where('category_id', $category_id)->get();

        $min_price = $this->makeMinPrice($products);

        $max_price = $this->makeMaxPrice($products);

        $characteristics = $this->makeCharacteristics($products);

        $manufacturers = $this->makeManufacturers($products);

        $data = [
            'min_price' => $min_price,
            'max_price' => $max_price,
            'manufacturers' => $manufacturers,
            'characteristics' => $characteristics,
        ];

        $this->filters[$category_id] = $data;

        Cache::put("category.filters.$category_id", $data, 60);
    }

    /**
     * @param Collection $products
     * @return array
     */
    private function makeCharacteristics(Collection $products): array
    {
        $characteristics = [];

        foreach ($products as $product) {
            foreach ($product->characteristics as $item) {
                if (!isset($characteristics[$item->characteristic_id])) {
                    $characteristics[$item->characteristic_id] = [
                        'id' => $item->characteristic->id,
                        'name_uk' => $item->characteristic->name_uk,
                        'name_ru' => $item->characteristic->name_ru,
                        'type' => $item->characteristic->type,
                        'prefix_uk' => $item->characteristic->prefix_uk,
                        'prefix_ru' => $item->characteristic->prefix_ru,
                        'postfix_uk' => $item->characteristic->postfix_uk,
                        'postfix_ru' => $item->characteristic->postfix_ru,
                        'values' => []
                    ];
                }

                $characteristics[$item->characteristic_id]['values'][] = [
                    'value_uk' => $item->value_uk,
                    'value_ru' => $item->value_ru,
                ];
            }
        }

        foreach ($characteristics as $key => $characteristic) {
            $characteristics[$key]['values'] = collect($characteristic['values'])->unique('value_uk')->values()->all();
        }

        return $characteristics;
    }

    /**
     * @param Collection $products
     * @return array
     */
    private function makeManufacturers(Collection $products): array
    {
        $manufacturers = [];

        foreach ($products as $item) {
            $manufacturers[$item->manufacturer_id] = [
                'id' => $item->manufacturer->id,
                'name_uk' => $item->manufacturer->name_uk,
                'name_ru' => $item->manufacturer->name_ru
            ];
        }

        return $manufacturers;
    }

    /**
     * @param Collection $products
     * @return float
     */
    private function makeMaxPrice(Collection $products): float
    {
        return (float)$products->max(function ($item) {
            return $item->getOriginal('price');
        });
    }

    /**
     * @param Collection $products
     * @return float
     */
    private function makeMinPrice(Collection $products): float
    {
        return (float)$products->min(function ($item) {
            return $item->getOriginal('price');
        });
    }

}