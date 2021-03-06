<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    @section('styles')
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    @show
    <title>Project flyer</title>
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-fixed-top navbar-expand navbar-dark bg-dark">
            <a class="navbar-brand" href="{{ route('home') }}">Project flyer</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExample02" aria-controls="navbarsExample02" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarsExample02">
                <ul class="navbar-nav ml-auto">
                    @auth
                    <li class="nav-item active">
                        <a class="nav-link" href="#">Hello, {{ auth()->user()->name }}</a>
                    </li>
                    @endauth
                </ul>
            </div>
        </nav>
        <div class="container">
            @yield('content')
        </div>
    </div>

    @section('scripts')
        <script src="{{ asset('js/app.js') }}"></script>
        @include('partials.flash')
    @show
</body>
</html>