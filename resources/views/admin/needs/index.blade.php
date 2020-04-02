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

                                        <button type="button" id="btn-delete" data-toggle="modal" data-type="{{$type_id}}"data-id="{{$n->id}}" data-target="#exampleModal">
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
                <h5 class="modal-title" id="exampleModalLabel">Eliminar Enfermedad</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="/needs/eliminar" method="post">
            {{csrf_field()}}
            <div class="modal-body">
                ¿Esta seguro de eliminar esta Enfermedad?
                <input type="hidden" class="form-control" id="id-delete" name="id">
                <input type="hidden" class="form-control" id="id-type" name="type">
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
   

    $('#myModal').on('shown.bs.modal', function() {
        $('#myInput').trigger('focus')
    });
    $('#exampleModal').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget) // Button that triggered the modal
        var recipient = button.data('id') // Extract info from data-* attributes
        var r2= button.data('type');
        // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
        // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
        var modal = $(this)
        modal.find('#id-type').val(r2)
        modal.find('#id-delete').val(recipient)
    });
    
</script>
@endpush