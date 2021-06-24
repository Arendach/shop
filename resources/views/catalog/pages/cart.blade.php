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
                        <li><a href="{{ route('index') }}">@translate('Головна')</a></li>
                        <li>@translate('Корзина')</li>
                    </ul>
                </div>
                <h1>@translate('Корзина')</h1>
            </div>

            <!-- /page_header -->
            <table class="table table-striped cart-list">
                <thead>
                <tr>
                    <th>@translate('Товар')</th>
                    <th>@translate('Атрибути')</th>
                    <th>@translate('Ціна')</th>
                    <th>@translate('Кількість')</th>
                    <th>@translate('Сума')</th>
                </tr>
                </thead>
                <tbody>
                @php /** @var $cartService \App\Services\CartService */ @endphp
                @foreach($cartService->getProductsCart() as $product)
                    <tr>
                        <td>
                            <div class="thumb_cart">
                                <img src="{{ $product->product->small_image }}" width="60px">
                            </div>
                            <span class="item_cart">
                                {{ $product->product->name }}
                            </span>
                        </td>
                        <td width="30%">
                            @isset($product->attributes)
                                @foreach($cartService->getAttributeList($product->id) as $key => $value)
                                    <strong>{{ $key }}</strong> - {{ $value }}<br>
                                @endforeach
                            @else
                                @translate('Без атрибутiв')
                            @endisset
                        </td>
                        <td>
                            <strong>
                                {{ number_format($product->product->new_price) }}
                            </strong>
                        </td>
                        <td>
                            <div class="numbers-rows">
                                <input id="quantity_cart{{ $product->id }}" type="text" value="{{ $product->amount }}" class="qty2"  data-id="{{ $product->id }}">
                                <div data-id="{{ $product->id }}" class="inc button_inc">+</div>
                                <div data-id="{{ $product->id }}" class="dec button_inc">-</div>
                            </div>
                        </td>
                        <td class="sum_amount_one_product{{ $product->id }}">
                            <strong>{{ number_format($product->product->new_price * $product->amount) }}</strong>
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
                    <div class="col-xl-4 col-md-6">
                                <span class="text-danger" style="font-size: 26px;font-weight: 600;text-transform: uppercase;">
                                    @translate('Сума'):
                                </span>
                                <i id="all_product_sum" class="dropdown-cart-sum" style="font-size: 24px;font-weight: 600">
                                    {{ number_format($cartService->getProductsSum() + $cartService->getDeliverySum()) }}
                                </i>
                        <br>
                        <a href="{{ route('checkout') }}"
                           class="btn_1 full-width cart">@translate('Оформити замовлення')</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- /box_cart -->

    </main>

@endsection