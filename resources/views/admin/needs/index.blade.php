@extends('layouts.app')

@section('content')
    @include('layouts.templates.topbar')
  
    <div class="container-fluid mt--7">
        <div class="card" style="margin-top: 12%;">
            <div class="card-body">

                @include('layouts.templates.card-search-header', [
                    'title' =>  $title,
                    'search_route'  =>  'needs.index',
                    'create_route'  =>  'needs.create',
                    'extra_params' =>  ['type' =>  $type_id]
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
                                    <th scope="col">ID</th>
                                    <th scope="col">Nombre</th>
                                    <th scope="col">Descripción</th>
                                    <th class="text-center" scope="col">Opciones</th>
                                </tr>
                            </thead>

                            <tbody class="list">
                                @foreach ($needs as $n)
                                <tr>
                                    <td> # {{$n->id}} </td>
                                    
                                    <td> {{$n->name}} </td>

                                    <td> {{$n->description }}</td>

                                    <td class="options-td">
                                        <a href="{{route('needs.edit', $n->id)}}" name="Editar">
                                            <i class="fas fa-edit"></i>
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