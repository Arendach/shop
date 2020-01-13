@inject('str', "Illuminate\\Support\\Str")
@inject('banner', "App\\Services\\BannerService")

        <!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <meta name="description" content="{{ $meta_description ?? '' }}">
    <meta name="keywords" content="{{ $meta_keywords ?? '' }}">

    @include('catalog.javascript')

    <script src="{{ asset('catalog/js/jquery.js') }}"></script>
    <script src="{{ asset('catalog/js/jquery.serializeJSON.js') }}"></script>
    <script src="{{ asset('catalog/js/jquery.inputmask.js') }}"></script>
    <script src="{{ asset('catalog/js/tooltip.js') }}"></script>
    <script src="{{ asset('catalog/js/bootstrap.js') }}"></script>
    <script src="{{ asset('catalog/js/toastr.min.js') }}"></script>
    <script src="{{ asset('catalog/js/sweetalert.js') }}"></script>
    <script src="{{ asset('catalog/js/common.js') }}"></script>
    <script src="{{ asset('catalog/js/menu.js') }}"></script>

    <link rel="stylesheet" href="{{ asset('catalog/css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('catalog/css/font-awesome.css') }}">
    <link rel="stylesheet" href="{{ asset('catalog/css/toastr.css') }}">
    <link rel="stylesheet" href="{{ asset('catalog/css/sweetalert.css') }}">

    @yield('style')


    @isset($css)
        @foreach($css as $item)
            <link rel="stylesheet" href="{{ asset("catalog/css/$item.css") }}">
        @endforeach
    @endisset

    <link rel="stylesheet" href="{{ asset('catalog/css/style.css') }}">
    <title>{{ $title ?? 'Enter Title' }}</title>
    @include('common.JavaScriptVars')

    @if(is_file(public_path("js/$controller.js")))
        <script src="{{ asset("js/$controller.js") }}"></script>
    @endif

    <script src="{{ asset('js/functions.js') }}"></script>

    @isset($js)
        @foreach($js as $item)
            <script src="{{ asset("catalog/js/$item.js") }}"></script>
        @endforeach
    @endisset

    @yield('script')

</head>
<body style="min-width: 1200px">

<header>
    @if($banner->isActive())
        <div class="banner" style="background-color: {{ $banner->getColor() }}">
            <div class="container">
                <a href="{{ $banner->getUrl() }}">
                    <img style="width: 100%" src="{{ $banner->getPhotoUrl() }}">
                </a>
            </div>
        </div>
    @endif

    <div class="top-menu">
        @if($menu->count())
            @foreach($menu as $item)
                <div class="drop-element {{ $item->type == 'drop' ? 'drop-down' : '' }}" data-id="menu-{{ $item->id }}">
                    @if($item->type == 'link')
                        <a href="{{ url($item->url) }}">{{ $item->name }}</a>
                    @else
                        <a>{{ $item->name }}</a>
                    @endif

                    @if($item->items->count())
                        <div class="drop-bridge"></div>
                        <div class="drop-items" id="menu-{{ $item->id }}">
                            @foreach($item->items as $item2)
                                @if($item2->type == 'link')
                                    <a href="{{ url($item2->url) }}">{{ $item2->name }}</a>
                                @else
                                    <a>{{ $item2->name }}</a>
                                @endif
                            @endforeach
                        </div>
                    @endif
                </div>
            @endforeach
        @endif
    </div>

    <div class="social-links">
        <a style="color: #3962a9" href="#" class="social-link">
            <i class="fa fa-facebook"></i>
        </a>

        <a style="color: #CC6699" href="#" class="social-link">
            <i class="fa fa-instagram"></i>
        </a>

        <a style="color: #3399CC" href="#" class="social-link">
            <i class="fa fa-telegram"></i>
        </a>

        <a href="#" class="social-link">
            <i class="fa fa-vk"></i>
        </a>
    </div>

    <div class="container">
        <div class="bottom-menu">
            <div class="categories">
                <div class="category-title">
                    <i class="fa fa-list"></i> @translate('Категорії товарів')
                </div>

                <div class="category-list match-height">

                    @foreach($categories as $item)
                        <div class="category-item" data-id="{{ $item->id }}">
                            <a href="{{ route('category.show', $item->slug) }}">
                                {{ $item->name }}
                            </a>
                        </div>
                    @endforeach

                </div>

                <div class="category-inner-container">

                    @foreach($categories as $item)
                        <div class="category-inner" data-id="{{ $item->id }}">

                            <span class="white-bridge" style="top: {{ $loop->index * 34 }}px"></span>

                            @foreach($item->child as $category_inner)
                                <div class="category-inner-item">
                                    <a href="{{ route('category.show', $category_inner->slug) }}">
                                        {{ $category_inner->name }}
                                    </a><br>
                                    @foreach($category_inner->links as $link)
                                        <a href="{{ $link->url }}">- {{ $link->name }}</a><br>
                                    @endforeach
                                </div>
                            @endforeach

                        </div>
                    @endforeach
                </div>
            </div>

            <div class="search-block">
                <div class="input-group input-group-sm">
                    <input class="form-control"
                           placeholder="@translate('Пошук товарів')"
                           id="search_string"
                           value="{{ $search_string ?? '' }}"
                           style="height: 30px">
                    <div class="input-group-append">
                        <button style="height: 30px" id="search_button" class="btn btn-outline-primary" type="button">
                            @translate('Шукати')
                        </button>
                    </div>
                </div>
            </div>

            <div class="right-block">
                @if(is_auth())
                    <a href="{{ route('profile') }}">
                        <i class="fa fa-user"></i> @translate('Профіль')
                    </a>
                @else
                    <a href="{{ route('login') }}">
                        <i class="fa fa-user"></i> @translate('Профіль')
                    </a>
                @endif

                <a href="{{ route('cart') }}">
                    <i class="fa fa-shopping-cart"></i> @translate('Корзина') <b class="text-danger"
                                                                                 id="cart_products_count">
                        {{ $cart_count_products }}
                    </b>
                </a>
            </div>
        </div>
    </div>
