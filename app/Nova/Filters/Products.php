<?php

namespace App\Nova\Filters;

use Illuminate\Http\Request;
use Laravel\Nova\Filters\Filter;
use App\Models\Category;
class Products extends Filter
{
    /**
     * The filter's component.
     *
     * @var string
     */
    public $component = 'select-filter';
    

    public function name()
    {
        return translate('Фільтр категорій');
    }
    /**
     * Apply the filter to the given query.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @param  mixed  $value
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function apply(Request $request, $query, $value)
    {
        return $query->where('category_id', $value);
        //return $query;
    }

    /**
     * Get the filter's available options.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function options(Request $request)
    {

        $categories = Category::with('child')->where('parent_id', 0)->get();
        $result = [];
        foreach ($categories as $category) {
            $result[$category->name] = $category->id;

            foreach ($category->child as $childCategory) {
                $result[" --- " . $childCategory->name . " (" . $childCategory->id . ")"] = $childCategory->id;
            }
        }

        return $result;
    }
}
