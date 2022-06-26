<div class="table-responsive">
  <table class="table align-items-center">
    <thead class="thead-light">
      <tr>
        <th scope="col">Nombre</th>
        <th scope="col">Apellido</th>
        <th scope="col">Enfermedad</th>
        <th scope="col">CICPC ID</th>
        <th scope="col">Telefono</th>
        <th scope="col">Opciones</th>
      </tr>
    </thead>
    <tbody>
      @foreach($users as $user)
        <tr>
          <td>{{ $user->name }}</td>
          <td>{{ $user->surname }}</td>
          <td>{{ $user->illness_name }}</td>
          <td>{{ $user->cicpc_id }}</td>
          <td>{{ $user->phone }}</td>
          <td>
            <div class="d-flex align-items-center custom-control custom-checkbox">
              <input class="custom-control-input" id={{ 'add-user' . $user->id }} type="checkbox">
              <label class="custom-control-label" for={{ 'add-user' . $user->id }}>Agregar al listado</label>
            </div>
          </td>
        </tr>
      @endforeach
    </tbody>
  </table>
</div>