@extends('catalog.layout')

@section('title', 'Оплата заказа')

@section('content')
    <main  class="bg_gray">

        <div class="container margin_30">
            @if($canceled)
            <div class="alert alert-danger mb-0 ml-0">
                {{ translate('Вы отменили платеж. Если вы сделали это случайно, пройдите процедуру оплаты еще раз') }}
            </div>
            @endif
            <div class="alert alert-info">
                {{ translate('Шановний') }}, <b>{{ $order->name }}</b>
                <br>
                {{ translate('Ви зробили замовлення на суму') }}: <b>{{ $order->sum() }} грн.</b>

                <br>
                {!! $form_pay !!}
            </div>
        </div>

    </main>
@endsection