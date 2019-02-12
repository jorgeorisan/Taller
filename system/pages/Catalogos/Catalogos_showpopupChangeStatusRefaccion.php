
<section id="widget-grid" class="">
  <form id="form-<?php echo $page; ?>" class="form-<?php echo $page; ?>" role="form" method=post action="#" onsubmit="return checkSubmit();" enctype="multipart/form-data">
    <fieldset style="padding-top:10px">    
        <input type="hidden" name='status_anterior' id='status_anterior'  value="<?php echo $status; ?>">
        <div class="col-sm-6 col-md-6">
           
            <div class="form-group">
                <label for="name">Cambiar Estatus</label>
                <select style="width:100%" class="select2" name="status" id="status">
                    <option value="">Selecciona Status</option>
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
                <label for="name">Fecha Inicio</label>
                <input type="date" class="form-control" value="<?php echo $fecha_inicio;?>"  placeholder="Fecha Inicio" name="fecha_inicio" id="fecha_inicio" >                                                                                             
            </div> 
            <div class="form-group fechasextras">
                <label for="name">Fecha Estimada</label>
                <input type="date" class="form-control" value="<?php echo $fecha_estimada;?>" placeholder="Fecha Estimada" name="fecha_estimada" id="fecha_estimada" >                                                                                             
            </div> 
           
            <div class="form-group fechasextras">
                <label for="name">Fecha Termino</label>
                <input type="date" class="form-control" value="<?php echo $fecha_fin;?>" placeholder="Fecha Termino" name="fecha_fin" id="fecha_fin" >                                                                                             
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
            $(".fechasextras").show();
            $(".contproveedor").show();
            if(status=="Recibida" || status=="Proporcionado-Cliente"){
                $(".fechasextras").hide();
            } 
            if(status=="Proporcionado-Cliente"){
                $(".contproveedor").hide();
            }           
        });
        
    });
</script>