<div class="modal fade" id="medicine-form" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
    <div class="modal-dialog modal- modal-dialog-centered modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-body p-0">
                <div class="card bg-secondary border-0 mb-0">
                    <div class="card-header bg-transparent">
                        <h1 class="text-center">Crear Medicina</h1>
                    </div>

                    <div class="card-body px-lg-5 py-lg-5">
                        <form id="cust-form" role="form">
                            {{ csrf_field() }}

                            <div class="form-group mb-3">
                                <div class="input-group input-group-merge input-group-alternative">
                                    <input class="form-control" name="name" type="text" placeholder="Nombre" id="medicine_name">
                                </div>
                            </div>

                            <div class="form-group mb-3">
                                <div class="input-group input-group-merge input-group-alternative">
                                    <input class="form-control" placeholder="Cantidad por caja" name="box_quantity" type="number" id="box_quantity">
                                </div>
                            </div>

                            <div class="form-group mb-3">
                                <div class="input-group input-group-merge input-group-alternative">
                                    <select class="form-control" name="medicine_form_id" id="medicine_form_id">
                                        <option value="none" disabled selected>Presentación Medicinal</option>
                                        @foreach ($med_forms as $md)
                                            <option value="{{$md->id}}">{{$md->name}} ({{$md->short_name}})</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group mb-3">
                                <div class="input-group input-group-merge input-group-alternative">
                                    <input class="form-control" name="concentration" type="number" placeholder="Concentración" id="concentration">
                                </div>
                            </div>

                            <div class="form-group mb-3">
                                <div class="input-group input-group-merge input-group-alternative">
                                    <select class="form-control" name="medicine_unit_id" id="medicine_unit_id">
                                        <option value="none" disabled selected>Unidad de Medida</option>
                                        @foreach ($med_units as $md)
                                            <option value="{{$md->id}}">{{$md->name}} ({{$md->short_name}})</option>
                                        @endforeach
                                    </select>
                                </div>  
                            </div>

                            <div class="text-center">
                                <button id="btn-submit-medicine" type="button" class="btn btn-success my-4">
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
    let btn_submit_medicine = $("#btn-submit-medicine");

    btn_submit_medicine.click('on', function () {

        let name = $("#medicine_name").val();
        let concentration = $("#concentration").val();
        let box_quantity = $("#box_quantity").val();

        //Select values
        let medicine_form_id = $("#medicine_form_id option:selected").val();
        let medicine_unit_id = $("#medicine_unit_id option:selected").val();

        let post_body = {
            name: name,
            concentration: concentration,
            box_quantity: box_quantity,
            medicine_form_id: medicine_form_id,
            medicine_unit_id: medicine_unit_id
        };
        
        let token = $( "input[name='_token']" ).val();
        let url = {!! json_encode($url_create_medicine) !!}

        $.ajax({
            headers: {'X-CSRF-TOKEN': token},
            type: 'POST',
            url: url,
            data: post_body,

            success: function (response) {
                //Adding new option as the response is true
                let select2 = $("#medicines-sel");

                let data = {
                    id: response.data.id,
                    text: response.data.name
                };

                var newOption = new Option(data.text, data.id, false, false);
                
                select2.append(newOption).trigger('change');
                
                document.getElementById("medicine-form").click(); // Click outside the modal
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