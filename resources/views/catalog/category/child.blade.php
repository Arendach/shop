@extends('catalog.layout')

@section('style')

    <link rel="stylesheet" href="{{ asset('catalog/css/products.css') }}">

@endsection

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-3">
                ФІЛЬТЕР
            </div>
            <div class="col-9">
                <div class="products">
                    @forelse($products->chunk(3) as $chunk)
                        <div class="row" {!! !$loop->last ? 'style="margin-bottom: 30px"' : '' !!}>
                            @foreach($chunk as $item)
                                <div class="col-4 product-card">
                                    <div class="product">
                                        <div class="product-top">
                                            <a href="{{ route('product.view', $item->slug) }}" class="product-image">
                                                <img width="100%" src="{{ $item->small_image }}" alt="{{ $item->name }}">
                                            </a>
                                            <div class="product-body">
                                                <div style="margin-top: 10px">{!! $item->available !!}</div>

                                                <div class="product-stars">
                                                    {!! $item->stars !!}
                                                </div>

                                                <div class="product-name">
                                                    <a href="{{ route('product.view', $item->slug) }}">
                                                        {{ $item->name }}
                                                    </a>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="product-bottom">
                                            <div class="price">
                                                @if(is_null($item->discount))
                                                    <span class="new-price">{{ $item->price }}</span>
                                                @else
                                                    <span class="new-price">{{ $item->discount }}</span>
                                                    <span class="old-price">{{ $item->price }}</span>
                                                @endif
                                            </div>

                                            <div class="buy-buttons">
                                                <div class="btn-group btn-group">
                                                    <button class="btn btn-outline-primary">
                                                        <i class="fa fa-shopping-bag"></i> @lang('collection.to_cart')
                                                    </button>
                                                    <button class="btn btn-outline-primary" data-toggle="tooltip"
                                                            title="@lang('collection.to_favorites')">
                                                        <i class="fa fa-heart-o"></i>
                                                    </button>

                                                    <button class="btn btn-outline-primary" data-toggle="tooltip"
                                                            title="@lang('collection.to_comparison')">
                                                        <i class="fa fa-balance-scale"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @empty
                        <h4 class="centered">@lang('common.empty')</h4>
                    @endforelse
                </div>

                {{ $products->links() }}
            </div>
        </div>
    </div>

@endsection


@section('script')

@endsection