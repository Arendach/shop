<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">

    <link rel="stylesheet" href="{{ asset('css/vendor/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('css/vendor/elements.css') }}">
    <link rel="stylesheet" href="{{ asset('css/vendor/toastr.css') }}">

    @yield('style')

    <title>{{ $title ?? 'Enter Title' }}</title>

    @include('common.JavaScriptVars')
    @include('admin.javascript')

    <script src="{{ asset('js/vendor/jquery.js') }}"></script>
    <script src="{{ asset('js/vendor/bootstrap.js') }}"></script>
    <script src="{{ asset('js/vendor/jquery.serializeJSON.js') }}"></script>
    <script src="{{ asset('js/vendor/popper.js') }}"></script>
    <script src="{{ asset('js/elements.js') }}"></script>
    <script src="{{ asset('js/vendor/toastr.js') }}"></script>
    <script src="{{ asset('adm/js/common.js') }}" type="module"></script>

    @yield('script')
</head>
<body>


<div class="container">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark" style="margin-bottom: 15px">
        <a class="navbar-brand" href="{{ route('bridge') }}">Bridge</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item active">
                    <a class="nav-link" href="{{ route('admin.index') }}">Адмінка</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Features</a>
                </li>
            </ul>
        </div>
    </nav>
</div>


<div class="container">
    @yield('content')
</div>

</body>
</html>