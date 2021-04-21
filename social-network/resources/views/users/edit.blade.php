@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-sm-8 offset-sm-2">
        <h1 class="display-3">Actualizar usuario</h1>

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
        <form method="post" action="{{ route('users.update', $user->id) }}">
            @method('PATCH') 
            @csrf
            <div class="form-group">
                <label for="id">id:</label>
                <input type="text" class="form-control" name="id" readonly value={{ $user->id }} />
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
                <label for="password_c">Confirmar contraseña:</label>
                <input type="password" class="form-control" name="password_c" value="" />
            </div>           

            <div class="text-right">
                <a href="{{ route('users.index')}}" class="btn btn-danger">Cancelar y volver</a>
                <button type="submit" class="btn btn-primary">Guardar</button>                            
            </div>
        </form>
    </div>
</div>
@endsection
