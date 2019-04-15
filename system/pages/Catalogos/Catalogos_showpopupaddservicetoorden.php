
<section id="widget-grid" class="">
  
    <form id="form-servicioadd" class="form-servicioadd" role="form" method=post action="#" onsubmit="return checkSubmit();" enctype="multipart/form-data">
        <fieldset style="padding-top: 10px;">    
            
            <div class="showservicios" style="display: ;">
                <!-- widget edit box -->
                <div class="jarviswidget-editbox" style=""></div>
                <div class="widget-body">
                    <div class="col-sm-12">
                        <div class="col-sm-4">
                            <div class="form-group">
                                <select style="width:100%" class="select2" name="idservicio" id="idservicio">
                                    <option value="0" selected disabled>Selecciona Servicio</option>
                                    <?php 
                                    $obj  = new Servicio();
                                    $list = $obj->getAllArr();
                                    if (is_array($list) || is_object($list))
                                        foreach($list as $val)
                                            echo "<option value='".$val['id']."'>".htmlentities($val['codigo'].'||'.$val['nombre'])."</option>";
                                    
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <select style="width:100%" class="select2" name="idserviciopqte" id="idserviciopqte">
                                    <option value="0" selected disabled>Selecciona Paquete</option>
                                    <?php 
                                    $obj = new Servicio();
                                    $list=$obj->getAllArrPackege();
                                    if (is_array($list) || is_object($list)){
                                        foreach($list as $val){
                                            echo "<option value='".$val['id']."'>".htmlentities($val['codigo'].'||'.$val['nombre'])."</option>";
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-1"></div>
                        <div class="col-sm-2 text-right">
                            
                        </div>
                    </div>
                    <div class='col-sm-12 col-md-12'>
                        <table style='width:100%' class='full-width' id="contservicios">
                            <tr>
                                <th>Codigo</th>
                                <th>Servicio</th>
                                <th>Costo</th>
                                <th class="borrar-td"></th>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </fieldset> 
        <div class="form-actions" style="text-align: center;width: 100%;margin-left: 0px;">
            <div class="row">
               <div class="col-md-12">
                    <button class="btn btn-default btn-md" type="button" class="close" data-dismiss="modal" aria-hidden="true">
                        Cancelar
                    </button>
                    <button class="btn btn-primary btn-md" type="button" id="savenewservice">
                        <i class="fa fa-save"></i>
                        Guardar
                    </button>
                </div>
            </div>
        </div>                              
    </form>
               
</section>

<script type="text/javascript">
    $(document).ready(function() {
        $('#idservicio').select2();
        $('#idserviciopqte').select2();
        $("#idservicio"). change(function(){
                var id = $("#idservicio"). val();
                if(id){
                    var text = $('select[name="idservicio"] option:selected').text();
                    var url = config.base+"/Catalogos/ajax/?action=get&object=getservicio"; // El script a dónde se realizará la petición.
                $.ajax({
                    type: "GET",
                    url: url,
                    data: "id="+id, // Adjuntar los campos del formula=rio enviado.
                    success: function(response){
                        if(response){
                            $('#contservicios').append(response);  
                            $('#idservicio').val('0').trigger('change.select2');
                        }else{
                            notify('error',"Oopss error al agregar servicio"+response);
                        }
                    }
                 });
                return false; // Evitar ejecutar el submit del formulario.
                }
        });
        $("#idserviciopqte"). change(function(){
                var idserv = $("#idserviciopqte"). val();
                if(idserv){
                    var text = $('select[name="idserviciopqte"] option:selected').text();
                    var url = config.base+"/Catalogos/ajax/?action=get&object=getservicio"; // El script a dónde se realizará la petición.
                $.ajax({
                    type: "GET",
                    url: url,
                    data: "id="+idserv, // Adjuntar los campos del formula=rio enviado.
                    success: function(response){
                        if(response){
                            $('#contservicios').append(response);  
                            $('#idserviciopqte').val('0').trigger('change.select2');
                        }else{
                            notify('error',"Oopss error al agregar servicio"+response);
                        }
                    }
                 });
                return false; // Evitar ejecutar el submit del formulario.
                }
        });
         $("body").on('click', '.borrar-servicio', function (e) {
            e.preventDefault();

            var id = $(this).attr("lineid");
            $("[lineid=" + id + "]").remove();
            
        });
        $('body').on('click', '#savenewservice', function(){
            if(!$(".servicio").length>0){
                swal({
                    title: "Advertencia",
                    text: "Se necesitan servicios!",
                    type: "warning",
                });
                return false;
            }
            var id_vehiculo = '<?php echo $id ?>';
            var url  = config.base+"/Catalogos/ajax/?action=get&object=savenewservicetoorden"; 
            var data = "&id_vehiculo=" + id_vehiculo;
            $.ajax({
                type: "POST",
                url: url,
                data: $( "form#form-servicioadd" ).serialize() + data, // Adjuntar los campos del formulario enviado.
                success: function(response){
                    if(response>0){
                        //alert("Group successfully added");
                        notify('success',"Servicio agregado correctamente:"+response);
                        location.reload();
                    }else{
                        notify('error',"Oopss error al agregar servicio"+response);
                    }
                }
             });
            return false; // Evitar ejecutar el submit del formulario.
        });
    });

</script>