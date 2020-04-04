@extends('layouts.app')

@section('content')
    @include('layouts.templates.topbar')
  
    <div class="container-fluid mt--7">
        <div class="card" style="margin-top: 12%;">
            <div class="card-body">

                @include('layouts.templates.card-search-header', [
                    'title' =>  'Listado de Sobrevivientes: ' . $inscribed->fullName,
                    'search_route'  =>  'survivors.index',
                    'create_route'  =>  'survivors.create',
                    'extra_params'  =>  [
                        'inscribed_id'  =>  $inscribed->id
                    ]
                ])

                @if (\Session::has('notification'))
                    @include('layouts.templates.notification', [
                        'success'   =>  \Session::get('success'),
                        'message'   =>  \Session::get('notification'),
                        'alert_class'   =>  \Session::get('success') == true ? 
                            'alert alert-success alert-dismissible fade show' :
                            'alert alert-danger alert-dismissible fade show'
                    ])
                @endif

                <div class="table-responsive">
                    <div>
                        <table class="table align-items-center">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col">Nombre</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Cédula</th>
                                    <th scope="col">Teléfono</th>
                                    <th scope="col">Dirección</th>
                                    <th class="text-center" scope="col">Opciones</th>
                                </tr>
                            </thead>

                            <tbody class="list">
                                @foreach ($inscribed->survivors as $s)
                                    <tr>
                                        <td> {{$s->fullName}} </td>

                                        <td> {{$s->email}} </td>

                                        <td> {{$s->identification}} </td>

                                        <td> {{$s->phone}} </td>

                                        <td> {{$s->address}} </td>

                                        <td class="options-td">
                                            <a href="{{route('survivors.edit', $s->id)}}" name="Editar">
                                                <i 
                                                    class="fas fa-edit"
                                                    data-toggle="tooltip"
                                                    data-placement="top"
                                                    title="Editar">
                                                </i>
                                            </a>

                                            <a href="">
                                                <i 
                                                    class="fas fa-trash text-red"
                                                    data-toggle="tooltip"
                                                    data-placement="top"
                                                    title="Eliminar">
                                                </i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="row">
                    <a class="btn btn-danger mt-5" href="{{route('inscribedUsers.index')}}">
                        Regresar
                    </a>
                </div>
            </div>
        </div>       
    </div>
@endsection

@push('js')
<script type="text/javascript">
    //Showing sidebar options
    let sidebar_link = document.getElementById('inscribed-users-link');
    sidebar_link.classList.remove('collapsed');
    sidebar_link.setAttribute('aria-expanded', true);

    let sidebar_options = document.getElementById('inscribed-users-options');
    sidebar_options.classList.add('show');
    //---
</script>
@endpush