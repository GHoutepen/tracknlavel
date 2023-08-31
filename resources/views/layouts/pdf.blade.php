<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Track n Label') }} @yield('title')</title>

    <style>
        body {
            font-family: 'Lato', sans-serif;
            width: 100%;
        }

        .utf8-font {
            font-family: 'dejavu sans', sans-serif;
        }

        .header {
            margin-bottom: 20px;
        }

        .header .header-image {
            max-width: 30%;
            float: right;
        }

        .header .header-title {
            margin-top: -2px;
        }

        .main {
            font-size: 0.9rem;
        }

        .table-full-width {
            width: 100%;
        }

        .table-col-lg {
            width: 30%
        }

        .mt-2 {
            margin-top: 20px
        }

        .mb-1 {
            margin-bottom: 10px
        }

        .mb-2 {
            margin-bottom: 20px
        }

        .pt-2 {
            padding-top: 20px
        }

        .pl-2 {
            padding-left: 20px
        }
    </style>

    @yield('style')

</head>
<body>
<div class="header">
    <img class="header-image" alt="TrackNLabel" src="{{ asset('images/logo.png') }}">
    <h1 class="header-title">{{ $title }}</h1>
</div>

@yield('content')
</body>
</html>
