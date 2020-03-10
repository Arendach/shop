@inject('cartService', App\Services\CartService)

@extends('catalog.layout')

@section('title', translate('Корзина'))

@section('css')
    <link href="{{ asset('catalog/css/cart.css') }}" rel="stylesheet">
@endsection

@section('content')

    <main class="bg_gray">
        <div class="container margin_30">
            <div class="page_header">
                <div class="breadcrumbs">
                    <ul>
                        <li><a href="#">Home</a></li>
                        <li><a href="#">Category</a></li>
                        <li>Page active</li>
                    </ul>
                </div>
                <h1>Cart page</h1>
            </div>

            <!-- /page_header -->
            <table class="table table-striped cart-list">
                <thead>
                <tr>
                    <th>@translate('Товар')</th>
                    <th>@translate('Ціна')</th>
                    <th>@translate('Кількість')</th>
                    <th>@translate('Сума')</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @php /** @var $cartService \App\Services\CartService */ @endphp
                @foreach($cartService->getProducts() as $product)
                    <tr>
                        <td>
                            <div class="thumb_cart">
                                <img src="{{ $product->small_image }}" width="60px">
                            </div>
                            <span class="item_cart">
                                {{ $product->name }}
                            </span>
                        </td>
                        <td>
                            <strong>
                                {{ number_format($product->new_price) }}
                            </strong>
                        </td>
                        <td>
                            <div class="numbers-row">
                                <input type="text" value="{{ $product->pivot->amount }}" class="qty2" data-type="cart_change_amount">
                                <div class="inc button_inc">+</div>
                                <div class="dec button_inc">-</div>
                            </div>
                        </td>
                        <td>
                            <strong>{{ number_format($product->new_price * $product->pivot->amount) }}</strong>
                        </td>
                        <td class="options">
                            <a href="#" @tooltip('Видалити товар з корзини') data-type="cart_page_detach"
                               data-id="{{ $product->id }}">
                                <i class="ti-trash"></i>
                            </a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>

            <div class="row add_top_30 flex-sm-row-reverse cart_actions">
                <div class="col-sm-4 text-right">
                    {{--<button type="button" class="btn_1 gray"></button>--}}
                </div>
                <div class="col-sm-8">
                    <div class="apply-coupon">
                        <div class="form-group form-inline">
                            <input type="text" name="coupon-code" value="" placeholder="@translate('Купон на знижку')"
                                   class="form-control">
                            <button type="button" class="btn_1 outline">@translate('Застосувати')</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /cart_actions -->
        </div>
        <!-- /container -->

        <div class="box_cart">
            <div class="container">
                <div class="row justify-content-end">
                    <div class="col-xl-4 col-lg-4 col-md-6">
                        <ul>
                            <li>
                                <span>@translate('Вартість товарів')</span> {{ number_format($cartService->getProductsSum()) }}
                            </li>
                            <li>
                                <span>@translate('Доставка')</span> {{ number_format($cartService->getDeliverySum()) }}
                            </li>
                            <li>
                                <span>
                                    @translate('Сума')
                                </span>
                                <i class="dropdown-cart-sum">
                                    {{ number_format($cartService->getProductsSum() + $cartService->getDeliverySum()) }}
                                </i>
                            </li>
                        </ul>
                        <a href="{{ route('checkout') }}"
                           class="btn_1 full-width cart">@translate('Оформити замовлення')</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- /box_cart -->

    </main>

@endsection