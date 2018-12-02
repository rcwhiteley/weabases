<!doctype html>
<html lang=''>
<head>
   <meta charset='utf-8'>
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <link rel="stylesheet" href="/style/styles.css">
   <title>MEDICOS</title>
</head>
<body>
	<?php
		include'menu_centro_medico.php';
	?>
	<?php 
 		if(isset($_GET['ver'])){
 			$rut=$_COOKIE['rut'];
			$conexion = pg_connect("host=bdd.inf.udec.cl port=5432 dbname=bdi2018a user=bdi2018a password=bdi2018a")
   				 or die ("Fallo!!!!");
   			 $search_path = "SET search_path TO proyecto"; 
			pg_query($conexion,$search_path);
	
			$query="SELECT * FROM trabaja WHERE rut_centro_medico='$rut'";
			$rs= pg_query($conexion, $query);
			if ($rs) {
				echo "<table class=\"table\" align=''rules=all >" ;
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
		}
 	?>

 		<ul>
 			<li><a href='/medicos.php?ver=todos'>Ver Medicos</a></li>
			<br>Contratar Medico<br>
			<form action="contratar_medico.php" method="get" class = "form-group">
				<!--<li>Nombre Medico: <input type="varchar(100)" name="Nombre"><br></li> -->
   				<div class="form-group">
   					<labe> Run Medico</labe>
   					<input type="varchar(10)" class="form-control" placeholder="run medico" name="run"><br>
   				</div>
   				<div class="form-group">
   					<labe> Direccion Sucursal</labe>
   					<input type="varchar(100)" placeholder="direccion sucursal" name="sucursal"><br>
   				</div>
   				<div class="form-group">
   					<labe> Fecha Ingreso</labe>
   					<input type="date" name="fecha_ingreso" placeholder="Fecha Ingreso"><br>
   				</div>

   				<div class="form-group">
   					<labe> Fecha Salida</labe>
   					<input type="date" name="fecha_salida" placeholder="Fecha Salida"><br>
   				</div>

   				<div class="form-group">
   					<labe> Hora Entrada</labe>
   					<input type="time" name="hora_entrada" step="2"><br>
   				</div>

   				<div class="form-group">
   					<labe> Hora Salida</labe>
   					<input type="time" name="hora_salida" step="2"><br>
   				</div>
   					<input type="submit" value="Enviar">
			</form>

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

</body>
<html>