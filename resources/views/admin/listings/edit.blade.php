@extends('layouts.app')

@section('custom-css')
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
@endsection

@section('content')
    @include('layouts.templates.topbar')
  
    <div class="container-fluid mt--7">
        <div class="card" style="margin-top: 12%;">
            <div class="card-body">
                <h1 class="card-title">Editar item</h1>
                <form action="" method="POST">
                {{ csrf_field() }}
                    {{ method_field('PUT') }}

                <div class="row" id="row2">
                     <div class="form-group col-6" id="">
                        <label for="description" class="form-control-label">Descripción</label>
                        <input class="form-control" name="description" value="{{$listing->description}}" type="text" placeholder="Ingresa una descripción" id="name">
                    </div>

                    <div class="form-group col-6">
                        <label for="date" class="form-control-label">Fecha para el pedido</label>
                        <input class="form-control" name="date" type="date" value="{{$listing->date}}" id="date">
                    </div> 
                </div>

                    <div class="row">
                        <a href="{{route('listings.index')}}" class="btn btn-danger">
                            Regresar
                        </a>
                        <button type="submit" class="btn btn-success">
                            Editar
                        </button>

                       
                    </div>

                </form> 
            </div>
        </div>
    </div>
@endsection

@push('js')
<script type="text/javascript">
    //Showing sidebar options
    let sidebar_link = document.getElementById('listing-link');
    sidebar_link.classList.remove('collapsed');
    sidebar_link.setAttribute('aria-expanded', true);
    let sidebar_options = document.getElementById('listing-options');
    sidebar_options.classList.add('show');
    //---
</script>
@endpush