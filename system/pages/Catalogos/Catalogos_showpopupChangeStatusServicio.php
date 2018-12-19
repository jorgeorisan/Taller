
<section id="widget-grid" class="">
  <form id="form-<?php echo $page; ?>" class="form-<?php echo $page; ?>" role="form" method=post action="#" onsubmit="return checkSubmit();" enctype="multipart/form-data">
    <fieldset style="padding-top:10px">    
        <input type="hidden" name='status_anterior' value="<?php echo $statusant; ?>">
        <div class="col-sm-6 col-md-6">
           
            <div class="form-group">
                <label for="name">Cambiar Estatus</label>
                <select style="width:100%" class="select2" name="status" id="status">
                    <option value="">Selecciona Status</option>
                    <?php 
                    
                    $listref= getStatusServicio();
                    if (is_array($listref)){
                        foreach($listref as $key => $valref){
                            $selected = ($key == $statusant) ? " selected ": "";
                            echo "<option  $selected value='".$key."'>".htmlentities($valref)."</option>";
                        }
                    }
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label for="name">Asignar Persona</label>
                <select style="width:100%" class="select2" name="id_userasigned" id="id_userasigned">
                    <option value="">Asignar Persona</option>
                    <?php 
                    $objref = new User();
                    $listref=$objref->getAllArr();
                    if (is_array($listref) || is_object($listref)){
                        foreach($listref as $valref){
                            echo "<option value='".$valref['id']."'>".htmlentities($valref['nombre'])."</option>";
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
                <input type="date" class="form-control" placeholder="Fecha Inicio" name="fecha_inicio" id="" >                                                                                             
            </div> 
            <div class="form-group">
                <label for="name">Fecha Estimada</label>
                <input type="date" class="form-control" placeholder="Fecha Estimada" name="fecha_estimada" id="" >                                                                                             
            </div> 
           
            <div class="form-group">
                <label for="name">Fecha Termino</label>
                <input type="date" class="form-control" placeholder="Fecha Termino" name="fecha_fin" id="" >                                                                                             
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
        $("#id_userasigned").select2({
            multiple: false,
            header: "Selecciona una opcion",
            noneSelectedText: "Seleccionar",
            selectedList: 1
        });
        
    });
</script>