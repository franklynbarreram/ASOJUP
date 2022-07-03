<?php
  function findExistentUser($user, $selectedUsers)
  {
    if (!$selectedUsers) {
      return FALSE;
    }
  
    foreach ($selectedUsers as $selectedUser) {
      if ($selectedUser['user_id'] == $user->id && $selectedUser['item_id'] == $user->item_id) {
        return TRUE;
      }
    }

    return FALSE;
  }
?>

<input type="hidden" name="type" value={{ $type }} />
<table class="table align-items-center">
  <thead class="thead-light">
    <tr>
      <th scope="col">Cedula</th>
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
        <td>{{ $user->identification }}</td>
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
              @if(findExistentUser($user, $selectedUsers))
                checked
              @endif
              data-user-id={{ $user->id }}
              data-user-identification={{ $user->identification }}
              data-user-name={{ $user->name }}
              data-user-surname={{ $user->surname }}
              data-user-item_name={{ $user->item_name }}
              data-user-item_id={{ $user->item_id }}
              data-user-requirement_type={{ $user->requirement_type }}
              id={{ $user->row }}
            />
            <label class="custom-control-label" for={{ $user->row }}></label>
          </div>
        </td>
      </tr>
    @endforeach
  </tbody>
</table>
