<input type="hidden" name="type" value={{ $type }} />
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
        <td class="text-center" >{{ $user->requirement_type }}</td>
        <td>
          <div class="d-flex align-items-center custom-control custom-checkbox d-flex justify-content-center">
            <input
              class="custom-control-input"
              type="checkbox"
              type="checkbox"
              onclick="handleInputClick(this)"
              data-user-id={{ $user->id }}
              id={{ 'user-row-index' . $user->id }}
            />
            <label class="custom-control-label" for={{ 'user-row-index' . $user->id }}></label>
          </div>
        </td>
      </tr>
    @endforeach
  </tbody>
</table>

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
