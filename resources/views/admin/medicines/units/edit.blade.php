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

                <h1 class="card-title">Nueva Forma Farmacéutica</h1>
                <form method="POST" action="{{route('units.update', $med_unit->id)}}">
                    {{ csrf_field() }}
                    {{ method_field('PUT') }}

                    <div class="row">
                        <div class="form-group col-6">
                            <label for="name" class="form-control-label">Nombre</label>
                            <input class="form-control" name="name" type="text" value="{{$med_unit->name}}" id="name">
                        </div>
    
                        <div class="form-group col-6">
                            <label for="short_name" class="form-control-label">Abreviación</label>
                            <input class="form-control" name="short_name" type="text" value="{{$med_unit->short_name}}" id="short_name">
                        </div>
                    </div>

                    <div class="row">
                        <button class="btn btn-success" type="submit">
                            Guardar
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