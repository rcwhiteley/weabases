<!doctype html>
<html lang=''>
<head>
   <meta charset='utf-8'>
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <link rel="stylesheet" href="/style/styles.css">
   <meta name="viewport" content="width=device-width, initial-scale=1"><link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

   <title>Sucursales</title>
</head>
<body>
	<?php
		include'menu_centro_medico.php';
	?>
	<div class="card mt-5 mx-5 md-4">
		<div class="card-header">Ingresar nueva sucursal</div>
		<div class="card-body">
			<form action="guardar_sucursal.php" method="get" class="form-group row">
				<div class="form-group mx-2">
					<input class="form-control" type="varchar(100)" name="direccion" placeholder="Direccion Sucursal"><br>
				</div>
				<div class="form-group mx-2">
					<input class="form-control" type="varchar(50)" name="tipo" placeholder="Tipo de Sucursal"><br>
				</div>
				<div class="form-group mx-2">
					<input class="btn btn-default"  type="submit" value="Enviar">
				</div>
			</form>
		</div>
	</div>
	<div class="card mt-2 mx-5 md-4">
		<div class="card-header">Sucursales</div>
			<div class="card-body">
				<!--<form action="/eliminar_sucursal.php" method="get" class="form-group">-->
					<div class="form-group">
						<table class="table">
							<tr>
								<th>RUT</th>
								<th>Nombre</th>
								<th>Direccion</th>
								<th>Tipo</th>
							</tr>
							<?php 
								$rut=$_COOKIE['rut'];
								$conexion = pg_connect("host=bdd.inf.udec.cl port=5432 dbname=bdi2018a user=bdi2018a password=bdi2018a")
								or die ("Fallo!!!!");
								$search_path = "SET search_path TO proyecto"; 
								pg_query($conexion,$search_path);
								$query="SELECT centro_medico.nombre, sucursal.* FROM sucursal, centro_medico WHERE sucursal.rut='$rut' and sucursal.rut=centro_medico.rut";
								$rs= pg_query($conexion, $query);
								if ($rs) {
									while($obj = pg_fetch_object($rs)){
										echo '<tr><td>'.$obj->rut.'</td><td>'.$obj->nombre.'</td><td>'.$obj->direccion.'</td><td>'.$obj->tipo.'</td></tr>';
									}
								}
							?>
						</table>
						
					</div>
					<!--<input class="btn btn-default" type="submit" value="Enviar">
				</form>-->
			</div>
		</div>
	</div>
</body>
<html>