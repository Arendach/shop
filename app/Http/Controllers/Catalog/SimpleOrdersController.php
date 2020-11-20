<?php

namespace App\Http\Controllers\Catalog;

use App\Http\Requests\Catalog\Orders\CreateSimpleOrderRequest;
use App\Http\Controllers\Controller;
use App\Models\SimpleOrder;

class SimpleOrdersController extends Controller
{
    public function create(CreateSimpleOrderRequest $request)
    {
        $table = new SimpleOrder;

        $table->name = $request->name;
        $table->phone = $request->phone;
        $table->product_id = $request->id;
        $table->ip = $request->ip();
        $table->user_agent = $request->userAgent();

        $table->save();

        return response()->json([
            'title'   => 'Виконано',
            'message' => 'Заявка прийнята! Менеджер звяжеться з вами найближчим часом!'
        ], 200);
    }
}
