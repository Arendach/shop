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
                        <li><a href="#">@translate('Головна')</a></li>
                        <li><a href="#">@translate('Корзина')</a></li>
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
    <script>
        $(document).on('change', '[name=delivery]', function () {
            let type = $(this).val()
            $('.delivery-form').hide()
            $('#delivery-' + type).show()
        })

        $('#sending_city').select2({
            theme: 'bootstrap4',
            minLength: 2,
            ajax: {
                type: 'post',
                url: '/api/new_post/search_cities',
                data: (params) => {
                    return {
                        search: params.term
                    }
                },
                processResults: function (data) {
                    return {
                        results: $.map(data.data, function (item) {
                            return {
                                text: item.name_uk,
                                id: item.id
                            }
                        })
                    };
                },
                delay: 400
            },
            cache: true,
        })

        $('#street')

        $(document).on('change', '#sending_city', function () {
            let city = $(this).val()

            $.post('/api/new_post/get_warehouses', {city})
                .then(function (response) {
                    if (response.data.length) {
                        let options = ''
                        $.map(response.data, function (item) {
                            options += `<option value="${item.id}">${item.name_uk}</option>`
                        })

                        $('#sending_warehouse').attr('disabled', false).html(options)
                    } else {
                        let options = '<option>Empty</option>'
                        $('#sending_warehouse').attr('disabled', true).html(options)
                    }
                })
        })

    </script>
@endsection