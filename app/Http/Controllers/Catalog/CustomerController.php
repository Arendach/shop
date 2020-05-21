<?php

namespace App\Http\Controllers\Catalog;

use App\Http\Requests\Catalog\Customer\UpdateContactsRequest;
use App\Http\Requests\Catalog\Customer\UpdatePasswordRequest;
use App\Http\Requests\Catalog\User\LoginRequest;
use App\Http\Requests\Catalog\User\RegisterRequest;
use App\Models\Customer;
use App\Services\AuthService;
use App\Services\CartService;
use App\Services\CustomerService;

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

        app(CartService::class)->importProductsFromSession($customer);

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

    public function logout(AuthService $authService)
    {
        $authService->logout();

        return redirect()->route('index');
    }

    public function orders()
    {
        $orders = customer()->orders;

        $orders->load('products');

        return view('catalog.customer.profile.orders', compact('orders'));
    }

    public function config()
    {
        return view('catalog.customer.profile.config');
    }

    public function action_update_contacts(UpdateContactsRequest $request)
    {
        app(CustomerService::class)->updateContacts($request->validated());
    }

    public function action_update_password(UpdatePasswordRequest $request)
    {
        app(CustomerService::class)->updatePassword($request->validated());
    }
}
