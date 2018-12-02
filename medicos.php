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
			<form action="contratar_medico.php" method="get">
				<!--<li>Nombre Medico: <input type="varchar(100)" name="Nombre"><br></li> -->
   				<li>Run Medico: <input type="varchar(10)" name="run"><br></li>
   				<li>Direccion Sucursal: <input type="varchar(100)" name="sucursal"><br></li>
   				<li>Fecha Ingreso: <input type="varchar(50)" name="fecha_ingreso"><br></li>
   				<li>Fecha Salida: <input type="varchar(50)" name="fecha_salida"><br></li>
   				<li>Hora Ingreso: <input type="varchar(50)" name="hora_ingreso"><br></li>
   				<li>Hora Salida: <input type="varchar(50)" name="hora_salida"><br></li>
   			<input type="submit" value="Enviar">
			</form>
		</ul>

 		<ul>
			<br>Despedir Medico<br>
			<form action="eliminar_sucursal.php" method="get">
				<li>Direccion: <input type="varchar(100)" name="direccion"><br></li>
   				<li>Tipo: <input type="varchar(50)" name="tipo"><br></li>
   			<input type="submit" value="Enviar">
			</form>
		</ul>

</body>
<html>