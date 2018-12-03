<?php

		$conexion = pg_connect("host=bdd.inf.udec.cl port=5432 dbname=bdi2018a user=bdi2018a password=bdi2018a")
   		or die ("Fallo!!!!");
    	$search_path = "SET search_path TO proyecto";
		pg_query($conexion,$search_path);

		$historial_id=$_GET['historial_id'];
		$rut_centro_medico=$_COOKIE['rut'];

		//echo $direccion."\n";
		//echo $tipo."\n";
		//echo $rut."\n";

		$query="update historial_laboral set fecha_salida=now() where id=$historial_id";
		$rs=pg_query($conexion,$query);
		$tuplasafectadas=pg_affected_rows($rs);
		if($tuplasafectadas==1){
			echo "Despedido :[, causa:se comenta acoso sexual";
		}
		else{
			echo "Dios lo quiere, siga trabajando";
		}
		//echo "<br> redireccion en 3 seg";
		header("Location: /medicos.php");
		die();
?>