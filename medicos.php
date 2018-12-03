<!doctype html>
<html lang=''>
<head>
   <meta charset='utf-8'>
   <meta name="viewport" content="width=device-width, initial-scale=1"><link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="/style/styles.css">
   <title>Médicos</title>
</head>
<body>
	<?php
		include'menu_centro_medico.php';
	?>
	<div class="row">
		<div class="col">
			<div class="card m-5" >
				<div class="card-header">Contratar médico</div>
				<div class="card-body">
				<form action="contratar_medico.php" method="get" class = "form-group">
						<!--<li>Nombre Medico: <input type="varchar(100)" name="Nombre"><br></li> -->
					<div class="form-group">
						<input class="form-control" type="varchar(10)" class="form-control" placeholder="run medico" name="run">
					</div>
					<div class="form-group">
						<select class="form-control" type="varchar(100)" placeholder="direccion sucursal" name="sucursal">
							<option disabled="disabled" selected="selected"> Escoja una sucursal </option>
							<?php
								$rut=$_COOKIE['rut'];
								$conexion = pg_connect("host=bdd.inf.udec.cl port=5432 dbname=bdi2018a user=bdi2018a password=bdi2018a")
									or die ("Fallo!!!!");
								$search_path = "SET search_path TO proyecto"; 
								pg_query($conexion,$search_path);
							
								$query="SELECT * FROM sucursal WHERE rut='$rut'";
								$rs= pg_query($conexion, $query);
								if ($rs) {
				
									while ($obj = pg_fetch_object($rs)) {
										echo "<option>".$obj->direccion."</option>";
									}
								}
							?>
						</select>
					</div>
					<div class="form-group">
						<input class="form-control" type="date" name="fecha_ingreso" placeholder="Fecha Ingreso">
					</div>
					<div class="form-group">
						<input class="form-control" type="date" name="fecha_salida" placeholder="Fecha Salida">
					</div>

					<div class="form-group">
						<input class="form-control" type="time" name="hora_entrada" step="2">
					</div>

					<div class="form-group">
						<input class="form-control" type="time" name="hora_salida" step="2">
					</div>
						<input class="btn btn-primary" type="submit" value="Enviar">
					</form>
				</div>
			</div>
		</div>
		<div class="col">
			<div class="card my-5 mr-5">
				<div class="card-header">Médicos</div>
				<div class="card-body">
								
					<form action="despedir_medico.php" method="get" class="form-group">
						<div class="form-group">
   							<input type="varchar(100)" name="direccion" placeholder="Direccion Sucursal"><br>
   						</div>
   						<div class="form-group">
   							<input type="varchar(10)" name="run_medico" placeholder="Run del sujeto"><br>
   						</div>
   						<input type="submit" value="Enviar">
					</form>
				</div>
			</div>
		</div>
	</div>

			<br>Despedir Medico de un Sucursal:<br>
				<form action="despedir_medico.php" method="get" class="form-group">
					<div class="form-group">
   						<labe> Direccion Sucursal:</labe>
   						<input type="varchar(100)" name="direccion" placeholder="Direccion Sucursal"><br>
   					</div>
   					<div class="form-group">
   						<labe> Run Medico</labe>
   				 		<input type="varchar(10)" name="run_medico" placeholder="Run del sujeto"><br>
   					</div>
   				<input type="submit" value="Enviar">
			</form>

		</ul>



	<?php 
 		$rut=$_COOKIE['rut'];
		$conexion = pg_connect("host=bdd.inf.udec.cl port=5432 dbname=bdi2018a user=bdi2018a password=bdi2018a")
   			 or die ("Fallo!!!!");
   		$search_path = "SET search_path TO proyecto"; 
		pg_query($conexion,$search_path);
	
		$query="SELECT * FROM trabaja WHERE rut_centro_medico='$rut'";
		$rs= pg_query($conexion, $query);
		if ($rs) {
			echo "<table class='table'>" ;
			echo "<tr>";
			echo "<th scope=\"col\">Medicos</th>";
			echo "</tr>";
			while ($obj = pg_fetch_object($rs)) {
				echo "<td><blockquote>"."Rut: ".$obj->run_medico."</blockquote></td>";
				echo "<td><blockquote>"."Direccion: ".$obj->direccion_sucursal."</blockquote></td>";
				echo "</tr>";
			}
			echo "</table>";
		}
 	?>
</body>
<html>