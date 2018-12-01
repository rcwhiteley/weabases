<!doctype html>
<html lang=''>
<head>
   <meta charset='utf-8'>
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <link rel="stylesheet" href="/style/styles.css">
   <title>PACIENTE.</title>

 <?php include'menu.html';
	$conexion = pg_connect("host=bdd.inf.udec.cl port=5432 dbname=bdi2018a user=bdi2018a password=bdi2018a")
    or die ("Fallo!!!!");
    $search_path = "SET search_path TO proyecto"; 
	pg_query($conexion,$search_path);
	$query="SELECT * FROM historial_atenciones WHERE run_paciente='17872056'";
		$rs= pg_query($conexion, $query);
		if ($rs) {
			echo "<table class=\"table\" align=''rules=all >" ;
			echo "<tr>";
			echo "<th scope=\"col\">Atenciones</th>";
			echo "</tr>";
			while ($obj = pg_fetch_object($rs)) {
			echo "<tr><td>"."id: "."</td><td>".$obj->id."</td>"; 
			echo "<tr><td>"."Run: "."</td><td>".$obj->run_paciente."</td>";
			echo "<tr><td>"."Nombre Medico: "."</td><td>".$obj->run_medico."</td>";
			echo "<tr><td>"."Fecha: "."</td><td>".$obj->fecha."</td>";
			echo "<tr><td>"."Razon: "."</td><td>".$obj->razon."</td>";
			//echo "<tr><td>"."Correo Electronico:  "."</td><td>".$obj->correo_electronico."</td>";
			//echo "<tr><td>"."Telefono: "."</td><td>".$obj->telefono."</td>";
			echo "</tr>";
			}
			echo "</table>";
		}


 ?>



</head>
<body>