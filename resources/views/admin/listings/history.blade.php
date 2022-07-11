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
                    'listingId' => $listing->id
                ])
            </div>
            <div id="jsGrid"></div>
            <div class="row d-flex justify-content-center">
                <button id="submit-listing" class="btn btn-success">
                    Guardar Listado
                </button>
                <a id="submit-listing" class="btn btn-success" href="{{route('generatePDF', $listing->id)}}">
                    Descargar PDF
                </a>
            </div>
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

    let inscribedUsers = {!! json_encode($inscribedUsers) !!} || []
    let listing = {!! json_encode($listing) !!}
    let token = $( "input[name='_token']" ).val();

    console.log({ inscribedUsers })

    // JS Grid table
    $("#jsGrid").jsGrid({
        width: "100%",
        height: "400px",
        editing: true,
        sorting: true,
        paging: true,
        data: inscribedUsers || [],
        fields: [
            { name: "identification", type: "text", title:"Cedula" },
            { name: "name", type: "text", title: "Nombre" },
            { name: "surname", type: "text", title: "Apellido" },
            { name: "item_name", type: "text", title: "Requerimiento" },
            { name: "requirement_type", type: "text", title: "Tipo" },
            { type: "control" },
        ],
    });

    const typeSelector = document.getElementById('search_type');

    // Key event listener for search input
    document.getElementById("search").addEventListener("keypress", function (e) {
        if (e.key !== "Enter") {
            return;
        }

        const searchValue = this.value;

        const jsGridData = $("#jsGrid").jsGrid("option", "data") ?? [];

        $.ajax({
            // headers: { "X-CSRF-TOKEN": token },
            type: "GET",
            url: "http://localhost:8000/listings/users/table",
            data: {
                listingId: listing.id,
                type: typeSelector.value,
                searchValue: searchValue,
                selectedUsers: inscribedUsers || [],
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
    const handleInputClick = (checkboxElement) => {
        const inscribedUserId = checkboxElement.dataset.userId;
        const existentIndex = inscribedUsers.findIndex((inscribed) => inscribed.user_id === inscribedUserId)

        const item  = {
            identification: checkboxElement.dataset.userIdentification,
            name: checkboxElement.dataset.userName,
            surname: checkboxElement.dataset.userSurname,
            item_name: checkboxElement.dataset.userItem_name,
            item_id: checkboxElement.dataset.userItem_id,
            requirement_type: checkboxElement.dataset.userRequirement_type,
            user_id: inscribedUserId,
        }

        if (existentIndex > -1) {
            inscribedUsers.splice(existentIndex, 1)
        } else {
            inscribedUsers.push(item)
        }

        $("#jsGrid").jsGrid("option", "data", inscribedUsers);
    }

    const submitTableButton = document.getElementById('inscribed-users-listing-form-submit');

    submitTableButton.onclick = () => {
        $("#listing-users-form").modal("hide");
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