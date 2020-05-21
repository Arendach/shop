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
            <h1>
                {{$category->name_uk}}
            </h1>
            <p>
                {!! htmlspecialchars_decode($category->description_uk) !!}
            </p>
        </div>

        @foreach($productsFromCategory as $productFromCategory)
            <h2 style="text-align: center;">
            {{$productFromCategory['name']}}
            </h2>
            <p style="text-align: center;">
                {!! htmlspecialchars_decode($productFromCategory['description']) !!}
            </p>
            <div class="row small-gutters">
                @foreach($productFromCategory['products'] as $product)
                    <div class="col-6 col-md-4 col-xl-3">
                        @include('catalog.parts.product-card')
                    </div>
                @endforeach
            </div>
        @endforeach
    </div>
</main>
@endsection

@section('js')

@endsection