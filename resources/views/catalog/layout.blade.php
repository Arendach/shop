@inject('str', "Illuminate\\Support\\Str")
@inject('banner', "App\\Services\\BannerService")

        <!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">

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
<body>

@if(Agent::isDesktop())
    @include('catalog.parts.desktop.header')
@else
    @include('catalog.parts.mobile.header')
@endif



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