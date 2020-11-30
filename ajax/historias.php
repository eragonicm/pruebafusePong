<?php

    include "../config/config.php";//Contiene funcion que conecta a la base de datos
    
    $action = (isset($_REQUEST['action']) && $_REQUEST['action'] !=NULL)?$_REQUEST['action']:'';
    if (isset($_GET['id'])){
        $id_del=intval($_GET['id']);
        $query=mysqli_query($con, "SELECT * from historia_usuario where id='".$id_del."'");
        $count=mysqli_num_rows($query);
            if ($delete1=mysqli_query($con,"DELETE FROM historia_usuario WHERE id='".$id_del."'")){
            ?>
            <div class="alert alert-success alert-dismissible" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <strong>Aviso!</strong> Datos eliminados exitosamente.
            </div>
    <?php 
        }else {
    ?>
            <div class="alert alert-danger alert-dismissible" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <strong>Error!</strong> No se pudo eliminar ésta  Historia. Existen Tickets vinculadas a ésta Historia. 
            </div>
<?php
        } //end else
    } //end if
?>

<?php
    if($action == 'ajax'){
        // escaping, additionally removing everything that could be (html/javascript-) code
         $q = mysqli_real_escape_string($con,(strip_tags($_REQUEST['q'], ENT_QUOTES)));
         $aColumns = array('nombre');//Columnas de busqueda
         $sTable = "historia_usuario as h";
         $sWhere = "";
        if ( $_GET['q'] != "" )
        {
            $sWhere = "WHERE (";
            for ( $i=0 ; $i<count($aColumns) ; $i++ )
            {
                $sWhere .= $aColumns[$i]." LIKE '%".$q."%' OR ";
            }
            $sWhere = substr_replace( $sWhere, "", -3 );
            $sWhere .= ')';
        }
        $sWhere.=" order by h.nombre desc";
        include 'pagination.php'; //include pagination file
        //pagination variables
        $page = (isset($_REQUEST['page']) && !empty($_REQUEST['page']))?$_REQUEST['page']:1;
        $per_page = 10; //how much records you want to show
        $adjacents  = 4; //gap between pages after number of adjacents
        $offset = ($page - 1) * $per_page;
        //Count the total number of row in your table*/
        $count_query   = mysqli_query($con, "SELECT count(*) AS numrows FROM $sTable  $sWhere");
        $row= mysqli_fetch_array($count_query);
        $numrows = $row['numrows'];
        $total_pages = ceil($numrows/$per_page);
        $reload = './historias.php';
        //main query to fetch the data
        $sql="SELECT  h.id,p.nombre as nombreproyecto,p.id as idproyecto,p.id,h.nombre,h.prioridad,u.name,h.descripcion from $sTable inner join user as u on h.id_usuario = u.id join proyecto as p on p.id = h.id_proyecto $sWhere LIMIT $offset,$per_page";
        $query = mysqli_query($con, $sql);
        //loop through fetched data
        if ($numrows>0){
            
            ?>
            <table class="table table-striped jambo_table bulk_action">
                <thead>
                    <tr class="headings">
                        <th class="column-title">Nombre Historia</th>
                        <th class="column-title">Prioridad</th>
                        <th class="column-title">Programador Responsable</th>
                        <th class="column-title">Descripcion</th>
                        <th class="column-title">Proyecto</th>
                        <th class="column-title no-link last"><span class="nobr"></span></th>
                    </tr>
                </thead>
                <tbody>
                <?php 
                    while ($r=mysqli_fetch_array($query)) {
                        $id=$r['id'];
                        $name=$r['nombre'];
                        $prioridad=$r['prioridad'];
                        $usuario=$r['name'];
                        $descripcion=$r['descripcion'];
                        $proyecto=$r['nombreproyecto'];
                        $id_proyecto=$r['idproyecto'];

                        
                ?>
                    <input type="hidden" value="<?php echo $id;?>" id="id<?php echo $id;?>">
                    <input type="hidden" value="<?php echo $name;?>" id="nombre<?php echo $id;?>">
                    <input type="hidden" value="<?php echo $prioridad;?>" id="prioridad<?php echo $id;?>">
                    <input type="hidden" value="<?php echo $usuario;?>" id="name<?php echo $id;?>">
                    <input type="hidden" value="<?php echo $descripcion;?>" id="descripcion<?php echo $id;?>">
                    <input type="hidden" value="<?php echo $proyecto;?>" id="nombreproyecto<?php echo $id;?>">

                    <tr class="even pointer">
                        <td ><?php echo $name; ?></td>
                        <td ><?php echo $prioridad; ?></td>
                        <td ><?php echo $usuario; ?></td>
                        <td ><?php echo $descripcion; ?></td>
                        <td ><?php echo $proyecto; ?></td>
                        <td ><span class="pull-right">
                        <a href="#" class='btn btn-default' title='Editar producto' onclick="obtener_datos('<?php echo $id;?>');" data-toggle="modal" data-target=".bs-example-modal-lg-udp"><i class="glyphicon glyphicon-edit"></i></a> 
                        <a href="#" class='btn btn-default' title='Borrar producto' onclick="eliminar('<?php echo $id; ?>')"><i class="glyphicon glyphicon-trash"></i> </a></span></td>
                    </tr>
            <?php
                } //end while
            ?>
                <tr>
                    <td colspan=6><span class="pull-right">
                        <?php echo paginate($reload, $page, $total_pages, $adjacents);?>
                    </span></td>
                </tr>
              </table>
            </div>
            <?php
        }else{
           ?> 
            <div class="alert alert-warning alert-dismissible" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <strong>Aviso!</strong> No hay datos para mostrar
            </div>
        <?php    
        }
    }
?>