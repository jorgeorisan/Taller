<?php
//initilize the page
require_once(SYSTEM_DIR . "/inc/init.php");

//require UI configuration (nav, ribbon, etc.)
require_once(SYSTEM_DIR . "/inc/config.ui.php");

/*---------------- PHP Custom Scripts ---------

YOU CAN SET CONFIGURATION VARIABLES HERE BEFORE IT GOES TO NAV, RIBBON, ETC.
E.G. $page_title = "Custom Title" */

$page_title = "Nuevo Gasto";

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
    $obj = new Gastos();
    $id  = $obj->addAll(getPost());
    //$id=240;
    
    if ($id > 0){
        informSuccess(true, make_url("Gastos","view",array('id'=>$id)));
    }else{
        informError(true,make_url("Gastos","add"));
    }
}
?>
<!-- ==========================CONTENT STARTS HERE ========================== -->

<!-- MAIN PANEL -->
<div id="main" role="main">
    <?php $breadcrumbs["Gastos"] = APP_URL."/Gastos/index"; include(SYSTEM_DIR . "/inc/ribbon.php"); ?>
    <!-- MAIN CONTENT -->
    <div id="content">
        <div class="row"> 
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">   
                <div class="well ">
                    <header>
                            <h2><i class="fa fa-automobile"></i>&nbsp;<?php echo $page_title ?></h2>
                    </header>
                    <fieldset>          
                        <form id="main-form" class="" role="form" method='post' action="<?php echo make_url("Gastos","add");?>" onsubmit="return checkSubmit();" enctype="multipart/form-data">    

                            <section id="widget-grid" class="">
                                <article class="col-sm-12 col-md-12 col-lg-12"  id="article-1">
                                    <div class="jarviswidget  jarviswidget-sortable jarviswidget-collapsed" id="wid-recepcion" 
                                    data-widget-deletebutton="false" data-widget-colorbutton="false" data-widget-editbutton="false"  data-widget-fullscreenbutton="false" data-widget-collapsed="false" >
                                        <header onclick="$('.showrecepcion').toggle()"> <span class="widget-icon"> 
                                            <i class="far fa-building"></i> </span><h2>Datos Gasto</h2>
                                        </header>
                                        <div class="showrecepcion" style="display: ;">
                                            <!-- widget edit box -->
                                            <div class="jarviswidget-editbox" style=""></div>
                                            <div class="widget-body">
                                                <div class="col-sm-12">
                                                    <div class="col-sm-4">
                                                        <div class="form-group">
                                                            <input type="text" class="form-control datepicker" data-dateformat='yyyy-mm-dd' autocomplete="off" value="<?php echo date('Y-m-d'); ?>" placeholder="Fecha de Alta" name="fecha_alta" >
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <div class="form-group">
                                                            <select style="width:100%" class="select2" name="id_gastostipo" id="id_gastostipo">
                                                                <option value="" selected disabled>Selecciona Tipo Gasto</option>
                                                                <?php 
                                                                $obj = new GastosTipo();
                                                                $list=$obj->getAllArrGral();
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
                                                      
                                                    </div> 
                                                    
                                                </div>
                                                <div class="col-sm-12">
                                                    <div class="col-sm-4">
                                                        <div class="form-group">
                                                            <input type="text" class="form-control " value="" placeholder="Concepto " name="nombre" >
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <div class="form-group">
                                                            <input type="text" class="form-control" placeholder="Comentarios Gasto" name="comentarios" >
                                                            
                                                        </div>
                                                    </div> 
                                                    
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="jarviswidget  jarviswidget-sortable jarviswidget-collapsed" id="wid-gastoes" 
                                    data-widget-deletebutton="false" data-widget-colorbutton="false" data-widget-editbutton="false"  data-widget-fullscreenbutton="false" data-widget-collapsed="false" >
                                        <header onclick="$('.showgastoes').toggle()"> <span class="widget-icon"> 
                                            <i class="far fa-box-full"></i> </span><h2>Gastos</h2>
                                        </header>
                                        <div class="showgastoes" style="display: ;">
                                            <!-- widget edit box -->
                                            <div class="jarviswidget-editbox" style=""></div>
                                            <div class="widget-body">
                                                <div class="col-sm-12">
                                                    <div class="col-sm-1 col-md-1">
                                                        <input style='' type='number' class="form-control" id='selectcantidad_gasto' value='1'> 
                                                    </div>
                                                    <div class="col-sm-4 col-md-4">
                                                        <div class="form-group">
                                                            <select style="width:50%" class="select2" name="id_gastostiporegistro" id="id_gastostiporegistro">
                                                                <option value="" selected disabled>Selecciona </option>
                                                                <?php 
                                                                $obj = new GastosTipo();
                                                                $list=$obj->getAllArrNormal();
                                                                if (is_array($list) || is_object($list)){
                                                                    foreach($list as $val)
                                                                        echo "<option value='".$val['id']."'>".htmlentities($val['nombre'])."</option>";
                                                                    
                                                                }
                                                                ?>
                                                            </select>
                                                        </div>
                                                        
                                                    </div>
                                                    <div class="col-sm-5 col-md-5">
                                                        <div class="col-sm-3">
                                                            <button class="btn btn-primary btn-md" type="button" onclick=" getgastostipo();"> Agregar  </button>
                                                        </div>
                                                        
                                                        <div class="col-sm-4 col-md-4"></div>
                                                        <div class="col-sm-2 text-right">
                                                            <h6><strong >Total=<span id="total-numgasto"></span></strong></h6>
                                                            <input type="hidden" name="total-globalgasto" id="total-globalgasto" value="0"/>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class='col-sm-12 col-md-12'>
                                                    <table style='width:100%' class='full-width' id="contgastos">
                                                        <tr>
                                                            <th>Cant.</th>
                                                            <th>Codigo</th>
                                                            <th>Gasto</th>
                                                            <th>TOTAL</th>
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
      
        validateForm =function(){
            var fecha_alta    = $("input[name=fecha_alta]").val();
            var nombre        = $("input[name=nombre]").val();
            var id_gastostipo = $("#id_gastostipo").val();
            var total         = $("#total-globalgasto").val();
           
            if ( ! fecha_alta )    return notify("info","La fecha de alta es requerida");
            if ( ! id_gastostipo ) return notify("info","El Tipo de gasto es requerido");
            if ( ! nombre )        return notify("info","El nombre es requerido");
            if ( total <= 0)       return notify("info","Se requieren totales para generar el gasto");
            
            $("#main-form").submit();       
        }
        
        //**********Gastos*************/
        getgastostipo = function() {
            var id = $('select[name="id_gastostiporegistro"] option:selected').val();
            if(id){
                var text = $('select[name="id_gastostiporegistro"] option:selected').text();
                var url = config.base+"/Catalogos/ajax/?action=get&object=getgastostipo"; // El script a dónde se realizará la petición.
               
                var cantidad = $("#selectcantidad_gasto").val();
                $.ajax({
                    type: "GET",
                    url: url,
                    data: "id="+id+ "&cantidad=" + cantidad, // Adjuntar los campos del formula=rio enviado.
                    success: function(response){
                        if(response){
                            $('#contgastos').append(response);  
                            $('#selectcantidad_gasto').val(1);
                            if ( id == 7 ) { // nomina
                                $('.select2').select2();
                                calcTotalgasto();
                            }
                        }else{
                            notify('error',"Oopss error al agregar gasto"+response);
                        }
                    }
                });
                return false; // Evitar ejecutar el submit del formulario.
            }
        }
        calcTotalgasto = function() {
            var totalesgastos     = $(".totalesgastos");
            var total = 0;
            for (var i = 0, len = totalesgastos.length; i < len; i++) {
                var valor=$(totalesgastos[i]).val();
                if (! isNaN( valor )  && valor > 0 ){
                    total += parseFloat(valor);
                    
                    //console.log(total);    
                }
            }
            
            $("#total-numgasto").html(total);
            $("#total-globalgasto").val(total);
        }
        
        showpopupgasto= function(){
            $('#titlemodal').html('<span class="widget-icon"><i class="far fa-plus"></i> Nueva Refaccion</span>');
            $.get(config.base+"/Catalogos/ajax/?action=get&object=showpopupgasto", null, function (response) {
                    if ( response ){
                        $("#contentpopup").html(response);
                    }else{
                        return notify('error', 'Error al obtener los datos del Formulario');
                        
                    }     
            });
        }
        showpopupgastobuscar= function(){
            $('#titlemodal').html('<span class="widget-icon"><i class="far fa-search"></i> Buscar Refaccion</span>');
            $.get(config.base+"/Catalogos/ajax/?action=get&object=showpopupgastobuscar", null, function (response) {
                    if ( response ){
                        $("#contentpopup").html(response);
                    }else{
                        return notify('error', 'Error al obtener los datos del Formulario');
                        
                    }     
            });
        }
        
        $("body").on('change', '.vincular-nomina', function (e) {
            e.preventDefault();
            var total = $('option:selected',this).attr("total");
            var lineid = $(this).attr("lineid");
            $('#totalesregistros'+lineid).val(total);
            
            $('#totalesregistros'+lineid).attr('value',total);
            calcTotalgasto();
        });
        $("body").on('click', '.borrar-gasto', function (e) {
            e.preventDefault();
            var id = $(this).attr("lineidgasto");
            $("[lineidgasto=" + id + "]").remove();
            calcTotalgasto();
        });
        $('body').on('click', '#savenewgasto', function(){
            
            var code        = $("input[name=codigo_gasto]", $(this).parents('form:first')).val();
            var nombre      = $("input[name=nombre_gasto]", $(this).parents('form:first')).val();
            var descripcion = $("input[name=descripcion_gasto]", $(this).parents('form:first')).val();
            var id_marca    = $("#id_marca_gasto").val();
            var id_submarca = $("#id_submarca_gasto").val();
            var modelo      = $("#modelo_gasto").val();
            var costoaprox  = $("#costo_aprox_gasto").val();
            var costoreal   = $("#costo_real_gasto").val();
          
            var url = config.base+"/Catalogos/ajax/?action=get&object=savenewgasto"; // El script a dónde se realizará la petición.
            $.ajax({
                type: "POST",
                url: url,
                data: "codigo="+code+"&nombre="+nombre+"&descripcion="+descripcion+"&id_marca="+id_marca+"&id_submarca="+id_submarca+"&modelo="+modelo+"&costo_aprox="+costoaprox+"&costo_real="+costoreal, // Adjuntar los campos del formulario enviado.
                success: function(response){
                    if(response>0){
                        //alert("Group successfully added");
                        $('#idgasto').append($('<option>', {
                            value: response,
                            text: code+"||"+nombre,
                            selected:true
                        }));  
                        $("#idgasto").select2({
                            multiple: false,
                            header: "Selecciona una opcion",
                            noneSelectedText: "Seleccionar",
                            selectedList: 1
                        });
                        $('#myModal').modal('hide');
                        $("#idgasto"). change();
                        notify('success',"Refaccion agregada correctamente:"+response);
                    }else{
                        notify('error',"Oopss error al agregar gasto"+response);
                    }
                }
             });
            return false; // Evitar ejecutar el submit del formulario.
        });
        $('body').on('blur', '.totalesgastos', function(){
            calcTotalgasto();
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
