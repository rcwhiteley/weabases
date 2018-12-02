<!doctype html>
<html lang=''>
<head>
   <meta charset='utf-8'>
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <link rel="stylesheet" href="/style/styles.css">
   <meta name="viewport" content="width=device-width, initial-scale=1"><link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
   <title>Atencion</title>
</head>
<body>

 <?php include'menu.php'; ?>
<div class="container m-5"?>
 <?php
    $atencion = $_GET;
    
    $id=$_GET['id'];
    $soyMedico = $_COOKIE["tipo"] == "medico";
	$conexion = pg_connect("host=bdd.inf.udec.cl port=5432 dbname=bdi2018a user=bdi2018a password=bdi2018a")
    or die ("Fallo!!!!");
    $search_path = "SET search_path TO proyecto"; 
	pg_query($conexion,$search_path);
    $query="SELECT *, diagnostico.id as id_diagnostico FROM historial_atenciones, diagnostico,medico WHERE historial_atenciones.id='".$id."' and historial_atenciones.run_medico=medico.run and diagnostico.id_historial_atenciones = historial_atenciones.id";

    $id_diagnostico = -1;
    echo '
    <form action="/registrar_diagnostico.php?id='.$id.'" action="get">
        <div class="form-group hidden">
            <input type="hidden" id="id_atencion_diagnostico" name="id_atencion_diagnostico" value="'.$id.'">
        </div>
        <input class="btn btn-primary ml-2" type="submit" value="Crear diagnostico" />
    </form>';
		$result= pg_query($conexion, $query);
		if ($result) {
           
            while( $obj = pg_fetch_object($result)){
                
                $id_diagnostico = $obj->id_diagnostico;
                
                echo '<div class="card my-2 mx-2">';
                
                echo '<div class="card-header">Enfermedad: '.$obj->nombre_enfermedad;
                if($soyMedico)
                    echo '<button cambiarenfermedad='.$id_diagnostico.' class="mx-5"> Cambiar </button>';  
                ?>
                    

                </div>
                <div class="card-body">
                <?php if($soyMedico){ echo '
                <form role="form" action="/registrar_sintoma.php" method="post">
                    <div class="row">
                        <div class="mx-3 form-group">
                            <input id="sintoma" name="sintoma" list="sintomas" type="select" class="form-control" placeholder="Sintoma">
                            <datalist id="sintomas">';
                            
                            $conexion = pg_connect("host=bdd.inf.udec.cl port=5432 dbname=bdi2018a user=bdi2018a password=bdi2018a")
                            or die ("Fallo!!!!");
                            $search_path = "SET search_path TO proyecto"; 
                            pg_query($conexion,$search_path);
                            $query="SELECT * FROM sintoma";
                            $rs= pg_query($conexion, $query);
                            if ($rs) {
                                while ($obj = pg_fetch_object($rs)) {
                                    echo "<option value='".$obj->nombre."'></option>" ;
                                }
                            }
                            echo '
                            </datalist>
                        </div>
                        <div class="mx-3 form-group">
                            <input id="informacion" name="informacion" type="text" class="form-control" placeholder="Información">
                         </div>
                         <div class="form-group hidden">
                             <input type="hidden" id="id_diagnostico_sintomas" name="id_diagnostico_sintomas" value="'.$id_diagnostico.'">
                        </div>
                        <div class="form-group hidden">
                            <input type="hidden" id="id_atencion_sintomas" name="id_atencion_sintomas" value="'.$id.'">
                        </div>
                        <div class="mx-3 form-group">
                            <input type="submit" value="agregar" class="btn btn-primary">
                        </div>
                   </div> 
                            
                </form>';
                }
                ?>
                <div class="card-header">Síntomas</div>
               

                <?php
                echo '<div class="card-body">';
                $query = "select * from diagnostica_sintoma where id_diagnostico=".$id_diagnostico;
                echo "<table class='table'>";
                echo "<th>Síntoma</th>";
                echo "<th>Información</th>";
                $rs = pg_query($conexion, $query);
                if($rs){
                    while ($obj = pg_fetch_object($rs)){
                        echo '<tr>';
                        echo '<td>'.$obj->nombre_sintoma.'</td>';
                        echo '<td>'.$obj->descripcion.'</td>';
                        echo '</tr>';
                    }
                }
                echo '</table>';
                echo '</div>';
                echo '</div>';
                echo '<div class="row mx-5">';
                
                echo '<button class="btn btn-primary m-3"> Ver recetas</button>';  
                if($soyMedico)
                echo '<button addreceta='.$id_diagnostico.' id="addReceta" class="btn btn-primary m-3"> Agregar receta</button>';
        
                echo '<button class="btn btn-primary m-3"> Ver licencias</button>';  
                if($soyMedico)
                echo '<button addlicencia='.$id_diagnostico.' class="btn btn-primary m-3"> Agregar Licencia</button>';
                
                echo '<button class="btn btn-primary m-3"> Ver examenes</button>';  
                if($soyMedico)
                echo '<button class="btn btn-primary m-3"> Agregar examen</button>';
                echo '</div>';
                echo '</div>';
            }
        }
    echo '</div></div>';

 ?>

