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
        <div class="container margin_30">
            <div class="main_title">
                <h1>{{ $category->name }}</h1>
            </div>

            @foreach($category->child as $child)
                {{-- <h2>{{ $child->name }}</h2>
                 <div class="row small-gutters">
                     @foreach($child->products as $product)
                         <div class="col-6 col-md-4 col-xl-3">
                             @include('catalog.parts.product-card')
                         </div>
                     @endforeach
                 </div>--}}

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

@endsection