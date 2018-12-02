

<?php
	//poner en el historial_laboral
//poner en la sucursal
		$conexion = pg_connect("host=bdd.inf.udec.cl port=5432 dbname=bdi2018a user=bdi2018a password=bdi2018a")
   		or die ("Fallo!!!!");
    	$search_path = "SET search_path TO proyecto";
		pg_query($conexion,$search_path);

		$run_medico=$_GET['run'];
		$direccion_sucursal=$_GET['sucursal'];
		$fecha_ingreso=$_GET['fecha_ingreso'];
		$fecha_salida=$_GET['fecha_salida'];
		$hora_salida=$_GET['hora_salida'];
		$hora_entrada=$_GET['hora_entrada'];
		$rut_centro_medico=$_COOKIE['rut'];
		

		//$hora_entrada2 = try_cast('$hora_entrada', time);
		//echo $hora_entrada2;
		//fecha_ingreso,fecha_salida,hora_ingreso,hora_salida
		//para el historial laboral
		$query="insert into historial_laboral(fecha_ingreso,fecha_salida,hora_entrada,hora_salida) values ('$fecha_ingreso','$fecha_salida','$hora_entrada','$hora_salida') returning id";
		echo $query;
		
		$rs=pg_query($conexion,$query);
		$row = pg_fetch_array($rs);
		$id_historial = $row['0'];
		$rut_centro_medico = $_COOKIE['rut'];
		//para trabaja
		//run medico, rut_centro_medico, direccion_sucursal, id_historial
		$query1="insert into trabaja(run_medico,rut_centro_medico,direccion_sucursal,id_historial) values ($run_medico,$rut_centro_medico,'$direccion_sucursal',$id_historial)";
		$rs1=pg_query($conexion,$query1);
		
		//header("Location: http://localhost/sucursal.php");
		//die();
?>