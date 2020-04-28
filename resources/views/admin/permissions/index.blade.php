@extends('layouts.app')

@section('content')
@include('layouts.templates.topbar')

<div class="container-fluid mt--7">
    <div class="card" style="margin-top: 12%;">
        <div class="card-body">

            @include('layouts.templates.card-search-header', [
                'title' => 'Listado de Permisos',
            ])

            @if (\Session::has('notification'))
                @include('layouts.templates.notification', [
                    'success' => \Session::get('success'),
                    'message' => \Session::get('notification'),
                    'alert_class' => \Session::get('success') == true ?
                    'alert alert-success alert-dismissible fade show' :
                    'alert alert-danger alert-dismissible fade show'
                ])
            @endif

            @if (Auth::user()->role_id != 1)
                <a class="mt-0" href="{{route('permissions.create')}}">Solicitar Permiso</a>
            @endif

            <div class="table-responsive mt-3">
                <div>
                    <table class="table align-items-center">
                        <thead class="thead-light">
                            <tr>
                                @if (Auth::user()->role_id == 1)
                                    <th scope="col" class="sort" data-sort="name">Delegado</th>
                                @endif

                                <th scope="col" class="sort" data-sort="completion">Descripción</th>
                                <th scope="col" class="sort" data-sort="status">Status</th>
                                <th>Fecha de Creación</th>

                                @if (Auth::user()->role_id == 1)
                                    <th scope="col" class="text-center">Opciones</th>
                                @endif
                            </tr>
                        </thead>

                        <tbody class="list">
                            @foreach ($permissions as $p)
                            <tr>
                                @if (Auth::user()->role_id == 1)
                                    <td id="name-{{$p->id}}">
                                        {{$p->user->name}}
                                    </td>
                                @endif

                                <td id="description-{{$p->id}}"> {{$p->description}} </td>

                                <td> {{$p->status}} </td>

                                <td> {{$p->created_at}} </td>

                                @if (Auth::user()->role_id == 1)
                                    <td class="options-td">
                                        <a
                                            href="{{route('permissions.edit', $p->id)}}" 
                                            data-toggle="modal" 
                                            data-target="#permission-form"
                                            data-perm-id="{{$p->id}}"
                                            id="perm-{{$p->id}}"
                                            onclick="setModalData(this)"
                                        >
                                            <i class="fas fa-edit"></i>
                                        </a>

                                        @if ($p->status == 'Aprobado')
                                            <form action="{{route('permissions.destroy', $p->id)}}" method="POST">
                                                {{ csrf_field() }}
                                                {{method_field('DELETE')}}
        
                                                <button type="submit" id="btn-delete">
                                                    <i class="fas fa-trash text-red"></i>
                                                </button>
                                            </form>
                                        @endif
                                    </td>
                                @endif
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Disease Form -->
@include('layouts.templates.forms.update-permission', [
    'url_create_benefit'   =>  url('needs/ajax/store'),
])

@endsection

@push('js')
<script type="text/javascript">

    function setModalData (e) {
        let perm_id = e.dataset.permId;

        let modal_name = document.getElementById('name-' + perm_id);
        let modal_desc = document.getElementById('description-' + perm_id);

        document.getElementById('modal-name').innerText = modal_name.innerText;
        document.getElementById('modal-description').innerText = modal_desc.innerText;

        let form = document.getElementById('cust-form');

        form.action = 'http://localhost:8000/permissions/' + perm_id;
    }

    function sendForm (status) {
        let status_input = document.getElementById('status_input');

        status_input.value = status;

        let form = document.getElementById('cust-form');

        form.submit();
    }

</script>
@endpush