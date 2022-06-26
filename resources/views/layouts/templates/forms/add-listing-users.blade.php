<div class="modal fade" id="listing-users-form" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
  <div class="modal-dialog modal- modal-dialog-centered modal modified-modal" role="document">
    <div class="modal-content">
      <div class="modal-body p-0">
        <div class="card bg-secondary border-0 mb-0">
          <div class="card-header bg-transparent">
            <h1 class="text-center">Inscritos que podrian ser relacionados</h1>
          </div>
          <div class="card-body">
            <form id="cust-form" role="form">
              {{ csrf_field() }}

              <div id="users-list" class="users-list"></div>

              <div class="text-center">
                <button id="btn-submit-inscribed-users" type="button" class="btn btn-success my-4">
                  Agregar usuarios
                </button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>