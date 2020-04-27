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
                <a class="mt-0" href="">Solicitar Permiso</a>
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
                                <th>Fecha de Modificación</th>

                                @if (Auth::user()->role_id == 1)
                                    <th scope="col" class="text-center">Opciones</th>
                                @endif
                            </tr>
                        </thead>

                        <tbody class="list">
                            @foreach ($permissions as $p)
                            <tr>
                                @if (Auth::user()->role_id == 1)
                                    <td>
                                        {{$p->user_id}}
                                    </td>
                                @endif

                                <td> {{$p->description}} </td>

                                <td> {{$p->status}} </td>

                                <td> {{$p->created_at}} </td>

                                <td> {{$p->updated_at}} </td>

                                @if (Auth::user()->role_id == 1)
                                    <td class="options-td">
                                        <a href="{{route('permissions.edit', $p->id)}}" name="Editar">
                                            <i class="fas fa-edit"></i>
                                        </a>

                                        <form action="{{route('permissions.destroy', $p->id)}}" method="POST">
                                            {{ csrf_field() }}
                                            {{method_field('DELETE')}}
                                            
                                            <button type="submit" id="btn-delete">
                                                <i class="fas fa-trash text-red"></i>
                                            </button>
                                        </form>
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
@endsection