<?php

namespace App\Http\Controllers\Admin\Orders;

use App\Http\Controllers\Admin\AdminController;
use App\Models\Order;
use App\SyncHelpers\OrderProductStorage;
use Illuminate\Http\Request;

class DefaultController extends AdminController
{
    public function section_main()
    {
        $orders = Order::orderByDesc('id')
            ->paginate(config('app.items'));

        $orders->load('products');

        $assets = [
            'types' => asset_data('order_types'),
            'statuses' => asset_data('order_statuses'),
            'colors' => asset_data('order_colors'),
        ];

        $data = [
            'title' => __('order.admin.title'),
            'orders' => $orders,
            'breadcrumbs' => [[__('order.admin.title')]],
            'assets' => $assets
        ];

        return view('admin.orders.default.main', $data);
    }

    public function section_update(Request $request, OrderProductStorage $storages)
    {
        $order = Order::with('products', '_delivery', 'sending', 'self')
            ->findOrFail($request->id);

        if ($order->status == 'new_order'){
            $order->status = 'in_process';
            $order->admin = user()->id;

            $order->save();
        }

        $sortStorages = $storages->exec($order->products);

        $data = [
            'title' => __('order.admin.update', ['id' => $request->id]),
            'breadcrumbs' => [
                [__('order.admin.title'), route('admin.get', ['orders', 'default', 'main'])],
                [__('order.admin.update', ['id' => $request->id])]
            ],
            'order' => $order,
            'storages' => $sortStorages
        ];

        return view('admin.orders.default.update', $data);
    }

    public function action_update(Request $request)
    {
        Order::findOrFail($request->id)
            ->update($request->all());

        return response()->json(['message' => __('common.success_text')]);
    }
}