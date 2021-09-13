<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>{{ __('Dashboard') }}</title>
    <script src="{{ asset('bower_components/jquery/dist/jquery.min.js') }}" type="text/javascript"></script>
    <link href="{{ asset('bower_components/select2-css/index.css') }}" rel="stylesheet" />
    <script src="{{ asset('bower_components/select2-js/index.js') }}" type="text/javascript"></script>
    <link rel="stylesheet" href="{{ asset('bower_components/AdminLTE/plugins/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('bower_components/ionicons/docs/css/ionicons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('bower_components/AdminLTE/dist/css/adminlte.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
    <script src="{{ asset('bower_components/ckeditor/ckeditor.js') }}"></script>
</head>

<body class="hold-transition sidebar-mini">
    @include('admin.partial.navbar')
    <div class="wrapper">
        @include('admin.partial.left')
        <div class="content-wrapper">
            @yield('content')
        </div>
        <aside class="control-sidebar control-sidebar-dark"></aside>
        <footer class="main-footer"></footer>
    </div>
    <script src="{{ asset('bower_components/AdminLTE/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('bower_components/AdminLTE/dist/js/adminlte.js') }}"></script>
    @stack('script')
</body>

</html>
