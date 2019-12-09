<?php

namespace App\Filters;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class CategoryProductFilter extends BasicFilter
{
    /**
     * @param array $characteristics
     * @return void
     */
    protected function characteristics($characteristics): void
    {
        if (!is_array($characteristics)) return;

        foreach ($characteristics as $id => $keys) {
            $this->builder->whereHas('characteristics', function (Builder $query) use ($id, $keys) {
                $query->where('characteristic_id', $id)
                    ->whereIn('value_' . config('locale.current'), $keys);
            });
        }
    }

    /**
     * @param array $manufacturers
     * @return void
     */
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

    /**
     * @param Request $request
     * @return array
     */
    protected function parseRequest(Request $request): array
    {
        $result = [];
        foreach ($request->all() as $key => $value) {
            if (preg_match('/ch_([0-9]+)/', $key, $matches)) {
                $result['characteristics'][$matches[1]] = $value;
                continue;
            }

            $result[$key] = $value;
        }

        return $result;
    }
}