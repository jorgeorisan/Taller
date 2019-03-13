<?php
//initilize the page
require_once(SYSTEM_DIR . "/inc/init.php");

//require UI configuration (nav, ribbon, etc.)
require_once(SYSTEM_DIR . "/inc/config.ui.php");

/*---------------- PHP Custom Scripts ---------

YOU CAN SET CONFIGURATION VARIABLES HERE BEFORE IT GOES TO NAV, RIBBON, ETC.
E.G. $page_title = "Custom Title" */

$page_title = "Nuevo Nomina";

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
    $obj = new Nomina();
    $id  = $obj->addAll(getPost());
    //$id=240;
    
    if ($id > 0){
        informSuccess(true, make_url("Nomina","view",array('id'=>$id)));
    }else{
        informError(true,make_url("Nomina","add"));
    }
}
$hoy = date('d');
if($hoy>=1 && $hoy<15){
    $begin = date('Y-m-01');   
    $end = date('Y-m-15'); 
}else{
    $begin = date('Y-m-15');  
    $fecha = new DateTime();
    $fecha->modify('last day of this month');
    $end = $fecha->format('Y-m-d');  
}
?>
<!-- ==========================CONTENT STARTS HERE ========================== -->

<!-- MAIN PANEL -->
<div id="main" role="main">
    <?php $breadcrumbs["Nomina"] = APP_URL."/Nomina/index"; include(SYSTEM_DIR . "/inc/ribbon.php"); ?>
    <!-- MAIN CONTENT -->
    <div id="content">
        <div class="row"> 
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">   
                <div class="well ">
                    <header>
                            <h2><i class="fa fa-automobile"></i>&nbsp;<?php echo $page_title ?></h2>
                    </header>
                    <fieldset>          
                        <form id="main-form" class="" role="form" method='post' action="<?php echo make_url("Nomina","add");?>" onsubmit="return checkSubmit();" enctype="multipart/form-data">    

                            <section id="widget-grid" class="">
                                <article class="col-sm-12 col-md-12 col-lg-12"  id="article-1">
                                    <div class="jarviswidget  jarviswidget-sortable jarviswidget-collapsed" id="wid-recepcion" 
                                    data-widget-deletebutton="false" data-widget-colorbutton="false" data-widget-editbutton="false"  data-widget-fullscreenbutton="false" data-widget-collapsed="false" >
                                        <header onclick="$('.showrecepcion').toggle()"> <span class="widget-icon"> 
                                            <i class="far fa-building"></i> </span><h2>Datos Nomina</h2>
                                        </header>
                                        <div class="showrecepcion" style="display: ;">
                                            <!-- widget edit box -->
                                            <div class="jarviswidget-editbox" style=""></div>
                                            <div class="widget-body">
                                                <div class="col-sm-12">
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <input type="text" class="form-control datepicker" data-dateformat='yyyy-mm-dd' autocomplete="off" value="<?php echo $begin;?>" placeholder="Fecha Inicial" name="fecha_inicial" id="fecha_inicial" >
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <input type="text" class="form-control datepicker" data-dateformat='yyyy-mm-dd' autocomplete="off" value="<?php echo $end;?>" placeholder="Fecha Final" name="fecha_final" id="fecha_final" >
                                                        </div>
                                                    </div>
                                                    
                                                    
                                                </div>
                                                <div class="col-sm-12">
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <input type="text" class="form-control " value="" placeholder="Nombre " name="nombre" >
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <input type="text" class="form-control" placeholder="Comentarios Nomina" name="comentarios" >
                                                            
                                                        </div>
                                                    </div> 
                                                    
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="jarviswidget  jarviswidget-sortable jarviswidget-collapsed" id="wid-nominaes" 
                                    data-widget-deletebutton="false" data-widget-colorbutton="false" data-widget-editbutton="false"  data-widget-fullscreenbutton="false" data-widget-collapsed="false" >
                                        <header onclick="$('.shownominaes').toggle()"> <span class="widget-icon"> 
                                            <i class="far fa-box-full"></i> </span><h2>Personal</h2>
                                        </header>
                                        <div class="shownominaes" style="display: ;">
                                            <!-- widget edit box -->
                                            <div class="jarviswidget-editbox" style=""></div>
                                            <div class="widget-body">
                                                <div class="col-sm-12">
                                                    <div class="col-sm-8">
                                                        <div class="row">
                                                            <div class="col-sm-8 col-md-8">
                                                                <select style="width:100%" class="select2" name="id_personalnomina" id="id_personalnomina">
                                                                    <option value="" selected disabled>Selecciona </option>
                                                                    <?php 
                                                                    $obj = new Personal();
                                                                    $list=$obj->getAllArr();
                                                                    if (is_array($list) || is_object($list)){
                                                                        foreach($list as $val)
                                                                            echo "<option value='".$val['id']."'>".htmlentities($val['nombre'].' '.$val['apellido_pat'].' '.$val['apellido_mat'])."</option>";
                                                                        
                                                                    }
                                                                    ?>
                                                                </select>
                                                            </div>
                                                            <div class="col-sm-2">
                                                                <button class="btn btn-primary btn-md" type="button" onclick=" getpersonal();"> Agregar  </button>
                                                            </div>
                                                        </div>
                                                        
                                                    </div>
                                                    
                                                    
                                                    <div class="col-sm-1">
                                                        
                                                    </div>
                                                    <div class="col-sm-1"></div>
                                                    <div class="col-sm-2 text-right">
                                                        <h6><strong >Total=<span id="total-numnomina"></span></strong></h6>
                                                        <input type="hidden" name="total" id="total-globalnomina" value="0"/>
                                                    </div>
                                                </div>
                                                <div class='col-sm-12 col-md-12'>
                                                    <table style='width:100%' class='full-width' id="contnomina">
                                                        <tr>
                                                            <th>Cant. Serv.</th>
                                                            <th>Personal</th>
                                                            <th>Auto</th>
                                                            <th>Fecha</th>
                                                            <th>TOTAL</th>
                                                            <th class="borrar-td"></th>
                                                        </tr>
                                                        <?php 
                                                        $objref = new Personal();
                                                        $dataref = $objref->getAllServicesGral($begin,$end);
                                                        $totalglobal = 0 ;
                                                        foreach($dataref as $lineId => $row) {
                                                            $idpersonal = $row['id_personal'];
                                                           
                                                            $nombre         = htmlentities($row['nombre'].' '.$row['apellido_pat'].' '.$row['apellido_mat']) ;
                                                            $nombrevehiculo =  htmlentities($row['marca']." ".$row['submarca']." - ". $row['modelo']);
                                                            $id_vehiculo    =  htmlentities($row['id_vehiculo']);
                                                            $status         = htmlentities($row['status']);
                                                            $porcentaje ="Fijo";
                                                            switch ($row['forma_pago']) {
                                                                case 'Fijo':
                                                                    $total = $row['cantidad'];
                                                                    break;
                                                                default:
                                                                    $total      = $row['total']*($row['cantidad']/100);
                                                                    $porcentaje = $row['cantidad']."%";
                                                                    $totalglobal+= $total*($row['cantidad']/100);
                                                                    break;
                                                            }
                                                            $queryAllServices = $objref->getAllServices($begin,$end,$row['id_personal']);
                                                          
                                                            $detalles = json_encode($queryAllServices);
                                                            $detalles = $nombre."<input type='hidden' name='detalles[]' value='".$detalles."'>";
                                                           
                                                        ?>
                                                        <tr class='personal' lineidpersonal='<?php echo $lineId; ?>'>
                                                            <input type='hidden' name='id_personal[]' value='<?php echo $row['id_personal'] ?>'/>
                                                            <input class='cantidadespersonal' type='hidden' name='cantidad[]' value='<?php echo $row['cantidad_servicios']?>'/>
                                                            <input type='hidden' name='fecha[]' value='<?php echo $fecha ?>'/>
                                                            <input type='hidden' name='id_vehiculo[]' value='<?php echo $id_vehiculo ?>'/>
                                                            <td><?php echo $row['cantidad_servicios']; ?></td>
                                                            <td><?php echo $detalles; ?></td>
                                                            <td><?php echo $nombrevehiculo; ?></td>
                                                            <td><?php echo $row['fecha']; ?></td>
                                                            <td>
                                                                <span style='float:left;padding-top: 10px;'><?php echo $porcentaje; ?></span>
                                                                <input type='number' style='width: 80px;' class='form-control totalespersonal' name='totalpersonal[]' value='<?php echo htmlentities($total) ?>' placeholder='00.00'>
                                                            </td>
                                                            <td class='borrar-td'>
                                                                <a data-toggle="modal" class="btn-historyservices" title="Ver Servicios" href="#myModal" idper='<?php echo $row['id_personal']; ?>' >
																		<i class="fa fa-history"></i>&nbsp;Servicios
                                                                </a>
                                                                <a href='javascript:void(0);' class='btn btn-danger borrar-personal' lineidpersonal='<?php echo $lineId ?>'> 
                                                                    <i class='glyphicon glyphicon-trash'></i>
                                                                </a>
                                                            </td>
                                                        </tr>

                                                        <?php
                                                        } 
                                                        ?>
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
            var fecha_inicio  = $("input[name=fecha_inicial]").val();  
            var fecha_final   = $("input[name=fecha_final]").val();
            var total         = $("#total-globalnomina").val();
           
            if ( ! fecha_inicio )  return notify("info","La fecha de inicio es requerida");
            if ( ! fecha_final )   return notify("info","La fecha final es requerida");
            if ( total <= 0)       return notify("info","Se requiere personal para generar el nomina");
            
            $("#main-form").submit();       
        }
        
        //**********Nomina*************/
        getpersonal = function() {
            var id = $('select[name="id_personalnomina"] option:selected').val();
            if(id){
                var text = $('select[name="id_personalnomina"] option:selected').text();
                var url = config.base+"/Personal/ajax/?action=get&object=getpersonal"; // El script a dónde se realizará la petición.
                var begin = $('#fecha_inicial').val();
                var end = $('#fecha_final').val();
                var cantidad = $("#selectcantidad_nomina").val();
                $.ajax({
                    type: "GET",
                    url: url,
                    data: "id="+id+ "&cantidad=" + cantidad + "&begin=" + begin + "&end=" + end, 
                    success: function(response){
                        if(response){
                            $('#contnomina').append(response);  
                            $('#selectcantidad_nomina').val(1);
                            calcTotalnomina();
                        }else{
                            notify('error',"Oopss error al agregar nomina"+response);
                        }
                    }
                });
                return false; // Evitar ejecutar el submit del formulario.
            }
        }
        calcTotalnomina = function() {
            var totalespersonal     = $(".totalespersonal");
            var total = 0;
            for (var i = 0, len = totalespersonal.length; i < len; i++) {
                var valor=$(totalespersonal[i]).val();
                if (! isNaN( valor )  && valor > 0 ){
                    total += parseFloat(valor);
                    
                    //console.log(total);    
                }
            }
            
            $("#total-numnomina").html(total);
            $("#total-globalnomina").val(total);
        }
        
        
        $("body").on('click', '.borrar-personal', function (e) {
            e.preventDefault();

            var id = $(this).attr("lineidpersonal");
            $("[lineidpersonal=" + id + "]").remove();
            calcTotalnomina();
        });
        $('body').on('click', '#savenewnomina', function(){
            
            var code        = $("input[name=codigo_nomina]", $(this).parents('form:first')).val();
            var nombre      = $("input[name=nombre_nomina]", $(this).parents('form:first')).val();
            var descripcion = $("input[name=descripcion_nomina]", $(this).parents('form:first')).val();
            var id_marca    = $("#id_marca_nomina").val();
            var id_submarca = $("#id_submarca_nomina").val();
            var modelo      = $("#modelo_nomina").val();
            var costoaprox  = $("#costo_aprox_nomina").val();
            var costoreal   = $("#costo_real_nomina").val();
          
            var url = config.base+"/Catalogos/ajax/?action=get&object=savenewnomina"; // El script a dónde se realizará la petición.
            $.ajax({
                type: "POST",
                url: url,
                data: "codigo="+code+"&nombre="+nombre+"&descripcion="+descripcion+"&id_marca="+id_marca+"&id_submarca="+id_submarca+"&modelo="+modelo+"&costo_aprox="+costoaprox+"&costo_real="+costoreal, // Adjuntar los campos del formulario enviado.
                success: function(response){
                    if(response>0){
                        //alert("Group successfully added");
                        $('#idnomina').append($('<option>', {
                            value: response,
                            text: code+"||"+nombre,
                            selected:true
                        }));  
                        $("#idnomina").select2({
                            multiple: false,
                            header: "Selecciona una opcion",
                            noneSelectedText: "Seleccionar",
                            selectedList: 1
                        });
                        $('#myModal').modal('hide');
                        $("#idnomina"). change();
                        notify('success',"Refaccion agregada correctamente:"+response);
                    }else{
                        notify('error',"Oopss error al agregar nomina"+response);
                    }
                }
             });
            return false; // Evitar ejecutar el submit del formulario.
        });
        $('body').on('blur', '.totalespersonal', function(){
            calcTotalnomina();
        });
        $(".totalespersonal").blur();
        
        $('body').on('click', '.btn-historyservices', function(){
            //history servicios personal
            var id        = $(this).attr("idper");
            var fechaini  = $('#fecha_inicial').val();
            var fechafin  = $('#fecha_final').val();
            $('#titlemodal').html('<span class="widget-icon"><i class="far fa-plus"></i> Historial Servicios</span>');
            $.get(config.base+"/Personal/ajax/?action=get&object=showpopupHistoryServices&id="+ id + '&fechaini=' + fechaini + '&fechafin=' +fechafin , null, function (response) {
				if ( response ){
					$("#contentpopup").html(response);
				}else{
					return notify('error', 'Error al obtener los datos del Formulario');
				}     
            });
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
