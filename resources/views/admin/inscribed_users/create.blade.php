@extends('layouts.app')

@section('custom-css')
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
@endsection

@section('content')
    @include('layouts.templates.topbar')
  
    <div class="container-fluid mt--7">
        <div class="card" style="margin-top: 12%;">
            <div class="card-body">
                <h1 class="card-title">Nuevo Inscrito</h1>

                <form action="{{route('inscribedUsers.store')}}" method="POST">
                    {{ csrf_field() }}
                    <div class="row">
                        <div class="form-group col-6">
                            <label for="name" class="form-control-label">Nombre</label>
                            <input class="form-control" name="name" type="text" placeholder="Ingresa el nombre" id="name" required>
                        </div>
    
                        <div class="form-group col-6">
                            <label for="surname" class="form-control-label">Apellido</label>
                            <input class="form-control" name="surname" type="text" placeholder="Ingresa el apellido" id="surname" required>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-6">
                            <label for="email" class="form-control-label">Email</label>
                            <input class="form-control" name="email" type="email" placeholder="name@example.com" id="email" required>
                        </div>

                        <div class="form-group col-6">
                            <label for="phone" class="form-control-label">Teléfono</label>
                            <input class="form-control" name="phone" type="text" placeholder="0424 - 6554482" id="phone" required>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-6">
                            <label for="identification" class="form-control-label">Cédula</label>
                            <input class="form-control" name="identification" type="text" placeholder="123456789" id="identification" required>
                        </div>
                        
                        <div class="form-group col-6">
                            <label for="cicpc_id" class="form-control-label">Identificación CICPC</label>
                            <input class="form-control" name="cicpc_id" type="text" placeholder="123456789" id="cicpc_id" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="address" class="form-control-label">Dirección</label>
                        <input class="form-control" name="address" type="text" placeholder="Calle #2 Carrera #3 C-07" id="address" required>
                    </div>

                    <!-- Extra data -->
                    <h1>Información Extra</h1>

                    <div class="row">
                        <div class="form-group col-4">
                            <label for="diseases[]">Enfermedades</label>
                            <select class="form-control" name="diseases[]" id="diseases-sel" multiple="multiple" required>
                                @foreach($diseases as $d)
                                    <option value="{{$d->id}}">{{$d->name}}</option>
                                @endforeach
                            </select>

                            <a class="" data-toggle="modal" data-target="#disease-form">
                                <small class="extra-create-link">Agregar nueva enfermedad</small>
                            </a>
                        </div>

                        <div class="form-group col-4">
                            <label for="benefits[]">Solicitudes Especiales</label>
                            <select class="form-control" name="benefits[]" id="benefits-sel" multiple="multiple" required>
                                @foreach($benefits as $d)
                                    <option value="{{$d->id}}">{{$d->name}}</option>
                                @endforeach
                            </select>

                            <a class="" data-toggle="modal" data-target="#benefits-form">
                                <small class="extra-create-link">Agregar nueva solicitud</small>
                            </a>
                        </div>

                        <div class="form-group col-4">
                            <label for="medicines[]">Medicinas</label>
                            <select class="form-control" name="medicines[]" id="medicines-sel" multiple="multiple" required>
                                @foreach($medicines as $d)
                                    <option value="{{$d->id}}">{{$d->fullName}}</option>
                                @endforeach
                            </select>

                            <a data-toggle="modal" data-target="#medicine-form">
                                <small class="extra-create-link">Agregar nueva medicina</small>
                            </a>
                        </div>
                    </div>

                    <div class="row">
                        <button type="submit" class="btn btn-success">
                            Registrar
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Disease Form -->
        @include('layouts.templates.forms.new-benefit', [
            'url_create_benefit'   =>  url('needs/ajax/store'),
        ])

        <!-- Benefit Form -->
        @include('layouts.templates.forms.new-disease', [
            'url_create_disease'   =>  url('needs/ajax/store'),
        ])

        <!-- Medicines Form -->
        @include('layouts.templates.forms.new-medicine', [
            'med_units' =>  $med_units,
            'med_forms' =>  $med_forms,
            'url_create_medicine'   =>  url('medicines/ajax/store'),
        ])
    </div>

    <!-- Success Modal -->
    <button id="success-modal-btn" type="button" data-toggle="modal" data-target="#modal-notification" style="display:none;">
        Notification
    </button>

    <div class="modal fade" id="modal-notification" tabindex="-1" role="dialog" aria-labelledby="modal-notification" aria-hidden="true">
        <div class="modal-dialog modal-success modal-dialog-centered modal-" role="document">
            <div class="modal-content bg-gradient-success">
                
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                
                <div class="modal-body" style="padding: 0;">
                    <div class="py-3 text-center">
                        <i class="fas fa-check-circle" style="font-size: 5rem;"></i>
                        <h2 class="heading mt-4">¡ÉXITO!</h2>
                        <p>Se han cargado los datos exitosamente.</p>
                    </div>
                </div>
                
            </div>
        </div>
    </div>
    <!-- End of success modal -->
@endsection

@push('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
<script type="text/javascript">
    $(document).ready(function(){
        let sidebar_link = document.getElementById('inscribed-users-link');
        sidebar_link.classList.remove('collapsed');
        sidebar_link.setAttribute('aria-expanded', true);

        let sidebar_options = document.getElementById('inscribed-users-options');
        sidebar_options.classList.add('show');

        $("#diseases-sel").select2({
            placeholder: 'Selecciona una enfermedad'
        });

        $("#benefits-sel").select2({
            placeholder: 'Selecciona una solicitud'
        });

        $("#medicines-sel").select2({
            placeholder: 'Selecciona una medicina'
        });
    });
</script>
@endpush