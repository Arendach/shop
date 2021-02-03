@extends('catalog.layout')

@section('title', $collection->meta_title)

@section('css')
    <link href="{{ asset('catalog/css/listing.css') }}" rel="stylesheet">
@endsection

@section('content')

    <main class="bg_gray">
        <div class="container margin_30">
            <div class="top_banner version_2">
                <div class="opacity-mask d-flex align-items-center" data-opacity-mask="rgba(0, 0, 0, 0)">
                    <div class="container">
                        <div class="d-flex justify-content-center">
                            <h1>{{ $collection->name }}</h1>
                        </div>
                    </div>
                </div>
                <img src="{{ $collection->getImage('image') }}" class="img-fluid" alt="{{ $collection->name }}">
            </div>

            <div style="margin: 20px 0">
                <div class="breadcrumbs">
                    <ul>
                        <li><a href="{{ route('index') }}">@translate('Головна')</a></li>
                        <li>Коллекции</li>
                        <li>{{ $collection->name }}</li>
                    </ul>
                </div>
            </div>

            <div id="stick_here"></div>

            <div class="row small-gutters">
                @foreach($products as $product)
                    @php /** @var \App\Models\Product $product */ @endphp
                    <div class="col-6 col-md-4 col-xl-3">
                        @include('catalog.parts.product-card')
                    </div>
                @endforeach
            </div>

            {!! $products->links('catalog.parts.paginate') !!}
        </div>
    </main>

@endsection