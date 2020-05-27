<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="{{ $meta_description ?? $globalData->meta_description }}">
    <meta name="keywords" content="{{ $meta_keywords ?? $globalData->meta_keywords }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', $globalData->meta_title)</title>

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

<!-- GOOGLE WEB FONT -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900&display=swap" rel="stylesheet">

    <!-- BASE CSS -->
    <link rel="stylesheet" href="{{ asset('catalog/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('catalog/css/bootstrap.custom.min.css') }}">
    <link rel="stylesheet" href="{{ asset('catalog/css/app.css') }}">

    <!-- SPECIFIC CSS -->
@yield('css')

<!-- YOUR CUSTOM CSS -->
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
</head>

<body>

<div id="page">
    <header class="version_1">
        <div class="layer"></div>
        <div class="main_header">
            <div class="container">
                <div class="row small-gutters">
                    <div class="col-xl-3 col-lg-3 d-lg-flex align-items-center">
                        <div id="logo">
                            <a href="{{ route('index') }}">
                                <img src="{{ $globalData->logo_image }}" width="100" height="35">
                            </a>
                        </div>
                    </div>
                    <nav class="col-xl-6 col-lg-7">
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
                            <ul>
                                @foreach($menu as $menuParts)
                                    <li class="@if($menuParts->role == 'menu') submenu @elseif($menuParts->role == 'megamenu') megamenu submenu @endif">
                                        @if($menuParts->role == 'link')
                                            <a href="{{ $menuParts->url }}">
                                                {{ $menuParts->name }}
                                            </a>
                                        @elseif($menuParts->role == 'menu')
                                            <a href="javascript:void(0);" class="show-submenu">
                                                {{ $menuParts->name }}
                                            </a>
                                            <ul>
                                                @foreach($menuParts->items as $item)
                                                    <li>
                                                        <a href="{{ $item->url }}">
                                                            {{ $item->name }}
                                                        </a>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        @else
                                            <a href="javascript:void(0);" class="show-submenu-mega">
                                                {{ $menuParts->name }}
                                            </a>

                                            <div class="menu-wrapper">
                                                <div class="row small-gutters">
                                                    @foreach($menuParts->items->groupBy('column_'. config('locale.current')) as $column => $items)
                                                        <div class="col-lg-3">
                                                            <h3>{{ $column }}</h3>
                                                            <ul>
                                                                @foreach($items as $item)
                                                                    <li>
                                                                        <a href="{{ $item->url }}">
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
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                        <!--/main-menu -->
                    </nav>
                    <div class="col-xl-3 col-lg-2 d-lg-flex align-items-center justify-content-end text-right">
                        <a class="phone_top" href="tel://{{ $globalData->phone('header_phone') }}">
                            <strong>
                                <span>
                                    @translate('Потрібна допомога?')
                                </span>
                                {{ $globalData->header_phone }}
                            </strong>
                        </a>
                    </div>
                </div>
                <!-- /row -->
            </div>
        </div>
        <!-- /main_header -->

        <div class="main_nav Sticky">
            <div class="container">
                <div class="row small-gutters">
                    <div class="col-xl-3 col-lg-3 col-md-3">
                        <nav class="categories">
                            <ul class="clearfix">
                                <li>
                                    <span>
										<a href="#">
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
                                                        <a href="{{ $category->url }}">
                                                            {{ $category->name }}
                                                        </a>
                                                    </span>
                                                    <ul>
                                                        @foreach($category->child as $child)
                                                            @continue(!$child->products_count)
                                                            <li>
                                                                <a href="{{ $child->url }}">
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
                                <input type="text" name="query" placeholder="@translate('Пошук товарів')"
                                       value="{{ $searchString ?? '' }}">
                                <button type="submit"><i class="header-icon_search_custom"></i></button>
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
                                                <a href="{{ isAuth() ? route('checkout') : route('login', ['redirect' => route('checkout')]) }}"
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
                                <a href="#menu" class="btn_cat_mob">
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

    <footer class="revealed">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-6">
                    <h3 data-target="#collapse_1">@translate('Швидка навігація')</h3>
                    <div class="collapse dont-collapse-sm links" id="collapse_1">
                        <ul>
                            @foreach($fastNavigation as $page)
                                <li>
                                    <a href="{{ $page->url }}">
                                        {{ $page->name }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <h3 data-target="#collapse_2">@translate('Категорії')</h3>
                    <div class="collapse dont-collapse-sm links" id="collapse_2">
                        <ul>
                            @foreach($categories->slice(0, 10)->all() as $category)
                                <li><a href="{{ $category->url }}">{{ $category->name }}</a></li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <h3 data-target="#collapse_3">@translate('Котакти')</h3>
                    <div class="collapse dont-collapse-sm contacts" id="collapse_3">
                        <ul>
                            <li><i class="ti-home"></i>{!! $globalData->footer_address !!}</li>
                            <li><i class="ti-headphone-alt"></i>{{ $globalData->formatPhone('footer_phone') }}</li>
                            <li><i class="ti-email"></i><a href="#0">{{ $globalData->footer_email }}</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <h3 data-target="#collapse_4">@translate('Підписатись на знижки')</h3>
                    <div class="collapse dont-collapse-sm" id="collapse_4">
                        <div id="newsletter">
                            <div class="form-group">
                                <input type="email" name="email_newsletter" id="email_newsletter" class="form-control"
                                       placeholder="@translate('Ваша електрона пошта')">
                                <button type="submit" id="submit-newsletter"><i class="ti-angle-double-right"></i>
                                </button>
                            </div>
                        </div>
                        <div class="follow_us">
                            <h5>@editable('Підпишіться на нас')</h5>
                            <ul>
                                <li>
                                    <a href="https://facebook.com/vozdushno.com.ua">
                                        <img src="data:image/gif;base64,R0lGODlhAQABAIAAAP///wAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw=="
                                             data-src="{{ asset('catalog/img/facebook_icon.svg') }}" class="lazy">
                                    </a>
                                </li>
                                <li>
                                    <a href="http://instagram.com/vozdushno">
                                        <img src="data:image/gif;base64,R0lGODlhAQABAIAAAP///wAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw=="
                                             data-src="{{ asset('catalog/img/instagram_icon.svg') }}" class="lazy">
                                    </a>
                                </li>
                                <li>
                                    <a href="https://www.youtube.com/channel/UCgetz4SbavYicHpsz0X9u1A">
                                        <img src="data:image/gif;base64,R0lGODlhAQABAIAAAP///wAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw=="
                                             data-src="{{ asset('catalog/img/youtube_icon.svg') }}" class="lazy">
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /row-->
            <hr>
            <div class="row add_bottom_25">
                <div class="col-lg-6">
                    <ul class="footer-selector clearfix">
                        <li>
                            <div class="styled-select lang-selector">
                                <select onchange="window.location.href = this.value">
                                    <option {{ config('locale.current') == "uk" ? 'selected': '' }} value="{{ route('locale', 'uk') }}">
                                        @translate('Українська')
                                    </option>
                                    <option {{ config('locale.current') == "ru" ? 'selected': '' }} value="{{ route('locale', 'ru') }}">
                                        @translate('Російська')
                                    </option>
                                </select>
                            </div>
                        </li>
                        <li>
                            <img src="data:image/gif;base64,R0lGODlhAQABAIAAAP///wAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw=="
                                 data-src="{{ asset('catalog/img/cards_all.svg') }}" alt="" width="198" height="30"
                                 class="lazy"></li>
                    </ul>
                </div>
                <div class="col-lg-6">
                    <ul class="additional_links">
                        <li><a href="#0">Terms and conditions</a></li>
                        <li><a href="#0">Privacy</a></li>
                        <li><span>©{{ date('Y') }} {{ $globalData->copyright }}</span></li>
                    </ul>
                </div>
            </div>
        </div>
    </footer>
</div>

<div id="toTop"></div>

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
@stack('js')
@yield('js')
</body>
</html>