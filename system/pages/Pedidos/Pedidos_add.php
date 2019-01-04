 <?php
//initilize the page
require_once(SYSTEM_DIR . "/inc/init.php");

//require UI configuration (nav, ribbon, etc.)
require_once(SYSTEM_DIR . "/inc/config.ui.php");

/*---------------- PHP Custom Scripts ---------

YOU CAN SET CONFIGURATION VARIABLES HERE BEFORE IT GOES TO NAV, RIBBON, ETC.
E.G. $page_title = "Custom Title" */

$page_title = "Nuevo Pedido";

/* ---------------- END PHP Custom Scripts ------------- */

//include header
//you can add your custom css in $page_css array.
//Note: all css files are inside css/ folder
$page_css[] = "vehiculo_style.css";
include(SYSTEM_DIR . "/inc/header.php");

//include left panel (navigation)
//follow the tree in inc/config.ui.php
//$page_nav["misc"]["sub"]["blank"]["active"] = true;
include(SYSTEM_DIR . "/inc/nav.php");
if(isPost()){
    $obj = new Pedido();
    $id  = $obj->addAll(getPost());
    //$id=240;
    
    if ($id > 0){
        informSuccess(true, make_url("Pedidos","showorden",array('id'=>$id)));
    }else{
        informError(true,make_url("Pedidos","add"));
    }
}
?>
<!-- ==========================CONTENT STARTS HERE ========================== -->

