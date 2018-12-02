<?php

		$conexion = pg_connect("host=bdd.inf.udec.cl port=5432 dbname=bdi2018a user=bdi2018a password=bdi2018a")
   		or die ("Fallo!!!!");
    	$search_path = "SET search_path TO proyecto";
		pg_query($conexion,$search_path);

		$direccion=$_GET['direccion'];
		$tipo=$_GET['tipo'];
		$rut=$_COOKIE['rut'];

		//echo $direccion."\n";
		//echo $tipo."\n";
		//echo $rut."\n";

		$query="insert into sucursal(rut,direccion,tipo) values (".$rut.",'".$direccion."','".$tipo."')";
		$rs=pg_query($conexion,$query);

		header("Location: http://localhost/sucursal.php");
		die();
?>