<div class="modal fade" id="listing-users-form" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
  <div class="modal-dialog modal- modal-dialog-centered modal modified-modal" role="document">
    <div class="modal-content">
      <div class="modal-body p-0">
        <div class="card bg-secondary border-0 mb-0">
          <div class="card-header bg-transparent">
            <h1 class="text-center">Inscritos que podrian ser relacionados</h1>
          </div>
          <div class="card-body">
            <form id="inscribed-users-listing-form" role="form" action="{{ url('/listings/history/1')}}" method="GET">
              {{ csrf_field() }}
              <div class="table-responsive inscribed-users-table">
                <input type="hidden" name="inscribedIds[]" id="inscribedIds" />
                <input type="hidden" name="listingId" id="listingId" value="1" />

                <!-- Dynamic list of users rendered by jquery html put -->
                <div id="users-list" class="users-list"></div>
              </div>
              <div class="text-center">
                <button id="inscribed-users-listing-form-submit" type="submit" class="btn btn-success my-4">
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
