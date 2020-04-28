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

            <h1 class="card-title">Solicitar Permiso</h1>

            <form method="POST" action="{{route('permissions.store')}}" id="form_need">
                {{ csrf_field() }}

                <div class="row" id="row-conteiner">
                    <div class="form-group col-12">
                        <label for="description" class="form-control-label">Descripción</label>
                        <input class="form-control" name="description" type="text" placeholder="Abrevs" id="description">
                    </div>
                </div>

                <div class="row">
                    <button class="btn btn-success" type="submit" id="btn">
                        Crear
                    </button>

                    <a href="{{route('permissions.index')}}" class="btn btn-danger">
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
</script>
@endpush