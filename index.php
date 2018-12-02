<!doctype html>
<html lang=''>
<head>
   <meta charset='utf-8'>
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <link rel="stylesheet" href="/style/styles.css">
   <title>INICIO</title>
</head>
<body>

<?php
//include 'menu.php';
	if($_COOKIE["tipo"] == "paciente" or $_COOKIE["tipo"] == "medico"){
	include 'menu.php';
	$conexion = pg_connect("host=bdd.inf.udec.cl port=5432 dbname=bdi2018a user=bdi2018a password=bdi2018a")
    or die ("Fallo!!!!");
    $search_path = "SET search_path TO proyecto"; //En caso de que tengan una base de datos distinta del esquema public
		//$query="show search_path;";
		pg_query($conexion,$search_path);
		$query="SELECT * FROM persona WHERE run='17872056'";
		$rs= pg_query($conexion, $query);
			if ($rs) {
				echo "<table class=\"table\" align='center'rules=all >" ;
				echo "<tr>";
				echo "<th scope=\"col\">Datos paciente</th>";
				echo "</tr>";
				while ($obj = pg_fetch_object($rs)) {
				echo "<tr><td>"."Run: "."</td><td>".$obj->run."</td>";
				echo "<tr><td>"."Nombre: "."</td><td>".$obj->nombre."</td>";
				echo "<tr><td>"."Fecha Nacimiento: "."</td><td>".$obj->fecha_nacimiento."</td>";
				echo "<tr><td>"."Direccion: "."</td><td>".$obj->direccion."</td>";
				echo "<tr><td>"."Correo Electronico:  "."</td><td>".$obj->correo_electronico."</td>";
				echo "<tr><td>"."Telefono: "."</td><td>".$obj->telefono."</td>";
				echo "</tr>";
				}
				echo "</table>";
			}
		}
		else if($_COOKIE["tipo"] == "centro_medico"){ //el otro menu
			include 'menu_centro_medico.php';
			$conexion = pg_connect("host=bdd.inf.udec.cl port=5432 dbname=bdi2018a user=bdi2018a password=bdi2018a")
   			 or die ("Fallo!!!!");
   			 $search_path = "SET search_path TO proyecto";
			pg_query($conexion,$search_path);
			$rut=$_COOKIE["rut"];
			$query="SELECT * FROM centro_medico WHERE rut='$rut'";
			$rs= pg_query($conexion,$query);
			if ($rs) {
				echo "<table class=\"table\" align='center'rules=all >" ;
				echo "<tr>";
				echo "<th scope=\"col\">Datos Centro Medico</th>";
				echo "</tr>";
				while ($obj = pg_fetch_object($rs)) {
				echo "<tr><td>"."Rut: "."</td><td>".$obj->rut."</td>";
				echo "<tr><td>"."Nombre: "."</td><td>".$obj->nombre."</td>";
				echo "</tr>";
				}
				echo "</table>";
			}

		}

?>

</body>
<html>