@extends('layouts.app')

@section('content')
    @include('layouts.templates.topbar')
  
    <div class="container-fluid mt--7">
        <div class="card" style="margin-top: 12%;">
            <div class="card-body">
                <h1 class="card-title">Nuevo Inscrito</h1>
                <form>
                    <div class="form-group">
                        <label for="name" class="form-control-label">Nombre</label>
                        <input class="form-control" name="name" type="text" placeholder="Ingresa el nombre" id="name">
                    </div>

                    <div class="form-group">
                        <label for="surname" class="form-control-label">Apellido</label>
                        <input class="form-control" name="surname" type="text" placeholder="Ingresa el apellido" id="surname">
                    </div>

                    <div class="form-group">
                        <label for="email" class="form-control-label">Email</label>
                        <input class="form-control" name="email" type="email" placeholder="name@example.com" id="email">
                    </div>

                    <div class="form-group">
                        <label for="identification" class="form-control-label">Cédula</label>
                        <input class="form-control" name="identification" type="text" placeholder="123456789" id="identification">
                    </div>
                    
                    <div class="form-group">
                        <label for="cicpc_id" class="form-control-label">Identificación CICPC</label>
                        <input class="form-control" name="cicpc_id" type="text" placeholder="123456789" id="cicpc_id">
                    </div>

                    <div class="form-group">
                        <label for="phone" class="form-control-label">Teléfono</label>
                        <input class="form-control" name="phone" type="text" placeholder="0424 - 6554482" id="phone">
                    </div>

                    <div class="form-group">
                        <label for="address" class="form-control-label">Dirección</label>
                        <input class="form-control" name="address" type="text" placeholder="Calle #2 Carrera #3 C-07" id="address">
                    </div>

                </form>
                <a href="#" class="btn btn-primary">Guardar</a>
            </div>
        </div>       
    </div>
@endsection