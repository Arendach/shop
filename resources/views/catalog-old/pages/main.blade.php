@inject('str', 'Illuminate\Support\Str')

@extends('catalog-old.layout')

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
{{--

        @if($images->count())
            <div class="slider">
                @if($images->count() > 0)
                    <span class="slider-arrow" id="slider-prev">&lsaquo;</span>
                @endif

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

                @if($images->count() > 1)
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
                @endif
            </div>
        @endif

        @if($collections->count())
            <div class="manufacturers">
                <div class="manufacturer-prev">&lsaquo;</div>
                <div class="manufacturer-items">
                    @foreach($collections as $item)
                        <div class="manufacturer">
                            <a href="{{ route('collection', $item->slug) }}"
                               style='background-image: url("{{ $item->image }}")'></a>
                        </div>
                    @endforeach
                </div>

                <div class="manufacturer-next">
                    <div id="m-arrow">&rsaquo;</div>
                </div>
            </div>
        @endif

--}}

        <div class="products" style="margin-top: 50px">
            <h2>@translate('Новинки')</h2>

            @forelse($new_products->chunk(4) as $chunk)
                <div class="row" {!! !$loop->last ? 'style="margin-bottom: 30px"' : '' !!}>
                    @foreach($chunk as $item)
                        @include('catalog-old.product.chunk', ['chunks' => 3, 'item' => $item])
                    @endforeach
                </div>
            @empty
                <h4 class="centered">@translate('Тут порожньо')</h4>
            @endforelse
        </div>

        <div class="products" style="margin-top: 50px">
            <h2>@translate('Рекоменовані товари')</h2>
            @forelse($recommended_products->chunk(4) as $chunk)
                <div class="row" {!! !$loop->last ? 'style="margin-bottom: 30px"' : '' !!}>
                    @foreach($chunk as $item)
                        @include('catalog-old.product.chunk', ['chunks' => 3, 'item' => $item])
                    @endforeach
                </div>
            @empty
                <h4 class="centered">@translate('Тут порожньо')</h4>
            @endforelse
        </div>

        <div class="products" style="margin-top: 50px">
            <h2>@translate('Товари зі знижкою')</h2>
            @forelse($discount_products->chunk(4) as $chunk)
                <div class="row" {!! !$loop->last ? 'style="margin-bottom: 30px"' : '' !!}>
                    @foreach($chunk as $item)
                        @include('catalog-old.product.chunk', ['chunks' => 3, 'item' => $item])
                    @endforeach
                </div>
            @empty
                <h4 class="centered">@translate('Тут порожньо')</h4>
            @endforelse
        </div>

        @if(!is_null($page))
            <div class="products" style="margin-top: 50px">
                {!! $page->content ?? '' !!}
            </div>
        @endif

    </div>

@endsection


@section('script')

    <script src="{{ asset('catalog/js/products.js') }}"></script>

    @include('catalog-old.assets.cart_scripts')

@endsection
