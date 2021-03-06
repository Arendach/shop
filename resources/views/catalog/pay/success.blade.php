@extends('catalog.layout')

@section('title', 'Страница оплаты')

@section('content')
    <main class="bg_gray">
        <div class="container margin_30">
            <div class="alert alert-success">
                {{ translate('Оплата прошла успешно. Спасибо за заказ.') }}.
                <div class="alert alert-info mt-4">
                    {{ translate('Вам отправлена квитанция на указанный E-mail') }}.
                </div>
            </div>
        </div>
    </main>
@endsection