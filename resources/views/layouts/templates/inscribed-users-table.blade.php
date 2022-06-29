<form id="cust-form" role="form" action="{{ url('/listings/history/1')}}" method="GET">
  {{ csrf_field() }}
  <div class="table-responsive inscribed-users-table">
    <input type="hidden" name="inscribedIds[]" id="inscribedIds" />

    <table class="table align-items-center">
      <thead class="thead-light">
        <tr>
          <th scope="col">CICPC ID</th>
          <th scope="col">Nombre</th>
          <th scope="col">Apellido</th>
          <th scope="col">Requerimiento</th>
          <th scope="col">Tipo de Requerimiento</th>
          <th scope="col">Agregar</th>
        </tr>
      </thead>
      <tbody>
        @foreach($users as $user)
          <tr>
            <td>{{ $user->cicpc_id }}</td>
            <td>{{ $user->name }}</td>
            <td>{{ $user->surname }}</td>
            <td>{{ $user->item_name }}</td>
            <td>{{ $user->requirement_type }}</td>
            <td>
              <div class="d-flex align-items-center custom-control custom-checkbox">
                <input
                  class="custom-control-input"
                  type="checkbox"
                  type="checkbox"
                  onclick="handleInputClick(this)"
                  data-user-id={{ $user->id }}
                  id={{ 'user-' . $user->id }}
                />
                <label class="custom-control-label" for={{ 'user-' . $user->id }}></label>
              </div>
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>
  <div class="text-center">
    <button id="btn-submit-inscribed-users" type="submit" class="btn btn-success my-4">
      Agregar usuarios
    </button>
  </div>
</form>

<script type="text/javascript">
  let inscribedIdsInput = document.getElementById('inscribedIds');
  let ids = inscribedIdsInput.value || [];

  const handleInputClick = (checkboxElement) => {
    const inscribedUserId = checkboxElement.dataset.userId;

    const index = ids.indexOf(inscribedUserId)

    if (index > -1) {
      ids.splice(index, 1)
    } else {
      ids.push(inscribedUserId)
    }

    inscribedIdsInput.value = ids;
  }
</script>
