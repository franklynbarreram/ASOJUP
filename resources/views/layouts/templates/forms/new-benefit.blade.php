<div class="modal fade" id="benefits-form" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
    <div class="modal-dialog modal- modal-dialog-centered modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-body p-0">
                <div class="card bg-secondary border-0 mb-0">
                    <div class="card-header bg-transparent">
                        <h1 class="text-center">Crear Solicitud Especial</h1>
                    </div>

                    <div class="card-body px-lg-5 py-lg-5">
                        <form id="cust-form" role="form">
                            {{ csrf_field() }}

                            <div class="form-group mb-3">
                                <div class="input-group input-group-merge input-group-alternative">
                                    <input class="form-control" name="name" type="text" placeholder="Nombre" id="benefit_name">
                                </div>
                            </div>

                            <div class="form-group mb-3">
                                <div class="input-group input-group-merge input-group-alternative">
                                    <input class="form-control" placeholder="Descripción" name="description" type="text" id="description">
                                </div>
                            </div>

                            <div class="text-center">
                                <button id="btn-submit-benefit" type="button" class="btn btn-success my-4">
                                    Crear
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

@push('js')
<script type="text/javascript">
    let btn_submit_benefit = $("#btn-submit-benefit");

    btn_submit_benefit.click('on', function () {

        let name = $("#benefit_name").val();
        let description = $("#description").val();

        let post_body = {
            name: name,
            description: description,
            need_type_id: 2
        };

        console.log(post_body);
        
        let token = $( "input[name='_token']" ).val();
        let url = {!! json_encode($url_create_benefit) !!}

        $.ajax({
            headers: {'X-CSRF-TOKEN': token},
            type: 'POST',
            url: url,
            data: post_body,

            success: function (response) {
                console.log(response);

                //Adding new option as the response is true
                let select2 = $("#benefits-sel");

                let data = {
                    id: response.data.id,
                    text: response.data.name
                };

                var newOption = new Option(data.text, data.id, false, false);
                
                select2.append(newOption).trigger('change');
                
                document.getElementById("benefits-form").click(); // Click outside the modal
                document.getElementById("success-modal-btn").click(); //Click the success modal triggers
            },

            error: function (XMLHttpRequest, textStatus, errorThrown) {
                console.log(XMLHttpRequest);
                console.log("Status: " + textStatus); 
                console.log("Error: " + errorThrown);
            }
        });
    });
</script>
@endpush