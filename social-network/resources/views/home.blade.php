@extends('template_home')

@section('content_')
    <div class="col-sm-12">

        @if(session()->get('success'))
        <div class="alert alert-success">
            {{ session()->get('success') }}  
        </div>
        @endif

        @if(session()->get('failed'))
        <div class="alert alert-danger">
            {{ session()->get('failed') }}  
        </div>
        @endif
        </div>  
    <div class ="container-fluid">    
        <div class="card">
            <h5 class="card-header">Agregar mensaje</h5>
            <div class="card-body">
                <h5 class="card-title">Mensaje:</h5>
                <form method="post" action="{{ route('messages.store') }}">
                    @csrf
                    <input type="text" class="form-control" name="message" value="" />
                    <button type="submit" class="btn btn-success">Publicar</button>
                </form>                
            </div>
        </div>  
        <br>       
        @forelse($messages as $message)
            <div class="card">
                <h5 class="card-header">{{$message->user->name}}</h5>
                <div class="card-body">
                    <h5 class="card-title">Mensaje</h5>
                    <p class="card-text">{{$message->message}}</p>

                    @if(Auth::user()->is_like($message->id))    
                        <a href="{{ route('like',$message->id)}}" class="btn btn-success">{{$message->like_count}} Me gusta</a>
                    @else
                        <a href="{{ route('like',$message->id)}}" class="btn btn-primary">{{$message->like_count}} Me gusta</a>
                    @endif        
                    
                    <a href="#" class="btn btn-primary">{{$message->comment_count}} Comentar</a>
                    <a href="#" class="btn btn-primary">{{$message->share_count}} Compartir</a>
                </div>
            </div>  
            <br>            
        @empty
            <p>No se encontraron mensajes registrados.</p>
        @endforelse                
    </div>

    <br>
@endsection
