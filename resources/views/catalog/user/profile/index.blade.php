@extends('catalog.layout')

@section('style')

    <style>
        .page{
            margin-top: 20px;
            box-shadow: 0 0 5px #eee;
            padding: 20px 10px;
        }

        .page a{
            color: #e31837;
        }
        .page a:hover{
            color: #af0009;

            text-decoration: none;
        }

        .page h3{
            color: #e31837;
            border-bottom: 1px solid #e31837;
            margin-bottom: 15px;
            padding-bottom: 5px;
        }
    </style>

@endsection

@section('content')

    <div class="container">
        <div class="page">
            <h3>Профіль</h3>

            @if (is_admin())
                <a href="{{ route('admin.index') }}">
                    <i class="fa fa-cogs"></i> Адмінка
                </a>

                <hr>
            @endif

           {{-- <a href="{{ route('profile.viewed') }}">
                <i class="fa fa-eye"></i> Переглянуті товари
            </a>--}}

           {{-- <hr>--}}

            <a href="{{ route('profile.desire') }}">
                <i class="fa fa-heart"></i> Вибрані товари (<b>{{ user()->desire_products->count() }}</b>)
            </a>

            <hr>

            <a href="{{ route('profile.orders') }}">
                <i class="fa fa-dollar"></i> Мої замовлення
            </a>

            <hr>

            <a href="{{ route('cart') }}">
                <i class="fa fa-shopping-bag"></i> Моя корзина (<b>{{ Cart::countProducts() }}</b>)
            </a>

            <hr>

            <a href="{{ route('exit') }}">
                <i class="fa fa-sign-out"></i> Вийти з профілю
            </a>

        </div>
    </div>

@endsection