</header>

{{-- Хлібні крихти --}}
@isset($breadcrumbs)
    <div class="container" style="margin-top: 15px">
        <ol class="breadcrumb" style="margin-bottom: 15px">
            <li class="breadcrumb-item">
                <a href="{{ route('index') }}"><i class="fa fa-home"></i></a>
            </li>
            @foreach($breadcrumbs as $item)
                @if(!$loop->last)
                    <li class="breadcrumb-item">
                        <a href="{{ $item[1] }}">{{ $item[0] }}</a>
                    </li>
                @else
                    <li class="breadcrumb-item active">{{ $item[0] }}</li>
                @endif
            @endforeach
        </ol>
    </div>
@endisset

@if(is_admin() && isset($admin_section) && $admin_section == true)

    <div class="container">
        <div class="catalog-admin-section">
            @yield('admin')
        </div>
    </div>

@endif

@yield('content')

<footer>
    <div class="container">
        <div class="row">
            <div class="col-4">
                <h5>SkyFire</h5>
                <a href="{{ route('page', 'contacts') }}">
                    {{ StaticPage::getName('contacts') }}
                </a>

                <br>

                <a href="{{ route('page', 'terms') }}">
                    {{ StaticPage::getName('terms') }}
                </a>

                <br>

                <a href="{{ route('page', 'collaboration') }}">
                    {{ StaticPage::getName('collaboration') }}
                </a>
            </div>

            <div class="col-4">
                <h5>Допомога</h5>
                <a href="{{ route('page', 'faq') }}">
                    {{ StaticPage::getName('faq') }}
                </a>

                <br>

                <a href="{{ route('page', 'delivery_and_pay') }}">
                    {{ StaticPage::getName('delivery_and_pay') }}
                </a>

                <br>

                <a href="{{ route('page', 'articles') }}">
                    {{ StaticPage::getName('articles') }}
                </a>
                {{--
                                <br>

                                <a href="#">
                                    Відгуки
                                </a>--}}
            </div>

            <div class="col-4">
                <h5>@translate('Корисна інформація')</h5>
                <a href="{{ route('page', 'discounts') }}">
                    {{ StaticPage::getName('discounts') }}
                </a>

                <br>

                <a href="{{ route('cart') }}">
                    @translate('Корзина')
                </a>

                <br>

                <a href="{{ route('profile.viewed') }}">
                    @translate('Переглянуті товари')
                </a>
            </div>
        </div>
    </div>
</footer>

<div class="modals-container">
    @yield('modal')
</div>

</body>
</html>