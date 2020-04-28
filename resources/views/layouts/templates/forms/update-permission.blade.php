<div class="modal fade" id="permission-form" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
    <div class="modal-dialog modal- modal-dialog-centered modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-body p-0">
                <div class="card bg-secondary border-0 mb-0">
                    <div class="card-header bg-transparent">
                        <h1 class="text-center">Editar Permiso</h1>
                    </div>

                    <div class="card-body px-lg-5 py-lg-5">
                        <form id="cust-form" role="form" method="POST">
                            {{ csrf_field() }}
                            {{ method_field('PUT') }}

                            <input type="hidden" name="status" id="status_input" value="">

                            <div class="row d-flex align-items-center mb-4">
                                <div class="col-6">
                                    <strong>Nombre:</strong>
                                </div>
                                <div class="col-6">
                                    <span id="modal-name"></span>
                                </div>
                            </div>

                            <div class="row d-flex align-items-center mb-4">
                                <div class="col-6">
                                    <strong>Descripción:</strong>
                                </div>
                                <div class="col-6">
                                    <span id="modal-description"></span>
                                </div>
                            </div>

                            <div class="row d-flex justify-content-center mt-4">
                                <button id="btn-submit-disease" onclick="sendForm('Aprobado')" type="button" class="btn btn-success">
                                    Aprobar
                                </button>

                                <button id="btn-submit-disease" onclick="sendForm('Rechazado')" type="button" class="btn btn-danger">
                                    Rechazar
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>