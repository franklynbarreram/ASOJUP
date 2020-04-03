<div class="modal fade" id="disease-form" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
    <div class="modal-dialog modal- modal-dialog-centered modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-body p-0">
                <div class="card bg-secondary border-0 mb-0">
                    <div class="card-header bg-transparent">
                        <h1 class="text-center">Crear Enfermedad</h1>
                    </div>

                    <div class="card-body px-lg-5 py-lg-5">
                        <form id="cust-form" role="form">
                            {{ csrf_field() }}

                            <div class="form-group mb-3">
                                <div class="input-group input-group-merge input-group-alternative">
                                    <input class="form-control" name="name" type="text" placeholder="Nombre" id="disease_name">
                                </div>
                            </div>

                            <div class="form-group mb-3">
                                <div class="input-group input-group-merge input-group-alternative">
                                    <input class="form-control" placeholder="Descripción" name="description" type="text" id="desc">
                                </div>
                            </div>

                            <div class="text-center">
                                <button id="btn-submit-disease" type="button" class="btn btn-success my-4">
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
    let btn_submit_disease = $("#btn-submit-disease");

    btn_submit_disease.click('on', function () {

        let name = $("#disease_name").val();
        let description = $("#desc").val();

        let post_body = {
            name: name,
            description: description,
            need_type_id: 1
        };
        
        let token = $( "input[name='_token']" ).val();
        let url = {!! json_encode($url_create_disease) !!}

        $.ajax({
            headers: {'X-CSRF-TOKEN': token},
            type: 'POST',
            url: url,
            data: post_body,

            success: function (response) {
                console.log(response);

                //Adding new option as the response is true
                let select2 = $("#diseases-sel");

                let data = {
                    id: response.data.id,
                    text: response.data.name
                };

                var newOption = new Option(data.text, data.id, false, false);
                
                select2.append(newOption).trigger('change');
                
                document.getElementById("disease-form").click(); // Click outside the modal
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