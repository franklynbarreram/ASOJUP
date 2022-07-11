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
    margin-bottom: 10px;
    position: relative;
  }

  .logo {
    width: 80px;
    margin-top: 10px;
  }

  .content-logo {
    position: absolute;
    margin-left: 10px;
  }

  .content-header {
    position: absolute;
    margin-top: 20px;
    margin-left: 110px;
  }

  .title {
    font-size: 16px;
    margin: 0;
    margin-bottom: 5px;
  }

  .dates {
    margin: 0;
  }

  .content-title {
    width: 100%;
    text-align: center;
    margin-bottom: 20px;
  }

  .content {
    margin-left: 30px;
    width: fit-content;
    font-size: .85rem;
    text-align: center;
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
    <div class="content-logo">
      <img class="logo" src="<?php echo $_SERVER["DOCUMENT_ROOT"] . '\imgs\AsojupLogo.png'; ?>" class="" alt="logo" id="LogoNavbar">
    </div>
    <div class="content-header">
      <h1 class="title">Asociación Civil de Jubilados, Pensionados y Sobrevivientes del CICPC (ASOJUP-CICPC)</h1>
      <div class="dates">
        <div>
          Fecha del pedido: <?php
                            $orderDate = new DateTime($date);
                            echo $orderDate->format('d-m-Y');
                            ?>
        </div>
      </div>
    </div>
  </div>
  <div class="content-title">
    <h3><?php echo $description ?></h3>
  </div>
  <div class="content">
    <table>
      <tr>
        <th class="label">IDENTIFICACIÓN</th>
        <th class="label">NOMBRE</th>
        <th class="label">APELLIDO</th>
        <th class="label">REQUERIMIENTO</th>
        <th class="label">TIPO DE REQUERIMINETO</th>
      </tr>

      <?php if (is_array($inscribedUsers)) : ?>
        @foreach($inscribedUsers as $user)
        <tr>
          <td class="label">{{$user -> identification}}</td>
          <td class="label">{{$user -> name}}</td>
          <td class="label">{{$user -> surname}}</td>
          <td class="label">{{$user -> item_name}}</td>
          <td class="label">{{$user -> requirement_type}}</td>
        </tr>
        @endforeach
      <?php endif; ?>
    </table>
  </div>


</body>

</html>