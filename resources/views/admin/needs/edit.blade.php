@extends('layouts.app')

@section('content')
    @include('layouts.templates.topbar')
  
    <div class="container-fluid mt--7">
        <div class="card" style="margin-top: 12%;">
            <div class="card-body">

                @if ($errors->any())
                    <div class="alert alert-danger mt-3">
                        <strong>¡No se ha podido enviar la notificación!</strong>
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <h1 class="card-title">{{$title}}</h1>
                <form method="POST" action="{{route('needs.update', $need->id)}}">
                    {{ csrf_field() }}
                    {{ method_field('PUT') }}
                    <div class="row">
                        <div class="form-group col-6">
                            <label for="name" class="form-control-label">Nombre</label>
                            <input class="form-control" name="name" type="text" value="{{$need->name}}" id="name">
                        </div>
    
                        <div class="form-group col-6">
                            <label for="description" class="form-control-label">Descripción</label>
                            <input class="form-control" name="description" type="text" value="{{$need->description}}" id="description">
                        </div>
                    </div>

                    <div class="row">
                        <button class="btn btn-success" type="submit">
                            Guardar
                        </button>

                        <a href="{{route('needs.index', ['type' =>  $need->need_type_id])}}" class="btn btn-danger">
                            Regresar
                        </a>
                    </div>
                </form>
            </div>
        </div>       
    </div>
@endsection