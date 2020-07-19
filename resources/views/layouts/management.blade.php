<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Abwenzi</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>  
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">
    

</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/home') }}">
                    <!--<img src="{{asset('images/logo.png')}}" width="100">-->
                    <span class="brand-name-1">ABWENZI</span> 
                    <span class="brand-name-2">Financial Services</span>
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
                        <!--
                            <li class="nav-item">
                                <a class="nav-link" href="#">{{ Auth::user()->name }}</a>
                            </li>
                        -->
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
                                    Menu <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <div class="d-flex flex-column">
                                        <a href="{{route('loans.index')}}"> <div class="p-2"><i class="fa fa-dollar fa-x1"></i> Loans </div></a>
                                        <a href="{{route('clients.index')}}"><div class="p-2"><i class="fa fa-handshake-o fa-x1"></i> Clients </div></a>
                                        <a href="{{route('commissions.index')}}"><div class="p-2"><i class="fa fa-balance-scale fa-x1"></i> Commissions </div></a>
                                        <a href="{{route('shareholders.index')}}"><div class="p-2"><i class="fa fa-briefcase fa-x1"></i> Shareholders </div></a>
                                        <a href="{{route('cash.index')}}"><div class="p-2"><i class="fa fa-money fa-x1"></i> Cash Flow </div></a>
                                        <a href="{{route('expenses.index')}}"><div class="p-2"><i class="fa fa-line-chart fa-x1"></i> Expenses </div></a>
                                        <a href="{{route('clients.index')}}"><div class="p-2"><i class="fa fa-users fa-x1"></i> Users </div></a>
                                        <a href="{{route('clients.index')}}"><div class="p-2"><i class="fa fa-cog fa-x1"></i> Settings </div></a>
                                        
                                        <hr>
                                        <a href="{{route('clients.index')}}"><div class="p-2"><i class="fa fa-user fa-x1"></i> My Account </div></a>
                                        
                                        <a href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                                        document.getElementById('logout-form').submit();">
                                            <div class="p-2"><i class="fa fa-sign-out fa-x1"></i>{{ Auth::user()->name }}</div>
                                        </a>
                                        
                                    </div>

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

        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>
</html>
