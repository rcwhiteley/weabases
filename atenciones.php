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
   <title>PACIENTE.</title>
</head>
<body>
<?php
	//$_COOKIE["rut"] y sabes si es medico o paciente con _$COOKIE["tipo"] == "paciente"
	include'menu.php';
	?>
 <?php 
 	if(isset($_GET['persona'])){
	$run=$_COOKIE['rut'];
	
	$soyMedico = $_COOKIE["tipo"] == "medico";
 	//$run=$_GET['persona'];
	$conexion = pg_connect("host=bdd.inf.udec.cl port=5432 dbname=bdi2018a user=bdi2018a password=bdi2018a")
    or die ("Fallo!!!!");
    $search_path = "SET search_path TO proyecto"; 
	pg_query($conexion,$search_path);
	$query="SELECT * FROM atencion,medico WHERE run_paciente='$run'";

		$rs= pg_query($conexion, $query);
		if ($rs) {
			echo "<table class=\"table\" align=''rules=all>" ;
			echo "<tr>";
			echo "<th scope=\"col\">Medicos que lo han atendido</th>";
			echo "</tr>";
			while ($obj = pg_fetch_object($rs)) {
			echo "<td><blockquote>"."Nombre Medico: ".$obj->nombre."</blockquote></td>";
			echo "<td><blockquote>"."Run Medico: ".$obj->run_medico."</blockquote></td>";
			echo "</tr>";
			}
			echo "</table>";
		}
	
	$query1="SELECT * FROM historial_atenciones WHERE run_paciente='$run'";
		$rs1= pg_query($conexion, $query);
	}
 ?>
<div class="container">
	<?php
	$soyMedico = $_COOKIE["tipo"] == "medico";
	$run =  $_COOKIE["rut"];
	if($soyMedico == false){
		header("Location: /historial_atenciones.php");
        die();
	} ?>
	
	<!--<li><a href="/atenciones.php">Medicos que lo han atendido</a></li>-->
	<br>Ingresar nueva atencion<br>
			<form action="guardar_atencion.php" method="get">
			<input type="hidden" name="run_medico" <?php echo 'value="'.$run.'"';?>>
			<div class="form-group">
   				<input type="varchar(10)" name="run_paciente" placeholder="rut paciente">
			</div>
   			<div class="form-group">
				<input type="text" name="razon" placeholder="Motivo">
			</div>
			<div class="form-group">
   				<input type="submit" value="Enviar">
			</div>
			</form>
			<a class="btn btn-sm btn-primary my-5" href="/historial_atenciones.php">Ver todas las atenciones realizadas</a>
</div>
<script>
$("#perfil").removeClass("active");
$("#atenciones").addClass("active");
</script>
</body>
<html>