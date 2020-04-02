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
            <form method="POST" action="{{route('medicines.store')}}" id="form_medicine">
                {{ csrf_field() }}

                <div class="row" id="row2">
                    <div class="form-group col-6" id="">
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
                        <select class="form-control" name="medicine_form_id" id="medicine_form_id">
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
                        <select class="form-control" name="medicine_unit_id" id="med_unit_id">
                            <option value="none" disabled selected>Selecciona una opción</option>
                            @foreach ($med_units as $md)
                            <option value="{{$md->id}}">{{$md->name}} ({{$md->short_name}})</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="row">
                    <button class="btn btn-success" type="submit" id="btn">
                        Crear
                    </button>

                    <a href="{{route('medicines.index')}}" class="btn btn-danger" >
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
    $('#btn').attr('disabled', true);
    let sidebar_options = document.getElementById('medicines-options');
    sidebar_options.classList.add('show');
   
   

        let name=false;
       
        $('#name').keyup(function() {

            var  nombre = $('#name').val();

            if (nombre != "") {

                var expresion = /^[a-zA-ZñÑáéíóúÁÉÍÓÚ ]*$/;
                if (!expresion.test(nombre)) {
                    $("#row2").parent().before('<div class="alert alert-warning"><strong>ERROR: </strong>No se permiten números ni caracteres especiales en el nombre</div>')
                  /*   $('#btn').attr('disabled', true); */
                  name=false;
                } else {
                    $(".alert").remove();
                    name=true;
                  /*   $('#btn').attr('disabled', true); */
                }
            }
        });
       let medicine_form=false;
         $('#medicine_form_id').click(function(){
             if($('#medicine_form_id').val()!=null){
                medicine_form=true;
             }
          
         });
         let cantidad=true;
         


         let concentration=false;
         $('#concentration').click(function(){
             if($('#concentration').val()!=null){
                concentration=true;
             }
          
         });

         let med_unit_id=false;
         $('#med_unit_id').click(function(){
             if($('#med_unit_id').val()!=null){
                med_unit_id=true;
              
             }
          
         });

        $('#form_medicine').click(function(){
            
            if(medicine_form ==true && name ==true && concentration==true &&cantidad==true && med_unit_id==true){
          
                $('#btn').attr('disabled', false);
            }else{
                $('#btn').attr('disabled', true);
            }
        });

        
</script>
@endpush