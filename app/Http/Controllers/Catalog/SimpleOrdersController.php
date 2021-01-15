<?php

namespace App\Http\Controllers\Catalog;

use App\Http\Requests\Catalog\Orders\CreateSimpleOrderRequest;
use App\Http\Controllers\Controller;
use App\Models\SimpleOrder;
use App\StreamTele\Sms\Auth;
use Illuminate\Http\JsonResponse;

class SimpleOrdersController extends Controller
{
    public function create(CreateSimpleOrderRequest $request): JsonResponse
    {
        $table = new SimpleOrder;

        $table->name = $request->name;
        $table->phone = $request->phone;
        $table->product_id = $request->id;
        $table->ip = $request->ip();
        $table->user_agent = $request->userAgent();

        $table->save();
        $phone = str_replace ('-' ,'' ,$table->phone);
        // Вiдправка Смс замовнику
        app(Auth::class)->smsSend($phone, $table->id);
        // Вiдправка Смс Адміністратору
        app(Auth::class)->smsSend(setting('Номер для повідомлення адміністратора про зроблене замовлення', '0991234567'),
            $table->id,
            setting('Текст смс для повідомлення адміністратора про замовлення','На сайті '.config('app.name').'з’явилося нове швидке замовлення'));

        return response()->json([
            'title'   => translate('Виконано'),
            'message' => translate('Заявка прийнята! Менеджер звяжеться з вами найближчим часом!')
        ]);
    }
}
