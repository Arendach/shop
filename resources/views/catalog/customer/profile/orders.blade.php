@php /** @var \App\Models\Order $order  */ @endphp

@extends('catalog.layout')

@section('title', translate('Мої замовлення'))

@section('content')

    <main>
        <div class="container margin_30">
            <div class="breadcrumbs">
                <ul>
                    <li>
                        <a href="{{ route('index') }}">
                            @translate('Головна')
                        </a>
                    </li>

                    <li>
                        <a href="{{ route('profile') }}">
                            @translate('Мій профіль')
                        </a>
                    </li>

                    <li>
                        @translate('Мої замовлення')
                    </li>
                </ul>
            </div>

            @if($orders && $orders->count())
                <div id="accordion">
                    @foreach($orders as $order)
                        <div class="card">
                            <div class="card-header" id="heading{{ $order->id }}">
                                <h5 class="mb-0">
                                    <button class="btn btn-link" data-toggle="collapse" data-target="#collapse{{ $order->id }}">
                                        {{ $order->name }}
                                    </button>
                                </h5>
                            </div>

                            <div id="collapse{{ $order->id }}" class="collapse {{ $loop->index == 1  ? 'show' : '' }}" data-parent="#accordion">
                                <div class="card-body">
                                    <table class="table">
                                        <tr>
                                            <td>
                                                {{ $order->name }}
                                            </td>

                                            <td>
                                                {{ $order->email }}
                                            </td>

                                            <td>
                                                {{ $order->phone }}
                                            </td>
                                        </tr>
                                    </table>
                                    <ul>
                                        @foreach($order->products as $product)
                                            <li>
                                                <a href="{{ $product->url }}">
                                                    {{ $product->name }}
                                                </a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <h4 class="text-center margin_30">
                    @translate('У вас немає жодного замовлення')
                </h4>
            @endif
        </div>
    </main>

@endsection