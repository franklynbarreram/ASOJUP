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

            <h1 class="card-title">Nuevo Listado</h1>
            <form method="POST" action="{{route('listings.store')}}" id="form_medicine">
                {{ csrf_field() }}

                <div class="row" id="row2">
                    <div class="form-group col-6" id="">
                        <label for="description" class="form-control-label">Descripción</label>
                        <input class="form-control" name="description" type="text" placeholder="Ingresa una descripción" id="name">
                    </div>

                    <div class="form-group col-6">
                        <label for="date" class="form-control-label">Fecha para el pedido</label>
                        <input class="form-control" name="date" type="date" value="1" id="date">
                    </div>
                </div>

                <div class="row">
                    <button class="btn btn-success" type="submit" id="btn">
                        Crear
                    </button>

                    <a href="{{route('listings.index')}}" class="btn btn-danger" >
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
    let sidebar_link = document.getElementById('listing-link');
    sidebar_link.classList.remove('collapsed');
    sidebar_link.setAttribute('aria-expanded', true);
    let sidebar_options = document.getElementById('listing-options');
    sidebar_options.classList.add('show');

</script>
@endpush