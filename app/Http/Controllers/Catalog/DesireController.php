<?php

namespace App\Http\Controllers\Catalog;

use App\Http\Requests\Catalog\Desire\AddRequest;

class DesireController extends CatalogController
{
    public function index()
    {
        if (!isAuth()) return redirect()->route('login');

        $data = [
            'title'       => 'Вибрані товари',
            'breadcrumbs' => [
                ['Профіль', route('profile')],
                ['Вибрані товари']
            ],
            'products'    => customer()->desire_products
        ];

        return view('catalog.customer.profile.desire', $data);
    }

    public function action_switch(AddRequest $request)
    {
        $desire = customer()->desire_products();

        if (customer()->hasDesire($request->id)) {
            $desire->detach($request->id);

            $message = 'Товар видалено з списку бажаних!';
            $action = 'detach';
        } else {
            $desire->attach($request->id);

            $message = 'Товар додано в список бажаних!';
            $action = 'attach';
        }

        return response()->json([
            'action'  => $action,
            'message' => $message
        ]);
    }
}
