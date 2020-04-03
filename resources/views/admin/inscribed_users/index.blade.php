@extends('layouts.app')

@section('content')
    @include('layouts.templates.topbar')
  
    <div class="container-fluid mt--7">
        <div class="card" style="margin-top: 12%;">
            <div class="card-body">

                @include('layouts.templates.card-search-header', [
                    'title' =>  'Listado de Inscritos',
                    'search_route'  =>  'inscribedUsers.index',
                    'create_route'  =>  'inscribedUsers.create'
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
                                    <th scope="col">Nomnre</th>
                                    <th scope="col">Apellido</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Cédula</th>
                                    <th scope="col">Teléfono</th>
                                    <th class="text-center" scope="col">Opciones</th>
                                </tr>
                            </thead>

                            <tbody class="list">
                                @foreach ($inscribed_users as $iu)
                                    <tr>
                                        <td> {{$iu->name}} </td>

                                        <td> {{$iu->surname}} </td>

                                        <td> {{$iu->email}} </td>

                                        <td> {{$iu->identification}} </td>

                                        <td> {{$iu->phone}} </td>

                                        <td class="options-td">
                                            <a href="{{route('inscribedUsers.edit', $iu->id)}}" name="Editar">
                                                <i class="fas fa-edit"></i>
                                            </a>

                                            <a href="{{route('inscribedUsers.edit', $iu->id)}}" name="Editar">
                                                <i class="fas fa-eye text-green"></i>
                                            </a>

                                            <a href="" name="Eliminar">
                                                <i class="fas fa-trash text-red"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>       
    </div>
@endsection

@push('js')
<script type="text/javascript">
    let sidebar_link = document.getElementById('inscribed-users-link');
    sidebar_link.classList.remove('collapsed');
    sidebar_link.setAttribute('aria-expanded', true);

    let sidebar_options = document.getElementById('inscribed-users-options');
    sidebar_options.classList.add('show');
</script>
@endpush