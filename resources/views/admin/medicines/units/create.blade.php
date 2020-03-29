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

                <h1 class="card-title">Nueva Unidad de Concentración</h1>
                <form method="POST" action="{{route('units.store')}}">
                    {{ csrf_field() }}
                    
                    <div class="row">
                        <div class="form-group col-6">
                            <label for="name" class="form-control-label">Nombre</label>
                            <input class="form-control" name="name" type="text" placeholder="Ingresa el nombre" id="name">
                        </div>
    
                        <div class="form-group col-6">
                            <label for="short_name" class="form-control-label">Abreviación</label>
                            <input class="form-control" name="short_name" type="text" placeholder="Abrevs" id="short_name">
                        </div>
                    </div>

                    <div class="row">
                        <button class="btn btn-success" type="submit">
                            Crear
                        </button>

                        <a href="{{route('forms.index')}}" class="btn btn-danger">
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
    let sidebar_link = document.getElementById('medicine-link');
    sidebar_link.classList.remove('collapsed');
    sidebar_link.setAttribute('aria-expanded', true);

    let sidebar_options = document.getElementById('medicines-options');
    sidebar_options.classList.add('show');
</script>
@endpush