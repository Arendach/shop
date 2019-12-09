<?php

namespace App\Http\Controllers\Admin\Orders;

use App\Http\Controllers\Admin\AdminController;
use App\Models\Order;
use App\Services\NewPostService;
use Illuminate\Http\Request;

class DeliveryController extends AdminController
{
    public function action_update_sending(Request $request, NewPostService $newPostService)
    {
        $order = Order::findOrFail($request->id);

        $city = $newPostService->getCityNameLocale($request->city_key);
        $warehouse = $newPostService->getWarehouseNameLocale($request->city_key, $request->warehouse_key);

        $order->sending->update([
            'city_key' => $request->city_key,
            'warehouse_key' => $request->warehouse_key,
            'city_name_uk' => $city['name_uk'],
            'city_name_ru' => $city['name_ru'],
            'warehouse_name_uk' => $warehouse['name_uk'],
            'warehouse_name_ru' => $warehouse['name_ru'],
        ]);

        return json(['message' => __('common.success_text')]);

    }

    public function action_search_sending_city(Request $request, NewPostService $newPostService)
    {
        $city = $newPostService->getCityList($request->term);

        $response = [];
        foreach ($city as $item)
            $response[] = [
                'id' => $item['key'],
                'value' => $item['description']
            ];

        return json($response);
    }

    public function action_search_sending_warehouses(Request $request, NewPostService $newPostService)
    {
        $warehouses = $newPostService->getWarehouses($request->id);

        $response = '';
        foreach ($warehouses as $warehouse)
            $response .= "<option value='{$warehouse['key']}'>{$warehouse['name']}</option>";

        return json(['content' => $response]);
    }

    public function action_update_delivery(Request $request)
    {
        $order = Order::findOrFail($request->id);

        $order->update($request->only('date_delivery'));

        $order->_delivery()->update($request->only('city', 'street', 'address'));

        return json([__('common.success_text')]);
    }


    public function action_update_self(Request $request)
    {
        $order = Order::findOrFail($request->id);

        $order->update($request->only('date_delivery'));

        $order->self()->update($request->only('shop'));

        return json([__('common.success_text')]);
    }
}
