<!DOCTYPE html>
<html lang="{{ config('locale.current') }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="{{ $meta_description ?? $globalData->meta_description }}">
    <meta name="keywords" content="{{ $meta_keywords ?? $globalData->meta_keywords }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', $title ?? $globalData->meta_title)</title>

    <!-- Favicons-->
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
    <link rel="apple-touch-icon" type="image/x-icon" href="{{ asset('img/apple-touch-icon-57x57-precomposed.png') }}">
    <link rel="apple-touch-icon" type="image/x-icon" sizes="72x72"
          href="{{ asset('img/apple-touch-icon-72x72-precomposed.png') }}">
    <link rel="apple-touch-icon" type="image/x-icon" sizes="114x114"
          href="{{ asset('img/apple-touch-icon-114x114-precomposed.png') }}">
    <link rel="apple-touch-icon" type="image/x-icon" sizes="144x144"
          href="{{ asset('img/apple-touch-icon-144x144-precomposed.png') }}">

@yield('seo')

    @foreach(config('locale.support') as $locale)
        <link rel="alternate" hreflang="{{ $locale }}" href="{{ app(\App\Services\LocaleService::class)->localizeUrl($locale, url()->current()) }}">
    @endforeach
    <link rel="alternate" hreflang="x-default" href="{{ app(\App\Services\LocaleService::class)->localizeUrl(config('locale.default'), url()->current()) }}">

    <!-- GOOGLE WEB FONT -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900&display=swap" rel="stylesheet">

    <!-- BASE CSS -->
    <link rel="stylesheet" href="{{ asset('catalog/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('catalog/css/bootstrap.custom.min.css') }}">
    <link rel="stylesheet" href="{{ asset('catalog/css/app.css') }}">
    <link href="{{ asset('catalog/css/listing.css') }}" rel="stylesheet">

    <!-- SPECIFIC CSS -->
@yield('css')
@stack('css')

<!-- YOUR CUSTOM CSS -->
    <link rel="stylesheet" href="{{ mix('css/custom.css') }}">
    <script async src="https://crm.streamtele.com/widget/getwidget/2b5889941b7aae1f3bdcf73f9f18bf0c" type="text/javascript" charset="UTF-8"></script>

    <!--Plugin CSS file with desired skin-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ion-rangeslider/2.3.1/css/ion.rangeSlider.min.css"/>

</head>

<body>

