
<section id="widget-grid" class="">
  <form id="form-<?php echo $page; ?>" class="form-<?php echo $page; ?>" role="form" method=post action="#" onsubmit="return checkSubmit();" enctype="multipart/form-data">
    <fieldset style="padding-top:10px">    
        <input type="hidden" name='status_anterior' id='status_anterior'  value="<?php echo $status; ?>">
        <div class="col-sm-6 col-md-6">
           
            <div class="form-group">
                <label for="name">Cambiar Estatus</label>
                <select style="width:100%" class="select2" name="status" id="status">
                    <?php 
                    
                    $listref= getStatusRefaccion();
                    if (is_array($listref)){
                        foreach($listref as $key => $valref){
                            $selected = ($key == $status) ? " selected ": "";
                            echo "<option  $selected value='".$key."'>".htmlentities($valref)."</option>";
                        }
                    }
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label for="name">Asignar Almacen</label>
                <select style="width:100%" class="select2" name="id_almacen" id="id_almacen">
                    <option value="">Asignar Almacen</option>
                    <?php 
                        $obj = new Almacen();
                        $list=$obj->getAllArr($_SESSION['user_info']['id_taller']);
                        if (is_array($list) || is_object($list)){
                            foreach($list as $val){
                                $selected = ($val['id'] == $almacen) ? " selected ": "";
                                echo "<option ".$selected." value='".$val['id']."'>".htmlentities($val['nombre'])."</option>";
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
            <div class="form-group contproveedor">
                <label for="name">Asignar Proveedor</label>
                <select style="width:100%" class="select2" name="id_proveedor" id="id_proveedor">
                    <?php 
                        $obj = new Proveedor();
                        $list=$obj->getAllArr($_SESSION['user_info']['id_taller']);
                        if (is_array($list) || is_object($list)){
                            foreach($list as $val){
                                $selected = ($val['id'] == $almacen) ? " selected ": "";
                                echo "<option ".$selected." value='".$val['id']."'>".htmlentities($val['nombre'])."</option>";
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
                  <button class="btn btn-primary btn-md" type="button" idaux="<?php echo $id; ?>" id="SaveNewStatusRefaccion" page="<?php echo $page; ?>">
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
        $(".select2").select2({
            multiple: false,
            header: "Selecciona una opcion",
            noneSelectedText: "Seleccionar",
            selectedList: 1
        });
       
        //servicios
		$('body').on('change', '#status', function(){
			//change status
            
			var status    = $('#status').val();
			var statusant = $('#statusant').val();
            console.log(status);
            $(".fechasextras").show();
            $(".contproveedor").show();
            if(status=="Recibida" || status=="Proporcionado-Cliente" || status=="active"){
                $(".fechasextras").hide();
            } 
            if(status=="Proporcionado-Cliente"){
                $(".contproveedor").hide();
            }  
            if(status=="active"){
                $(".fechaestimada").show();
            }  
            if(status=="Reenvio" || status=="Autorizada"){
                $(".fechafin").hide();
            }         
        });
        $('#status').change();
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
</script>