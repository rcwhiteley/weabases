<?php 

    $id_diagnostico = $_POST['id_diagnostico_licencia'];
    $id_atencion = $_POST['id_atencion_licencia'];
    $dias = $_POST['dias'];
    $conexion = pg_connect("host=bdd.inf.udec.cl port=5432 dbname=bdi2018a user=bdi2018a password=bdi2018a")
    or die ("Fallo!!!!");
    $search_path = "SET search_path TO proyecto";
    pg_query($conexion,$search_path);
    $query = "insert into archivo (id_diagnostico) values (".$id_diagnostico.") RETURNING id";
    $result = pg_query($conexion, $query);
    $row = pg_fetch_row($result);
    $id_archivo = $row[0];
    
    pg_query($conexion, $query);
    date_default_timezone_set('UCT');
    $fecha_emision = date("Y-m-d");
    echo $fecha_emision;
    $fecha_expiracion = strtotime($fecha_emision."+ ".$dias." days");
    $fecha_expiracion = date("Y-m-d", $fecha_expiracion);
    echo $fecha_expiracion;
    $query = "insert into licencia (id, fecha_emision, fecha_termino) values ($id, '$fecha_emision', '$fecha_expiracion')";
    echo $query;
    pg_query($conexion, $query);
    header("Location: /atencion.php?id=".$id_atencion);
    die();
?>