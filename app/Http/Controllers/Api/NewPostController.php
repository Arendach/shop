<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\NewPostCityResource;
use App\Http\Resources\NewPostStreetsResource;
use App\Http\Resources\NewPostWarehouseResource;
use App\Models\NewPostCity;
use App\Models\Streets;
use App\Models\Payment;
use App\Models\NewPostWarehouse;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class NewPostController extends Controller
{
    public function searchCities(Request $request): AnonymousResourceCollection
    {
        $search = $request->search;

        $cities = NewPostCity::where(function (Builder $builder) use ($search) {
            $builder->where('name_uk', 'like', "%$search%")
                ->orWhere('name_ru', 'like', "%$search%");
        })
            ->limit(100)
            ->get();

        return NewPostCityResource::collection($cities);
    }

    public function getWarehouses(Request $request): AnonymousResourceCollection
    {
        $id = $request->city;

        $city = NewPostCity::findOrFail($id);

        $warehouses = NewPostWarehouse::where('city_ref', $city->ref)->get();

        return NewPostWarehouseResource::collection($warehouses);
    }


        public function searchStreets(Request $request): AnonymousResourceCollection
    {
        $search = $request->search;
        $streets = Streets::where(function (Builder $builder) use ($search) {
            $builder->where('name', 'like', "%$search%");
        })
            ->limit(100)
            ->get();

        return NewPostStreetsResource::collection($streets);
    }



    public function getPayment(): AnonymousResourceCollection
    {
        $pay = Payment::orderBy('id','ASC')->all();
        return NewPostPaymentResource::collection($pay);
    }

}
