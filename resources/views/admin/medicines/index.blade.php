@extends('layouts.app')

@section('content')
    @include('layouts.templates.topbar')
  
    <div class="container-fluid mt--7">
        <div class="card" style="margin-top: 12%;">
            <div class="card-body">

                @include('layouts.templates.card-search-header', [
                    'title' =>  'Listado de Medicamentos',
                    'search_route'  =>  'medicines.index',
                    'create_route'  =>  'medicines.create'
                ])

                <div class="table-responsive">
                    <div>
                        <table class="table align-items-center">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col" class="sort" data-sort="name">Nombre</th>
                                    <th scope="col" class="sort" data-sort="budget">Cantidad <small>(caja)</small></th>
                                    <th scope="col" class="sort" data-sort="completion">Presentación</th>
                                    <th scope="col" class="sort" data-sort="status">Concentracion</th>
                                    <th scope="col">Opciones</th>
                                </tr>
                            </thead>

                            <tbody class="list">
                                @foreach ($medicines as $m)
                                    <tr>
                                        <td> {{$m->name}} </td>

                                        <td> {{$m->box_quantity}} </td>

                                        <td> {{$m->presentation}} </td>

                                        <td> {{$m->fullUnits}} </td>

                                        <td class="options-td">
                                            <a href="{{route('medicines.edit', $m->id)}}" name="Editar">
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

@push('js')
<script type="text/javascript">
    let sidebar_link = document.getElementById('medicine-link');
    //sidebar_link.classList.remove('collapsed');
    //sidebar_link.attributes[5] = true;
    console.log(sidebar_link);

</script>
@endpush