<?php

		$conexion = pg_connect("host=bdd.inf.udec.cl port=5432 dbname=bdi2018a user=bdi2018a password=bdi2018a")
   		or die ("Fallo!!!!");
    	$search_path = "SET search_path TO proyecto";
		pg_query($conexion,$search_path);

		$direccion_sucursal=$_GET['direccion'];
		$run_medico=$_GET['run_medico'];
		$rut_centro_medico=$_COOKIE['rut'];

		//echo $direccion."\n";
		//echo $tipo."\n";
		//echo $rut."\n";

		$query="delete from trabaja where rut_centro_medico='$rut_centro_medico' and direccion_sucursal='$direccion_sucursal' and run_medico='$run_medico'";
		$rs=pg_query($conexion,$query);
		
		header("Location: http://localhost/sucursal.php");
		die();
?>