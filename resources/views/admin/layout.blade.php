@php $menu = include base_path('assets/admin_menu.php'); @endphp

        <!doctype html>
<html lang="{{ config('app.locale') }}">

{{-- ШАПКА --}}
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $title ?? '' }}</title>

    {{--  Стилі  --}}
    <link rel="stylesheet" href="{{ asset('css/vendor/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('css/vendor/font-awesome.css') }}">
    <link rel="stylesheet" href="{{ asset('css/vendor/toastr.css') }}">
    <link rel="stylesheet" href="{{ asset('css/vendor/sweetalert.css') }}">
    <link rel="stylesheet" href="{{ asset('css/vendor/elements.css') }}">
    <link rel="stylesheet" href="{{ asset('adm/css/common.css') }}">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">


@isset($components)
        @foreach($components as $component)
            @if(is_file(public_path("css/components/$item/$item.css")))
                <link rel="stylesheet" href="{{ asset("css/components/$item/$item.css") }}">
            @endisset
        @endforeach
    @endisset

    @if(is_file(public_path("adm/css/modules/$controller.css")))
        <link rel="stylesheet" href="{{ asset("adm/css/modules/$controller.css") }}">
    @endif

    @isset($css)
        @foreach($css as $item)
            <link rel="stylesheet" href="{{ asset("adm/css/$item.css") }}">
        @endforeach
    @endisset

    @yield('style')

    {{--  Скрипти  --}}
    @include('common.JavaScriptVars')

    <script src="{{ asset('js/vendor/jquery.js') }}"></script>
    <script src="{{ asset('js/vendor/jquery.serializeJSON.js') }}"></script>
    <script src="{{asset('js/vendor/popper.js')}}"></script>
    <script src="{{ asset('js/vendor/toastr.js') }}"></script>
    <script src="{{ asset('js/vendor/bootstrap.js') }}"></script>
    <script src="{{ asset('js/vendor/vue.js') }}"></script>
    <script src="{{ asset('js/vendor/sweetalert.js') }}"></script>
    <script src="{{ asset('js/elements.js') }}"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

    @include('admin.javascript')

    @isset($components)
        @foreach($components as $component)
            @if(is_file(public_path("js/components/$item/$item.js")))
                <script src="{{ asset("js/components/$item/$item.js") }}"></script>
            @endisset
        @endforeach
    @endisset

    <script type="module" src="{{ asset('adm/js/common.js') }}"></script>

    @isset($js)
        @foreach($js as $item)
            <script src="{{ asset("adm/js/$item.js") }}"></script>
        @endforeach
    @endisset

    @if(is_file(public_path("adm/js/modules/$controller.js")))
        <script src="{{ asset("adm/js/modules/$controller.js") }}"></script>
    @endif

    @yield('script')
</head>

{{-- Тіло документа --}}
<body>

{{-- Навігація --}}
<div class="container">
    <nav class="navbar navbar-expand-lg navbar-light bg-light">

        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a class="nav-link" href="{{ route('admin.index') }}">
                    @lang('admin.routes.admin')
                </a>
            </li>

            @foreach($menu as $part => $links)
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown">
                        {{ $part }}
                    </a>
                    <div class="dropdown-menu">
                        @foreach($links as $link)
                            <a class="dropdown-item" href="{{ $link['url'] }}">
                                {{ $link['text'] }}
                            </a>
                        @endforeach
                    </div>
                </li>
            @endforeach
        </ul>

        <div class="dropdown">
            <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown">
                {{ user()->name }}
            </a>
            <div class="dropdown-menu">
                <a class="dropdown-item" href="#">
                    1
                </a> <a class="dropdown-item" href="#">
                    2
                </a>
            </div>
        </div>

    </nav>
</div>


{{-- Хлібні крихти --}}
@isset($breadcrumbs)
    <div class="container" style="margin-top: 15px">
        <ol class="breadcrumb" style="margin-bottom: 15px">
            <li class="breadcrumb-item">
                <a href="{{ route('index') }}"><i class="fa fa-home"></i> @lang('admin.routes.home')</a>
            </li>
            <li class="breadcrumb-item">
                <a href="{{ route('admin.index') }}">@lang('admin.routes.admin')</a>
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

{{-- КОНТЕНТ --}}
<div class="main-content-container ui container">
    @yield('content')
</div>

{{-- НОГИ --}}
<footer style="margin-top: 20px">


</footer>

</body>
</html>
