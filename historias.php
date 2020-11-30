<?php
    $title ="Categorias | ";
    include "head.php";
    include "sidebar.php";
?>
        
    <div class="right_col" role="main"><!-- page content -->
        <div class="">
            <div class="page-title">
                <div class="clearfix"></div>
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <?php
                        include("modal/new_historia.php");
                        include("modal/upd_historia.php");
                    ?>
                    <div class="x_panel">
                        <div class="x_title">
                            <h2>Historias de usuario</h2>
                            <ul class="nav navbar-right panel_toolbox">
                                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                </li>
                                <li><a class="close-link"><i class="fa fa-close"></i></a>
                                </li>
                            </ul>
                            <div class="clearfix"></div>
                        </div>
                        
                        <!-- form search -->
                        <form class="form-horizontal" role="form" id="category_expence">
                            <div class="form-group row">
                                <label for="q" class="col-md-2 control-label">Nombre</label>
                                <div class="col-md-4">
                                    <input type="text" class="form-control" id="q" placeholder="Nombre de la historia de usuario" onkeyup='load(1);'>
                                </div>
                                <div class="col-md-3">
                                    <button type="button" class="btn btn-default" onclick='load(1);'>
                                        <span class="glyphicon glyphicon-search" ></span> Buscar</button>
                                    <span id="loader"></span>
                                </div>
                            </div>
                        </form>    
                        <!-- end form search -->

                        <div class="x_content">
                            <div class="table-responsive">
                                <!-- ajax -->
                                    <div id="resultados"></div><!-- Carga los datos ajax -->
                                    <div class='outer_div'></div><!-- Carga los datos ajax -->
                                <!-- /ajax -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div><!-- /page content -->


<?php include "footer.php" ?>

<script type="text/javascript" src="js/historia.js"></script>

<script>
$( "#add" ).submit(function( event ) {
  $('#save_data').attr("disabled", true);
  
 var parametros = $(this).serialize();
     $.ajax({
            type: "POST",
            url: "action/addhistoria.php",
            data: parametros,
             beforeSend: function(objeto){
                $("#result").html("Mensaje: Cargando...");
              },
            success: function(datos){
            $("#result").html(datos);
            $('#save_data').attr("disabled", false);
            load(1);
          }
    });
  event.preventDefault();
})

// success

$( "#upd" ).submit(function( event ) {
  $('#upd_data').attr("disabled", true);
  
 var parametros = $(this).serialize();
     $.ajax({
            type: "POST",
            url: "action/updhistoria.php",
            data: parametros,
             beforeSend: function(objeto){
                $("#result2").html("Mensaje: Cargando...");
              },
            success: function(datos){
            $("#result2").html(datos);
            $('#upd_data').attr("disabled", false);
            load(1);
          }
    });
  event.preventDefault();
})

    function obtener_datos(id){
            var name = $("#nombre"+id).val();
            var prioridad = $("#prioridad"+id).val();
            var usuario = $("#usuario"+id).val();
            var descripcion = $("#descripcion"+id).val();
            var proyecto = $("#proyecto"+id).val();
            $("#mod_id").val(id);
            $("#mod_nombre").val(name);
            $("#mod_usuario").val(usuario);
            $("#mod_prioridad").val(prioridad);
            $("#mod_descripcion").val(descripcion);
            $("#mod_proyecto").val(proyecto);
        }
</script>