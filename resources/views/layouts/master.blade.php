<html>
<head>
    <title>People - @yield('title')</title>
    <meta name="description" content="@yield('metaDescription')">
    <meta name="keywords" content="@yield('metaKeywords')">
    <link rel="stylesheet" type="text/css" href="{{ elixir('css/app.css') }}">
</head>
<body>
 @include('layouts.header')
 {{-- @yield('headercontent') --}}
{{-- <header class="">
 
<div class="container">
    <div class="row">
        <div class="col-xs-12">
          
        </div>
    </div>
</div>
</header> --}}
{{-- <section>
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                {{--  <div class="flex-center position-ref full-height"> --}}
    {{-- @if (Route::has('login')) --}}
        {{-- <div class="top-right links"> --}}
           {{--  @if (Auth::check()) --}}
                {{-- <a href="{{ url('/home') }}">Home</a> --}}
           {{--  @else
                <a href="{{ url('/login') }}">Login</a>
                <a href="{{ url('/register') }}">Register</a>
            @endif --}}
        {{-- </div> --}}
   {{--  @endif --}}
{{-- </div>  --}}
           {{--  </div>
        </div>
    </div>
</section> --}} 
@include('layouts.header')
@yield('content')
<footer>
    @include('layouts.footer')
</footer>
<script type="text/javascript" src="{{ URL::asset('js/app.js')}}"></script>

</body>
</html>