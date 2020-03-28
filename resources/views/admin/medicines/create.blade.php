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

                <h1 class="card-title">Nuevo Medicamento</h1>
                <form method="POST" action="{{route('medicines.store')}}">
                    {{ csrf_field() }}
                    
                    <div class="row">
                        <div class="form-group col-6">
                            <label for="name" class="form-control-label">Nombre</label>
                            <input class="form-control" name="name" type="text" placeholder="Ingresa el nombre" id="name">
                        </div>
    
                        <div class="form-group col-6">
                            <label for="box_quantity" class="form-control-label">Cantidad <small>(medicamentos por caja)</small></label>
                            <input class="form-control" name="box_quantity" type="number" value="1" id="box_quantity">
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-4">
                            <label for="email" class="form-control-label">Forma Farmacéutica</label>
                            <select class="form-control" name="medicine_form_id" id="">
                                <option value="none" disabled selected>Selecciona una opción</option>
                                @foreach ($med_forms as $md)
                                    <option value="{{$md->id}}">{{$md->name}} ({{$md->short_name}})</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group col-4">
                            <label for="concentration" class="form-control-label">Concentración</label>
                            <input class="form-control" name="concentration" type="number" placeholder="500" id="concentration">
                        </div>
                        
                        <div class="form-group col-4">
                            <label for="medicine_unit_id" class="form-control-label">Unidades de Concentración</label>
                            <select class="form-control" name="medicine_unit_id" id="">
                                <option value="none" disabled selected>Selecciona una opción</option>
                                @foreach ($med_units as $md)
                                    <option value="{{$md->id}}">{{$md->name}} ({{$md->short_name}})</option>
                                @endforeach
                            </select>
                        </div>  
                    </div>

                    <div class="row">
                        <button class="btn btn-success" type="submit">
                            Crear
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