@extends('layouts.app')

@section('custom-css')
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
@endsection

@section('content')
    @include('layouts.templates.topbar')
  
    <div class="container-fluid mt--7">
        <div class="card" style="margin-top: 12%;">
            <div class="card-body">
                <h1 class="card-title">Nuevo Sobreviviente - {{$inscribed->fullName}}</h1>

                <form action="{{route('survivors.store')}}" method="POST">
                    {{ csrf_field() }}

                    <input type="hidden" name="inscribed_user_id" value="{{$inscribed->id}}">

                    <div class="row">
                        <div class="form-group col-6">
                            <label for="name" class="form-control-label">Nombre</label>
                            <input class="form-control" name="name" type="text" placeholder="Ingresa el nombre" id="name">
                        </div>
    
                        <div class="form-group col-6">
                            <label for="surname" class="form-control-label">Apellido</label>
                            <input class="form-control" name="surname" type="text" placeholder="Ingresa el apellido" id="surname">
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-6">
                            <label for="email" class="form-control-label">Email</label>
                            <input class="form-control" name="email" type="email" placeholder="name@example.com" id="email">
                        </div>

                        <div class="form-group col-6">
                            <label for="phone" class="form-control-label">Teléfono</label>
                            <input class="form-control" name="phone" type="text" placeholder="0424 - 6554482" id="phone">
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-6">
                            <label for="identification" class="form-control-label">Cédula</label>
                            <input class="form-control" name="identification" type="text" placeholder="123456789" id="identification">
                        </div>
                        
                        <div class="form-group col-6">
                            <label for="address" class="form-control-label">Dirección</label>
                            <input class="form-control" name="address" type="text" placeholder="Calle #2 Carrera #3 C-07" id="address">
                        </div>
                    </div>

                    <div class="row">
                        <button type="submit" class="btn btn-success">
                            Crear
                        </button>

                        <a class="btn btn-danger" href="{{route('survivors.index', ['inscribed_id' => $inscribed->id])}}">
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
    //Showing sidebar options
    let sidebar_link = document.getElementById('inscribed-users-link');
    sidebar_link.classList.remove('collapsed');
    sidebar_link.setAttribute('aria-expanded', true);

    let sidebar_options = document.getElementById('inscribed-users-options');
    sidebar_options.classList.add('show');
    //---
</script>
@endpush