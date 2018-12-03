<!doctype html>
<html lang=''>
<head>
<meta charset='utf-8'>
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1"><link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="/style/styles.css">
   <title>Perfil</title>
</head>
<body>

<?php
//include 'menu.php';
	if($_COOKIE["tipo"] == "paciente" or $_COOKIE["tipo"] == "medico"){
	include 'menu.php';
	$soyMedico = $_COOKIE["tipo"] == "medico";
	$run = $_COOKIE["rut"];
	$conexion = pg_connect("host=bdd.inf.udec.cl port=5432 dbname=bdi2018a user=bdi2018a password=bdi2018a")
    or die ("Fallo!!!!");
    $search_path = "SET search_path TO proyecto"; //En caso de que tengan una base de datos distinta del esquema public
		//$query="show search_path;";
		pg_query($conexion,$search_path);
		$query="SELECT * FROM persona WHERE run='$run'";
		if($soyMedico){
			$query="SELECT * FROM medico WHERE run='$run'";
		}
		$rs= pg_query($conexion, $query);
			if ($rs) {
				echo "<table class='table' >" ;
				echo "<tr>";
				echo '<th></th>';
				echo '<th></th>';
				//echo "<th scope=\"col\">Datos paciente</th>";
				echo "</tr>";
				while ($obj = pg_fetch_object($rs)) {
				echo "<tr><td>"."Run "."</td><td>".$obj->run."</td></tr>";
				echo "<tr><td>"."Nombre "."</td><td>".$obj->nombre."</td>";
				if($soyMedico){
					echo "<tr><td>"."Especialidad "."</td><td>".$obj->especialidad."</td>";
					
				}
				else{
					echo "<tr><td>"."Direccion "."</td><td>".$obj->direccion."</td>";
					echo "<tr><td>"."Fecha Nacimiento "."</td><td>".$obj->fecha_nacimiento."</td>";
				}
				
				echo "<tr><td>"."Correo Electronico  "."</td><td>".$obj->correo_electronico."</td>";
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
				echo "<table class='table m-5' >" ;
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
<script>
$(document).ready(function(){
	$("#perfil").addClass("active");
});
</script>
</body>
<html>