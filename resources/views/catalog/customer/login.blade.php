@extends('catalog.layout')

@section('title', translate('Авторизація'))

@section('css')
    <link href="{{ asset('catalog/css/account.css') }}" rel="stylesheet">
@endsection

@section('content')
    <main class="bg_gray">
        <div class="container margin_30">
            <div class="page_header">
                <div class="breadcrumbs">
                    <ul>
                        <li><a href="#">@translate('Головна')</a></li>
                        <li><a href="#">@translate('Товари')</a></li>
                        <li>@translate('Авторизація')</li>
                    </ul>
                </div>
                <h1>@translate('Авторизуватись або зареєструватись')</h1>
            </div>
            <div class="row justify-content-center">
                <div class="col-xl-6 col-lg-6 col-md-8">
                    <div class="box_account">
                        <h3 class="client">@translate('Зареєстрований клієнт')</h3>
                        <div class="form_container">
                            @include('catalog.customer.login.login')
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 d-none d-lg-block">
                            <ul class="list_ok">
                                <li>Find Locations</li>
                                <li>Quality Location check</li>
                                <li>Data Protection</li>
                            </ul>
                        </div>
                        <div class="col-md-6 d-none d-lg-block">
                            <ul class="list_ok">
                                <li>Secure Payments</li>
                                <li>H24 Support</li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-xl-6 col-lg-6 col-md-8">
                    <div class="box_account">
                        <h3 class="new_client">@translate('Новий покупець')</h3>
                        <small class="float-right pt-2">@translate('* Обовязкове поле')</small>
                        <div class="clearfix"></div>
                        <div class="form_container">
                          @include('catalog.customer.login.register')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection

@section('js')
    <script src="{{ asset('js/customer.js') }}"></script>
@endsection