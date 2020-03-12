@extends('catalog-old.layout')

@section('style')

    <style>
        .table tr:first-child td, .table tr:first-child th {
            border-top: none;
        }
    </style>

@stop

@section('content')

    <div class="container">

        <div class="page">
            <h3>@translate('Замовлення') #{{ $order->id }}</h3>

            <table class="table">
                <tr>
                    <th>@translate('Дата оформлення')</th>
                    <td>{{ $order->created_at->format('d / m / Y H:i') }}</td>
                </tr>

                @if(!is_null($order->date_delivery))
                    <tr>
                        <th>@translate('Бажана дата доставки')</th>
                        <td>{{ $order->date_delivery->format('d / m / Y') }}</td>
                    </tr>
                @endif

                <tr>
                    <th>@translate('Ваше імя')</th>
                    <td>{{ $order->name }}</td>
                </tr>

                <tr>
                    <th>@translate('Номер телефону')</th>
                    <td>{{ $order->phone }}</td>
                </tr>

                <tr>
                    <th>@translate('Електронна пошта')</th>
                    <td>{{ $order->email }}</td>
                </tr>
            </table>

            <h3>@translate('Товари')</h3>

            <table class="table">
                <tr>
                    <th colspan="2">@translate('Товар')</th>
                    <th>@translate('Категорія')</th>
                    <th>@translate('Кількість')</th>
                    <th>@translate('Ціна')</th>
                </tr>
                @foreach($order->products as $item)
                    <tr>
                        <td>
                            <a href="{{ route('product.view', $item->slug) }}">
                                <img width="100px" src="{{ $item->small_image }}" alt="">
                            </a>
                        </td>

                        <td>
                            <a href="{{ route('product.view', $item->slug) }}">
                                {{ $item->name }}
                            </a>
                        </td>
                        <td>
                            <a href="{{ route('category.show', $item->category->slug) }}">
                                {{ $item->category->name }}
                            </a>
                        </td>
                        <td>{{ $item->pivot->amount }}</td>
                        <td>{{ $item->pivot->price }}</td>
                    </tr>
                @endforeach

                <tr>
                    <td colspan="4" style="text-align: right">
                        @translate('Сума'): <span class="text-primary">{{ $order->sum }}</span>грн
                    </td>
                </tr>
            </table>

        </div>

    </div>

@stop