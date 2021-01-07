@extends('catalog.layout')

@section('title', '')

@section('content')
    <main  class="bg_gray">

        <div class="container margin_30">
            @if(!$order)
                {{ translate('Произошла ошибка. Выполните Свой заказ заново') }}
            @else
                {{ translate('Произошла неизвестная ошибка') }}
            @endif

            <br>
        </div>

    </main>
@endsection