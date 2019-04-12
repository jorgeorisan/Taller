
<section id="widget-grid" class="">
  
    <form id="form-refaccionadd" class="form-servicioadd" role="form" method=post action="#" onsubmit="return checkSubmit();" enctype="multipart/form-data">
        <fieldset style="padding-top: 10px;">  
             <div class="showrefacciones" style="display: ;">
                <!-- widget edit box -->
                <div class="jarviswidget-editbox" style=""></div>
                <div class="widget-body">
                    <div class="col-sm-12">
                        <div class="col-sm-2"> <input style='' type='number' class="form-control" id='selectcantidad_refaccion' value='1'> </div>
                        <div class="col-sm-4">
                            <div class="form-group" id='contrefaccion'>
                                Selecciona primero el modelo del vehiculo
                            </div>
                            
                        </div>
                        <div class="col-sm-3">
                            
                        </div>
                        <div class="col-sm-1"></div>
                        <div class="col-sm-2 text-right">
                           
                        </div>
                    </div>
                    <div class='col-sm-12 col-md-12'>
                        <table style='width:100%' class='full-width' id="contrefacciones">
                            <tr>
                                <th>Cant.</th>
                                <th>Codigo</th>
                                <th>Refaccion</th>
                                <th>Costo </th>
                                <th>Total </th>
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
                    <button class="btn btn-primary btn-md" type="button" id="savenewrefaccion">
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
        getselectrefaccion= function(id){
            if ( ! id ) return;
        
            $("#contrefaccion").html("<div align='center'><i class='far fa-cog fa-spin fa-2x'></i></div>");
            $.get(config.base+"/Catalogos/ajax/?action=get&object=getselectrefaccion&id=" + id , null, function (response) {
                    if ( response ){
                        $("#contrefaccion").html(response);
                        $('#idrefaccion').select2();
                    }else{
                        notify('error', 'Error al obtener los datos de la refaccion');
                        return false;
                    }     
            });
        }
        getselectrefaccion(<?php echo $datavehiculo['id_submarca']; ?>);
        getrefaccion = function(id) {
            if(id){
                var text     = $('select[name="idrefaccion"] option:selected').text();
                var url      = config.base+"/Catalogos/ajax/?action=get&object=getrefaccion"; 
                var aseg     = <?php echo ($datavehiculo['id_aseguradora']) ? $datavehiculo['id_aseguradora'] : ''; ?>;
                var cantidad = $("#selectcantidad_refaccion").val();
                $.ajax({
                    type: "GET",
                    url: url,
                    data: "id="+id+ "&aseguradora=" + aseg + "&cantidad=" + cantidad, 
                    success: function(response){
                        if(response){
                            $('#contrefacciones').append(response);  
                            $('#idrefaccion').val('').trigger('change.select2');
                            $('#selectcantidad_refaccion').val(1)
                            
                        }else{
                            notify('error',"Oopss error al agregar refaccion"+response);
                        }
                    }
                });
                return false; // Evitar ejecutar el submit del formulario.
            }
        }
       
        $('body').on('change', '#idrefaccion', function(){
            if( $(this).val() ){
                var id = $("#idrefaccion").val();
                getrefaccion(id);
            }
        });
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
    });

</script>