<div id="page">
    <header class="version_1">
        <div class="layer"></div>
        <div class="main_header" style="background-color: {{ setting('колір шапки сайта','#004dda') }}; color:{{ setting('колір тексту шапки сайта','white') }};">
            <div class="container">
                <div class="row small-gutters">
                    <div class="col-xl-2 col-lg-3 d-lg-flex align-items-center">
                        <div id="logo">
                            <a href="{{ route('index') }}">
                                <img src="{{ $globalData->logo_image }}" width="100" height="35">
                            </a>
                        </div>
                    </div>
                    <nav class="col-xl-6 col-lg-6">
                        <a class="open_close" href="javascript:void(0);">
                            <div class="hamburger hamburger--spin">
                                <div class="hamburger-box">
                                    <div class="hamburger-inner"></div>
                                </div>
                            </div>
                        </a>
                        <!-- Mobile menu button -->
                        <div class="main-menu">
                            <div id="header_menu">
                                <a href="{{ route('index') }}">
                                    <img src="{{ $globalData->logo_image }}" width="100" height="35">
                                </a>
                                <a href="#" class="open_close" id="close_in">
                                    <i class="ti-close"></i>
                                </a>
                            </div>
                            @if($agent->isMobile())
                                <div class="store_switcher_mobile">
                                    <div class="lang-switcher-button {{config('locale.current') == "uk" ? 'active': ''}}">
                                        <a href="{{ route('locale', 'uk') }}">
                                            @translate('Укр')
                                        </a>
                                    </div>
                                    <div class="lang-switcher-button {{config('locale.current') == "ru" ? 'active': ''}}">
                                        <a href="{{ route('locale', 'ru') }}">
                                            @translate('Рос')
                                        </a>
                                    </div>
                                </div>
                            @endif
                            <ul>
                                @foreach($menu as $menuParts)
                                    <li class="@if($menuParts->role == 'menu') submenu @elseif($menuParts->role == 'megamenu') megamenu submenu @endif">
                                        @if($menuParts->role == 'link')
                                            <a style="color:{{ setting('колір тексту шапки сайта','white') }};" href="{{ $menuParts->url }}">
                                                {{ $menuParts->name }}
                                            </a>
                                        @elseif($menuParts->role == 'menu')
                                            <a href="javascript:void(0);" class="show-submenu" style="color:{{ setting('колір тексту шапки сайта','white') }};">
                                                {{ $menuParts->name }}
                                            </a>
                                            <ul>
                                                @foreach($menuParts->items as $item)
                                                    <li>
                                                        <a href="{{ $item->url }}" style="color:{{ setting('колір тексту шапки сайта','white') }};">
                                                            {{ $item->name }}
                                                        </a>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        @else
                                            <a href="javascript:void(0);" class="show-submenu-mega" style="color:{{ setting('колір тексту шапки сайта','white') }};">
                                                {{ $menuParts->name }}
                                            </a>
                                            @if($menuParts->name_ru == 'Коллекции')
                                                <div class="menu-wrapper">
                                                    @foreach($collectionMenu as $collection)
                                                        <div class="carus-party">
                                                            <h3>
                                                                <a class="text-dark font-bold" href="{{ url('collection/'.$collection->slug) }}">
                                                                    {{ $collection->name }}
                                                                </a>
                                                            </h3>
                                                            <div class="carus-party-in">

                                                                @foreach($collection->child as $child)
                                                                    <div class="one-party">
                                                                        <a href="{{ url('collection/'.$child->slug) }}">
                                                                            <div class="one-party-thumb">
                                                                                <img src="{{ $child->getImage('image', 'catalog/img/bg_cat_shoes.jpg') }}" width="185" height="80" alt="{{ $child->name }}">
                                                                            </div>
                                                                            <div class="one-party-tit">
                                                                                <div class="one-party-tit-in">
                                                                                    {{ $child->name }}
                                                                                </div>
                                                                            </div>
                                                                        </a>
                                                                    </div>
                                                                @endforeach

                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>

                                            @else

                                            <div class="menu-wrapper">
                                                <div class="row small-gutters">
                                                    @foreach($menuParts->items->groupBy('column_'. config('locale.current')) as $column => $items)
                                                        <div class="col-lg-3">
                                                            <h3>{{ $column }}</h3>
                                                            <ul>
                                                                @foreach($items as $item)
                                                                    <li>
                                                                        <a href="{{ url($item->url) }}">
                                                                            {{ $item->name }}
                                                                        </a>
                                                                    </li>
                                                                @endforeach
                                                            </ul>
                                                        </div>
                                                    @endforeach
                                                    <div class="col-lg-3 d-xl-block d-lg-block d-md-none d-sm-none d-none">
                                                        <div class="banner_menu">
                                                            <a href="#0">
                                                                <img src="{{ $menuParts->getImage('photo', 'catalog/img/banner_menu.jpg') }}"
                                                                     width="400" height="550" class="img-fluid">
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- /row -->
                                            </div>
                                            @endif
                                        @endif
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                        <!--/main-menu -->
                    </nav>
                    <div class="col-xl-4 col-lg-3 d-lg-flex align-items-center justify-content-end text-right contacts">
                        <div class="sn">
                            <a href="{{ setting('Посилання на facebook', 'https://facebook.com/vozdushno.com.ua') }}" class="social-links" style="color:{{ setting('колір тексту шапки сайта','white') }};">
                                <i class="ti-facebook"></i>
                            </a>
                            <a href="{{ setting('Посилання на instagram', 'http://instagram.com/vozdushno') }}" class="social-links" style="color:{{ setting('колір тексту шапки сайта','white') }};">
                                <i class="ti-instagram"></i>
                            </a>
                            <a href="{{ setting('Посилання на youtube', 'https://www.youtube.com/channel/UCgetz4SbavYicHpsz0X9u1A') }}" class="social-links" style="color:{{ setting('колір тексту шапки сайта','white') }};">
                                <i class="ti-youtube"></i>
                            </a>
                        </div>
{{--                        <a class="phone_top" href="tel://{{ $globalData->phone('header_phone') }}">--}}
                        <div class="dropdown show dropdown-numbers ml-3 pr-4">
                            <a class="phone_top" href="#" role="button" id="dropdownMenuLink" style="color:{{ setting('колір тексту шапки сайта','white') }};">
                                <strong>
                                    <span>
                                        @translate('НАШІ КОНТАКТИ')
                                    </span>
                                    {{ $globalData->header_phone }}
                                </strong>
                            </a>
                            <div class="dropdown-menu p-3" aria-labelledby="dropdownMenuLink">
                                @translate('Наши телефоны')
                                <a class="dropdown-item" href="tel:{{ setting('1 контактный телефон','+38 (093) 775-14-89') }}"><img width="16px" src="{{ asset('/img/phone-header.png') }}" /> {{ setting('1 контактный телефон','+38 (093) 775-14-89') }}</a>
                                <a class="dropdown-item" href="tel:{{ setting('2 контактный телефон','+38 (093) 775-14-89') }}"><img width="16px" src="{{ asset('/img/phone-header.png') }}" /> {{ setting('2 контактный телефон','+38 (093) 775-14-89') }}</a>
                                <hr class="p-0 m-0 mb-1">
                                @translate('Время работы')
                                <a class="dropdown-item" href="#"><img width="16px" src="{{ asset('/img/time-header.png') }}" /> {{ setting('Время работы магазинов','Пн-Пт 10:00 - 22:00') }}</a>
                                <hr class="p-0 m-0 mb-1">
                                @translate('Наши адреса')
                                @foreach($shopsHeader as $shop)
                                    <a class="dropdown-item" href="{{$shop->url}}" target="_blank"><img width="16px" src="{{ asset('/img/zone-header.png') }}" /> {{ $shop->address }}, @translate('Київ')</a>
                                @endforeach
                            </div>
                        </div>
                        @if(!$agent->isMobile())
                        <div class="store-switcher header__item">
                            <a class="a_select_lang {{config('locale.current') == "uk" ? 'a_select_lang_active': ''}}" href="{{ route('locale', 'uk') }}">
                                    @translate('Укр')
                            </a><hr class="d-inline">
                            <a class="a_select_lang {{config('locale.current') == "ru" ? 'a_select_lang_active': ''}}" href="{{ route('locale', 'ru') }}">
                                    @translate('Рос')
                            </a>
                        </div>
                        @endif
                    </div>
                </div>
                <!-- /row -->
            </div>
        </div>
        <!-- /main_header -->

        <div class="main_nav Sticky" @if($agent->isMobile())style="background: linear-gradient(90deg, {{ setting('Колір мобільної кнопки категорії','#fff') }} 50%, #FFF 50%);"@endif>
            <div class="container">
                <div class="row small-gutters">
                    <div class="col-xl-3 col-lg-3 col-md-3">
                        <nav class="categories">
                            <ul class="clearfix">
                                <li>
                                    <span>
										<a href="#" style="font-size: 15pt;font-weight:800;">
											<span class="hamburger hamburger--spin">
												<span class="hamburger-box">
													<span class="hamburger-inner"></span>
												</span>
											</span>
											@translate('Категорії')
										</a>
									</span>
                                    <div id="menu">
                                        <ul>
                                            @foreach($categories as $category)
                                                <li>
                                                    <span>
                                                        <a style="font-size: 13pt;font-weight:800;" href="{{ $category->url }}">
                                                            {{ $category->name }}
                                                        </a>
                                                    </span>
                                                    <ul>
                                                        @foreach($category->child as $child)
                                                            @continue(!$child->products_count)
                                                            <li>
                                                                <a style="font-weight:800;" href="{{ $child->url }}">
                                                                    {{ $child->name }}
                                                                </a>
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </li>
                            </ul>
                        </nav>
                    </div>
                    <div class="col-xl-6 col-lg-7 col-md-6 d-none d-md-block">
                        <form action="{{ route('search') }}" method="GET">
                            <div class="custom-search-input">
                                <input type="text" name="query" placeholder="@translate('Пошук товарів')" autocomplete="off"
                                       value="{{ $searchString ?? '' }}" class="search-pc">
                                <button type="submit"><i class="header-icon_search_custom"></i></button>
                            </div>
                            <div class="search-results">
                            </div>
                        </form>
                    </div>
                    <div class="col-xl-3 col-lg-2 col-md-3">
                        <ul class="top_tools">
                            <li>
                                <div class="dropdown dropdown-cart">
                                    <a href="{{ route('cart') }}" class="cart_bt">
                                        <strong class="dropdown-cart-count">
                                            {{ Cart::countProducts() }}
                                        </strong>
                                    </a>
                                    <div class="dropdown-menu">
                                        <div class="has-products"
                                             style="display: {{ Cart::hasProducts() ? 'block' : 'none' }}">
                                            <ul class="dropdown-cart-products">
                                                @foreach(Cart::getProducts() as $product)
                                                    @include('catalog.parts.dropdown-cart-product')
                                                @endforeach
                                            </ul>
                                            <div class="total_drop">
                                                <div class="clearfix">
                                                    <strong>
                                                        @translate('Сума')
                                                    </strong>
                                                    <span class="dropdown-cart-sum">
                                                        {{ Cart::getProductsSum() }}
                                                    </span>
                                                </div>
                                                <a href="{{ route('cart') }}" class="btn_1 outline">
                                                    @translate('Переглянути корзину')
                                                </a>
                                                <a href="{{ route('checkout') }}"
                                                   class="btn_1" rel="nofollow">
                                                    @translate('Оформити замовлення')
                                                </a>
                                            </div>
                                        </div>
                                        <div class="not-products"
                                             style="display: {{ !Cart::hasProducts() ? 'block' : 'none' }}">
                                            @translate('В корзині немає товарів')
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <a href="{{ isAuth() ? route('profile.desire') : route('login', ['redirect' => route('profile.desire')]) }}"
                                   rel="nofollow"
                                   class="wishlist">
                                    <span>Wishlist</span>
                                </a>
                            </li>

                            @if(isset($service) && $service == 'facebook')
                                <li>
                                    Welcome {{ $details->user['name']}} ! <br> Your email is
                                    : {{ $details->user['email'] }} <br> You are {{ $details->user['gender'] }}.
                                </li>
                            @endif

                            <li>
                                <div class="dropdown dropdown-access">
                                    <a href="{{ isAuth() ? route('profile') : route('login', ['redirect' => route('profile')]) }}"
                                       rel="nofollow"
                                       class="access_link">
                                        <span>@translate('Профіль')</span>
                                    </a>
                                    <div class="dropdown-menu">
                                        <a href="{{ isAuth() ? route('profile') : route('login', ['redirect' => route('profile')]) }}"
                                           rel="nofollow"
                                           class="btn_1">
                                            @translate('Профіль')
                                        </a>
                                        <ul>
                                            <li>
                                                <a href="#" rel="nofollow">
                                                    <i class="ti-truck"></i>@translate('Відслідкувати замовлення')
                                                </a>
                                            </li>
                                            <li>
                                                <a href="{{ route('profile.orders') }}" rel="nofollow">
                                                    <i class="ti-package"></i>@translate('Мої замовлення')
                                                </a>
                                            </li>
                                            <li>
                                                <a href="{{ route('profile') }}" rel="nofollow">
                                                    <i class="ti-user"></i>@translate('Мій профіль')
                                                </a>
                                            </li>
                                            <li>
                                                <a href="{{ route('faq') }}">
                                                    <i class="ti-help-alt"></i>@translate('Допомога і Faq')
                                                </a>
                                            </li>

                                            @if(isAuth())
                                                <li>
                                                    <a href="{{ route('customer.logout') }}" rel="nofollow">
                                                        <i class="ti-close"></i>@translate('Покинути профіль')
                                                    </a>
                                                </li>
                                            @endif
                                        </ul>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <a href="javascript:void(0);"
                                   class="btn_search_mob"><span>@translate('Пошук')</span></a>
                            </li>
                            <li>
                                <a href="#menu" class="btn_cat_mob" style="font-weight: 800">
                                    <div class="hamburger hamburger--spin" id="hamburger">
                                        <div class="hamburger-box">
                                            <div class="hamburger-inner"></div>
                                        </div>
                                    </div>
                                    @translate('Категорії')
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <!-- /row -->
            </div>
            <div class="search_mob_wp"
                 style="display: {{ isset($searchString) && Agent::isMobile() ? 'block' : 'none' }}">
                <form action="{{ route('search') }}" method="GET">
                    <input name="query" class="form-control" placeholder="@translate('Пошук товарів...')"
                           value="{{ $searchString ?? '' }}">
                    <input type="submit" class="btn_1 full-width" value="@translate('Шукати')">
                </form>
            </div>
            <!-- /search_mobile -->
        </div>
        <!-- /main_nav -->
    </header>
    <!-- /header -->

    @yield('content')

    @include('catalog.partials.footer.footer')
