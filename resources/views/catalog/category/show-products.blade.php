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
                               {{-- @foreach(request()->except('order') as $key => $value)
                                    <input type="hidden" name="{{ $key }}" value="{{ $value }}">
                                @endforeach--}}

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
                            @php
                                $characteristics = "";
                                foreach($product->characteristics as $characteristic) {
                                    $name = $characteristic->getName();
                                    $prefix = $characteristic->getPrefix();
                                    $value = $characteristic->value;
                                    $postfix = $characteristic->getPostfix();
                                    $characteristics .= "<strong>$name</strong> $prefix $value $postfix <br>";
                                }
                            @endphp
                            <div class="col-6 col-md-4">
                                <div class="grid_item"
                                     data-html="true"
                                     data-toggle="popover"
                                     data-trigger="hover"
                                     title="Характеристики"
                                     data-content="{!! $characteristics !!}"
                                >
                                    @if(!$product->on_storage)
                                        <span class="ribbon off">@translate('Нету в наличии')</span>
                                    @elseif($product->is_discounted)
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
                                    <a href="{{(!empty($product->rating)) ? route('product.view', $product->id) . '?rev=1' : route('product.leave_review', $product->id)}}">
                                        {!! htmlspecialchars_decode($product->stars) !!}
                                        <em>{{ $product->reviews->count() }} @translate('Відгук(ів)')</em>
                                    </a>
                                    <br>
                                    <a href="{{ $product->url }}">
                                        <h3>{{ $product->name }}</h3>
                                    </a>
                                    <div class="price_box">
                                        <span class="new_price">₴ {{ $product->new_price }}</span>
                                        @if($product->is_discounted)
                                            <span class="old_price">₴ {{ $product->old_price }}</span>
                                        @endif
                                    </div>
                                    <ul>
                                        @if($product->video)
                                            <li class="tooltip-1 li-video" data-toggle="tooltip" data-placement="left" title="Дивитись відео">
                                                <a class="click-video d-none d-xl-block" href="#0" data-video-id="{{$product->video}}"
                                                   data-video-title="{{$product->name}}"
                                                   data-toggle="modal"
                                                   data-target="#video-window">
                                                    <i class="ti-youtube"></i>
                                                    <span>Дивитись відео</span>
                                                </a>
                                            </li>
                                        @endif
                                    </ul>
                                </div>
                                <ul class="grid_item_2">
                                    <li>
                                        <a href="javascript:void(0)"
                                           data-type="cart_attach"
                                           data-id="{{ $product->id }}"
                                           @tooltip(translate('Додати в корзину'), 'left')
                                           class="tooltip-1"
                                           style="width: 130px; color: white; background-color: green;"
                                        >
                                            <i class="ti-shopping-cart"></i>
                                            <span>@translate('В корзину')</span>
                                        </a>
                                    </li>

                                    <li class="tooltip-1" data-toggle="tooltip" data-placement="left" title="Купить в 1 клик">
                                        <a class="click-one-click-order" href="#0" data-toggle="modal"
                                           data-target="#one-click-order-window"
                                           data-id="{{ $product->id }}">
                                            <i class="ti-location-arrow"></i>
                                            <!--<span>Купить в 1 клик</span>-->
                                        </a>
                                    </li>

                                    <li>
                                        <a href="#0" class="tooltip-1" data-toggle="tooltip" data-placement="left"
                                           title="Add to favorites">
                                            <i class="ti-heart"></i>
                                            <!--<span>Add to favorites</span>-->
                                        </a>
                                    </li>

                                    <li>
                                        <a href="#0" class="tooltip-1" data-toggle="tooltip" data-placement="left"
                                           title="Add to compare">
                                            <i class="ti-control-shuffle"></i>
                                            <!--<span>Add to compare</span>-->
                                        </a>
                                    </li>

                                    @if($product->video)
                                        <li class="tooltip-1" data-toggle="tooltip" data-placement="left" title="Дивитись відео">
                                            <a class="click-video d-none d-md-block d-lg-none" href="#0" data-video-id="{{$product->video}}"
                                               data-video-title="{{$product->name}}"
                                               data-toggle="modal"
                                               data-target="#video-window"
                                               style="color: white; background-color: red;"
                                            >
                                                <i class="ti-youtube"></i>
                                                <!--<span>Дивитись відео</span>-->
                                            </a>
                                        </li>
                                    @endif
                                </ul>
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

@push('modals')
<!-- Modal Video-->
<div class="modal fade" id="video-window" tabindex="-1" role="dialog" aria-labelledby="video_title" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title" id="video_title">Payments Methods</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="embed-responsive embed-responsive-16by9">
                    <iframe id="iframe-video" class="embed-responsive-item" src="//www.youtube.com/embed/EvxDxOVzz24" frameborder="0" allowfullscreen=""></iframe>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal One click order-->
<div class="modal fade" id="one-click-order-window" tabindex="-1" role="dialog" aria-labelledby="one-click-order-title" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title" id="one-click-order-title">Замовлення в 1 клік</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="form-one-click-order">
                    <div class="form-group">
                        <label for="name-label">Имя</label>
                        <input type="text" class="form-control" id="name-label" name="name">
                    </div>
                    <div class="form-group">
                        <label for="phone-label">Телефон</label>
                        <input type="text" class="form-control" id="phone-label" name="phone" placeholder="050-111-11-11">
                    </div>
                    <input type="hidden" value="0" name="product_id" id="product_id">
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="make-one-click-order">Замовити</button>
            </div>
        </div>
    </div>
</div>
@endpush

@section('js')
    <script src="{{ asset('catalog/js/sticky_sidebar.min.js') }}"></script>
    <script src="{{ asset('catalog/js/specific_listing.js') }}"></script>
    <script src="{{ asset('catalog/js/modal_windows.js') }}"></script>
@endsection