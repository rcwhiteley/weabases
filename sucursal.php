<!doctype html>
<html lang=''>
<head>
   <meta charset='utf-8'>
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <link rel="stylesheet" href="/style/styles.css">
   <title>PACIENTE.</title>
</head>
<body>
	<?php
		include'menu_centro_medico.php';
	?>

 		<ul>
			<br>Ingresar nueva sucursal<br>
			<form action="guardar_sucursal.php" method="get">
				<li>Direccion: <input type="varchar(100)" name="direccion"><br></li>
   				<li>Tipo: <input type="varchar(50)" name="tipo"><br></li>
   			<input type="submit" value="Enviar">
			</form>
		</ul>

 		<ul>
			<br>Eliminar nueva sucursal<br>
			<form action="eliminar_sucursal.php" method="get">
				<li>Direccion: <input type="varchar(100)" name="direccion"><br></li>
   				<li>Tipo: <input type="varchar(50)" name="tipo"><br></li>
   			<input type="submit" value="Enviar">
			</form>
		</ul>

 	<?php 
 	$rut=$_COOKIE['rut'];
	$conexion = pg_connect("host=bdd.inf.udec.cl port=5432 dbname=bdi2018a user=bdi2018a password=bdi2018a")
    or die ("Fallo!!!!");
    $search_path = "SET search_path TO proyecto"; 
	pg_query($conexion,$search_path);
	$query="SELECT * FROM sucursal WHERE rut='$rut'";
		$rs= pg_query($conexion, $query);
		if ($rs) {
			echo "<table class=\"table\" align=''rules=all >" ;
			echo "<tr>";
			echo "<th scope=\"col\">Sucursales</th>";
			echo "</tr>";
			while ($obj = pg_fetch_object($rs)) {
			echo "<td><blockquote>"."Rut: ".$obj->rut."</blockquote></td>";
			echo "<td><blockquote>"."Direccion: ".$obj->direccion."</blockquote></td>";
			echo "<td><blockquote>"."Tipo: ".$obj->tipo."</blockquote></td>";
			echo "</tr>";
			}
			echo "</table>";
		}
 ?>

</body>
<html>