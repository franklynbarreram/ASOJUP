@extends('layouts.app')

@section('custom-css')
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
@endsection

@section('content')
@include('layouts.templates.topbar')

<div class="container-fluid mt--7">
    <div class="card" style="margin-top: 12%;">
        <div class="card-body">
            <h1 class="card-title">Nuevo Delegado</h1>

            <form action="{{route('delegates.store')}}" method="POST">
                {{ csrf_field() }}
                <div class="row">
                    <div class="form-group col-6">
                        <label for="name" class="form-control-label">Nombre</label>
                        <input class="form-control" name="name" type="text" placeholder="Ingresa el nombre" id="name" required>
                    </div>

                    <div class="form-group col-6">
                        <label for="email" class="form-control-label">Email</label>
                        <input class="form-control" name="email" type="email" placeholder="name@example.com" id="email" required>
                    </div>
                </div>
                <div>
                    <div class="row">
                        <div class="form-group col-6">
                            <label for="password" class="form-control-label">Contraseña</label>
                            <input class="form-control" name="password" type="password" placeholder="*****" id="password" required>
                        </div>
                        <div class="form-group col-6">
                        <label for="zona" class="form-control-label">Zona</label>
                        

                             <select name="zone_id" id="zone_id" class="form-control">
                             <?php foreach ($zones as $zone => $value) {?>
                                <option value="<?=  $value["id"]; ?>"><?=  $value["name"]; ?></option>
                                <?php } ?>
                            </select> 
                       
                        </div>
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


</div>


<!-- Success Modal -->
<!-- <button id="success-modal-btn" type="button" data-toggle="modal" data-target="#modal-notification" style="display:none;">
        Notification
    </button> -->

<!--   <div class="modal fade" id="modal-notification" tabindex="-1" role="dialog" aria-labelledby="modal-notification" aria-hidden="true">
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
    </div> -->

@endsection

@push('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
<script type="text/javascript">

</script>
@endpush