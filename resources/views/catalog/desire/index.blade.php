@extends('catalog.layout')

@section('style')

    <link rel="stylesheet" href="{{ asset('catalog/css/products.css') }}">

@stop

@section('content')

    <div class="container">
        <div class="products">
            @forelse($products->chunk(4) as $chunks)
                <div class="row">
                    @foreach($chunks as $item)
                        @include('catalog.product.chunk', ['item' => $item, 'chunks' => 3])
                    @endforeach
                </div>
            @empty

            @endforelse
        </div>
    </div>

@stop

@section('script')

    @include('catalog.assets.cart_scripts')

@stop