<?php

namespace App\Filters;

use Illuminate\Database\Eloquent\Builder;

class CategoryProductFilter extends BasicFilter
{
    protected function characteristics($characteristics): void
    {
        if (!is_array($characteristics)) return;

        foreach ($characteristics as $id => $keys) {
            $this->builder->whereHas('characteristics', function (Builder $query) use ($id, $keys) {
                $lang = config('locale.current');
                $query->where('characteristic_id', $id)->whereIn("value_$lang", $keys);
            });
        }
    }

    protected function manufacturers($manufacturers): void
    {
        if (!is_array($manufacturers)) return;

        $this->builder->whereIn('manufacturer_id', $manufacturers);
    }

    protected function order($order): void
    {
        $allowed = [
            'rating,desc',
            'date,desc',
            'price,asc',
            'price,desc'
        ];

        if (!is_string($order) || !in_array($order, $allowed))
            $order = 'date,desc';

        [$column, $direction] = explode(',', $order);

        if ($column == 'rating')
            $this->builder->orderBy('rating', $direction);
        elseif ($column == 'date')
            $this->builder->orderBy('created_at', $direction);
        elseif ($column == 'price')
            $this->builder->orderBy('price', $direction);
    }

    protected function min_price($min_price): void
    {
        $this->builder->where('price', '>=', $min_price);
    }

    protected function max_price($max_price): void
    {
        $this->builder->where('price', '<=', $max_price);
    }
}