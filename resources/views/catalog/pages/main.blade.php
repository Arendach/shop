@inject('str', 'Illuminate\Support\Str')

@extends('catalog.layout')

@section('style')

    <style>
        .slider-item a {
            width: 100%;
            height: 100%;
            display: block;
            position: relative;
            background-position: center;
            background-repeat: no-repeat;
            background-size: contain;
            color: #ffff;
        }

        .slider-item a:hover {
            text-decoration: none;
        }

        .slider-item a h3 {
            position: absolute;
            top: 45%;
            width: 100%;
            text-align: center;
        }

        .slider-item a p {
            position: absolute;
            top: 45%;
            width: 100%;
            padding: 50px;
            text-align: center;
        }
    </style>

@endsection

@section('content')

    <div class="container" style="margin-top: 20px">

        <div class="slider">
            <span class="slider-arrow" id="slider-prev">&lsaquo;</span>

            <div class="slider-items">
                @foreach($images as $item)
                    <div class="slider-item {{ $loop->iteration === 1 ? 'slider-active' : '' }}"
                         id="slider-item-{{ $loop->iteration }}">
                        <a href="{{ $item->url }}" style="background-image: url('{{ $item->image }}')"
                           title="{{ $item->alt }}">
                            <h3 style="color: {{ $item->color }}">{{ $item->title }}</h3>
                            <p style="color: {{ $item->color }}">{{ $item->description }}</p>
                        </a>
                    </div>
                @endforeach
            </div>

            <div class="slider-points">
                @foreach ($images as $item)
                    <div data-type="item" data-id="{{ $loop->iteration }}"
                         class="slider-point {{ $loop->iteration == 1 ? 'slider-point-active' : '' }}">
                        {{ $loop->iteration }}
                    </div>
                @endforeach

                <div data-type="handle" data-id="pause" class="slider-point">
                    &#10074;&#10074;
                </div>
            </div>

            <span class="slider-arrow" id="slider-next">&rsaquo;</span>
        </div>

        <div class="manufacturers">
            <div class="manufacturer-prev">&lsaquo;</div>
            <div class="manufacturer-items">
                @foreach($manufacturers as $item)
                    <div class="manufacturer">
                        <a href="#"
                           style='background-image: url("{{ $item->photo }}")'></a>
                    </div>
                @endforeach
            </div>

            <div class="manufacturer-next">
                <div id="m-arrow">&rsaquo;</div>
            </div>
        </div>


        <div class="products" style="margin-top: 50px">
            <h2>Новинки</h2>

            @forelse($new_products->chunk(4) as $chunk)
                <div class="row" {!! !$loop->last ? 'style="margin-bottom: 30px"' : '' !!}>
                    @foreach($chunk as $item)
                        <div class="col-3 product-card">
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

        <div class="products" style="margin-top: 50px">
            <h2>Рекомендовані</h2>
            @forelse($recommended_products->chunk(4) as $chunk)
                <div class="row" {!! !$loop->last ? 'style="margin-bottom: 30px"' : '' !!}>
                    @foreach($chunk as $item)
                        <div class="col-3 product-card">
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

        <div class="products" style="margin-top: 50px">
            <h2>Товари зі знижкою</h2>
            @forelse($discount_products->chunk(4) as $chunk)
                <div class="row" {!! !$loop->last ? 'style="margin-bottom: 30px"' : '' !!}>
                    @foreach($chunk as $item)
                        <div class="col-3 product-card">
                            <div class="product" data-id="{{ $item->id }}">
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
                                            <button class="btn btn-outline-primary add_to_cart">
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

    </div>

@endsection


@section('script')

    <script src="{{ asset('catalog/js/products.js') }}"></script>

    @include('catalog.assets.cart_scripts')

@endsection
