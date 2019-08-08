<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <title>Actualización de datos</title>
  <script type="text/javascript">
    $("#formulario").hide();

  </script>
</head>
<body>
  <div class="container" id="show">
  <?php 
  include("conexionCrud.php");

  echo " <table width=\"100%\" border=\"1\">
  <tr>
  <td><b><center>Nombre</center></b></td>
  <td><b><center>Apellido</center></b></td>
  <td><b><center>Nombre de usuario</center></b></td>
  <td><b><center>E-mail</center></b></td>
  <td><b><center>Dirección</center></b></td>
  <td><b><center>Pais</center></b></td>
  </tr>";
  $resultados = mysqli_query($conexion,"SELECT * FROM user");
  while($cons = mysqli_fetch_array($resultados))
  {   
    echo 
    "
    <tr>
    <td>".$cons['firtsName']."</td>
    <td>".$cons['lastName']."</td>
    <td>".$cons['userName']."</td>
    <td>".$cons['email']."</td>
    <td>".$cons['address']."</td>
    <td>".$cons['country']."</td>
    </tr>";
  }
  echo " </table>";

  //include("desconect.php");
  ?>

  <div class="container">
    <div class="mb-12 text-center">
      <h4 class="mb-3">Seleccione un usuario</h4>
      <form method="post" action="actualizar.php">
        <select name="usuario" id="select">

          <?php 
          $resultados = mysqli_query($conexion,"SELECT * FROM user");
          while($consu = mysqli_fetch_array($resultados)){
            echo "
            <option value=".$consu['userName'].">" .$consu['userName']."</option>
            ";
          }

          ?>
        </select>
        <button name="actualizar" type="submit" >Actualizar</button>
      </form>
    </div>
  </div>
  <br>

  <?php 
  $resultado;
  if (isset($_POST['actualizar'])) {
    $resultado=$_POST['usuario'];

    $query= ("SELECT `firtsName`, `lastName`, `userName`, `email`, `address`, `country` FROM `user` WHERE `userName`='$resultado'");
    $consulta=mysqli_query($conexion, $query) or die ("Error al registrar al usuario");
    $datos = mysqli_fetch_array($consulta);

    $frName = $datos['firtsName'];
    $ltName = $datos['lastName'];
    $userName = $datos['userName'];
    $email = $datos['email'];
    $addr = $datos['address'];
    $country = $datos['country'];
  }

  ?>
</div>
  


  <div class="container" id="formulario"><div class="mb-12 text-center">
    <form action="actualizar.php" method="post">
      <div class="col-md-12 order-md-1">
        <h4 class="mb-3">Actualización de datos</h4>
        <form class="create-user" novalidate="">
          <div class="row">
            <div class="col-md-6 mb-3">
              <label for="firstName">Primer nombre</label>
              <input type="text" class="form-control" id="firstName" name="modfirstName" placeholder="" value="<?php echo "$frName" ?>" required="">
            </div>
            <div class="col-md-6 mb-3">
              <label for="lastName">Ultimo nombre</label>
              <input type="text" class="form-control" id="lastName" name="modlastName" placeholder="" value="<?php echo "$ltName" ?>" required="">
            </div>
          </div>

          <div class="mb-3">
            <label for="username">Nombre de Usuario</label>
            <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text">@</span>
              </div>
              <input type="text" class="form-control" id="username" name="modusername" placeholder="Nombre de Usuario" required="" value="<?php echo "$userName" ?>">
              <div class="invalid-feedback" style="width: 100%;">
                Your username is required.
              </div>
            </div>
          </div>

          <div class="mb-3">
            <label for="email">Email <span class="text-muted">(Opcional)</span></label>
            <input type="email" class="form-control" id="email" name='modemail' placeholder="correo@ejemplo.com" value="<?php echo "$email" ?>">
            <div class="invalid-feedback">
              Please enter a valid email address for shipping updates.
            </div>
          </div>

          <div class="mb-3">
            <label for="address">Dirección</label>
            <input type="text" class="form-control" id="address" name="modaddress" placeholder="Cll 12 #34-56 St" required="" value="<?php echo "$addr" ?>">
            <div class="invalid-feedback">
              Please enter your shipping address.
            </div>
          </div>

          <div class="row">
            <div class="col-md-5 mb-3">
              <label for="country">Pais</label>
              <select class="custom-select d-block w-100" id="country" name="modcountry" required="">
                <option value="<?php echo "$country" ?>"><?php echo "$country" ?></option>
                <option value="Colombia">Colombia</option>
                <option value="Mexico">Mexico</option>
                <option value="Argentina">Argentina</option>
                <option value="Brasil">Brasil</option>
              </select>
              <div class="invalid-feedback">
                Please select a valid country.
              </div>
            </div>
          </div>
        </form>
        <hr class="mb-4">
        <button class="btn btn-primary btn-lg btn-block" type="submit" name='modificar'>Modificar</button>
      </form>
      <?php 
      if(isset($_POST['modificar']))
      {
        $modfrName = $_POST['modfirstName'];
        $modltName = $_POST['modlastName'];
        $moduserName = $_POST['modusername'];
        $modemail = $_POST['modemail'];
        $modaddr = $_POST['modaddress'];
        $modcountry = $_POST['modcountry'];

        $query= ("UPDATE `user` SET `firtsName`='$modfrName',`lastName`='$modltName',`email`='$modemail',`address`='$modaddr',`country`='$modcountry' WHERE `userName`='$moduserName'");
        mysqli_query($conexion, $query) or die ("Error al registrar al usuario");
        include('desconect.php');
        echo '<script> window.location="CRUD.php"; </script>';
        echo '<script> alert("¡Su informacion ha sido actualizada e ingresada correctamente!"); </script>';
      }
      ?>
    </div>
  </div>
</div>
</body>
</html>