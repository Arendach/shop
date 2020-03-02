@extends('catalog.layout')

@section('css')
    <link href="{{ asset('catalog/css/home_1.css') }}" rel="stylesheet">
@endsection

@section('content')

    <main>
        <div id="carousel-home">
            <div class="owl-carousel owl-theme">
                @foreach($banners as $banner)
                    {{-- Дописати логіку для баннерів (ліво прао по центру) --}}
                    <div class="owl-slide cover" style="background-image: url({{ $banner->getImage() }})">
                        <div class="opacity-mask d-flex align-items-center" data-opacity-mask="rgba(0, 0, 0, 0.5)">
                            <div class="container">
                                <div class="row justify-content-center justify-content-md-{{ $banner->position == 'right' ? 'end' : 'start' }}">
                                    <div class="{{ $banner->position == 'center' ? 'col-lg-12' : 'col-lg-6' }} static">
                                        <div class="slide-text text-{{ $banner->position }}"
                                             style="color: {{ $banner->color }}">
                                            <h2 class="owl-slide-animated owl-slide-title"
                                                style="color: {{ $banner->color }}">
                                                {{ $banner->title }}
                                            </h2>
                                            <p class="owl-slide-animated owl-slide-subtitle">
                                                {{ $banner->description }}
                                            </p>
                                            <div class="owl-slide-animated owl-slide-cta">
                                                <a class="btn_1" href="{{ $banner->url }}" role="link">
                                                    {{ $banner->button }}
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div id="icon_drag_mobile"></div>
        </div>
        <!--/carousel-->

        <ul id="banners_grid" class="clearfix">
            @foreach($collections as $collection)
                <li>
                    <a href="{{ route('collection', $collection->slug) }}" class="img_container">
                        <img src="{{ $collection->image }}" data-src="{{ $collection->image }}"
                             alt="{{ $collection->name }}" class="lazy">
                        <div class="short_info opacity-mask" data-opacity-mask="rgba(0, 0, 0, 0.5)">
                            <h3>{{ $collection->name }}</h3>
                            <div><span class="btn_1">@translate('Детальніше')</span></div>
                        </div>
                    </a>
                </li>
            @endforeach
        </ul>
        <!--/banners_grid -->

        <div class="container margin_60_35">
            <div class="main_title">
                <h2>@translate('Популярні')</h2>
                <span>@translate('Товари')</span>
                <p>@translate('Товари які користуються популярністю в наших покупців')</p>
            </div>
            <div class="row small-gutters">
                @foreach($productsHome as $product)
                    <div class="col-6 col-md-4 col-xl-3">
                        <div class="grid_item">
                            <figure>
                                @if($product->is_discounted)
                                    <span class="ribbon off">-{{ $product->discount_percent }}%</span>
                                @elseif($product->is_new)
                                    <span class="ribbon new">@translate('Новинка')</span>
                                @elseif($product->is_recommended)
                                    <span class="ribbon hot">@translate('Рекомендовано')</span>
                                @endif
                                <a href="{{ route('product.view', $product->slug) }}">
                                    <img class="img-fluid lazy" src="{{ $product->big_image }}"
                                         data-src="{{ $product->big_image }}" alt="">
                                    <img class="img-fluid lazy" src="{{ $product->big_image }}"
                                         data-src="{{ $product->big_image }}" alt="">
                                </a>
                                @if($product->is_discounted)
                                    <div data-countdown="{{ date('Y/m/d', time() + 3600 * 24) }}"
                                         class="countdown"></div>
                                @endif
                            </figure>
                            <div class="rating">
                                {!! $product->stars !!}
                            </div>
                            <a href="{{ route('product.view', $product->slug) }}">
                                <h3>{{ $product->name }}</h3>
                            </a>
                            <div class="price_box">
                                <span class="new_price">{{ $product->new_price }}</span>
                                @if($product->is_discounted)
                                    <span class="old_price">{{ $product->old_price }}</span>
                                @endif
                            </div>
                            <ul>
                                <li><a href="#0" class="tooltip-1" data-toggle="tooltip" data-placement="left"
                                       title="Add to favorites"><i
                                                class="ti-heart"></i><span>Add to favorites</span></a>
                                </li>
                                <li><a href="#0" class="tooltip-1" data-toggle="tooltip" data-placement="left"
                                       title="Add to compare"><i
                                                class="ti-control-shuffle"></i><span>Add to compare</span></a>
                                </li>
                                <li><a href="#0" class="tooltip-1" data-toggle="tooltip" data-placement="left"
                                       title="Add to cart"><i class="ti-shopping-cart"></i><span>Add to cart</span></a>
                                </li>
                            </ul>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <div class="featured lazy" data-bg="url(img/featured_home.jpg)">
            <div class="opacity-mask d-flex align-items-center" data-opacity-mask="rgba(0, 0, 0, 0.5)">
                <div class="container margin_60">
                    <div class="row justify-content-center justify-content-md-start">
                        <div class="col-lg-6 wow" data-wow-offset="150">
                            <h3>Armor<br>Air Color 720</h3>
                            <p>Lightweight cushioning and durable support with a Phylon midsole</p>
                            <div class="feat_text_block">
                                <div class="price_box">
                                    <span class="new_price">$90.00</span>
                                    <span class="old_price">$170.00</span>
                                </div>
                                <a class="btn_1" href="listing-grid-1-full.html" role="button">Shop Now</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="container margin_60_35">
            <div class="main_title">
                <h2>@translate('Рекомендовані')</h2>
                <span>@translate('Товари')</span>
                <p>@translate('Товари які рекомендує наш магазин')</p>
            </div>
            <div class="owl-carousel owl-theme products_carousel">
                @foreach($recommended as $product)
                    <div class="item">
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
                                    <img class="owl-lazy" src="{{ $product->small_image }}"
                                         data-src="{{ $product->big_image }}" alt="{{ $product->name }}">
                                </a>
                            </figure>
                            <div class="rating">{!! $product->stats !!}</div>
                            <a href="{{ $product->url }}">
                                <h3>{{ $product->name }}</h3>
                            </a>
                            <div class="price_box">
                                <span class="new_price">{{ $product->new_price }}</span>
                                @if($product->is_discounted)
                                    <span class="old_price">{{ $product->old_price }}</span>
                                @endif
                            </div>
                            <ul>
                                <li>
                                    <a href="#0" class="tooltip-1" data-toggle="tooltip" data-placement="left"
                                       title="Add to favorites">
                                        <i class="ti-heart"></i><span>Add to favorites</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#0" class="tooltip-1" data-toggle="tooltip" data-placement="left"
                                       title="Add to compare">
                                        <i class="ti-control-shuffle"></i><span>Add to compare</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)" onclick="Cart.add('{{ $product->id }}', this)"
                                       class="tooltip-1"
                                       data-toggle="tooltip" data-placement="left" title="@translate('Додати в корзину')">
                                        <i class="ti-shopping-cart"></i> <span>@translate('Додати в корзину')</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <!-- /grid_item -->
                    </div>
                @endforeach
            </div>
        </div>


        {{-- TODO: дописати виробників чи ше шось --}}
        {{--<div class="bg_gray">
            <div class="container margin_30">
                <div id="brands" class="owl-carousel owl-theme">
                    <div class="item">
                        <a href="#0"><img src="img/brands/placeholder_brands.png" data-src="img/brands/logo_1.png"
                                          alt="" class="owl-lazy"></a>
                    </div><!-- /item -->
                    <div class="item">
                        <a href="#0"><img src="img/brands/placeholder_brands.png" data-src="img/brands/logo_2.png"
                                          alt="" class="owl-lazy"></a>
                    </div><!-- /item -->
                    <div class="item">
                        <a href="#0"><img src="img/brands/placeholder_brands.png" data-src="img/brands/logo_3.png"
                                          alt="" class="owl-lazy"></a>
                    </div><!-- /item -->
                    <div class="item">
                        <a href="#0"><img src="img/brands/placeholder_brands.png" data-src="img/brands/logo_4.png"
                                          alt="" class="owl-lazy"></a>
                    </div><!-- /item -->
                    <div class="item">
                        <a href="#0"><img src="img/brands/placeholder_brands.png" data-src="img/brands/logo_5.png"
                                          alt="" class="owl-lazy"></a>
                    </div><!-- /item -->
                    <div class="item">
                        <a href="#0"><img src="img/brands/placeholder_brands.png" data-src="img/brands/logo_6.png"
                                          alt="" class="owl-lazy"></a>
                    </div><!-- /item -->
                </div><!-- /carousel -->
            </div><!-- /container -->
        </div>--}}


        {{-- TODO: створити блог і вивести --}}
        {{--<div class="container margin_60_35">
            <div class="main_title">
                <h2>Latest News</h2>
                <span>Blog</span>
                <p>Cum doctus civibus efficiantur in imperdiet deterruisset</p>
            </div>
            <div class="row">
                <div class="col-lg-6">
                    <a class="box_news" href="blog.html">
                        <figure>
                            <img src="img/blog-thumb-placeholder.jpg" data-src="img/blog-thumb-1.jpg" alt="" width="400"
                                 height="266" class="lazy">
                            <figcaption><strong>28</strong>Dec</figcaption>
                        </figure>
                        <ul>
                            <li>by Mark Twain</li>
                            <li>20.11.2017</li>
                        </ul>
                        <h4>Pri oportere scribentur eu</h4>
                        <p>Cu eum alia elit, usu in eius appareat, deleniti sapientem honestatis eos ex. In ius esse
                            ullum vidisse....</p>
                    </a>
                </div>
                <!-- /box_news -->
                <div class="col-lg-6">
                    <a class="box_news" href="blog.html">
                        <figure>
                            <img src="img/blog-thumb-placeholder.jpg" data-src="img/blog-thumb-2.jpg" alt="" width="400"
                                 height="266" class="lazy">
                            <figcaption><strong>28</strong>Dec</figcaption>
                        </figure>
                        <ul>
                            <li>By Jhon Doe</li>
                            <li>20.11.2017</li>
                        </ul>
                        <h4>Duo eius postea suscipit ad</h4>
                        <p>Cu eum alia elit, usu in eius appareat, deleniti sapientem honestatis eos ex. In ius esse
                            ullum vidisse....</p>
                    </a>
                </div>
                <!-- /box_news -->
                <div class="col-lg-6">
                    <a class="box_news" href="blog.html">
                        <figure>
                            <img src="img/blog-thumb-placeholder.jpg" data-src="img/blog-thumb-3.jpg" alt="" width="400"
                                 height="266" class="lazy">
                            <figcaption><strong>28</strong>Dec</figcaption>
                        </figure>
                        <ul>
                            <li>By Luca Robinson</li>
                            <li>20.11.2017</li>
                        </ul>
                        <h4>Elitr mandamus cu has</h4>
                        <p>Cu eum alia elit, usu in eius appareat, deleniti sapientem honestatis eos ex. In ius esse
                            ullum vidisse....</p>
                    </a>
                </div>
                <!-- /box_news -->
                <div class="col-lg-6">
                    <a class="box_news" href="blog.html">
                        <figure>
                            <img src="img/blog-thumb-placeholder.jpg" data-src="img/blog-thumb-4.jpg" alt="" width="400"
                                 height="266" class="lazy">
                            <figcaption><strong>28</strong>Dec</figcaption>
                        </figure>
                        <ul>
                            <li>By Paula Rodrigez</li>
                            <li>20.11.2017</li>
                        </ul>
                        <h4>Id est adhuc ignota delenit</h4>
                        <p>Cu eum alia elit, usu in eius appareat, deleniti sapientem honestatis eos ex. In ius esse
                            ullum vidisse....</p>
                    </a>
                </div>
                <!-- /box_news -->
            </div>
            <!-- /row -->
        </div>--}}


    </main>

@endsection

@section('js')
    <script src="{{ asset('catalog/js/carousel-home.min.js') }}"></script>
@endsection