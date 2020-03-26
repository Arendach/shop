<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\NewPostCity;
use App\Models\NewPostWarehouse;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class NewPostController extends Controller
{
    public function searchCities(Request $request)
    {
        $search = $request->search;

        $cities = NewPostCity::where(function (Builder $builder) use ($search) {
            $builder->where('name_uk', 'like', "%$search%")
                ->orWhere('name_ru', 'like', "%$search%");
        })
            ->limit(100)
            ->get();

        return response()->json([
            'data' => $cities
        ], 200);
    }

    public function getWarehouses(Request $request)
    {
        $id = $request->city;

        $city = NewPostCity::findOrFail($id);

        $warehouses = NewPostWarehouse::where('city_ref', $city->ref)->get();

        return response()->json([
            'data' => $warehouses
        ], 200);
    }
}
