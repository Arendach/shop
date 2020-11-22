@php /** @var \App\Models\Category $category */ @endphp

@extends('catalog.layout')

@section('title', $category->name)

@section('seo')
    <link rel="canonical" href="{{ url()->current() }}">
@endsection

@section('css')
    <link href="{{ asset('catalog/css/listing.css') }}" rel="stylesheet">
@endsection

@section('content')
    <main>
        <div class="top_banner">
            <div class="opacity-mask d-flex align-items-center" data-opacity-mask="rgba(0, 0, 0, 0.3)">
                <div class="container">
                    <div class="breadcrumbs">
                        <ul>
                            <li><a href="{{ route('index') }}">@translate('Головна')</a></li>
                            <li>{{ $category->name }}</li>
                        </ul>
                    </div>
                    <h1>{{ $category->name }}</h1>
                </div>
            </div>
            <img src="{{ $category->getImage('big', 'catalog/img/bg_cat_shoes.jpg') }}" class="img-fluid">
        </div>

        <div class="container margin_30">
            @foreach($category->child as $child)
                <div class="container margin_60_35">
                    <h2 style="margin-bottom: 50px"><a href="{{ $child->url }}">{{ $child->name }}</a></h2>
                    <div class="owl-carousel owl-theme products_carousel">
                        @foreach($child->products as $product)
                            <div class="item">
                                @include('catalog.parts.product-card')
                            </div>
                        @endforeach
                    </div>
                </div>

                <hr>
            @endforeach

            <div>{!! $category->description !!}</div>
        </div>
    </main>
@endsection

@section('js')
    <script src="{{ asset('catalog/js/sticky_sidebar.min.js') }}"></script>
    <script src="{{ asset('catalog/js/specific_listing.js') }}"></script>
@endsection