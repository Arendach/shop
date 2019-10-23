<?php

namespace App\Http\Controllers\Catalog;

use App\Http\Requests\Catalog\User\LoginRequest;
use App\Http\Requests\Catalog\User\OnlyNotLoggedRequest;
use App\Http\Requests\Catalog\User\RegisterRequest;
use App\Services\AuthService;
use App\Services\UserService;
use Auth;
use Cart;

class UserController extends CatalogController
{
    public function profile()
    {
        $data = [
            'title' => 'Профіль',
            'breadcrumbs' => [['Профіль']]
        ];

        return view('catalog.user.profile.index', $data);
    }

    public function orders()
    {
        $data = [
            'title' => 'мої замовлення',
            'breadcrumbs'=>[
                ['Профіль', route('profile')],
                ['мої замовлення']
            ],
            'orders' => user()->orders
        ];

        return view('catalog.user.profile.orders', $data);
    }

    public function login(OnlyNotLoggedRequest $request)
    {
        $data = [
            'title' => __('user.login.title'),
            'breadcrumbs' => [['Автороизація']]
        ];

        return view('catalog.user.login', $data);
    }

    public function register(OnlyNotLoggedRequest $request)
    {
        $data = [
            'title' => __('user.register.title'),
            'breadcrumbs' => [['Реєстрація']]
        ];

        return view('catalog.user.register', $data);
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
            'message' => 'Реєстрація закінчилась вдало!'
        ], 200);
    }

    public function action_login(LoginRequest $request, UserService $userService)
    {
        if ($userService->userIsValid($request->login, $request->password)){
            Auth::make($userService->get($request->login), $request, $request->remember == 'true');

            Cart::importProductsFromSession();
        } else {
            return response()->json([

            ], 400);
        }

        return response()->json([], 200);
    }

    public function exit()
    {
        Auth::exit();

        return redirect()->route('index');
    }

    public function action_login_form(OnlyNotLoggedRequest $request)
    {
        return response()->json([
            'content' => view('catalog.user.login_form', [
                'title' => 'Авторизація'
            ])->render()
        ], 200);
    }
}
