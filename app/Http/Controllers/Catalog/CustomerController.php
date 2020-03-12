<?php

namespace App\Http\Controllers\Catalog;

use App\Http\Requests\Catalog\User\LoginRequest;
use App\Http\Requests\Catalog\User\RegisterRequest;
use App\Models\Customer;
use App\Models\Order;
use App\Services\AuthService;
use App\Services\CartService;
use App\Services\CustomerService;
use Auth;
use Cart;

class CustomerController extends CatalogController
{
    public function profile()
    {
        return view('catalog.customer.profile.profile');
    }

    public function login()
    {
        if (isAuth()) {
            return redirect()->route('index');
        }

        return view('catalog.customer.login');
    }

    public function action_register(RegisterRequest $request, CustomerService $customerService, AuthService $authService)
    {
        // реєстрація користувача
        $customer = $customerService->register($request->all());

        // запамятовуємо користувача
        $authService->make($customer);

        // Cart::importProductsFromSession();

        // Відповідаємо
        return response()->json([
            'message' => translate('Реєстрація пройшла успішно')
        ], 200);
    }

    public function action_login(LoginRequest $request, AuthService $authService, CartService $cartService)
    {
        $customer = Customer::where('email', $request->login)
            ->orWhere('phone', $request->phone)
            ->firstOrFail();

        $authService->make($customer);

        $cartService->importProductsFromSession($customer);
    }

    public function action_login_form()
    {
        $data = [
            'title' => __('user.login.title')
        ];

        $content = view('catalog.user.login_form', $data)->render();

        return response()->json([
            'content' => $content
        ], 200);
    }

    public function logout(AuthService $authService)
    {
        $authService->logout();

        return redirect()->route('index');
    }

    public function orders()
    {
        $data = [
            'title'       => __('user.profile.orders'),
            'breadcrumbs' => [
                [__('user.profile.title'), route('profile')],
                [__('user.profile.orders')]
            ],
            'orders'      => customer()->orders
        ];

        return view('catalog.customer.profile.orders', $data);
    }

    public function order_view($id)
    {
        $order = Order::with('products')->findOrFail($id);

        abort_if($order->user_id != customer()->id, 403);

        $order->products->load('category');

        $data = [
            'title'       => '',
            'order'       => $order,
            'breadcrumbs' => [
                [__('user.profile.title'), route('profile')],
                [__('user.profile.orders'), route('profile.orders')],
                [__('user.profile.order', ['id' => $order->id])]
            ]
        ];

        return view('catalog.user.profile.order_view', $data);
    }
}
