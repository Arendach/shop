<?php

namespace App\Http\Controllers\Bridge;

use App\Library\BaseConnection;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\SyncHelpers\ProductImportHelper;

class ProductsSyncController extends Controller
{
    public function section_main(BaseConnection $connection)
    {
        $categories_local = Category::where('parent_id', 0)->get();

        $data = [
            'categories_local' => $categories_local
        ];

        return view('bridge.products', $data);
    }

    public function action_search(Request $request, BaseConnection $connection)
    {
        $products = $connection->request('product', 'search', $request->all());

        $products = collect(json_decode($products));

        foreach ($products as $it => $item)
            if (Product::where('product_key', $item->product_key)->count())
                unset($products[$it]);

        return view('bridge.products_list', [
            'products' => $products,
            'category_local' => $request->category_local
        ]);
    }

    public function action_import(Request $request, BaseConnection $connection)
    {
        $products = $connection->request('product', 'export', [
            'ids' => $request->selected
        ]);

        $products = collect(json_decode($products));

        $i = 0;
        foreach ($products as $item) {

            $item->category_id = $request->category_local;

            new ProductImportHelper($item);

            $i++;
        }

        return response()
            ->json([
                'message' => 'Імпортовано ' . $i . ' з ' . $products->count(),
                'action' => 'reload'
            ]);
    }

    public function section_on_storage(BaseConnection $connection)
    {
        $products = $connection->requestParse('product', 'on_storage');

        foreach ($products as $product_key => $count) {
            $product = Product::where('product_key', $product_key)->first();

            if (!is_null($product)) {
                $product->on_storage = ($count > 0) ? 1 : 0;

                $product->save();
            }
        }

        return redirect()
            ->route('bridge')
            ->with('message', 'Наявність товару на складі синхронізовано з базою даних!');
    }
}
