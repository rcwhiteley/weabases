<?php 
    $medicamento = $_POST['medicamento'];
    $id_diagnostico = $_POST['id_diagnostico'];
    $id_atencion = $_POST['id_atencion'];
    $dias = $_POST['dias'];
    $cantidad_por_dia = $_POST['cantidad_por_dia'];
    $indicacion = $_POST['indicacion'];
    $conexion = pg_connect("host=bdd.inf.udec.cl port=5432 dbname=bdi2018a user=bdi2018a password=bdi2018a")
    or die ("Fallo!!!!");
    $search_path = "SET search_path TO proyecto";
    pg_query($conexion,$search_path);
    $query = "insert into archivo (id_diagnostico) values (".$id_diagnostico.") RETURNING id";
    $result = pg_query($conexion, $query);
    $row = pg_fetch_row($result);
    $id_archivo = $row[0];
    $query = "insert into medicamento values('".$medicamento."') on conflict do nothing";
    pg_query($conexion, $query);
    date_default_timezone_set('UCT');
    $fecha_emision = date("Y-m-d");
    echo $fecha_emision;
    $fecha_expiracion = strtotime($fecha_emision."+ ".$dias." days");
    $fecha_expiracion = date("Y-m-d", $fecha_expiracion);
    echo $fecha_expiracion;
    $query = "insert into receta (id, nombre_medicamento, fecha_emision, fecha_termino, cantidad_por_dia, indicacion) values (".
            $id_archivo.", '".$medicamento."', '".$fecha_emision."', '".$fecha_expiracion."', '".$cantidad_por_dia."', '".$indicacion."')";
    echo $query;
    pg_query($conexion, $query);
    header("Location: /atencion.php?id=".$id_atencion);
    die();
?>