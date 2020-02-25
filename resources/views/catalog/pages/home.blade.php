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
                    <div class="owl-slide cover" style="background-image: url({{ $banner->image}});">
                        <div class="opacity-mask d-flex align-items-center" data-opacity-mask="rgba(0, 0, 0, 0.5)">
                            <div class="container">
                                <div class="row justify-content-center justify-content-md-end">
                                    <div class="col-lg-6 static">
                                        <div class="slide-text text-right white">
                                            <h2 class="owl-slide-animated owl-slide-title">{{ $banner->title }}</h2>
                                            <p class="owl-slide-animated owl-slide-subtitle">
                                                {{ $banner->description }}
                                            </p>
                                            <div class="owl-slide-animated owl-slide-cta">
                                                <a class="btn_1" href="{{ $banner->url }}" role="link">
                                                    Shop Now
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
                        <img src="{{ $collection->image }}" data-src="" alt="" class="lazy">
                        <div class="short_info opacity-mask" data-opacity-mask="rgba(0, 0, 0, 0.5)">
                            <h3>{{ $collection->name }}</h3>
                            <div><span class="btn_1">Shop Now</span></div>
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
                @foreach($recommendedProducts as $product)
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
        <!-- /featured -->

        <div class="container margin_60_35">
            <div class="main_title">
                <h2>Featured</h2>
                <span>Products</span>
                <p>Cum doctus civibus efficiantur in imperdiet deterruisset</p>
            </div>
            <div class="owl-carousel owl-theme products_carousel">
                <div class="item">
                    <div class="grid_item">
                        <span class="ribbon new">New</span>
                        <figure>
                            <a href="product-detail-1.html">
                                <img class="owl-lazy" src="img/products/product_placeholder_square_medium.jpg"
                                     data-src="img/products/shoes/4.jpg" alt="">
                            </a>
                        </figure>
                        <div class="rating"><i class="icon-star voted"></i><i class="icon-star voted"></i><i
                                    class="icon-star voted"></i><i class="icon-star voted"></i><i class="icon-star"></i>
                        </div>
                        <a href="product-detail-1.html">
                            <h3>ACG React Terra</h3>
                        </a>
                        <div class="price_box">
                            <span class="new_price">$110.00</span>
                        </div>
                        <ul>
                            <li><a href="#0" class="tooltip-1" data-toggle="tooltip" data-placement="left"
                                   title="Add to favorites"><i class="ti-heart"></i><span>Add to favorites</span></a>
                            </li>
                            <li><a href="#0" class="tooltip-1" data-toggle="tooltip" data-placement="left"
                                   title="Add to compare"><i class="ti-control-shuffle"></i><span>Add to compare</span></a>
                            </li>
                            <li><a href="#0" class="tooltip-1" data-toggle="tooltip" data-placement="left"
                                   title="Add to cart"><i class="ti-shopping-cart"></i><span>Add to cart</span></a></li>
                        </ul>
                    </div>
                    <!-- /grid_item -->
                </div>
                <!-- /item -->
                <div class="item">
                    <div class="grid_item">
                        <span class="ribbon new">New</span>
                        <figure>
                            <a href="product-detail-1.html">
                                <img class="owl-lazy" src="img/products/product_placeholder_square_medium.jpg"
                                     data-src="img/products/shoes/5.jpg" alt="">
                            </a>
                        </figure>
                        <div class="rating"><i class="icon-star voted"></i><i class="icon-star voted"></i><i
                                    class="icon-star voted"></i><i class="icon-star voted"></i><i class="icon-star"></i>
                        </div>
                        <a href="product-detail-1.html">
                            <h3>Air Zoom Alpha</h3>
                        </a>
                        <div class="price_box">
                            <span class="new_price">$140.00</span>
                        </div>
                        <ul>
                            <li><a href="#0" class="tooltip-1" data-toggle="tooltip" data-placement="left"
                                   title="Add to favorites"><i class="ti-heart"></i><span>Add to favorites</span></a>
                            </li>
                            <li><a href="#0" class="tooltip-1" data-toggle="tooltip" data-placement="left"
                                   title="Add to compare"><i class="ti-control-shuffle"></i><span>Add to compare</span></a>
                            </li>
                            <li><a href="#0" class="tooltip-1" data-toggle="tooltip" data-placement="left"
                                   title="Add to cart"><i class="ti-shopping-cart"></i><span>Add to cart</span></a></li>
                        </ul>
                    </div>
                    <!-- /grid_item -->
                </div>
                <!-- /item -->
                <div class="item">
                    <div class="grid_item">
                        <span class="ribbon hot">Hot</span>
                        <figure>
                            <a href="product-detail-1.html">
                                <img class="owl-lazy" src="img/products/product_placeholder_square_medium.jpg"
                                     data-src="img/products/shoes/8.jpg" alt="">
                            </a>
                        </figure>
                        <div class="rating"><i class="icon-star voted"></i><i class="icon-star voted"></i><i
                                    class="icon-star voted"></i><i class="icon-star voted"></i><i class="icon-star"></i>
                        </div>
                        <a href="product-detail-1.html">
                            <h3>Air Color 720</h3>
                        </a>
                        <div class="price_box">
                            <span class="new_price">$120.00</span>
                        </div>
                        <ul>
                            <li><a href="#0" class="tooltip-1" data-toggle="tooltip" data-placement="left"
                                   title="Add to favorites"><i class="ti-heart"></i><span>Add to favorites</span></a>
                            </li>
                            <li><a href="#0" class="tooltip-1" data-toggle="tooltip" data-placement="left"
                                   title="Add to compare"><i class="ti-control-shuffle"></i><span>Add to compare</span></a>
                            </li>
                            <li><a href="#0" class="tooltip-1" data-toggle="tooltip" data-placement="left"
                                   title="Add to cart"><i class="ti-shopping-cart"></i><span>Add to cart</span></a></li>
                        </ul>
                    </div>
                    <!-- /grid_item -->
                </div>
                <!-- /item -->
                <div class="item">
                    <div class="grid_item">
                        <span class="ribbon off">-30%</span>
                        <figure>
                            <a href="product-detail-1.html">
                                <img class="owl-lazy" src="img/products/product_placeholder_square_medium.jpg"
                                     data-src="img/products/shoes/2.jpg" alt="">
                            </a>
                        </figure>
                        <div class="rating"><i class="icon-star voted"></i><i class="icon-star voted"></i><i
                                    class="icon-star voted"></i><i class="icon-star voted"></i><i class="icon-star"></i>
                        </div>
                        <a href="product-detail-1.html">
                            <h3>Okwahn II</h3>
                        </a>
                        <div class="price_box">
                            <span class="new_price">$90.00</span>
                            <span class="old_price">$170.00</span>
                        </div>
                        <ul>
                            <li><a href="#0" class="tooltip-1" data-toggle="tooltip" data-placement="left"
                                   title="Add to favorites"><i class="ti-heart"></i><span>Add to favorites</span></a>
                            </li>
                            <li><a href="#0" class="tooltip-1" data-toggle="tooltip" data-placement="left"
                                   title="Add to compare"><i class="ti-control-shuffle"></i><span>Add to compare</span></a>
                            </li>
                            <li><a href="#0" class="tooltip-1" data-toggle="tooltip" data-placement="left"
                                   title="Add to cart"><i class="ti-shopping-cart"></i><span>Add to cart</span></a></li>
                        </ul>
                    </div>
                    <!-- /grid_item -->
                </div>
                <!-- /item -->
                <div class="item">
                    <div class="grid_item">
                        <span class="ribbon off">-50%</span>
                        <figure>
                            <a href="product-detail-1.html">
                                <img class="owl-lazy" src="img/products/product_placeholder_square_medium.jpg"
                                     data-src="img/products/shoes/3.jpg" alt="">
                            </a>
                        </figure>
                        <div class="rating"><i class="icon-star voted"></i><i class="icon-star voted"></i><i
                                    class="icon-star voted"></i><i class="icon-star voted"></i><i class="icon-star"></i>
                        </div>
                        <a href="product-detail-1.html">
                            <h3>Air Wildwood ACG</h3>
                        </a>
                        <div class="price_box">
                            <span class="new_price">$75.00</span>
                            <span class="old_price">$155.00</span>
                        </div>
                        <ul>
                            <li><a href="#0" class="tooltip-1" data-toggle="tooltip" data-placement="left"
                                   title="Add to favorites"><i class="ti-heart"></i><span>Add to favorites</span></a>
                            </li>
                            <li><a href="#0" class="tooltip-1" data-toggle="tooltip" data-placement="left"
                                   title="Add to compare"><i class="ti-control-shuffle"></i><span>Add to compare</span></a>
                            </li>
                            <li><a href="#0" class="tooltip-1" data-toggle="tooltip" data-placement="left"
                                   title="Add to cart"><i class="ti-shopping-cart"></i><span>Add to cart</span></a></li>
                        </ul>
                    </div>
                    <!-- /grid_item -->
                </div>
                <!-- /item -->
            </div>
            <!-- /products_carousel -->
        </div>
        <!-- /container -->

        <div class="bg_gray">
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
        </div>
        <!-- /bg_gray -->

        <div class="container margin_60_35">
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
        </div>
        <!-- /container -->
    </main>
    <!-- /main -->

@endsection

@section('js')
    <script src="{{ asset('catalog/js/carousel-home.min.js') }}"></script>
@endsection