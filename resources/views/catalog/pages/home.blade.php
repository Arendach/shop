@extends('catalog.layout')

@section('title', $title ?? $globalData->meta_title)

@section('css')
    <link href="{{ asset('catalog/css/home_1.css') }}" rel="stylesheet">
@endsection

@section('content')

    <main>
        <div id="carousel-home">
            <div class="owl-carousel owl-theme">
                @foreach($banners as $banner)
                    <div class="owl-slide cover" style="background-image: url({{ $banner->getImage() }})">
                        <div class="opacity-mask d-flex align-items-center"
                             @if(setting('Затемнення банера на головній',0))data-opacity-mask="rgba(0, 0, 0, 0.5)"@endif
                            style="{{ setting('Стилі для банера на головній','') }}"
                        >
                            <div class="container">
                                <div class="row justify-content-center justify-content-md-{{ $banner->position == 'right' ? 'end' : 'start' }}">
                                    <div class="{{ $banner->position == 'center' ? 'col-lg-12' : 'col-lg-6' }} static">
                                        <div class="slide-text text-{{ $banner->position }}" style="color: {{ $banner->color }}">
                                            <h2 class="owl-slide-animated owl-slide-title" style="color: {{ $banner->color }}">
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
                @php /** @var \App\Models\ProductCollection $collection */ @endphp
                <li>
                    <a href="{{ route('collection', $collection->slug) }}" class="img_container">
                        <img src="{{ $collection->getImage('image') }}" data-src="{{ $collection->getImage('image') }}"
                             alt="{{ $collection->name }}" class="lazy">
                        <div class="short_info opacity-mask"
                             @if(setting('Затемнення коллекцій на головній',0))data-opacity-mask="rgba(0, 0, 0, 0.5)"@endif
                             style="{{ setting('Стилі для колекцій на головній','') }}"
                        >
                            <h3>{{ $collection->name }}</h3>
                            <div><span class="btn_1" style="background: {{ $collection->button_color }}">@translate('Детальніше')</span></div>
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
                        @include('catalog.parts.product-card')
                    </div>
                @endforeach
            </div>
        </div>

        {{-- Придумати що зробити з цим баннером --}}
        @if(false)
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
        @endif


        <div class="container margin_60_35">
            <div class="main_title">
                <h2>@translate('Рекомендовані')</h2>
                <span>@translate('Товари')</span>
                <p>@translate('Товари які рекомендує наш магазин')</p>
            </div>
            <div class="owl-carousel owl-theme products_carousel">
                @foreach($recommended as $product)
                    <div class="item">
                        @include('catalog.parts.product-card')
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
        @if(\App\Models\Page::where('uri_name', 'index')->count())
            <div class="container margin_60_35">
                {!! \App\Models\Page::where('uri_name', 'index')->first()->content !!}
            </div>
        @endif

    </main>

@endsection

@section('js')
    <script src="{{ asset('catalog/js/carousel-home.min.js') }}"></script>
@endsection