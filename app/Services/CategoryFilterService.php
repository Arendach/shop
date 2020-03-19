<?php

namespace App\Services;

use App\Models\Product;
use App\Models\ProductCharacteristic;
use Cache;
use Illuminate\Support\Collection;

class CategoryFilterService
{
    private $filter = [];

    public function get(int $category_id): self
    {
        $this->filter = Cache::rememberForever("category.filters.$category_id", function () use ($category_id) {
            return $this->make($category_id);
        });

        return $this;
    }

    private function make(int $category_id)
    {
        $products = Product::with('manufacturer')
            ->with('characteristics')
            ->where('category_id', $category_id)
            ->get();

        $min_price = $this->makeMinPrice($products);

        $max_price = $this->makeMaxPrice($products);

        $characteristics = $this->makeCharacteristics($products);

        $manufacturers = $this->makeManufacturers($products);

        $data = [
            'min_price'       => $min_price,
            'max_price'       => $max_price,
            'manufacturers'   => $manufacturers,
            'characteristics' => $characteristics,
        ];

        return $data;
    }

    private function makeCharacteristics($products)
    {
        $characteristics = collect([]);

        /** @var $products Collection|Product[] */
        $products->each(function (Product $product) use (&$characteristics) {
            $product->characteristics->each(function (ProductCharacteristic $characteristic) use (&$characteristics) {
                $characteristics->prepend($characteristic);
            });
        });

        return ($characteristics->unique('characteristic.id')->map(function (ProductCharacteristic $characteristic) use ($characteristics) {
            $values = $characteristics->where('characteristic_id', $characteristic->characteristic_id)->unique('value_uk')->map(function (ProductCharacteristic $productCharacteristic) {
                return $productCharacteristic;
            });

            $characteristic->characteristic->setValues($values);

            return $characteristic->characteristic;
        }));
    }

    private function makeManufacturers(Collection $products): Collection
    {
        return ($products->map(function (Product $product) {
            return $product->manufacturer;
        })->unique());
    }

    private function makeMaxPrice(Collection $products): float
    {
        return (float)$products->max(function ($item) {
            return $item->getOriginal('price');
        });
    }

    private function makeMinPrice(Collection $products): float
    {
        return (float)$products->min(function ($item) {
            return $item->getOriginal('price');
        });
    }

    public function getCharacteristics()
    {
        return $this->filter['characteristics'] ?? [];
    }

    public function getManufacturers()
    {
        return $this->filter['manufacturers'] ?? [];
    }

    public function getMinPrice(): ?float
    {
        return $this->filter['min_price'] ?? null;
    }

    public function getMaxPrice(): ?float
    {
        return $this->filter['max_price'] ?? null;
    }
}