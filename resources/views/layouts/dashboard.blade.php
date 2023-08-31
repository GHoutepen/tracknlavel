<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Track N Label') }}</title>

    <!-- Scripts -->
    <link href="{{ URL::asset('/images/favicon.png') }}" rel="icon" type="image/x-icon"/>
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Lato&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Raleway&display=swap" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    @yield('header')
</head>
<body>
<div id="body-wrapper"
     class="@if(Session::get('sidebar') === true)extendedView @endif"
     v-bind:class="{extendedView: extendedView, removeTransition: removeTransition}">
    <nav id="sidebar">
        <div class="header simple-flex">
           <span>
                            <img alt="TrackNLabel" src="{{ asset('images/logo.png') }}">
                        </span>
                <div style="margin-top: 2px;">
                            <span class="pin-icon" v-on:click="changeView(true,  'php')">
                                <i data-feather="x"></i>
                            </span>
                </div>
            </div>

        @include('layouts.menu')
    </nav>

    <div id="content-area">
        <div class="navbar-wrapper">
            <nav class="navbar navbar-expand-md">
               <h2>Track n Label Top bar</h2>
            </nav>
        </div>

        <div id="main">
            @if (session('success'))
                <div class="alert-container">
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                </div>
            @endif

            @if (session('warning'))
                <div class="alert-container">
                    <div class="alert alert-warning">
                        {{ session('warning') }}
                    </div>
                </div>
            @endif

            @if (session('danger'))
                <div class="alert-container">
                    <div class="alert alert-danger">
                        {{ session('danger') }}
                    </div>
                </div>
            @endif

            @if ($errors->any())
                <div class="alert-container">
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @endif

            @yield('content')
        </div>
    </div>
</div>
</body>
</html>
