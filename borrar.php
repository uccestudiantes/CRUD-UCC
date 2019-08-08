<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<title>Crear</title>
</head>
<body>

	<?php 

	include("conexionCrud.php");

	echo " <table width=\"100%\" border=\"1\" id=\"tabla\">
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
			<form method="post" action="borrar.php">
				<h4 class="mb-3">Seleccione un usuario</h4>
				<select name="usuario" id="select">
					<?php 
					$resultados = mysqli_query($conexion,"SELECT * FROM user");
					while($consu = mysqli_fetch_array($resultados)){
						echo "
						<option value=".$consu['userName'].">".$consu['userName']."</option>";
					}
					?>
				</select>
				<button name="borra" type="submit" >Eliminar</button>
			</form>
			<?php 
			if (isset($_POST['borra'])) {
				$resultado=$_POST['usuario'];

				$query= ("DELETE FROM `user` WHERE `userName`='$resultado'");
	            //echo "Usuario Registrado Correctamente";
				mysqli_query($conexion, $query) or die ("Error al registrar al usuario");

	            //$conexion -> query("insert into user (firtsName,lastName,userName,email,address,country) VALUES ('$frName','$ltName','$userName','$email','$addr','$country')");
	            //echo "Usuario Registrado Correctamente";
				include('desconect.php');
				echo '<script> alert("¡La informacion del usuario a sido eliminada!"); </script>';
				echo '<script> window.location="CRUD.php"; </script>';
				
				/* $conectar->query("insert into proveedor (cc,nombre,apellido,direccion,telefono) VALUES ('$doc','$nombre','$apellido','$dir','$tel')");*/

			}

			?>
		</div>
	</div>
	<br>





</body>
</html>