

<?php
	//poner en el historial_laboral
//poner en la sucursal
		$conexion = pg_connect("host=bdd.inf.udec.cl port=5432 dbname=bdi2018a user=bdi2018a password=bdi2018a")
   		or die ("Fallo!!!!");
    	$search_path = "SET search_path TO proyecto";
		pg_query($conexion,$search_path);

		$run_medico=$_GET['run'];
		$direccion=$_GET['sucursal'];
		$fecha_ingreso=$_GET['fecha_ingreso'];
		$fecha_salida=$_GET['fecha_salida'];
		$hora_ingreso=$_GET['hora_ingreso'];
		$hora_salida=$_GET['hora_salida'];
		$rut_centro_medico=$_COOKIE['rut'];
		//echo $direccion."\n";
		//echo $tipo."\n";
		//echo $rut."\n";

		$query="insert into sucursal(rut,direccion,tipo) values (".$rut.",'".$direccion."','".$tipo."')";
		$rs=pg_query($conexion,$query);

		header("Location: http://localhost/sucursal.php");
		die();
?>