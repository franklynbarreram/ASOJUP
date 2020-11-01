@extends('layouts.app')

@section('content')
@include('layouts.templates.topbar')

<div class="container-fluid mt--7">
    <div class="card" style="margin-top: 12%;">
        <div class="card-body">

            @include('layouts.templates.card-search-header', [
                'title' => 'Listado de Delegados',
                'search_route' => 'delegates.index',
                'create_route' => 'delegates.create'
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

                                  <!--   <form action="{{route('delegates.destroy', $d->id)}}" method="POST"> 
                                        {{ csrf_field() }}
                                        {{method_field('DELETE')}}-->

                                        <button type="submit" id="btn-delete" data-toggle="modal" data-target="#eliminarDelegado"
                                        data-id="{{$d->id}}">
                                            <i class="fas fa-trash text-red"></i>
                                        </button>
                                  <!--   </form> -->
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
<div class="modal fade" id="eliminarDelegado" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Eliminar Delegado</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="formEliminarDelegado" action="{{url('delegates/eliminar')}}" method="POST" >
                {{ csrf_field() }}
                   
                    

                   
                    <div class="form-row">
                        
                        <p>¿Desea eliminar el delegado?</p>
                      
                        <input type="hidden" name="id_delegado" id="id_destroy_delegado">
                    </div>




                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                        <button type="submit" id="" class="btn btn-primary"  >Eliminar delegado</button>
                    </div>
                </form>
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


     $('#eliminarDelegado').on('show.bs.modal',function(event){
        
        var button = $(event.relatedTarget);
        var id = button.data('id');

        var modal = $(this);
        modal.find('#id_destroy_delegado').val(id);
     });            
</script>
@endpush