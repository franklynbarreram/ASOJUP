@extends('layouts.app')

@section('content')
@include('layouts.templates.topbar')

<div class="container-fluid mt--7">
    <div class="card" style="margin-top: 12%;">
        <div class="card-body">

            @include('layouts.templates.card-search-header', [
                'title' => 'Listado de Delegados',
                'search_route' => 'delegates.index',
                'create_route' => 'register'
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

            <div class="table-responsive">
                <div>
                    <table class="table align-items-center">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col" class="sort" data-sort="name">Nombre</th>
                                <th scope="col" class="sort" data-sort="completion">Email</th>
                                <th scope="col" class="sort" data-sort="status">Zona</th>
                                <th scope="col" class="text-center">Opciones</th>
                            </tr>
                        </thead>

                        <tbody class="list">
                            @foreach ($delegates as $d)
                            <tr>
                                <td> {{$d->name}} </td>

                                <td> {{$d->email}} </td>

                                <td> {{$d->zone->name}} </td>

                                <td class="options-td">
                                    <a href="{{route('delegates.edit', $d->id)}}" name="Editar">
                                        <i class="fas fa-edit"></i>
                                    </a>

                                    <form action="{{route('delegates.destroy', $d->id)}}" method="POST">
                                        {{ csrf_field() }}
                                        {{method_field('DELETE')}}
                                        
                                        <button type="submit" id="btn-delete">
                                            <i class="fas fa-trash text-red"></i>
                                        </button>
                                    </form>
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

    let sidebar_link = document.getElementById('delegates-link');
    sidebar_link.classList.remove('collapsed');
    sidebar_link.setAttribute('aria-expanded', true);

    let sidebar_options = document.getElementById('delegates-options');
    sidebar_options.classList.add('show');

</script>
@endpush