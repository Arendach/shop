@extends('admin.layout')

@section('content')

    <ul class="nav nav-pills nav-justified mb-3">
        <li class="nav-item">
            <a class="nav-link active" data-toggle="pill" href="#pills-home">
                @lang('order.admin.info')
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="pill" href="#pills-profile">
                @lang('order.admin.products')
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="pill" href="#pills-contact">
                @lang('order.admin.delivery')
            </a>
        </li>
    </ul>


    <div class="tab-content">
        <div class="tab-pane fade show active" id="pills-home">
            @include('admin.orders.default.update.info')
        </div>

        <div class="tab-pane fade" id="pills-profile">
            @include('admin.orders.default.update.products')
        </div>

        <div class="tab-pane fade" id="pills-contact">
            @include('admin.orders.default.update.delivery')
        </div>
    </div>

@stop