<!-- MAIN PANEL -->
<div id="main" role="main">
    <?php $breadcrumbs["Pedidos"] = APP_URL."/Pedidos/index"; include(SYSTEM_DIR . "/inc/ribbon.php"); ?>
    <!-- MAIN CONTENT -->
    <div id="content">
        <div class="row"> 
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">   
                <div class="well ">
                    <header>
                            <h2><i class="fa fa-automobile"></i>&nbsp;<?php echo $page_title ?></h2>
                    </header>
                    <fieldset>          
                        <form id="main-form" class="" role="form" method='post' action="<?php echo make_url("Pedidos","add");?>" onsubmit="return checkSubmit();" enctype="multipart/form-data">    

                            <section id="widget-grid" class="">
                                <article class="col-sm-12 col-md-12 col-lg-12"  id="article-1">
                                    <div class="jarviswidget  jarviswidget-sortable jarviswidget-collapsed" id="wid-recepcion" 
                                    data-widget-deletebutton="false" data-widget-colorbutton="false" data-widget-editbutton="false"  data-widget-fullscreenbutton="false" data-widget-collapsed="false" >
                                        <header onclick="$('.showrecepcion').toggle()"> <span class="widget-icon"> 
                                            <i class="far fa-building"></i> </span><h2>Datos Pedido</h2>
                                        </header>
                                        <div class="showrecepcion" style="display: ;">
                                            <!-- widget edit box -->
                                            <div class="jarviswidget-editbox" style=""></div>
                                            <div class="widget-body">
                                                <div class="col-sm-12">
                                                    <div class="col-sm-4">
                                                        <div class="form-group">
                                                            <input type="text" class="form-control datepicker" data-dateformat='yy-mm-dd' autocomplete="off" value="<?php echo date('Y-m-d'); ?>" placeholder="Fecha de pedido" name="fecha_alta" >
                                                            
                                                        </div>
                                                        <div class="form-group">
                                                            <input type="text" class="form-control" autocomplete="off" placeholder="Nombre Pedido" name="nombre" >
                                                            
                                                        </div>
                                                        
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <div class="form-group">
                                                            <select style="width:100%" class="select2" name="id_proveedor" id="id_proveedor">
                                                                <option value="" selected disabled>Selecciona Proveedor</option>
                                                                <?php 
                                                                $obj = new Proveedor();
                                                                $list=$obj->getAllArr();
                                                                if (is_array($list) || is_object($list)){
                                                                    foreach($list as $val){
                                                                        echo "<option value='".$val['id']."'>".htmlentities($val['nombre'])."</option>";
                                                                    }
                                                                }
                                                                 ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-4">    
                                                        <div class="form-group">
                                                            <select style="width:100%" class="select2" name="id_almacen" id="id_almacen">
                                                                <option value="1" selected disabled>Selecciona Almacen</option>
                                                                <?php 
                                                                $obj = new Almacen();
                                                                $list=$obj->getAllArr($_SESSION['user_info']['id_taller']);
                                                                if (is_array($list) || is_object($list)){
                                                                    foreach($list as $val){
                                                                        $selected = "";
                                                                        echo "<option ".$selected." value='".$val['id']."'>".htmlentities($val['nombre'])."</option>";
                                                                    }
                                                                }
                                                                 ?>
                                                            </select>
                                                        </div>                                                 
                                                    </div> 
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="jarviswidget  jarviswidget-sortable jarviswidget-collapsed" id="wid-refacciones" 
                                    data-widget-deletebutton="false" data-widget-colorbutton="false" data-widget-editbutton="false"  data-widget-fullscreenbutton="false" data-widget-collapsed="false" >
                                        <header onclick="$('.showrefacciones').toggle()"> <span class="widget-icon"> 
                                            <i class="far fa-box-full"></i> </span><h2>Refacciones</h2>
                                        </header>
                                        <div class="showrefacciones" style="display: ;">
                                            <!-- widget edit box -->
                                            <div class="jarviswidget-editbox" style=""></div>
                                            <div class="widget-body">
                                                <div class="col-sm-12">
                                                    <div class="col-sm-1"> <input style='' type='number' class="form-control" id='selectcantidad_refaccion' value='1'> </div>
                                                    <div class="col-sm-4">
                                                        <div class="form-group">
                                                            <div class="col-sm-6">
                                                                <select style="width:50%" class="select2" name="id_marca" id="id_marca">
                                                                    <option value="" selected disabled>Selecciona Marca</option>
                                                                    <?php 
                                                                    $obj = new Marca();
                                                                    $list=$obj->getAllArr();
                                                                    if (is_array($list) || is_object($list)){
                                                                        foreach($list as $val){
                                                                            echo "<option value='".$val['id']."'>".htmlentities($val['nombre'])."</option>";
                                                                        }
                                                                    }
                                                                    ?>
                                                                </select>
                                                            </div>
                                                            <div class="col-sm-6">
                                                                <div class="form-group" id="contsubmarca">
                                                                    <select style="width:50%" class="select2" name="id_submarca" id="id_submarca">
                                                                        <option value="" selected disabled>Selecciona Modelo</option>
                                                                        <?php 
                                                                        $obj = new SubMarca();
                                                                        $list=$obj->getAllArr();
                                                                        if (is_array($list) || is_object($list)){
                                                                            foreach($list as $val){
                                                                                echo "<option value='".$val['id']."'>".htmlentities($val['nombre'])."</option>";
                                                                            }
                                                                        }
                                                                        ?>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group" id='contrefaccion'>
                                                            Selecciona primero el modelo del vehiculo
                                                        </div>
                                                        
                                                    </div>
                                                    <div class="col-sm-1">
                                                         <a data-toggle="modal" title="Nueva Refaccion"  class="btn btn-success" href="#myModal" onclick="showpopuprefaccion()" > <i class="fa fa-plus"></i></a>
                                                    </div>
                                                    <div class="col-sm-1">
                                                         <a data-toggle="modal" title="Buscar Refaccion" class="btn btn-info" href="#myModal" onclick="showpopuprefaccionbuscar()" > <i class="fa fa-search"></i></a>
                                                    </div>
                                                    <div class="col-sm-3">
                                                        
                                                    </div>
                                                    <div class="col-sm-1"></div>
                                                    <div class="col-sm-2 text-right">
                                                        <h6><strong >Total=<span id="total-numrefaccion"></span></strong></h6>
                                                        <input type="hidden" name="total-globalrefaccion" id="total-globalrefaccion" value="0"/>
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
                                    </div>
                                </article>                               
                            </section>                                       
                        </form>
                    </fieldset>
                    <footer>
                        <div class="form-actions" style="text-align: center">
                            <div class="row">
                               <div class="col-md-12">
                                    <button class="btn btn-default btn-md" type="button" onclick="window.history.go(-1); return false;">
                                        Cancelar
                                    </button>
                                    <button class="btn btn-primary btn-md" type="button" onclick=" validateForm();">
                                        <i class="fa fa-save"></i>
                                        Guardar
                                    </button>
                                </div>
                            </div>
                        </div>
                    </footer>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                    &times;
                </button>
                <h4 class="modal-title">
                    <img src="<?php echo ASSETS_URL; ?>/img/logo.png" width="50" alt="SmartAdmin">
                    <div id='titlemodal' style="float:right; margin-right: 20px;">
                        <span class="widget-icon"><i class="fa fa-plus"></i> Nuevo</span>
                    </div>
                    
                </h4>
            </div>
            <div class="modal-body no-padding" >
                <div id="contentpopup">

                </div>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
