<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Social Network') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Social Network') }}
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
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif
                            
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else                                                       
                            <li class="nav-item">                                
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                        {{ Auth::user()->name }}
                                </a> 
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>

                                    <a class="dropdown-item" href=""
                                       onclick="event.preventDefault();
                                                     document.getElementById('profile-form').submit();">
                                        {{ __('Profile') }}
                                    </a>

                                    <form id="profile-form" action="" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>                                
                            </li>                            
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <!--<main class="py-4">
            @yield('content')
        </main>-->

        <br>

        <main class= "container-fluid">
            <div class="row"> 
                <div class="col-2 order-1 order-sm-2">                                    
                    <nav class="">
                        <div class="nav flex-column " aria-orientation="vertical" >          
                            <ul class="nav navbar-nav nav-pills nav-fill">
                                <li class="nav-item" id="home">
                                    <a class="nav-link" href="" >Home</a>
                                </li>
                                <li class="nav-item" id="clientes">
                                    <a class="nav-link active" href="{{ url('users')}}">Usuarios</a>          
                                </li>
                                <li class="nav-item" id="facturas">
                                    <a class="nav-link" href="">------</a>
                                </li>
                                <li class="nav-item" id="ofrendas">
                                    <a class="nav-link" href="">------</a>
                                </li>
                                <li class="nav-item" id="categorias">
                                    <a class="nav-link" href="">------</a>
                                </li>
                            </ul>
                        </div>
                    </nav>
                </div>           

                <div class="col order-2 order-sm-1">                
                    @yield('content')
                </div>                                
                
            </div>
            <footer class="text-center">
                <p>&copy; 2021 Social Network derechos reservados</p>
            </footer>
        </main>    
    </div>
</body>
</html>
