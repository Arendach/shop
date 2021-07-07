@extends('catalog.layout')


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
                            <li><a href="{{ $category->parent->url }}">{{ $category->parent->name }}</a></li>
                            <li>{{ $category->name }}</li>
                        </ul>
                    </div>
                    <h1>{{ $category->name }}</h1>
                </div>
            </div>
            <img src="{{ $category->getImage('big', 'catalog/img/bg_cat_shoes.jpg') }}" class="img-fluid">
        </div>

        <div id="stick_here"></div>
        <div class="toolbox elemento_stick">
            <div class="container">
                <ul class="clearfix">
                    <li>
                        <div class="sort_select">
                            <form action="{{ url()->current() }}" method="get">
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
                     {{--<li>
                        <a href="#0"><i class="ti-view-grid"></i></a>
                        <a href="listing-row-1-sidebar-left.html"><i class="ti-view-list"></i></a>
                    </li> --}}
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
                                @include('catalog.parts.product-card', ['col' => 3])
                            </div>
                        @endforeach
                    </div>

                    {{ $products->links('catalog.parts.paginate') }}

                </div>
                <!-- /col -->
            </div>
            <!-- /row -->

        </div>

        <div class="container margin_30">
            <div class="row">
{{--                <div class="col-3"></div>--}}
                <div class="col-12">
                    {!! $category->description !!}
                </div>
            </div>
        </div>
        <!-- /container -->
    </main>
@endsection

@section('js')
    <script src="{{ asset('catalog/js/sticky_sidebar.min.js') }}"></script>
    <script src="{{ asset('catalog/js/specific_listing.js') }}"></script>
@endsection