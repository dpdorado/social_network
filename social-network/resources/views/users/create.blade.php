@extends('template_home')

@section('content_')
<div class="row">
 <div class="col-sm-8 offset-sm-2">
    <h1 class="display-3">Registrar usuario</h1>
  <div>
    @if ($errors->any())
      <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
        </ul>
      </div><br />
    @endif
      <form method="post" action="{{ route('users.store') }}">
          @csrf     
            <div class="form-group">
                <label for="name">Nombre:</label>
                <input type="text" class="form-control" name="name" value="" />
            </div>
            
            <div class="form-group">
                <label for="username">Nombre de usuario:</label>
                <input type="text" class="form-control" name="username" value="" />
            </div>

            <div class="form-group">
                <label for="email">E-mail:</label>
                <input type=text class="form-control" name="email" value="" />
            </div>

            <div class="form-group">
                <label for="password">Contraseña:</label>
                <input type="password" class="form-control" name="password" value="" />
            </div>       

            <div class="form-group">
                <label for="password-confirm">Confirmar contraseña:</label>
                <input type="password" id="password-confirm" class="form-control" name="password_confirmation" value="" />
            </div>                   
            
            <div class="form-group">
                <label for="role">Rol:</label>            
                <select class="form-control" name="role" id="FormControlSelect">
                        @foreach($roles as $role)
                        <option value={{$role->name}}>{{$role->description}} </option>
                        @endforeach
                </select>             
            </div>       
                              
          <div class="text-right">
            <a href="{{ route('users.index')}}" class="btn btn-danger">Cancelar y volver</a>
            <button type="submit" class="btn btn-primary">Guardar</button>
          </div>
      </form>
  </div>
</div>
</div>
@endsection
