
<section id="widget-grid" class="">
  <form id="form-<?php echo $page; ?>" class="form-<?php echo $page; ?>" role="form" method=post action="#" onsubmit="return checkSubmit();" enctype="multipart/form-data">
    <fieldset style="padding-top:10px">    
        <input type="hidden" name='status_anterior' id='status_anterior' value="<?php echo $status; ?>">
        <div class="col-sm-6 col-md-6">
           
            <div class="form-group">
                <label for="name">Cambiar Estatus</label>
                <select style="width:100%" class="select2" name="status" id="status">
                    <option value="">Selecciona Status </option>
                    <?php 
                    
                    $listref= getStatusServicio();
                    if (is_array($listref)){
                        foreach($listref as $key => $valref){
                            $selected = ($key == $status) ? " selected ": "";
                            $disabled = '';
                            if($key == 'Garantia' && $status != 'Realizado' )
                                continue;

                            if( $status == 'Realizado' && ($key != 'Garantia' || $key == 'Realizado'))
                                continue;

                            echo "<option $selected value='".$key."'>".htmlentities($valref).$disabled."</option>";
                        }
                    }
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label for="name">Asignar Personal</label>
                <select style="width:100%" class="select2" name="id_personal" id="id_personal">
                    <option value="">--Selecciona--</option>
                    <?php 
                    $objper = new Personal();
                    $lisper=$objper->getAllArr();
                    if (is_array($lisper) || is_object($lisper)){
                        foreach($lisper as $key => $valref){
                            $selected = ($valref['id'] == $personal) ? " selected ": "";
                            echo "<option $selected  value='".$valref['id']."'>".htmlentities($valref['nombre']." ".$valref['apellido_pat'])."</option>";
                        }
                    }
                    ?>
                </select>
            </div>
    
            <div class="form-group">
                <label for="name">Comentarios</label>
                <input type="text" class="form-control" placeholder="Comentarios" name="comentarios" id="comentarios" >                                                                                             
            </div> 
                                           
        </div>
        <div class="col-sm-6 col-md-6">
            <div class="form-group">
                <label for="name">Fecha Inicio </label>
                <div class="input-group date form_datetime col-md-12" data-date="<?php echo $fecha_inicio ;?>"  data-link-field="fecha_inicio">
                    <input class="form-control" size="16" type="text" value="<?php echo $fecha_inicio;?>" readonly>
                    <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
					<span class="input-group-addon"><span class="glyphicon glyphicon-th"></span></span>
                </div>
				<input type="hidden" name="fecha_inicio" id="fecha_inicio" value="<?php echo $fecha_inicio;?>" />
            </div> 
            
            <div class="form-group">
                <label for="name">Fecha Estimada</label>
                <div class="input-group date form_datetime col-md-12" data-date="<?php echo $fecha_estimada;?>"  data-link-field="fecha_estimada">
                    <input class="form-control" size="16" type="text" value="<?php echo $fecha_estimada;?>" readonly>
                    <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
					<span class="input-group-addon"><span class="glyphicon glyphicon-th"></span></span>
                </div>
				<input type="hidden" name="fecha_estimada" id="fecha_estimada" value="<?php echo $fecha_estimada;?>" />
            </div> 
           
            <div class="form-group">
                <label for="name">Fecha Termino</label>
                <div class="input-group date form_datetime col-md-12" data-date="<?php echo $fecha_fin;?>"  data-link-field="fecha_fin">
                    <input class="form-control" size="16" type="text" value="<?php echo $fecha_fin;?>" readonly>
                    <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
					<span class="input-group-addon"><span class="glyphicon glyphicon-th"></span></span>
                </div>
				<input type="hidden" name="fecha_fin" id="fecha_fin" value="<?php echo $fecha_fin;?>" />
            </div> 
                                           
        </div>
               
    </fieldset> 
      <div class="form-actions" style="text-align: center;width: 100%;margin-left: 0px;">
          <div class="row">
             <div class="col-md-12">
                  <button class="btn btn-default btn-md" type="button" class="close" data-dismiss="modal" aria-hidden="true">
                      Cancelar
                  </button>
                  <button class="btn btn-primary btn-md" type="button" idaux="<?php echo $id; ?>" id="SaveNewStatus" page="<?php echo $page; ?>">
                      <i class="fa fa-save"></i>
                      Guardar
                  </button>
              </div>
          </div>
      </div>                              
  </form>
             
</section>
<script>
   
    $(document).ready(function() { 
        $("#status").select2({
            multiple: false,
            header: "Selecciona una opcion",
            noneSelectedText: "Seleccionar",
            selectedList: 1
        });
        $("#id_personal").select2({
            multiple: false,
            header: "Selecciona una opcion",
            noneSelectedText: "Seleccionar",
            selectedList: 1
        });
        $('.form_datetime').datetimepicker({
            format: "yyyy-mm-dd hh:ii",
            language:  'es',
            weekStart: 0,
            todayBtn:  1,
            autoclose: 1,
            todayHighlight: 1,
            startView: 2,
            forceParse: 0,
            showMeridian: 0,
            minuteStep :30
        });
    });
</script>
