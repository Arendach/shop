@extends('catalog.layout')

@section('title', '')

@section('content')
    <main  class="bg_gray">

        <div class="container margin_30">
            <div class="alert alert-success">
                {{ translate('Оплата прошла успешно. Спасибо за заказ.') }}.
                @if($orderFind->email)
                    <div class="alert alert-info mt-4">
                        {{ translate('Вам отправлена квитанция на указанный E-mail') }}.
                    </div>
                @endif
            </div>
        </div>

    </main>
@endsection