@extends('catalog.layout')

@section('style')

    <style>
        .page {
            margin-top: 20px;
            box-shadow: 0 0 5px #eee;
            padding: 20px 10px;
        }

        .page a {
            color: #e31837;
        }

        .page a:hover {
            color: #af0009;

            text-decoration: none;
        }

        .page h3 {
            color: #e31837;
            border-bottom: 1px solid #e31837;
            margin-bottom: 15px;
            padding-bottom: 5px;
        }

        .order-item {
            display: block;
            padding: 10px;
            margin-bottom: 10px;
            cursor: pointer;
        }

        .order-item:last-child {
            margin-bottom: 0;
        }

        .order-item:hover {
            box-shadow: 0 0 10px #ccc;
        }
    </style>

@endsection
<?php setlocale(LC_ALL, 'ru_RU');
?>
@section('content')

    <div class="container">

        <div class="page">
            <h3>@translate('Мої замовлення')</h3>


            @forelse($orders as $item)

                <a href="{{ route('profile.orders.view', $item->id) }}" class="order-item">
                    <div class="row">
                        <div class="col-1">
                            <b style="margin-right: 10px">№{{ $item->id }}</b>
                        </div>
                        <div class="col-3">
                             {{ $item->created_at->format('d M Y H:i') }}
                        </div>

                        <div class="col-4">
                            <b>{{ $item->products->count() }}</b>
                            @choice('products.products', $item->products->count())
                            @translate('на суму') <b>{{ $item->sum }}</b> грн
                        </div>

                        <div class="col-4">
                            <span style="color: {{ OrderStatus::getColor($item->status) }}">
                                {{ OrderStatus::getName($item->status) }}
                            </span>
                        </div>
                    </div>


                </a>

                @if (!$loop->last)
                    <hr>
                @endif

            @empty

            @endforelse

        </div>
    </div>

@endsection