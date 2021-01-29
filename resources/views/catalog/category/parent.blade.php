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
                <div class="card border-0" style="width: 18rem;display: inline-flex">
                    @if(!$agent->isMobile())
                        <img class="card-img-top" src="{{ $child->small_image }}" alt="Card image cap">
                    @endif
                    <div class="card-body">
                        <h5 style="text-align: center" class="card-title"><a href="{{ $child->url }}">{{ $child->name }}</a></h5>
                    </div>
                </div>

            @endforeach

            <div>{!! $category->description !!}</div>
        </div>
    </main>
@endsection

@section('js')
    <script src="{{ asset('catalog/js/sticky_sidebar.min.js') }}"></script>
    <script src="{{ asset('catalog/js/specific_listing.js') }}"></script>
@endsection