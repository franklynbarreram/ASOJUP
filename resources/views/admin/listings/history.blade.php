@extends('layouts.app')

@section('custom-css')
<!-- <link rel="stylesheet" href="/tabulator/css/tabulator.css"> -->
<link type="text/css" rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jsgrid/1.5.3/jsgrid.min.css" />
<link type="text/css" rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jsgrid/1.5.3/jsgrid-theme.min.css" />
<link type="text/css" rel="stylesheet" href="/css/modified-modal.css" />
@endsection

@section('content')
@include('layouts.templates.topbar')
<div class="container-fluid mt--7">
    <div class="card" style="margin-top: 12%;">
        <div class="card-body">
            @if (\Session::has('notification'))
                @include('layouts.templates.notification', [
                    'success' => \Session::get('success'),
                    'message' => \Session::get('notification'),
                    'alert_class' => \Session::get('success') == true ?
                    'alert alert-success alert-dismissible fade show' :
                    'alert alert-danger alert-dismissible fade show'
                ])
            @endif

            <h1 class="card-title">Listado # {{$listing->id}} - {{$listing->date}}</h1>

            <!-- <div id="example_div" data-listing-id="{{$listing->id}}"></div> -->
            <div class="row">
                <div class="form-group col-2">
                    <select class="form-control" name="search_type">
                        <option value="medicines">
                            Medicamento
                        </option>
                        <option value="needs">
                            Necesidad
                        </option>
                        <option value="diseases">
                            Enfermedad
                        </option>
                    </select>
                </div>
                <div class="d-flex form-group col-10">
                    <input
                        class="form-control"
                        type="search"
                        name="search"
                        id="search"
                        placeholder="Escribe lo que quieras buscar y presiona la tecla 'Enter'"
                    >
                </div>
                @include('layouts.templates.forms.add-listing-users', [])
            </div>
            <div id="jsGrid"></div>
        </div>
    </div>
</div>

@endsection

@push('js')
<!-- <script src="/js/app.js"></script> -->
<!-- <script type="text/javascript" src="/tabulator/js/tabulator.js"></script> -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jsgrid/1.5.3/jsgrid.min.js"></script>
<script type="text/javascript" src="/js/listing.js"></script>
<script type="text/javascript">
    const inscribedUsers = {!! json_encode($inscribedUsers) !!}

    $("#jsGrid").jsGrid({
        width: "100%",
        height: "400px",
        editing: true,
        sorting: true,
        paging: true,
        data: inscribedUsers,
        fields: [
            { name: "name", type: "text" },
            { name: "surname", type: "text" },
            { name: "cicpc_id", type: "text" },
            { name: "disease_name", type: "text" },
            { name: "email", type: "text" },
            { name: "identification", type: "text" },
            { type: "control" },
        ],
    });
</script>
@endpush