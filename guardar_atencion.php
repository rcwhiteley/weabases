<?php

		$conexion = pg_connect("host=bdd.inf.udec.cl port=5432 dbname=bdi2018a user=bdi2018a password=bdi2018a")
   		or die ("Fallo!!!!");
    	$search_path = "SET search_path TO proyecto";
		pg_query($conexion,$search_path);
		$run_paciente=$_GET['run_paciente'];
		$run_medico=$_GET['run_medico'];
		$razon=$_GET['razon'];
		//date_default_timezone_set('UTC');
		//$fecha_expiracion = strtotime($fecha_emision."+ ".$dias." days");
    	//$fecha_expiracion = date("Y-m-d", $fecha_expiracion);
		$fecha = date("Y-m-d G:i:s");
		$fecha1 = strtotime($fecha) - 60* 60*4 ;
		$fecha = date("Y-m-d G:i:s", $fecha1);	
		echo $fecha;

		//$query="insert into atencion(run_paciente,run_medico) values ($run_paciente,$run_medico)";
		//$rs=pg_query($conexion,$query);
		$query1="insert into historial_atenciones(run_paciente,run_medico,fecha,razon) values ('$run_paciente','$run_medico','".$fecha."','".$razon."')";
		echo $query1;
		$rs1=pg_query($conexion,$query1);
		//$query2 = "insert into diagnostico (descripcion, nombre_enfermedad, id_historial_atenciones) values ('', 'Desconocida', "
		//$query="insert into facultad(nombre,decano,vicedecano) values ('".$_POST["nombre"]."\' , \'".$_POST["decano"]."\',\'".$_POST["vicedecano"]."\');";

		//$rs= pg_query($conexion, $query);

		header("Location: /atenciones.php");
		die();
?>