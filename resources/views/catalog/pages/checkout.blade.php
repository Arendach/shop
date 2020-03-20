@inject('cartService', App\Services\CartService)
@php /** @var $cartService \App\Services\CartService */@endphp

@extends('catalog.layout')

@section('title', translate('Оформлення замовлення'))

@section('css')
    <link href="{{ asset('catalog/css/checkout.css') }}" rel="stylesheet">
@endsection

@section('content')
    <main class="bg_gray">
        <div class="container margin_30">
            <div class="page_header">
                <div class="breadcrumbs">
                    <ul>
                        <li><a href="#">@translate('Головна')</a></li>
                        <li><a href="#">@translate('Корзина')</a></li>
                        <li>@translate('Оформлення замовлення')</li>
                    </ul>
                </div>
                <h1>@translate('Оформлення замовлення')</h1>

            </div>
            <!-- /page_header -->
            <div class="row">
                <div class="col-lg-4 col-md-6">
                    <div class="step first payments">
                        <h3>1. @translate('Контакти та оплати')</h3>

                        <h6 class="pb-2">@translate('Контакти')</h6>

                        <div class="row no-gutters">
                            <div class="col-6 form-group pr-1">
                                <input type="text" class="form-control" placeholder="@translate('Імя')"
                                       value="{{ customer()->first_name }}">
                            </div>
                            <div class="col-6 form-group pl-1">
                                <input type="text" class="form-control"
                                       placeholder="@translate('Прізвище')" {{ customer()->last_name }}>
                            </div>
                        </div>
                        <div class="form-group">
                            <input type="email" class="form-control" placeholder="Email"
                                   value="{{ customer()->email }}">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="@translate('Номер телефону')"
                                   value="{{ customer()->phone }}">
                        </div>

                        <h6 class="pb-2">@translate('Оплата')</h6>

                        <ul>
                            @foreach(asset_data('pay_methods') as $key => $payMethod)
                                <li>
                                    <label class="container_radio">
                                        {{ $payMethod['name'] }}
                                        <a href="#0" class="info" data-toggle="modal"
                                           data-target="#payments_method"></a>
                                        <input type="radio" name="payment" @checked($loop->iteration == 1)>
                                        <span class="checkmark"></span>
                                    </label>
                                </li>
                            @endforeach
                        </ul>
                        <div class="payment_info d-none d-sm-block">
                            <figure><img src="{{ asset('catalog/img/cards_all.svg') }}"></figure>
                            <p>
                                {{-- Тут вивести інформацію по способах оплати --}}
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="step middle payments">
                        <h3>2. @translate('Доставка')</h3>

                        <h6 class="pb-2">@translate('Спосіб отримання')</h6>

                        <ul>
                            @foreach(asset_data('order_types') as $key => $orderType)
                                <li>
                                    <label class="container_radio">
                                        {{ $orderType['name'] }}
                                        <a href="#0" class="info" data-toggle="modal"
                                           data-target="#payments_method"></a>
                                        <input type="radio" name="shipping" @checked($loop->iteration == 1)>
                                        <span class="checkmark"></span>
                                    </label>
                                </li>
                            @endforeach
                        </ul>

                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="@translate('Місто')">
                        </div>

                        <div class="form-group">
                            <input disabled type="text" class="form-control" placeholder="@translate('Відділення')">
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6">
                    <div class="step last">
                        <h3>3. @translate('Підсумок')</h3>
                        <div class="box_general summary">
                            <ul>
                                @foreach($cartService->getProducts() as $product)
                                    <li class="clearfix">
                                        <em>{{ $product->pivot->amount }}x {{ $product->name }}</em>
                                        <span>{{ number_format($product->new_price * $product->pivot->amount) }}</span>
                                    </li>
                                @endforeach
                            </ul>
                            <ul>
                                <li class="clearfix">
                                    <em><strong>@translate('Вартість товарів')</strong></em>
                                    <span>{{ number_format($cartService->getProductsSum()) }}</span>
                                </li>
                                <li class="clearfix">
                                    <em><strong>@translate('Вартість доставки')</strong></em>
                                    <span>{{ number_format($cartService->getDeliverySum()) }}</span>
                                </li>
                            </ul>
                            <div class="total clearfix">
                                @translate('Сума')
                                <span>
                                    {{ number_format($cartService->getProductsSum() + $cartService->getDeliverySum()) }}
                                </span>
                            </div>
                            <a href="confirm.html" class="btn_1 full-width">Confirm and Pay</a>
                        </div>
                        <!-- /box_general -->
                    </div>
                    <!-- /step -->
                </div>
            </div>
            <!-- /row -->
        </div>
    </main>
@endsection