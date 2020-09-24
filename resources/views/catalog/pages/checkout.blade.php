@inject('cartService', App\Services\CartService)
@php /** @var $cartService \App\Services\CartService */@endphp

@extends('catalog.layout')

@section('title', translate('Оформлення замовлення'))

@section('content')
    <main class="bg_gray">
        <div class="container margin_30">
            <div class="page_header">
                <div class="breadcrumbs">
                    <ul>
                        <li><a href="{{ route('index') }}">@translate('Головна')</a></li>
                        <li><a href="{{ route('cart') }}">@translate('Корзина')</a></li>
                        <li>@translate('Оформлення замовлення')</li>
                    </ul>
                </div>

                <h1>@translate('Оформлення замовлення')</h1>
            </div>

            <div id="checkout-form-wrapper">
                <checkout :data="{{ json_encode($checkoutPageData) }}"></checkout>
            </div>
        </div>
    </main>
@endsection

@push('css')
    <link href="{{ vAsset('css/checkout.css') }}" rel="stylesheet">
@endpush

@push('js')
    <script src="{{ vAsset('js/checkout.js') }}"></script>
@endpush