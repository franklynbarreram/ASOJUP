@extends('layouts.app')

@section('content')
    @include('layouts.templates.topbar')
  
    <div class="container-fluid mt--7">
        <div class="card" style="margin-top: 12%;">
            <div class="card-body">

                @include('layouts.templates.card-search-header', [
                    'title' =>  'Listado de Unidades de Concentración',
                    'search_route'  =>  'units.index',
                    'create_route'  =>  'units.create'
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
                                    <th scope="col">Abreviación</th>
                                    <th class="text-center" scope="col">Opciones</th>
                                </tr>
                            </thead>

                            <tbody class="list">
                                @foreach ($units as $u)
                                <tr>
                                    <td> # {{$u->id}} </td>
                                    
                                    <td> {{$u->name}} </td>

                                    <td> {{$u->short_name}} </td>

                                    <td class="options-td">
                                        <a href="{{route('units.edit', $u->id)}}" name="Editar">
                                            <i class="fas fa-edit"></i>
                                        </a>

                                        <button type="button" id="btn-delete" data-toggle="modal" data-id="{{$u->id}}" data-target="#exampleModal">
                                    <i class="fas fa-trash text-red"></i>
                                    </button>
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
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Eliminar Unidad de Medida</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="/units/eliminar" method="post">
            {{csrf_field()}}
            <div class="modal-body">
                ¿Esta seguro de eliminar esta Unidad de medida?
                <input type="hidden" class="form-control" id="id-delete" name="id">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                <button type="submit" class="btn btn-primary">Si</button>
            </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('js')
<script type="text/javascript">
    let sidebar_link = document.getElementById('medicine-link');
    sidebar_link.classList.remove('collapsed');
    sidebar_link.setAttribute('aria-expanded', true);

    let sidebar_options = document.getElementById('medicines-options');
    sidebar_options.classList.add('show');
    $('#myModal').on('shown.bs.modal', function() {
        $('#myInput').trigger('focus')
    });
    $('#exampleModal').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget) // Button that triggered the modal
        var recipient = button.data('id') // Extract info from data-* attributes
        // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
        // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
        var modal = $(this)
      
        modal.find('#id-delete').val(recipient)
    })
</script>
@endpush