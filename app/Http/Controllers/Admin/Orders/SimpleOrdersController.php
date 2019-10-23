<?php

namespace App\Http\Controllers\Admin\Orders;

use App\Http\Controllers\Admin\AdminController;
use App\Models\SimpleOrder;
use Illuminate\Http\Request;

class SimpleOrdersController extends AdminController
{
    public function section_main()
    {
        $data = [
            'title' => 'Швидкі замовлення',
            'orders' => SimpleOrder::with('product')->paginate(config('app.items')),
            'breadcrumbs' => [['Швидкі замовлення']]
        ];

        return view('admin.orders.simple_orders.main', $data);
    }

    public function action_ok(Request $request)
    {
        SimpleOrder::find($request->id)->update(['accepted' => 1]);

        return response()->json([
            'message' => 'Прийнято!',
            'action' => 'reload'
        ], 200);
    }

    public function action_delete(Request $request){
        SimpleOrder::destroy($request->id);

        return response()->json([
            'message' => 'Видалено!',
            'action' => 'reload'
        ], 200);
    }
}
