<?php

namespace App\Http\Controllers\Catalog;

use App\Http\Requests\Catalog\Desire\AddRequest;

class DesireController extends CatalogController
{
    public function index()
    {
        if (!isAuth()) return redirect()->route('login');

        $data = [
            'title' => 'Вибрані товари',
            'breadcrumbs' => [
                ['Профіль', route('profile')],
                ['Вибрані товари']
            ],
            'products' => customer()->desire_products
        ];

        return view('catalog.desire.index', $data);
    }

    public function action_add(AddRequest $request)
    {
        $desire = customer()->desire_products();

        if ($desire->where('product_id', $request->product_id)->count()) {
            $desire->detach($request->product_id);

            $message = 'Товар видалено з списку бажаних!';
            $action = 'detach';
            $button_title = __('collection.to_favorites');
        } else {
            $desire->attach($request->product_id);

            $message = 'Товар додано в список бажаних!';
            $action = 'attach';
            $button_title = __('collection.un_favorites');
        }

        return response()->json([
            'action' => $action,
            'title' => 'Виконано!',
            'button_title' => $button_title,
            'message' => $message
        ], 200);
    }
}
