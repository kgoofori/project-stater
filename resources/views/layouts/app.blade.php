<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Martlify') }}</title>

    <link href="{{ mix('css/app.css') }}" rel="stylesheet">

    <!-- Theme CSS -->
      
    <link rel="stylesheet" href="assets/css/theme.min.css" id="stylesheetLight">

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    
</head>
<body>
    <div id="app">
        @yield('content')
    </div>

    <!-- JAVASCRIPT
    ================================================== -->
    <!-- Libs JS -->

    <script src="{{ mix('js/vendor.js') }}" ></script>
    <script src="{{ mix('js/manifest.js') }}" ></script>
    <script src="{{ mix('js/app.js') }}" ></script>
</body>
</html>
