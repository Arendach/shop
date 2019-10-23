<?php

namespace App\Http\Controllers\Admin\Product;

use App\Http\Controllers\Admin\AdminController;
use App\Http\Requests\Admin\Product\CharacteristicRequest;
use App\Models\Characteristic;
use App\Models\Product;
use App\Models\ProductCharacteristic;
use Illuminate\Http\Request;

class ProductCharacteristicsController extends AdminController
{
    public function action_update_form(Request $request)
    {
        $data = [
            'title' => 'EDIT',
            'characteristic' => ProductCharacteristic::find($request->id)
        ];

        return view('admin.products.forms.update_characteristic', $data);
    }

    public function action_update(CharacteristicRequest $request)
    {
        ProductCharacteristic::find($request->id)->update($request->all());

        return response()->json(['message' => __('common.success_text')]);
    }

    public function action_delete(Request $request)
    {
        ProductCharacteristic::find($request->id)->delete();

        return response(null, 200);
    }

    public function action_create_form(Request $request)
    {
        $data = [
            'title' => 'Create',
            'product' => Product::find($request->product_id),
            'characteristics' => Characteristic::all()
        ];

        return view('admin.products.forms.create_characteristic', $data);
    }

    public function action_create(CharacteristicRequest $request)
    {
        ProductCharacteristic::insert($request->all());

        return response()->json(['message' => __('common.success_text')]);
    }
}
