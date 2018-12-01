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
 <?php include'menu.html';
 	$run=$_GET['persona'];
	$conexion = pg_connect("host=bdd.inf.udec.cl port=5432 dbname=bdi2018a user=bdi2018a password=bdi2018a")
    or die ("Fallo!!!!");
    $search_path = "SET search_path TO proyecto"; 
	pg_query($conexion,$search_path);
	$query="SELECT * FROM atencion WHERE run_paciente='$run'";
		$rs= pg_query($conexion, $query);
		if ($rs) {
			echo "<table class=\"table\" align=''rules=all >" ;
			echo "<tr>";
			echo "<th scope=\"col\">Atenciones</th>";
			echo "</tr>";
			while ($obj = pg_fetch_object($rs)) {
			echo "<tr><td><blockquote>"."Run persona: ".$obj->run_paciente."</blockquote></td>";
			echo "<td><blockquote>"."Run Medico: ".$obj->run_medico."</blockquote></td>";
			echo "</tr>";
			}
			echo "</table>";
		}


 ?>




</body>
<html>