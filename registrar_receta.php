<!-- Hay que agregar esto a atencion -->
<div class="modal fade" id="myModal" role="dialog">
                <div class="modal-dialog">

                <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
                        <div class="modal-body">
                            <form role="form" form action="/registrar_receta.php" method="post" >
                            <div class="form-group">
                            <input type="select" list="medicamentos" class="form-control" id="medicamento" placeholder="Ingrese el medicamento">
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
                                            echo "<option value='".$obj->nombre."'>" ;
                                        }
                                    }
                                ?>
                            </datalist>
                            </div>
                            <div class="form-group">
                            <input type="text" class="form-control" id="indicacion" placeholder="Ingrese indicaciones">
                            </div>
                            <div class="form-group">
                            <input type="number" class="form-control" id="dias" placeholder="Cantidad de dias">
                            </div>
                            <div class="form-group">
                            <input type="text" class="form-control" id="cantidad_por_dia" placeholder="Cantidad por día">
                            </div>
                            <button type="submit" class="btn btn-default btn-success btn-block"><span class="glyphicon glyphicon-off"></span> Agregar</button>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-default btn-default pull-left" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Cancel</button>
                        </div>
                    </div>
                </div>
        </div> 

$(document).ready(function(){
    $("#myBtn").click(function(){
        $("#myModal").modal();
    });
});