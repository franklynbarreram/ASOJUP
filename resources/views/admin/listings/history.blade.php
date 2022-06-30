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
                    <select class="form-control" name="search_type" id="search_type">
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
                @include('layouts.templates.forms.add-listing-users', [
                    
                ])
            </div>

            @if(count($inscribedUsers) == 0)
                <h1 class="text-center mt-2 mb-2">No hay datos para mostrar</h1>
                <h5 class="text-center">Puedes buscar y seleccionar a los inscritos que quieras agregar para guardar el listado</h5>
            @else
                <div id="jsGrid"></div>
                <div class="row d-flex justify-content-center">
                    <button id="submit-listing" class="btn btn-success">
                        Guardar Listado
                    </button>
                </div>
            @endif
        </div>
    </div>
</div>

@endsection

@push('js')
<!-- <script src="/js/app.js"></script> -->
<!-- <script type="text/javascript" src="/tabulator/js/tabulator.js"></script> -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jsgrid/1.5.3/jsgrid.min.js"></script>
<script type="text/javascript">
    const sidebarLink = document.getElementById("listing-link");
    sidebarLink.classList.remove("collapsed");
    sidebarLink.setAttribute("aria-expanded", true);

    const sidebarOptions = document.getElementById("listing-options");
    sidebarOptions.classList.add("show");

    const inscribedUsers = {!! json_encode($inscribedUsers) !!}
    const listing = {!! json_encode($listing) !!}
    let token = $( "input[name='_token']" ).val();

    // JS Grid table
    $("#jsGrid").jsGrid({
        width: "100%",
        height: "400px",
        editing: true,
        sorting: true,
        paging: true,
        data: inscribedUsers,
        fields: [
            { name: "identification", type: "text" },
            { name: "name", type: "text" },
            { name: "surname", type: "text" },
            { name: "email", type: "text" },
            { name: "cicpc_id", type: "text" },
            { name: "item_name", type: "text" },
            { name: "requirement_type", type: "text" },
            { type: "control" },
        ],
    });

    const typeSelector = document.getElementById('search_type');

    // Key event listener for search input
    document.getElementById("search").addEventListener("keypress", (e) => {
        if (e.key !== "Enter") {
            return;
        }

        $.ajax({
            // headers: { "X-CSRF-TOKEN": token },
            type: "GET",
            url: "http://localhost:8000/listings/users/table",
            data: {
                listingId: listing.id,
                type: typeSelector.value,
            },
            success: (response) => {
                // Directly inject the dynamic html output
                $("#users-list").html(response);
                $("#listing-users-form").modal("show");
            },
            error: (XMLHttpRequest, textStatus, errorThrown) => {
                console.log(XMLHttpRequest);
                console.error({ textStatus, errorThrown });
            },
        });
    });

    // Handle modal user lists item selection
    let inscribedIdsInput = document.getElementById('inscribedIds');
    let ids = inscribedIdsInput.value || [];

    const handleInputClick = (checkboxElement) => {
        const inscribedUserId = checkboxElement.dataset.userId;
        const index = ids.indexOf(inscribedUserId)

        if (index > -1) {
            ids.splice(index, 1)
        } else {
            ids.push(inscribedUserId)
        }

        inscribedIdsInput.value = ids;
    }

    // Submit listing handler
    const submitListingButton = document.getElementById('submit-listing');

    if (submitListingButton) {
        submitListingButton.onclick = () => {
            const gridData = $("#jsGrid").jsGrid("option", "data");

            $.ajax({
                headers: { "X-CSRF-TOKEN": token },
                type: "PUT",
                url: `http://localhost:8000/listings/history/${listing.id}/users`,
                data: {
                    data: JSON.stringify(gridData),
                    listingId: listing.id,
                },
                success: (response) => {
                    console.log(response)
                },
                error: (XMLHttpRequest, textStatus, errorThrown) => {
                    console.log(XMLHttpRequest);
                    console.error({ textStatus, errorThrown });
                },
            });
        }
    }
</script>
@endpush