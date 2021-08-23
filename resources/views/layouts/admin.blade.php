<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Dashboard</title>
    <link rel="stylesheet" href="{{ asset('bower_components/AdminLTE/plugins/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('bower_components/ionicons/docs/css/ionicons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('bower_components/AdminLTE/dist/css/adminlte.min.css') }}">
    <script src="{{ asset('bower_components/ckeditor/ckeditor.js') }}"></script>
    <link href="{{ asset('bower_components/fonts-googleapis/index') }}" rel="stylesheet">
</head>
<body class="hold-transition sidebar-mini">
@include('include.navbar')
<div class="wrapper">
        @include('include.left')
    <div class="content-wrapper">
        @yield('content')
    </div>
    <aside class="control-sidebar control-sidebar-dark"></aside>
    <footer class="main-footer"></footer>
</div>
<script src="{{ asset('bower_components/AdminLTE/plugins/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('bower_components/AdminLTE/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('bower_components/AdminLTE/dist/js/adminlte.js') }}"></script>
<script src="{{ asset('bower_components/AdminLTE/plugins/chart.js/Chart.min.js') }}"></script>
<script src="{{ asset('bower_components/AdminLTE/dist/js/demo.js') }}"></script>
<script src="{{ asset('bower_components/AdminLTE/dist/js/pages/dashboard3.js') }}"></script>
</body>
</html>
