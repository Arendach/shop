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
                            <li><a href="#">@translate('Головна')</a></li>
                            <li>{{ $category->parent->name }}</li>
                            <li>{{ $category->name }}</li>
                        </ul>
                    </div>
                    <h1>{{ $category->name }}</h1>
                </div>
            </div>
            <img src="{{ $category->getImage('big', 'catalog/img/bg_cat_shoes.jpg') }}" class="img-fluid"
                 alt="{{ $category->name }}">
        </div>

        <div id="stick_here"></div>
        <div class="toolbox elemento_stick">
            <div class="container">
                <ul class="clearfix">
                    <li>
                        <div class="sort_select">
                            <form action="{{ url()->current() }}" method="get">
                                @foreach(request()->except('order') as $key => $value)
                                    <input type="hidden" name="{{ $key }}" value="{{ $value }}">
                                @endforeach

                                <select name="order" class="selectpicker" onchange="$(this).parents('form').submit()">
                                    <option @selected('order', 'date,desc') value="date,desc">
                                        @translate('Новинки')
                                    </option>

                                    <option @selected('order', 'rating,desc') value="rating,desc">
                                        @translate('За рейтингом')
                                    </option>

                                    <option @selected('order', 'price,desc') value="price,desc">
                                        @translate('Від дорогих до дешевих')
                                    </option>

                                    <option @selected('order', 'price,asc') value="price,asc">
                                        @translate('Від дешевих до дорогих')
                                    </option>
                                </select>
                            </form>
                        </div>
                    </li>
                    <li>
                        <a href="#0"><i class="ti-view-grid"></i></a>
                        <a href="listing-row-1-sidebar-left.html"><i class="ti-view-list"></i></a>
                    </li>
                    <li>
                        <a href="#0" class="open_filters">
                            <i class="ti-filter"></i><span>Filters</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <!-- /toolbox -->

        <div class="container margin_30">

            <div class="row">
                <aside class="col-lg-3" id="sidebar_fixed">
                    @include('catalog.category.filter')
                </aside>

                <div class="col-lg-9">
                    <div class="row small-gutters">
                        @foreach($products as $product)
                            <div class="col-6 col-md-4">
                                <div class="grid_item">
                                    @if($product->is_discounted)
                                        <span class="ribbon off">-{{ $product->discount_percent }}%</span>
                                    @elseif($product->is_new)
                                        <span class="ribbon new">@translate('Новинка')</span>
                                    @elseif($product->is_recommended)
                                        <span class="ribbon hot">@translate('Рекомендовано')</span>
                                    @endif
                                    <figure>
                                        <a href="{{ $product->url }}">
                                            <img class="img-fluid lazy" src="{{ $product->small_image }}"
                                                 data-src="{{ $product->small_image }}" alt="{{ $product->name }}">
                                        </a>
                                        @if($product->is_discounted)
                                            <div data-countdown="{{ date('Y/m/d', time() + 3600 * 24 * 3) }}"
                                                 class="countdown"></div>
                                        @endif
                                    </figure>
                                    <a href="{{ $product->url }}">
                                        <h3>{{ $product->name }}</h3>
                                    </a>
                                    <div class="price_box">
                                        <span class="new_price">${{ $product->new_price }}</span>
                                        @if($product->is_discounted)
                                            <span class="old_price">${{ $product->old_price }}</span>
                                        @endif
                                    </div>
                                    <ul>
                                        <li>
                                            <a href="#0" class="tooltip-1" data-toggle="tooltip" data-placement="left"
                                               title="Add to favorites">
                                                <i class="ti-heart"></i>
                                                <span>Add to favorites</span>
                                            </a>
                                        </li>

                                        <li>
                                            <a href="#0" class="tooltip-1" data-toggle="tooltip" data-placement="left"
                                               title="Add to compare">
                                                <i class="ti-control-shuffle"></i>
                                                <span>Add to compare</span>
                                            </a>
                                        </li>

                                        <li>
                                            <a href="javascript:void(0)"
                                               data-type="cart_attach"
                                               data-id="{{ $product->id }}"
                                               @tooltip(translate('Додати в корзину'), 'left')
                                               class="tooltip-1"
                                            >
                                                <i class="ti-shopping-cart"></i>
                                                <span>@translate('Додати в корзину')</span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    {{ $products->links('catalog.parts.paginate') }}

                </div>
                <!-- /col -->
            </div>
            <!-- /row -->

        </div>
        <!-- /container -->
    </main>

@endsection

@section('js')
    <script src="{{ asset('catalog/js/sticky_sidebar.min.js') }}"></script>
    <script src="{{ asset('catalog/js/specific_listing.js') }}"></script>
@endsection