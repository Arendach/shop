@extends('catalog.layout')

@section('title', translate('Мій профіль'))

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
                        @translate('Мій профіль')
                    </li>
                </ul>
            </div>

            <div class="margin_30">
                <div class="list-group">
                    <a class="list-group-item list-group-item-action" href="{{ route('profile.orders') }}">
                        @translate('Мої замовлення')
                    </a>

                    <a class="list-group-item list-group-item-action" href="{{ route('profile.desire') }}">
                        @translate('Обрані товари')
                    </a>

                    <a class="list-group-item list-group-item-action" href="{{ route('profile.desire') }}">
                        @translate('Налаштування профілю')
                    </a>
                </div>
            </div>
        </div>
    </main>


@endsection