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
                        <li><a href="{{ route('index') }}">@translate('Головна')</a></li>
                        <li><a href="{{ route('cart') }}">@translate('Корзина')</a></li>
                        <li>@translate('Оформлення замовлення')</li>
                    </ul>
                </div>
                <h1>@translate('Оформлення замовлення')</h1>

            </div>

            <form action="{{ route('checkout.create') }}" id="checkout">
                <div class="row">
                    @include('catalog.checkout.contacts')

                    @include('catalog.checkout.delivery')

                    @include('catalog.checkout.cart')
                </div>
            </form>
        </div>
    </main>
@endsection

@section('js')
    <script src="{{ vAsset('js/checkout.js') }}"></script>
@endsection