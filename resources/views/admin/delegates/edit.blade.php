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

                <h1 class="card-title">Editar: {{$delegate->name}}</h1>
                <form method="POST" action="{{route('delegates.update', $delegate->id)}}">
                    {{ csrf_field() }}
                    {{ method_field('PUT') }}
                    
                    <div class="row">
                        <div class="form-group col-12">
                            <label for="name" class="form-control-label">Nombre</label>
                            <input class="form-control" name="name" type="text" value="{{$delegate->name}}" id="name">
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-12">
                            <label for="email" class="form-control-label">Email</label>
                            <input class="form-control" name="email" type="email" value="{{$delegate->email}}" id="box_quantity">
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-12">
                            <label for="password" class="form-control-label">Contraseña</label>
                            <input class="form-control" type="password" name="password" id="password">
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-12">
                            <label for="passowrd_confirm" class="form-control-label">Confirmar Contraseña</label>
                            <input class="form-control" type="password" name="password_confirmation" id="passowrd_confirm">
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-12">
                            <label for="passowrd_confirm" class="form-control-label">Zona</label>
                            <select class="form-control" name="zone_id" value="{{ old('zone_id') }}" required>
                                <option value="none" disabled>Elige una zona</option>
                                @foreach ($zones as $z)
                                    @if ($z->id == $delegate->zone_id)
                                        <option value="{{$z->id}}" selected>{{$z->name}}</option>
                                    @else
                                        <option value="{{$z->id}}">{{$z->name}}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <button class="btn btn-success" type="submit">
                            Guardar
                        </button>

                        <a href="" class="btn btn-danger">
                            Regresar
                        </a>
                    </div>
                </form>
            </div>
        </div>       
    </div>
@endsection

@push('js')
<script type="text/javascript">
    let sidebar_link = document.getElementById('delegates-link');
    sidebar_link.classList.remove('collapsed');
    sidebar_link.setAttribute('aria-expanded', true);

    let sidebar_options = document.getElementById('delegates-options');
    sidebar_options.classList.add('show');
</script>
@endpush