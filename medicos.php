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
						
						<label>Fecha termino contrato</label>
						<input class="form-control" type="date" name="fecha_salida" placeholder="Fecha Salida">
					</div>

					<div class="form-group">
						
						<label>Hora de entrada </label>
						<input class="form-control" type="time" name="hora_entrada" step="2">
					</div>

					<div class="form-group">
						<label>Hora de salida </label>
						<input class="form-control" type="time" name="hora_salida" step="2">
					</div>
						<input class="btn btn-primary" type="submit" value="Enviar">
					</form>
				</div>
			</div>
		</div>
		<div class="col"></div>
	</div>
		
	<div class="card mx-5">
		<div class="card-header">Médicos</div>
			<div class="card-body">
				<table class="table">
					<tr>
						<th>Centro médico</th>
						<th>Sucursal</th>
						<th>Nombre médico</th>
					</tr>
					<?php
					$rut=$_COOKIE['rut'];
					$conexion = pg_connect("host=bdd.inf.udec.cl port=5432 dbname=bdi2018a user=bdi2018a password=bdi2018a")
						or die ("Fallo!!!!");
					$search_path = "SET search_path TO proyecto"; 
					pg_query($conexion,$search_path);
				
					$query="SELECT medico.*, historial_laboral.id as historial_id, sucursal.direccion as direccion, centro_medico.nombre as nombre_centro FROM centro_medico,trabaja,historial_laboral, medico, sucursal where
					trabaja.id_historial=historial_laboral.id and centro_medico.rut = sucursal.rut and trabaja.rut_centro_medico = sucursal.rut
					and trabaja.direccion_sucursal=sucursal.direccion and medico.run=trabaja.run_medico and fecha_salida > now()
					and sucursal.rut='$rut'";
					$rs= pg_query($conexion, $query);
					if ($rs) {
						while ($obj = pg_fetch_object($rs)) {
							echo '<tr><td>'.$obj->nombre_centro.'</td><td>'.$obj->direccion.'</td><td>'.$obj->nombre.'</td>
							<td><a href="/despedir_medico.php?historial_id='.$obj->historial_id.'">Despedir</a></td></tr>';
						}
					}
				?>
				</table>
				
			</div>
		</div>
	</div>

			

</body>
<html>