<!-- /.modal -->
<!-- END MAIN PANEL -->
<!-- ==========================CONTENT ENDS HERE ========================== -->

<!-- PAGE FOOTER -->
<?php
    // include page footer
    include(SYSTEM_DIR . "/inc/footer.php");
?>
<!-- END PAGE FOOTER -->

<?php
    //include required scripts
    include(SYSTEM_DIR . "/inc/scripts.php");
?>

<!-- PAGE RELATED PLUGIN(S)
<script src="<?php echo ASSETS_URL; ?>/js/plugin/YOURJS.js"></script>-->

<script>
   
    $(document).ready(function() {
         $(".select2").select2({
            multiple: false,
            header: "Selecciona una opcion",
            noneSelectedText: "Seleccionar",
            selectedList: 1
        });
        /*GENERALES*/
        getsubmarca= function(id){
            if ( ! id ) return;
            $("#contsubmarca").html("<div align='center'><i class='far fa-cog fa-spin fa-2x'></i></div>");
            $.get(config.base+"/Vehiculos/ajax/?action=get&object=getsubmarca&id=" + id, null, function (response) {
                    if ( response ){
                        $("#contsubmarca").html(response);
                        $('#id_submarca').select2();
                    }else{
                        notify('error', 'Error al obtener los datos del cliente');
                        return false;
                    }     
            });
        }
        validateForm =function(){
            var fecha_alta    = $("input[name=fecha_alta]").val();
            var fecha_promesa = $("input[name=fecha_promesa]").val();
            var id_user       = $("#id_user").val();
            var id_taller     = $("#id_taller").val();
            var id_cliente    = $("#id_cliente").val();
            var id_marca      = $("#id_marca").val();
            var id_submarca   = $("#id_submarca").val();
            var modelo        = $("#modelo").val();
            console.log
            if ( ! fecha_alta )    return notify("info","La fecha de alta es requerida");
            if ( ! fecha_promesa ) return notify("info","La fecha de promesa es requerida");
            if ( ! id_user )       return notify("info","El asesor es requerido");
            if ( ! id_taller )     return notify("info","El taller es requerido");
            if ( ! id_cliente )    return notify("info","El cliente es requerido");
            if ( ! id_marca )      return notify("info","La marca es requerida");
            if ( ! id_submarca )   return notify("info","El modelo es requerido");
            if ( ! modelo )        return notify("info","El año es requerido");
            
            $("#main-form").submit();       
        }
        $(document).keydown(function(event) {
            if (event.ctrlKey==true && (event.which == '106' || event.which == '74')) {
                // alert('thou. shalt. not. PASTE!');
                event.preventDefault();
            }
        });
        //**********Refaccion*************/
        getrefaccion = function(id) {
            if(id){
                var text = $('select[name="idrefaccion"] option:selected').text();
                var url = config.base+"/Catalogos/ajax/?action=get&object=getrefaccion"; // El script a dónde se realizará la petición.
                var aseg     = $("#id_aseguradora").val();
                var cantidad = $("#selectcantidad_refaccion").val();
                $.ajax({
                    type: "GET",
                    url: url,
                    data: "id="+id+ "&aseguradora=" + aseg + "&cantidad=" + cantidad, // Adjuntar los campos del formula=rio enviado.
                    success: function(response){
                        if(response){
                            $('#contrefacciones').append(response);  
                            $('#idrefaccion').val('').trigger('change.select2');
                            $('#selectcantidad_refaccion').val(1)
                            calcTotalrefaccion();
                        }else{
                            notify('error',"Oopss error al agregar refaccion"+response);
                        }
                    }
                });
                return false; // Evitar ejecutar el submit del formulario.
            }
        }
        calcTotalrefaccion = function() {
            var costos     = $(".costorefaccion");
            var totales    = $(".totalesrefaccion");
            var cantidades = $(".cantidadesrefaccion");
            var total = 0;
            if($("#id_aseguradora").val()==null || $("#id_aseguradora").val()==1 ){
                for (var i = 0, len = costos.length; i < len; i++) {
                    var valor=$(costos[i]).val();
                    if (! isNaN( valor )  && valor > 0 ){
                        total += parseFloat(valor*$(cantidades[i]).val());
                        $(totales[i]).val(valor*$(cantidades[i]).val());
                        //console.log(total);    
                    }
                }
            }
            

            $("#total-numrefaccion").html(total);
            $("#total-globalrefaccion").val(total);
        }
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
        showpopuprefaccion= function(){
            $('#titlemodal').html('<span class="widget-icon"><i class="far fa-plus"></i> Nueva Refaccion</span>');
            $.get(config.base+"/Catalogos/ajax/?action=get&object=showpopuprefaccion", null, function (response) {
                    if ( response ){
                        $("#contentpopup").html(response);
                    }else{
                        return notify('error', 'Error al obtener los datos del Formulario');
                        
                    }     
            });
        }
        showpopuprefaccionbuscar= function(){
            $('#titlemodal').html('<span class="widget-icon"><i class="far fa-search"></i> Buscar Refaccion</span>');
            $.get(config.base+"/Catalogos/ajax/?action=get&object=showpopuprefaccionbuscar", null, function (response) {
                    if ( response ){
                        $("#contentpopup").html(response);
                    }else{
                        return notify('error', 'Error al obtener los datos del Formulario');
                        
                    }     
            });
        }
        $("body").on('click', '.borrar-refaccion', function (e) {
            e.preventDefault();

            var id = $(this).attr("lineidrefaccion");
            $("[lineidrefaccion=" + id + "]").remove();
            calcTotalrefaccion();
        });
        $('body').on('click', '#savenewrefaccion', function(){
            
            var code        = $("input[name=codigo_refaccion]", $(this).parents('form:first')).val();
            var nombre      = $("input[name=nombre_refaccion]", $(this).parents('form:first')).val();
            var descripcion = $("input[name=descripcion_refaccion]", $(this).parents('form:first')).val();
            var id_marca    = $("#id_marca_refaccion").val();
            var id_submarca = $("#id_submarca_refaccion").val();
            var modelo      = $("#modelo_refaccion").val();
            var costoaprox  = $("#costo_aprox_refaccion").val();
            var costoreal   = $("#costo_real_refaccion").val();
          
            var url = config.base+"/Catalogos/ajax/?action=get&object=savenewrefaccion"; // El script a dónde se realizará la petición.
            $.ajax({
                type: "POST",
                url: url,
                data: "codigo="+code+"&nombre="+nombre+"&descripcion="+descripcion+"&id_marca="+id_marca+"&id_submarca="+id_submarca+"&modelo="+modelo+"&costo_aprox="+costoaprox+"&costo_real="+costoreal, // Adjuntar los campos del formulario enviado.
                success: function(response){
                    if(response>0){
                        //alert("Group successfully added");
                        $('#idrefaccion').append($('<option>', {
                            value: response,
                            text: code+"||"+nombre,
                            selected:true
                        }));  
                        $("#idrefaccion").select2({
                            multiple: false,
                            header: "Selecciona una opcion",
                            noneSelectedText: "Seleccionar",
                            selectedList: 1
                        });
                        $('#myModal').modal('hide');
                        $("#idrefaccion"). change();
                        notify('success',"Refaccion agregada correctamente:"+response);
                    }else{
                        notify('error',"Oopss error al agregar refaccion"+response);
                    }
                }
             });
            return false; // Evitar ejecutar el submit del formulario.
        });
        $('body').on('blur', '.costorefaccion', function(){
            calcTotalrefaccion();
        });
        $('body').on('change', '#idrefaccion', function(){
            if( $(this).val() ){
                var id = $("#idrefaccion").val();
                getrefaccion(id);
            }
        });
        //marca
        $('body').on('change', '#id_marca', function(){
            if( $(this).val() ){
                var id = $("#id_marca").val();
                getsubmarca(id);
            }
        });
        //submarca
        $('body').on('change', '#id_submarca', function(){
            if( $(this).val() ){
                var id = $("#id_submarca").val();
                getselectrefaccion(id);
            }
        });
      
        /* DO NOT REMOVE : GLOBAL FUNCTIONS!
         * pageSetUp() is needed whenever you load a page.
         * It initializes and checks for all basic elements of the page
         * and makes rendering easier.
         *
         */
         pageSetUp();

    })

</script>

<?php
    //include footer
    include(SYSTEM_DIR . "/inc/close-html.php");

?>
