@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-sm-8 offset-sm-2">
        <h1 class="display-3">Profile</h1>

        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        <br /> 
        @endif
        <form method="post" action="{{ route('profiles.update', $user->id) }}" accept-charset="UTF-8" enctype="multipart/form-data">
            @method('PATCH') 
            @csrf          
            <a href="" class="avatar rounded-circle">
                <img class="rounded-circle" alt="Image placeholder" src='/uploads/{{$user->profile_pic}}' width="200" height="200"/>
            </a>
            <div class="form-group">                             
                <label class="col-md-4 control-label">Cambiar imagen:</label>
                <div class="col-md-6">                
                    <input accept="image/*" type="file" name="imagen"  class="form-control">
                </div>
            </div>
 
            <div class="form-group">
                <label for="name">Nombre:</label>
                <input type="text" class="form-control" name="name" value={{ $user->name }} />
            </div>

            <div class="form-group">
                <label for="username">Nombre de usuario:</label>
                <input type="text" class="form-control" name="username" value={{ $user->username}} />
            </div>

            <div class="form-group">
                <label for="email">E-mail:</label>
                <input type=text class="form-control" name="email" value={{ $user->email }} />
            </div>

            <div class="form-group">
                <label for="password">Contraseña:</label>
                <input type="password" class="form-control" name="password" value={{ $user->password }} />
            </div>       

            <div class="form-group">
                <label for="password-confirm">Confirmar contraseña:</label>
                <input type="password" id="password-confirm" class="form-control" name="password_confirmation" value="" />
            </div> 

            <div class="text-right">
                <a href="{{ route('home')}}" class="btn btn-danger">Cancelar y volver</a>
                <button type="submit" class="btn btn-primary">Guardar</button>                            
            </div>
        </form>
    </div>
</div>
@endsection