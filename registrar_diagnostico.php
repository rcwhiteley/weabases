<?php
    $id = $_GET["id_atencion_diagnostico"];
    $conexion = pg_connect("host=bdd.inf.udec.cl port=5432 dbname=bdi2018a user=bdi2018a password=bdi2018a")
    or die ("Fallo!!!!");
    $search_path = "SET search_path TO proyecto";
    pg_query($conexion,$search_path);
    $query = "insert into diagnostico (nombre_enfermedad, id_historial_atenciones) values ('DESCONOCIDO',".$id.") ";
    pg_query($conexion, $query);
    header("Location: /atencion.php?id=".$id);
    die();
?>