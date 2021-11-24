<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="hotel-domain" content="{{ optional($myHotel ?? null)->id }}">
    <meta name="hotel-currency" content="{{ optional($myHotel ?? null)->currency ?? 'GHS' }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <link href="{{ mix('css/app.css') }}" rel="stylesheet">

    <!-- Libs CSS -->
    <link rel="stylesheet" href="/assets/fonts/feather/feather.css" />

    <!-- Theme CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        crossorigin="anonymous">
    <link rel="stylesheet" href="/css/telement-theme/index.css">
    <link rel="stylesheet" href="/assets/css/theme.min.css" id="stylesheetLight">
    <link rel="stylesheet" href="/css/iconmoon.css">


    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <script src="https://www.google.com/recaptcha/api.js"></script>



    <style>
        .card {
            display: block;
        }

        .gallery-modal {
            width: calc(100% - 3.5rem);
            height: calc(100% - 3.5rem);
            max-width: calc(100% - 3.5rem);
            overflow: scroll;
        }

        button.select2-selection__choice__remove {
            border: none;
            background: transparent;
        }

    </style>


</head>

{{ $slot }}

<!-- JAVASCRIPT
    ================================================== -->
<!-- Libs JS -->
<script src="https://js.paystack.co/v1/inline.js"></script>
@if (config('app.env') == 'production')
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.2.0/dist/jquery.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr@4.6.3/dist/flatpickr.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/autosize@4.0.2/dist/autosize.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/dropzone@5.7.0/dist/dropzone.min.js"></script>
@endif

<script src="{{ mix('js/vendor.js') }}"></script>
<script src="{{ mix('js/manifest.js') }}"></script>
<script src="{{ mix('js/app.js') }}"></script>


</html>