<div class="modal fade" id="addRecetaModal" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <form role="form" form action="/registrar_receta.php" method="post" >
                    <div class="form-group">
                        <input type="select" list="medicamentos" class="form-control" id="medicamento" name="medicamento" placeholder="Ingrese el medicamento">
                        <datalist id="medicamentos">
                            <?php
                            $conexion = pg_connect("host=bdd.inf.udec.cl port=5432 dbname=bdi2018a user=bdi2018a password=bdi2018a")
                            or die ("Fallo!!!!");
                            $search_path = "SET search_path TO proyecto"; 
                            pg_query($conexion,$search_path);
                            $query="SELECT * FROM medicamento";
                            $rs= pg_query($conexion, $query);
                            if ($rs) {
                                while ($obj = pg_fetch_object($rs)) {
                                    echo "<option value='".$obj->nombre."'></option>" ;
                                }
                            }
                            ?>
                        </datalist>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="indicacion" name="indicacion" placeholder="Ingrese indicaciones">
                    </div>
                    <div class="form-group">
                        <input type="number" class="form-control" id="dias" name="dias" placeholder="Cantidad de dias">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="cantidad_por_dia" name="cantidad_por_dia" placeholder="Cantidad por día">
                    </div>
                    <div class="form-group hidden">
                        <?php echo '<input type="hidden" id="id_diagnostico" name="id_diagnostico" value="'.$id_diagnostico.'">'?>
                    </div>
                    <div class="form-group hidden">
                        <?php echo '<input type="hidden" id="id_atencion" name="id_atencion" value="'.$id.'">'?>
                    </div>
                    <input type="submit" class="btn btn-default btn-success btn-block"><span class="glyphicon glyphicon-off"></span>
                </form>
            </div>
                    
        </div>
    </div>
</div>

<div class="modal fade" id="addLicenciaModal" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <form role="form" form action="/registrar_licencia.php" method="post" >
                    <div class="form-group">
                        <input type="number" class="form-control" id="dias" name="dias" placeholder="Cantidad de dias">
                    </div>
                    <div class="form-group hidden">
                        <?php echo '<input type="hidden" id="id_diagnostico_licencia" name="id_diagnostico_licencia" value="'.$id_diagnostico.'">'?>
                    </div>
                    <div class="form-group hidden">
                        <?php echo '<input type="hidden" id="id_atencion_licencia" name="id_atencion_licencia" value="'.$id.'">'?>
                    </div>
                    <input type="submit" class="btn btn-default btn-success btn-block"><span class="glyphicon glyphicon-off"></span>
                </form>
            </div>
                    
        </div>
    </div>
</div>

<div class="modal fade" id="cambiarEnfermedadModal" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <form role="form" form action="/cambiar_enfermedad.php" method="post" >
                    <div class="form-group">
                        <input type="select" list="enfermedades" class="form-control" id="enfermedad" name="enfermedad" placeholder="Ingrese enfermedad">
                        <datalist id="enfermedades">
                            <?php
                            $conexion = pg_connect("host=bdd.inf.udec.cl port=5432 dbname=bdi2018a user=bdi2018a password=bdi2018a")
                            or die ("Fallo!!!!");
                            $search_path = "SET search_path TO proyecto"; 
                            pg_query($conexion,$search_path);
                            $query="SELECT * FROM enfermedad";
                            $rs= pg_query($conexion, $query);
                            if ($rs) {
                                while ($obj = pg_fetch_object($rs)) {
                                    echo "<option value='".$obj->nombre."'></option>" ;
                                }
                            }
                            ?>
                        </datalist>
                    </div>
                    
                    <div class="form-group hidden">
                        <?php echo '<input type="hidden" id="id_diagnostico_enfermedad" name="id_diagnostico_enfermedad" value="-1">'?>
                    </div>
                    <div class="form-group hidden">
                        <?php echo '<input type="hidden" id="id_atencion_enfermedad" name="id_atencion_enfermedad" value="'.$id.'">'?>
                    </div>
                    <input type="submit" class="btn btn-default btn-success btn-block"><span class="glyphicon glyphicon-off"></span>
                </form>
            </div>
                    
        </div>
    </div>
</div>


<script>
$(document).ready(function(){
    $("[addreceta]").each(function(){
        var id = $(this).attr('addreceta');
         $(this).click(function(){
             $("#id_diagnostico").attr('value', id);
            $("#addRecetaModal").modal();
        });
    });
    $("[addlicencia]").each(function(){
        var id = $(this).attr('addlicencia');
         $(this).click(function(){
             $("#id_diagnostico_licencia").attr('value', id);
            $("#addLicenciaModal").modal();
        });
    });
    $("[cambiarenfermedad]").each(function(){
        var id = $(this).attr('cambiarenfermedad');
         $(this).click(function(){
             $("#id_diagnostico_enfermedad").attr('value', id);
            $("#cambiarEnfermedadModal").modal();
        });
    });
    //$("#addReceta").click(function(){
    //    $("#addRecetaModal").modal();
    //});
});
</script>
</div>
</body>
<html>