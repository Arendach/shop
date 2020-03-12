<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">

    <link rel="stylesheet" href="{{ asset('bridge-assets/css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('bridge-assets/css/elements.css') }}">
    <link rel="stylesheet" href="{{ asset('bridge-assets/css/toastr.css') }}">

    @yield('style')

    <title>{{ $title ?? 'Enter Title' }}</title>

    @include('bridge.javascript-vars')
    <script>
        const JS = {};
        JS.deleteSuccessTitle = '@lang('common.delete.success_title')';
        JS.deleteSuccessText = '@lang('common.delete.success_text')';
        JS.deleteConfirmTitle = '@lang('common.delete.confirm_title')';
        JS.deleteConfirmText = '@lang('common.delete.confirm_text')';
        JS.cancel = '@lang('common.cancel')';
        JS.error = '@lang('common.error')';
        JS.unknown_error = '@lang('common.unknown_error')';
        JS.successTitle = '@lang('common.success_title')';
        JS.successText = '@lang('common.success_text')';
    </script>

    <script src="{{ asset('bridge-assets/js/jquery.js') }}"></script>
    <script src="{{ asset('bridge-assets/js/popper.js') }}"></script>
    <script src="{{ asset('bridge-assets/js/bootstrap.js') }}"></script>
    <script src="{{ asset('bridge-assets/js/jquery.serializeJSON.js') }}"></script>
    <script src="{{ asset('bridge-assets/js/elements.js') }}"></script>
    <script src="{{ asset('bridge-assets/js/toastr.js') }}"></script>
    <script src="{{ asset('bridge-assets/js/custom/common.js') }}" type="module"></script>


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
                    <a class="nav-link" href="/nova">Адмінка</a>
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