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
                                    <th scope="col">Activo</th>
                                    <th scope="col">Nombre</th>
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
                                        <td>
                                            <input 
                                                type="checkbox" 
                                                name="" 
                                                id="check-user-{{$iu->id}}" 
                                                disabled
                                                @if($iu->active)
                                                    checked
                                                @endif
                                            >
                                        </td>

                                        <td> {{$iu->name}} </td>

                                        <td> {{$iu->surname}} </td>

                                        <td> {{$iu->email}} </td>

                                        <td> {{$iu->identification}} </td>

                                        <td> {{$iu->phone}} </td>

                                        <td class="options-td">
                                            <a href="{{route('inscribedUsers.edit', $iu->id)}}" name="Editar">
                                                <i 
                                                    class="fas fa-edit"
                                                    data-toggle="tooltip"
                                                    data-placement="top"
                                                    title="Editar">
                                                </i>
                                            </a>

                                            <a href="{{route('survivors.index', ['inscribed_id' => $iu->id])}}" name="Editar">
                                                <i 
                                                    class="fas fa-users text-green"
                                                    data-toggle="tooltip"
                                                    data-placement="top"
                                                    title="Sobrevivientes">
                                                </i>
                                            </a>

                                            <a onClick="setFormValues({{$iu->id}})" data-toggle="modal" data-target="#inhabilitate-form">
                                                <i 
                                                    class="fas fa-user-slash text-red"
                                                    data-toggle="tooltip"
                                                    data-placement="top"
                                                    title="Inhabilitar Usuario">
                                                </i>
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

    <!-- Modal Form -->
    <div class="modal fade" id="inhabilitate-form" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
        <div class="modal-dialog modal- modal-dialog-centered modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-body p-0">
                    <div class="card bg-secondary border-0 mb-0">

                        <div class="card-header bg-transparent">
                            <h1 class="text-center">Inhabilitar Inscrito</h1>
                        </div>
    
                        <div class="card-body px-lg-2 py-lg-2">
                            <h3 class="text-center">
                                Al realizar esta acción, el inscrito quedará dado de baja.
                            </h3>

                            <p class="text-center">
                                <small >
                                    Deberás registrar sobrevivientes luego de esto.
                                </small>
                            </p>

                            <form id="cust-form" role="form">
                                {{ csrf_field() }}
                                {{ method_field('PUT') }}

                                <input type="hidden" id="post_url" name="post_url" value="{{url('inscribedUsers/inhabilitate/')}}">

                                <div class="text-center">
                                    <button id="btn-submit" type="button" class="btn btn-success my-4">
                                        De acuerdo
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('layouts.templates.notifications.success-modal', [
        'message'   =>  'Se ha inhabilitado al inscrito satisfactoriamente.'
    ])
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

    var post_url = document.getElementById('post_url').value;
    var new_post = '';

    function setFormValues (inscribed_id) {
        new_post = '';
        new_post = post_url + '/' + inscribed_id;
    }

    //Manage click event
    let btn_submit = document.getElementById('btn-submit');

    btn_submit.onclick = function () {
        console.log(new_post);

        let token = $( "input[name='_token']" ).val();
        
        $.ajax({
            headers: {'X-CSRF-TOKEN': token},
            type: 'PUT',
            url: new_post,

            success: function (response) {
                console.log(response);

                document.getElementById('check-user-' + response.data.id).checked = false;

                document.getElementById("inhabilitate-form").click(); // Click outside the modal
                document.getElementById("success-modal-btn").click(); //Click the success modal triggers
            },

            error: function (XMLHttpRequest, textStatus, errorThrown) {
                console.log(XMLHttpRequest);
                console.log("Status: " + textStatus); 
                console.log("Error: " + errorThrown);
            }
        });
        
    }
</script>
@endpush