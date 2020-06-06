<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name') }} - @yield('title') </title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <!-- icons -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light shadow-sm text-dark h5" style="text-transform: uppercase; background:#b1d1ea">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/vehicle') }}">
                    <span><img src="/logo/small-logo.png" alt="logo"></span>
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    <i class="fa fa-user"></i>
                                    {{ Auth::user()->first_name }} {{ Auth::user()->last_name }}<span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                                     <i class="fa fa-close"></i>
                                        {{ __('Logout') }}
                                    </a>
                                    <a class="dropdown-item" href="/profile">
                                    <i class="fa fa-cogs"></i>
                                        Profile
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>
        <br>
        <br>
        <div class="row">
            <div class="col-sm-4"></div>
            <nav class="nav nav-tabs col-sm-4 h5">   
                @if (\Request::is('vehicle') || \Request::is('vehicle/*'))         
                    <a href="/vehicle" class="nav-item nav-link active">
                        <i class="fa fa-car"></i> Vehicles
                    </a>
                @else
                    <a href="/vehicle" class="nav-item nav-link">
                        <i class="fa fa-car"></i> Vehicles
                    </a>
                @endif                
                @if (\Request::is('service/*') || \Request::is('service'))
                    <a href="/services" class="nav-item nav-link active">
                        <i class="fa fa-wrench"></i> Services
                    </a>
                @else
                    <a href="/services" class="nav-item nav-link">
                        <i class="fa fa-wrench"></i> Services
                    </a>
                @endif
                <!-- remember to change when you change the info page -->
                @if (\Request::is('profile') || \Request::is('profile/*')) 
                    <a href="/profile" class="nav-item nav-link active" >
                        <i class="fa fa-info"></i> Info
                    </a>
                @else
                    <a href="/profile" class="nav-item nav-link" >
                        <i class="fa fa-info"></i> Info
                    </a>
                @endif
                @if (\Request::is('assistant/*') || \Request::is('assistant')) 
                    <a href="/assistant" class="nav-item nav-link active">
                        <i class="fa fa-phone"></i> Assistant
                    </a>
                @else 
                    <a href="/assistant" class="nav-item nav-link">
                        <i class="fa fa-phone"></i> Assistant
                    </a>
                @endif
            </nav>
            <div class="col-sm-4"></div>
        </div>
        <br>
        @include('flashMessages')
        
        <main class="p-4" style="min-height: 62.5vh" >
            @yield('content')
        </main>
        <footer>
            <div class="row">
				<div class="col-xs-12 col-sm-12 col-md-12 mt-2 mt-sm-2 h5 text-center text-black" style="background:#b1d1ea">
					<p><img src="/logo/small-logo.png" alt="logo"></p>
                    <p>Easy-Garage</p>
					<p class="h6">© All right Reversed.</p>
                    <br>
				</div>
			</div>	
        </footer>
    </div>
</body>
</html>
