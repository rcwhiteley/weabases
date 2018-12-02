<!doctype html>
<html lang=''>
<head>
    <meta charset='utf-8'>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1"><link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="/style/styles.css">
    <title>Licencias</title>
</head>
<body>
      
<?php include 'menu.php';?>
<div class="container my-3 mx-5">
    <?php
         $persona;
         if(isset($_GET['persona']))
             $persona=$_GET['persona'];
        else
            $persona=$_COOKIE["rut"];
        $conexion = pg_connect("host=bdd.inf.udec.cl port=5432 dbname=bdi2018a user=bdi2018a password=bdi2018a")
        or die ("Fallo!!!!");
        $search_path = "SET search_path TO proyecto"; //En caso de que tengan una base de datos distinta del esquema public


        pg_query($conexion,$search_path);
        
		
        if(isset($_GET['diagnostico'])){
            $diagnostico = $_GET['diagnostico'];
            $query="select medico.nombre, diagnostico.*, licencia.* from atencion, medico, diagnostico, archivo, historial_atenciones, licencia
            where diagnostico.id=$diagnostico and medico.run = atencion.run_medico and historial_atenciones.run_medico = atencion.run_medico and historial_atenciones.run_paciente = atencion.run_paciente and diagnostico.id_historial_atenciones = historial_atenciones.id and archivo.id_diagnostico = diagnostico.id and licencia.id = archivo.id";
        }
        else{
            $query="select medico.nombre, diagnostico.*, licencia.* from atencion, medico, diagnostico, archivo, historial_atenciones, licencia
        where atencion.run_paciente='".$persona."' and medico.run = atencion.run_medico and historial_atenciones.run_medico = atencion.run_medico and historial_atenciones.run_paciente = atencion.run_paciente and diagnostico.id_historial_atenciones = historial_atenciones.id and archivo.id_diagnostico = diagnostico.id and licencia.id = archivo.id";
        }
        
        $rs= pg_query($conexion, $query);
        echo "<div class='row sm-4'>";
		if ($rs) {
			while ($obj = pg_fetch_object($rs)) {
                echo '<div class="card mx-1 m-1">';
                echo '<div class="card-body">';
                echo '<h5 class="card-title">'.$obj->nombre_enfermedad.'</h5>';
                echo '<p class="card-text">Fecha Emisión: '.$obj->fecha_inicio.'</p>';
                echo '<p class="card-text">Fecha Expiracion: '.$obj->fecha_termino.'</p>';
                echo '<p class="card-text">Médico: '.$obj->nombre.'</p>';
                echo '</div></div>';
            }
        }
        echo "</div>";
        
    ?>
        
</div>
<script>

</script>
</body>
<html>
