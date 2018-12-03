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
   <title>Atenciones</title>
</head>
<body>

 <?php include'menu.php';
	echo "<div class='container  m-5'>";
	$run=$_COOKIE['rut'];
	$soyMedico = $_COOKIE['tipo'] == "medico";
	$conexion = pg_connect("host=bdd.inf.udec.cl port=5432 dbname=bdi2018a user=bdi2018a password=bdi2018a")
    or die ("Fallo!!!!");
    $search_path = "SET search_path TO proyecto"; 
	pg_query($conexion,$search_path);
	$query="SELECT * FROM historial_atenciones,medico WHERE run_paciente='$run' and historial_atenciones.run_medico=medico.run order by fecha desc";
	if($soyMedico){
		$query="SELECT * FROM historial_atenciones,medico WHERE medico.run='$run' and historial_atenciones.run_medico=medico.run order by fecha desc";
	}
		$rs= pg_query($conexion, $query);
		if ($rs) {
			echo "<table class='table table-hover my-5' align>" ;
			echo "<tr>";
			echo "<th >Run Paciente</th>";
			echo "<th >Run Médico</th>";
			echo "<th >Nombre Médico</th>";
			echo "<th >Fecha</th>";
			echo "<th >Motivo</th>";
			echo "</tr>";
			while ($obj = pg_fetch_object($rs)) {
			echo "<tr onclick='window.location=\"/atencion.php?id=".$obj->id."\";'>";
			echo "<td><p>".$obj->run_paciente."</p></td>";
			echo "<td><p>".$obj->run_medico."</p></td>";
			echo "<td><p>".$obj->nombre."</p></td>";
			echo "<td><p>".$obj->fecha."</p></td>";
			echo "<td><p>".$obj->razon."</p></td>";
			//echo '<td><button type="button" class="btn btn-primary">Detalles</button></td>';
			echo "</tr>";
			}
			echo "</table>";
		}
	$query1="SELECT * FROM historial_atenciones WHERE run_paciente='$run'";
		$rs1= pg_query($conexion, $query);

	echo "</div>";
 ?>
<script>
$(document).ready(function(){
	$("#perfil").removeClass("active");
	$("#atenciones").addClass("active");
});
</script>
</body>
<html>