<?php 
    $sintoma = $_POST['sintoma'];
    $id_diagnostico = $_POST['id_diagnostico_sintomas'];
    $informacion = $_POST['informacion'];
    $id_atencion = $_POST['id_atencion_sintomas'];
    $conexion = pg_connect("host=bdd.inf.udec.cl port=5432 dbname=bdi2018a user=bdi2018a password=bdi2018a")
    or die ("Fallo!!!!");
    $search_path = "SET search_path TO proyecto";
    pg_query($conexion,$search_path);
    $query = "insert into sintoma values('".$sintoma."') on conflict do nothing";
    pg_query($conexion, $query);
    date_default_timezone_set('UCT');
    $query = "insert into diagnostica_sintoma (id_diagnostico, nombre_sintoma, descripcion) values (".
            $id_diagnostico.", '".$sintoma."', '".$informacion."') on conflict do nothing";
    echo $query;
    pg_query($conexion, $query);
    header("Location: /atencion.php?id=".$id_atencion);
    die();
?>