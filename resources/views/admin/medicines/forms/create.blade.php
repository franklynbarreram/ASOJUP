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
                <form method="POST" action="{{route('forms.store')}}" id="form_farm">
                    {{ csrf_field() }}
                    
                    <div class="row" id="row-conteiner">
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
                        <button class="btn btn-success" type="submit" id="btn">
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
   


    $('#btn').attr('disabled', true);
    let name = false;
    let description=false;
    $('#name').keyup(function() {

        var nombre = $('#name').val();

        if (nombre != "") {

            var expresion = /^[a-zA-ZñÑáéíóúÁÉÍÓÚ ]*$/;
            if (!expresion.test(nombre)) {
                $("#row-conteiner").parent().before('<div class="alert alert-warning"><strong>ERROR: </strong>No se permiten números ni caracteres especiales en el nombre</div>')
                /*   $('#btn').attr('disabled', true); */
                name = false;
            } else {
                $(".alert").remove();
                name = true;
                /*   $('#btn').attr('disabled', true); */
            }
        }
    });

    $('#short_name').keyup(function() {

        var descripcion = $('#short_name').val();

        if (descripcion != "") {

            var expresion = /^[a-zA-ZñÑáéíóúÁÉÍÓÚ ]*$/;
            if (!expresion.test(descripcion)) {
                $("#row-conteiner").parent().before('<div class="alert alert-warning"><strong>ERROR: </strong>No se permiten números ni caracteres especiales en la abreviación</div>')
                /*   $('#btn').attr('disabled', true); */
                description = false;
            } else {
                $(".alert").remove();
                description= true;
                /*   $('#btn').attr('disabled', true); */
            }
        }
    });

    $('#form_farm').keyup(function(){
         
         if(description ==true && name ==true ){
        
             $('#btn').attr('disabled', false);
         }else{
             $('#btn').attr('disabled', true);
         }
     });
     

</script>
@endpush