</div>

<div id="toTop"></div>

@include('catalog.partials.footer.feedbacks')

@stack('modals')

<script>
    const lang = '{{ config('locale.current') }}'
    const langPrefix = '{{ config('locale.prefix') }}'

    // todo: write logic + trim path
    function url(path) {
        return `/${langPrefix}/${path}`
    }
</script>
<script src="/assets/translates.js"></script>
<script src="{{ asset('js/app.js') }}"></script>
<script src="{{ asset('catalog/js/main.js') }}"></script>
<script src="{{ asset('catalog/js/toastr.js') }}"></script>
<script src="{{ asset('js/cart.js') }}"></script>
<script src="{{ asset('catalog/js/modal_windows.js') }}"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/ion-rangeslider/2.3.1/js/ion.rangeSlider.min.js"></script>
@stack('js')
@yield('js')
<script>
    var pc_search = $('.search-pc');

    $('.menu-feedback a').on('click', function(){
        $('#feedback-contacts').fadeToggle();
    });

    pc_search.on('focus', function(){
        if ($(this).val().length != 0) {
            $('.search-results').show(1000);
        }
    });

    pc_search.on('focusout', function(){
        $('.search-results').hide(1000);
    });

    pc_search.on('keyup', function(){
        if ($(this).val().length != 0) {
            $('.search-results').show(1000);
            $.ajax({
                method: 'POST',
                url: '/search-live',
                data: {
                    'query': $('.search-pc').val()
                },
                success: function(data) {
                    $('.search-results').html(data);
                }
            });
        } else {
            $('.search-results').hide(1000);
        }
    });
</script>
</body>
</html>