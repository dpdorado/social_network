@extends('layouts.app')

@section('content')

<br>

<main class= "container-fluid">
    <div class="row"> 
        <div class="col-2 order-2 order-sm-1">                                    
            <nav class="">
                <div class="nav flex-column " aria-orientation="vertical" >          
                    <ul class="nav navbar-nav nav-pills nav-fill">
                    <ul class="navbar-nav ">
                        <li class="nav-item" id="home">
                            <a class="nav-link" href="{{ url('home')}}" >Home</a>
                        </li>
                        @if(Auth::user()->hasRole("admin"))    
                            <li class="nav-item" id="clientes">
                                <a class="nav-link" href="{{ url('users')}}">Usuarios</a>
                            </li>
                        @endif                                
                        <li class="nav-item" id="facturas">
                            <a class="nav-link" href="">Información</a>
                        </li>
                        <li class="nav-item" id="ofrendas">
                            <a class="nav-link" href="">Contacto</a>
                        </li>                        
                    </ul>
                </div>
            </nav>
        </div>           

        <div class="col order-1 order-sm-2">                
            @yield('content_')
        </div>                                
        
    </div>
    <footer class="text-center">
        <p>&copy; 2021 Social Network derechos reservados</p>
    </footer>
</main>    
@endsection