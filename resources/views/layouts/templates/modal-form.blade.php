<div class="modal fade" id="{{$modal_id}}" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
    <div class="modal-dialog modal- modal-dialog-centered modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-body p-0">
                <div class="card bg-secondary border-0 mb-0">
                    <div class="card-header bg-transparent">
                        <h1 class="text-center">{{$title}}</h1>
                    </div>

                    <div class="card-body px-lg-5 py-lg-5">
                        <form id="cust-form" role="form">
                            {{ csrf_field() }}
                            @foreach ($form_values as $fv)
                                <div class="form-group mb-3">
                                    <div class="input-group input-group-merge input-group-alternative">
                                        @if($fv['type'] != 'select')
                                            <input 
                                                class="form-control"
                                                name="{{$fv['name']}}"
                                                placeholder="{{$fv['placeholder']}}"
                                                type="{{$fv['type']}}"
                                                id="{{$fv['name']}}"
                                            >
                                        @else
                                        <select class="form-control" id="{{$fv['name']}}" name="{{$fv['name']}}">
                                            <option value="none" selected disabled>{{$fv['placeholder']}}</option>

                                            @foreach($fv['options'] as $opt)
                                                <option value="{{$opt['id']}}">
                                                    {{$opt['name']}} ({{$opt['short_name']}}) 
                                                </option>
                                            @endforeach

                                            </select>
                                        @endif

                                    </div>
                                </div>
                            @endforeach

                            <div class="text-center">
                                <button id="{{$button_id}}" type="button" class="btn btn-success my-4">Crear</button>
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
    let url_medicine = document.getElementById('url_medicine').value;

    console.log(url_medicine);

    let select2_id = {!! json_encode($select2_id) !!}
    let modal_id = {!! json_encode($modal_id) !!}
    let button_id = {!! json_encode($button_id) !!}

    let btn_submit = $("#" + button_id);

    btn_submit.click('on', function () {

        let post_body;

        if (this.id == 'btn-submit-benefit') {

            let name = $("#medicine_name").val();
            let description = $("#description").val();
            let concentration = $("#concentration").val();
            let box_quantity = $("#box_quantity").val();

            //Select values
            let medicine_form_id = $("#medicine_form_id option:selected").val();
            let medicine_unit_id = $("#medicine_unit_id option:selected").val();

            post_body = {
                name: name,
                description: description,
                concentration: concentration,
                box_quantity: box_quantity,
                medicine_form_id: medicine_form_id,
                medicine_unit_id: medicine_unit_id
            };
        }

        let token = $( "input[name='_token']" ).val();
        
        $.ajax({
            headers: {'X-CSRF-TOKEN': token},
            type: 'POST',
            url: url,
            data: post_body,

            success: function (response) {
                console.log(response)

                //Adding new option as the response is true
                let select2 = $("#" + select2_id);

                let data = {
                    id: response.data.id,
                    text: response.data.name
                };

                let newOption = new Option(data.text, data.id, false, false);

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