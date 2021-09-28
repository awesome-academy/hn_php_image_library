<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/html">

<head>
    <meta charset="utf-8">
    <title>{{ __('Image Library') }}</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" name="viewport">
    <script src="{{ asset('bower_components/jquery/dist/jquery.min.js') }}" type="text/javascript"></script>
    <script defer="" src="{{ asset('bower_components/wcave/index.js') }}" type="text/javascript"></script>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/button.css') }}" />
    <script src="{{ asset('js/header.js') }}" type="text/javascript"></script>
    <script src="{{ asset('bower_components/pusher-js/dist/web/pusher.min.js') }}"></script>
    <script src="{{ asset('js/app.js') }}"></script>
</head>

<body id="home">
    @include('frontend.partial.header')
    <div id="web">
        @yield('content')
    </div>
    @include('frontend.partial.footer')
    <a href="#" id="scrollarrow">{{ __('Scroll up this page') }}</a>
    @stack('script')
</body>

</html>
