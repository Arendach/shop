<?php

namespace App\Http\Controllers\Catalog;

use App\Http\Requests\Catalog\User\LoginRequest;
use App\Http\Requests\Catalog\User\OnlyNotLoggedRequest;
use App\Http\Requests\Catalog\User\RegisterRequest;
use App\Models\Order;
use App\Services\AuthService;
use App\Services\UserService;
use Auth;
use Cart;

class CustomerController extends CatalogController
{
    public function profile()
    {
        return view('catalog.user.profile.index');
    }

    public function login(OnlyNotLoggedRequest $request)
    {
        return view('catalog.user.login');
    }

    public function register(OnlyNotLoggedRequest $request)
    {
        return view('catalog.user.register');
    }

    public function action_register(RegisterRequest $request, UserService $userService, AuthService $authService)
    {
        // реєстрація користувача
        $user = $userService->register($request->only(['name', 'email', 'password', 'phone']));

        // запамятовуємо користувача
        $authService->make($user, $request, true);

        Cart::importProductsFromSession();

        // Відповідаємо
        return response()->json([
            'message' => __('user.register.success_message')
        ], 200);
    }

    public function action_login(LoginRequest $request, UserService $userService)
    {
        if ($userService->userIsValid($request->login, $request->password)) {
            Auth::make($userService->get($request->login), $request, $request->remember == 'true');

            Cart::importProductsFromSession();
        } else {
            return response()->json([

            ], 400);
        }

        return response()->json([], 200);
    }

    public function action_login_form(OnlyNotLoggedRequest $request)
    {
        $data = [
            'title' => __('user.login.title')
        ];

        $content = view('catalog.user.login_form', $data)->render();

        return response()->json([
            'content' => $content
        ], 200);
    }

    public function exit()
    {
        Auth::exit();

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
            'orders'      => user()->orders
        ];

        return view('catalog.user.profile.orders', $data);
    }

    public function order_view($id)
    {
        $order = Order::with('products')->findOrFail($id);

        abort_if($order->user_id != user()->id, 403);

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
