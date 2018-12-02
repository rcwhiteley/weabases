<?php
    $id_diagnostico = $_POST["id_diagnostico_enfermedad"];
    $enfermedad = $_POST["enfermedad"];
    $id_atencion = $_POST["id_atencion_enfermedad"];
    
    $conexion = pg_connect("host=bdd.inf.udec.cl port=5432 dbname=bdi2018a user=bdi2018a password=bdi2018a")
    or die ("Fallo!!!!");
    $search_path = "SET search_path TO proyecto";
    pg_query($conexion,$search_path);
    $query = "insert into enfermedad values('".$enfermedad."') on conflict do nothing";
    pg_query($conexion, $query);
    date_default_timezone_set('UCT');
    $query = "update diagnostico set nombre_enfermedad='".$enfermedad."' where id=".$id_diagnostico;
    echo $query;
    pg_query($conexion, $query);
    header("Location: /atencion.php?id=".$id_atencion);
    die();
?>