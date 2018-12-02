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
 	include'menu.php';
 	if($_GET['persona']!="de"){
 	$run=$_GET['persona'];
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
 <ul>
	<li><a href="/historial_atenciones.php?persona=17872056">Consultas historicas</a></li>
	<li><a href="/atenciones.php?persona=17872056">Medicos que lo han atendido</a></li>
	<li><a href="/guardar_consulta.php">Crear nueva consulta</a></li>
</ul>
<form action="formget.php" method="get">
    Nombre: <input type="text" name="nombre"><br>
    Email: <input type="text" name="email"><br>
    <input type="submit" value="Enviar">
</form>
</body>
<html>