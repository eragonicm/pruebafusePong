<?php
$usuario =mysqli_query($con, "select * from user");
$proyecto =mysqli_query($con, "select * from proyecto");
?>
    
    <div> 
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bs-example-modal-lg-new"><i class="fa fa-plus-circle"></i> Agregar Historia</button>
    </div>
    <div class="modal fade bs-example-modal-lg-new" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                    </button>
                    <h4 class="modal-title" id="myModalLabel">Nueva Historia de usuario</h4>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal form-label-left input_mask" method="post" id="add" name="add">
                        <div id="result"></div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Nombre Historia<span class="required">*</span>
                            </label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                              <input name="name" class="form-control col-md-7 col-xs-12" required type="text" placeholder="Nombre Historia de usuario">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Prioridad<span class="required">*</span>
                            </label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                            <select class="form-control" name="prioridad" >
                            <option>Seleccione la prioridad</option>
                                       <option value="Alta">Alta</option>
                                        <option value="media">Media</option>
                                        <option value="baja">Baja</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Programador Responsable<span class="required">*</span>
                            </label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                            <select class="form-control" name="usuario" >
                                      <?php foreach($usuario as $u):?>
                                        <option value="<?php echo $u['id']; ?>"><?php echo $u['name']; ?></option>
                                      <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Descripción <span class="required">*</span>
                            </label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                              <textarea name="description" class="date-picker form-control col-md-7 col-xs-12" required></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Proyecto<span class="required">*</span>
                            </label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                            <select class="form-control" name="proyecto" >
                                      <?php foreach($proyecto as $p):?>
                                        <option value="<?php echo $p['id']; ?>"><?php echo $p['nombre']; ?></option>
                                      <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="ln_solid"></div>
                        <div class="form-group">
                            <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
                              <button id="save_data" type="submit" class="btn btn-success">Guardar</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div> <!-- /Modal -->