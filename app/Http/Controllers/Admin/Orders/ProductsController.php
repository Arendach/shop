<?php

namespace App\Http\Controllers\Admin\Orders;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use App\SyncHelpers\OrderProductStorage;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    public function action_update(Request $request)
    {
        Order::findOrFail($request->id)
            ->products()
            ->syncWithoutDetaching($request->product);

        return json(['message' => 'ok']);
    }

    public function action_search(Request $request)
    {
        $result = Product::whereNotIn('id', $request->exept)
            ->where(function (Builder $query) use ($request) {
                $query->where('name_uk', 'like', "%$request->term%")
                    ->orWhere('name_ru', 'like', "%$request->term%")
                    ->orWhere('article', 'like', "%$request->term%");
            })
            ->get();

        $response = [];

        foreach ($result as $item) {
            $response[] = [
                'id' => $item->id,
                'value' => $item->name
            ];
        }

        return json($response);
    }

    public function action_searched(Request $request, OrderProductStorage $storagesRequest)
    {
        $products = Product::where('id', $request->id)->get();

        $storages = $storagesRequest->exec($products);

        $product = $products->first();

        $data = [
            'id' => $product->id,
            'name' => $product->name,
            'slug' => $product->slug,
            'product_key' => $product->product_key,
            'amount' => 1,
            'price' => $product->now_price,
            'storage' => 0,
            'storages' => $storages,
        ];

        return view('admin.orders.default.update.product_row', $data);
    }
}
