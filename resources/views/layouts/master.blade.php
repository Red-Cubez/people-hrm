<html>
<head>
    <title>People - @yield('title')</title>
    <meta name="description" content="@yield('metaDescription')">
    <meta name="keywords" content="@yield('metaKeywords')">
</head>
<body>
<header class="row">
    @include('layouts.header')
    @yield('headercontent')
    {{--@yield('scripts')--}}
    {{--@yield('stylesheets')--}}
</header>
<div class="flex-center position-ref full-height">
    @if (Route::has('login'))
        <div class="top-right links">
            @if (Auth::check())
                <a href="{{ url('/home') }}">Home</a>
            @else
                <a href="{{ url('/login') }}">Login</a>
                <a href="{{ url('/register') }}">Register</a>
            @endif
        </div>
    @endif
</div>

<div class="container">
    @yield('content')
</div>
<footer class="row">
    @include('layouts.footer')
</footer>
</body>
</html>