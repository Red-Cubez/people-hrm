<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">

<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">

<!-- CSRF Token -->
<meta name="csrf-token" content="{{ csrf_token() }}">

<title>{{ config('app.name', 'Laravel') }}</title>

<!-- Styles -->
<link href="{{ asset('css/app.css') }}" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('css/index.css') }}" type="text/css">
<link rel="stylesheet" href="{{ asset('css/websiteStyle.css') }}" type="text/css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<script>
    window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
        ]) !!};
</script>
<script
        src="https://code.jquery.com/jquery-3.2.1.min.js"
        integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4="
        crossorigin="anonymous"></script>
<script src="{{ asset('js/app.js') }}"></script>
<script src="{{ asset('js/confirmationBox/bootstrap-confirmation.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.min.js" ></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.16.0/jquery.validate.min.js"></script>
@yield('page-scripts')
</head>
<body>
<div id="app">

    <nav class="navbar navbar-default navbar-static-top">
        <div class="container">
            <div class="navbar-header">

                <!-- Collapsed Hamburger -->
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                        data-target="#app-navbar-collapse">
                    <span class="sr-only">Toggle Navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

                <!-- Branding Image -->
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'People') }}
                </a>
            </div>

            <div class="collapse navbar-collapse" id="app-navbar-collapse">
                <!-- Left Side Of Navbar -->
                <ul class="nav navbar-nav">
                 <li class="dropdown">
                       <a href="#" class="dropdown-toggle" data-toggle="dropdown"
                        role="button" aria-haspopup="true" aria-expanded="false">
                        Company <span class="caret"></span></a>
                       <ul class="dropdown-menu">
                           <li><a href="/projects">Project</a></li>
                           <li><a href="/companies/{{Auth::user()->employee->company->id}}/edit">Edit </a></li>
                           <li><a href="/holidays" >Holidays </a></li>
                           <li><a href="/clients" >Client </a></li>
                           <li><a href="/employees" >Employee </a></li>
                        </ul>
                    </li>
                    <li class="dropdown">
                       <a href="#" class="dropdown-toggle" data-toggle="dropdown"
                        role="button" aria-haspopup="true" aria-expanded="false">
                        Client <span class="caret"></span></a>
                       <ul class="dropdown-menu">
                           <li><a href="#">Info</a></li>
                           <li><a href="#">Project</a></li>
                            
                           {{-- <li role="separator" class="divider"></li>
                           <li class="dropdown-header">Specials</li>
                           <li><a href="#">Lunch Buffet</a></li>
                           <li><a href="#">Weekend Brunch</a></li> --}}
                       </ul>
                    </li>
                    <li class="dropdown">
                       <a href="#" class="dropdown-toggle" data-toggle="dropdown"
                        role="button" aria-haspopup="true" aria-expanded="false">
                        <i class="fa fa-user" aria-hidden="true"></i> Employee <span class="caret"></span></a>
                       <ul class="dropdown-menu">
                           <li><a href="/employees/{{Auth::user()->employee->id}}">Info</a></li>
                           <li><a href="/employeetimesheet/{{Auth::user()->employee->id}}/create">Timesheet</a></li>
                        </ul>
                    </li>
                    <li class="dropdown">
                       <a href="#" class="dropdown-toggle" data-toggle="dropdown"
                        role="button" aria-haspopup="true" aria-expanded="false">
                       <i class="fa fa-user-plus" aria-hidden="true"></i> Roles <span class="caret"></span></a>
                       <ul class="dropdown-menu">
                           <li><a href="/roles">Add New Role</a></li>
                           <li><a href="/user-roles">Add User Roles</a></li>
                        </ul>
                    </li>
                  
                 
                  <li class="dropdown">
                       <a href="#" class="dropdown-toggle" data-toggle="dropdown"
                        role="button" aria-haspopup="true" aria-expanded="false">
                        <i class="fa fa-bar-chart" aria-hidden="true"></i> Reports <span class="caret"></span></a>
                       <ul class="dropdown-menu">
                           <li><a href="/company/{{Auth::user()->employee->company->id}}/reports">Client Project</a></li>
                           <li><a href="/company/{{Auth::user()->employee->company->id}}/reports">Internal </a></li>
                           <li><a href="/company/{{Auth::user()->employee->company->id}}/reports">All </a></li>
                        </ul>
                    </li>
                   <li><a href="/company-settings/{{Auth::user()->employee->company->id}}">
                   <i class="fa fa-cog" aria-hidden="true"></i> Setting</a></li>
                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="nav navbar-nav navbar-right">
                    <!-- Authentication Links -->
                    @if (Auth::guest())
                        <li><a href="{{ route('login') }}">Login</a></li>
                        <li><a href="{{ route('register') }}">Register</a></li>
                    @else
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                               aria-expanded="false">
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>

                            <ul class="dropdown-menu" role="menu">
                                <li>
                                    <a href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        Logout
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                          style="display: none;">
                                        {{ csrf_field() }}
                                    </form>
                                </li>
                            </ul>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>
    @yield('content')
</div>
<!-- Scripts -->

<script type="text/javascript" src="{{ URL::asset('js/index.js')}}"></script>
</body>
</html>
