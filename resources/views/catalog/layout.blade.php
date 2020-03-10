<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="author" content="Ansonika">
    <title>@yield('title', 'Enter Title')</title>

    <!-- Favicons-->
    <link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon">
    <link rel="apple-touch-icon" type="image/x-icon" href="img/apple-touch-icon-57x57-precomposed.png">
    <link rel="apple-touch-icon" type="image/x-icon" sizes="72x72" href="img/apple-touch-icon-72x72-precomposed.png">
    <link rel="apple-touch-icon" type="image/x-icon" sizes="114x114"
          href="img/apple-touch-icon-114x114-precomposed.png">
    <link rel="apple-touch-icon" type="image/x-icon" sizes="144x144"
          href="img/apple-touch-icon-144x144-precomposed.png">

    <!-- GOOGLE WEB FONT -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900&display=swap" rel="stylesheet">

    <!-- BASE CSS -->
    <link href="{{ asset('catalog/css/bootstrap.custom.min.css') }}" rel="stylesheet">
    <link href="{{ asset('catalog/css/style.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">

    <!-- SPECIFIC CSS -->
@yield('css')

<!-- YOUR CUSTOM CSS -->
    <link href="{{ asset('catalog/css/custom.css') }}" rel="stylesheet">
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
                                <li class="submenu">
                                    <a href="javascript:void(0);" class="show-submenu">@translate('Головна')</a>
                                    <ul>
                                        <li><a href="index.html">Slider</a></li>
                                        <li><a href="index-2.html">Video Background</a></li>
                                        <li><a href="index-3.html">Vertical Slider</a></li>
                                        <li><a href="index-4.html">GDPR Cookie Bar</a></li>
                                    </ul>
                                </li>
                                <li class="megamenu submenu">
                                    <a href="javascript:void(0);"
                                       class="show-submenu-mega">@translate('Колекції товарів')</a>
                                    <div class="menu-wrapper">
                                        <div class="row small-gutters">
                                            <div class="col-lg-3">
                                                <h3>Listing grid</h3>
                                                <ul>
                                                    <li><a href="listing-grid-1-full.html">Grid Full Width</a></li>
                                                    <li><a href="listing-grid-2-full.html">Grid Full Width 2</a></li>
                                                    <li><a href="listing-grid-3.html">Grid Boxed</a></li>
                                                    <li><a href="listing-grid-4-sidebar-left.html">Grid Sidebar Left</a>
                                                    </li>
                                                    <li><a href="listing-grid-5-sidebar-right.html">Grid Sidebar
                                                            Right</a></li>
                                                    <li><a href="listing-grid-6-sidebar-left.html">Grid Sidebar Left
                                                            2</a></li>
                                                    <li><a href="listing-grid-7-sidebar-right.html">Grid Sidebar Right
                                                            2</a></li>
                                                </ul>
                                            </div>
                                            <div class="col-lg-3">
                                                <h3>Listing row &amp; Product</h3>
                                                <ul>
                                                    <li><a href="listing-row-1-sidebar-left.html">Row Sidebar Left</a>
                                                    </li>
                                                    <li><a href="listing-row-2-sidebar-right.html">Row Sidebar Right</a>
                                                    </li>
                                                    <li><a href="listing-row-3-sidebar-left.html">Row Sidebar Left 2</a>
                                                    </li>
                                                    <li><a href="listing-row-4-sidebar-extended.html">Row Sidebar
                                                            Extended</a></li>
                                                    <li><a href="product-detail-1.html">Product Large Image</a></li>
                                                    <li><a href="product-detail-2.html">Product Carousel</a></li>
                                                    <li><a href="product-detail-3.html">Product Sticky Info</a></li>
                                                </ul>
                                            </div>
                                            <div class="col-lg-3">
                                                <h3>Other pages</h3>
                                                <ul>
                                                    <li><a href="cart.html">Cart Page</a></li>
                                                    <li><a href="checkout.html">Check Out Page</a></li>
                                                    <li><a href="confirm.html">Confirm Purchase Page</a></li>
                                                    <li><a href="account.html">Create Account Page</a></li>
                                                    <li><a href="track-order.html">Track Order</a></li>
                                                    <li><a href="help.html">Help Page</a></li>
                                                    <li><a href="help-2.html">Help Page 2</a></li>
                                                    <li><a href="leave-review.html">Leave a Review</a></li>
                                                </ul>
                                            </div>
                                            <div class="col-lg-3 d-xl-block d-lg-block d-md-none d-sm-none d-none">
                                                <div class="banner_menu">
                                                    <a href="#0">
                                                        <img src="data:image/gif;base64,R0lGODlhAQABAIAAAP///wAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw=="
                                                             data-src="{{ asset('catalog/img/banner_menu.jpg') }}"
                                                             width="400" height="550"
                                                             alt="" class="img-fluid lazy">
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- /row -->
                                    </div>
                                    <!-- /menu-wrapper -->
                                </li>
                                <li class="submenu">
                                    <a href="javascript:void(0);" class="show-submenu">@translate('Про нас')</a>
                                    <ul>
                                        <li><a href="header-2.html">Header Style 2</a></li>
                                        <li><a href="header-3.html">Header Style 3</a></li>
                                        <li><a href="header-4.html">Header Style 4</a></li>
                                        <li><a href="header-5.html">Header Style 5</a></li>
                                        <li><a href="404.html">404 Page</a></li>
                                        <li><a href="sign-in-modal.html">Sign In Modal</a></li>
                                        <li><a href="contacts.html">Contact Us</a></li>
                                        <li><a href="about.html">About 1</a></li>
                                        <li><a href="about-2.html">About 2</a></li>
                                        <li><a href="modal-advertise.html">Modal Advertise</a></li>
                                        <li><a href="modal-newsletter.html">Modal Newsletter</a></li>
                                    </ul>
                                </li>
                                <li>
                                    <a href="blog.html">@translate('Блог')</a>
                                </li>
                                <li>
                                    <a href="#0">@translate('Послуги')</a>
                                </li>
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
                                                        <a href="{{ route('category.show', $category->slug) }}">
                                                            {{ $category->name }}
                                                        </a>
                                                    </span>
                                                    <ul>
                                                        @foreach($category->child as $child)
                                                            <li>
                                                                <a href="{{ route('category.show', $child->slug) }}">
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
                        <div class="custom-search-input">
                            <input type="text" placeholder="@translate('Пошук товарів')">
                            <button type="submit"><i class="header-icon_search_custom"></i></button>
                        </div>
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
                                        @if(Cart::hasProducts())
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
                                                <a href="checkout.html" class="btn_1">
                                                    @translate('Оформити замовлення')
                                                </a>
                                            </div>
                                        @else
                                            <div class="">
                                                @translate('В корзині немає товарів')
                                            </div>
                                        @endif
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
                                                <a href="#">
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
            <div class="search_mob_wp">
                <input type="text" class="form-control" placeholder="@translate('Пошук товарів...')">
                <input type="submit" class="btn_1 full-width" value="@translate('Шукати')">
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
                            <h5>@translate('Підпишіться на нас')</h5>
                            <ul>
                                <li>
                                    <a href="#0">
                                        <img src="data:image/gif;base64,R0lGODlhAQABAIAAAP///wAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw=="
                                             data-src="{{ asset('catalog/img/twitter_icon.svg') }}" class="lazy">
                                    </a>
                                </li>
                                <li>
                                    <a href="#0">
                                        <img src="data:image/gif;base64,R0lGODlhAQABAIAAAP///wAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw=="
                                             data-src="{{ asset('catalog/img/facebook_icon.svg') }}" class="lazy">
                                    </a>
                                </li>
                                <li>
                                    <a href="#0">
                                        <img src="data:image/gif;base64,R0lGODlhAQABAIAAAP///wAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw=="
                                             data-src="{{ asset('catalog/img/instagram_icon.svg') }}" class="lazy">
                                    </a>
                                </li>
                                <li>
                                    <a href="#0">
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
                        <li><span>©2020 {{ $globalData->copyright }}</span></li>
                    </ul>
                </div>
            </div>
        </div>
    </footer>
    <!--/footer-->
</div>
<!-- page -->

<div id="toTop"></div><!-- Back to top button -->
<!-- COMMON SCRIPTS -->
<script src="{{ asset('catalog/js/common_scripts.min.js') }}"></script>
<script src="{{ asset('catalog/js/main.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<script src="{{ asset('js/app.js') }}"></script>
<script src="{{ asset('js/cart.js') }}"></script>
@yield('js')
</body>
</html>