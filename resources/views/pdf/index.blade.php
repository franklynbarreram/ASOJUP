<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>

<style type="text/css" media="screen">
  body {
    font-family: Open Sans, sans-serif;
    width: 730px;
    padding: 0;
    margin: 0;
  }

  .navbar {
    height: 100px;
    width: 100%;
    background: #5e72e4;
    margin-bottom: 20px;
  }

  .content {
    margin: 0 auto;
    width: fit-content;
    font-size: .85rem;
  }

  .label {
    text-align: center;
    border-bottom: 1px solid #e9ecef;
  }

  td {
    color: #525f7f;
    padding: 15px;
  }

  th {
    padding: 10px;
    color: #8898aa;
    background-color: #f6f9fc;
    border-top: 1px solid #e9ecef;
  }
</style>

<body>
  <div class="navbar">
    <div>
      logo
    </div>
    <div class="row">
      <div>
        fecha1
      </div>
      <div>
        fecha2
      </div>
    </div>
  </div>
  <div class="content">
    <table>
      <tr>
        <th class="label">CICPC ID</th>
        <th class="label">NOMBRE</th>
        <th class="label">APELLIDO</th>
        <th class="label">REQUERIMIENTO</th>
        <th class="label">TIPO DE REQUERIMINETO</th>
      </tr>

      @foreach($inscribedUsers as $user)
      <tr>
        <td class="label">{{$user -> cicpc_id}}</td>
        <td class="label">{{$user -> name}}</td>
        <td class="label">{{$user -> surname}}</td>
        <td class="label">{{$user -> item_name}}</td>
        <td class="label">{{$user -> requirement_type}}</td>
      </tr>
      @endforeach
    </table>
  </div>


</body>

</html>