 <?php
//initilize the page
require_once(SYSTEM_DIR . "/inc/init.php");

//require UI configuration (nav, ribbon, etc.)
require_once(SYSTEM_DIR . "/inc/config.ui.php");

/*---------------- PHP Custom Scripts ---------

YOU CAN SET CONFIGURATION VARIABLES HERE BEFORE IT GOES TO NAV, RIBBON, ETC.
E.G. $page_title = "Custom Title" */

$page_title = "Orden de Reparacion";

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
    $obj = new Vehiculo();
    $id  = $obj->addAll(getPost());
    //$id=240;
    
    if ($id > 0){
        if (isset($_FILES['filevehiculo'])){
            $cantidad = count($_FILES["filevehiculo"]["tmp_name"]);
            $carpeta  = EXPEDIENTE_DIR .DIRECTORY_SEPARATOR. 'auto'.DIRECTORY_SEPARATOR.'auto_'.$id;
            if ( !file_exists($carpeta) ) {
                mkdir($carpeta, 0777, true);
                $carpetaimg = EXPEDIENTE_DIR .DIRECTORY_SEPARATOR. 'auto'.DIRECTORY_SEPARATOR.'auto_'.$id.DIRECTORY_SEPARATOR.'images';
                if ( !file_exists($carpetaimg) ) {
                    mkdir($carpetaimg, 0777, true);
                }
            }else{
                $carpetaimg = EXPEDIENTE_DIR .DIRECTORY_SEPARATOR. 'auto'.DIRECTORY_SEPARATOR.'auto_'.$id.DIRECTORY_SEPARATOR.'images';
            }
            for ($i=0; $i < $cantidad; $i++){
                //Comprobamos si el fichero es una imagen
                $subir=0;
                if ($_FILES['filevehiculo']['type'][$i]=='image/png' || $_FILES['filevehiculo']['type'][$i]=='image/jpeg'){
                    if ( isset($_POST['deletefilevehiculo'] ) ) {
                        $imagesdeleted = $_POST['deletefilevehiculo'];
                        $pos = strpos($imagesdeleted, $_FILES["filevehiculo"]["name"][$i]); //quitamos las imagenes eliminadas
                        if ($pos === false) {
                            move_uploaded_file($_FILES["filevehiculo"]["tmp_name"][$i], $carpetaimg."/".$_FILES["filevehiculo"]["name"][$i]);
                            $subir=1;
                        }   
                    }else{
                        move_uploaded_file($_FILES["filevehiculo"]["tmp_name"][$i], $carpetaimg."/".$_FILES["filevehiculo"]["name"][$i]);
                        $subir=1;
                    } 
                    if($subir)  {
                        $objimg = new ImagenesVehiculo();
                        $idimg  = $objimg->addImage($id,$_FILES["filevehiculo"]["name"][$i]);  
                        if(!$idimg){
                            echo "Error al añadir imagen".$id."->".$carpetaimg."->".$_FILES["filevehiculo"]["name"][$i];
                            exit;
                        }  
                    } 
                $validar=true;
                }
                else $validar=false;
                    
            }
        }
        informSuccess(true, make_url("Vehiculos","showorden",array('id'=>$id)));
    }else{
        informError(true,make_url("Vehiculos","add"));
    }
}
?>
<!-- ==========================CONTENT STARTS HERE ========================== -->

<!-- MAIN PANEL -->
<div id="main" role="main">
    <?php $breadcrumbs["Vehiculos"] = APP_URL."/Vehiculos/index"; include(SYSTEM_DIR . "/inc/ribbon.php"); ?>
    <!-- MAIN CONTENT -->
    <div id="content">
        <div class="row"> 
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">   
                <div class="well ">
                    <header>
                            <h2><i class="fa fa-automobile"></i>&nbsp;<?php echo $page_title ?></h2>
                    </header>
                    <fieldset>          
                        <form id="main-form" class="" role="form" method='post' action="<?php echo make_url("Vehiculos","add");?>" onsubmit="return checkSubmit();" enctype="multipart/form-data">    

                            <section id="widget-grid" class="">
                                <article class="col-sm-12 col-md-12 col-lg-12"  id="article-1">
                                    <div class="jarviswidget  jarviswidget-sortable jarviswidget-collapsed" id="wid-recepcion" 
                                    data-widget-deletebutton="false" data-widget-colorbutton="false" data-widget-editbutton="false"  data-widget-fullscreenbutton="false" data-widget-collapsed="false" >
                                        <header onclick="$('.showrecepcion').toggle()"> <span class="widget-icon"> 
                                            <i class="far fa-building"></i> </span><h2>Recepcion</h2>
                                        </header>
                                        <div class="showrecepcion" style="display: ;">
                                            <!-- widget edit box -->
                                            <div class="jarviswidget-editbox" style=""></div>
                                            <div class="widget-body">
                                                <div class="col-sm-12">
                                                    <div class="col-sm-4">
                                                        <div class="form-group">
                                                            <input type="text" class="form-control datepicker" data-dateformat='yy-mm-dd' autocomplete="off" value="<?php echo date('Y-m-d'); ?>" placeholder="Fecha de orden" name="fecha_alta" >
                                                            
                                                        </div>
                                                        <div class="form-group">
                                                            <select style="width:100%" class="select2" name="id_cliente" id="id_cliente">
                                                                <option value="" selected disabled>Selecciona Cliente</option>
                                                                <?php 
                                                                $obj = new Cliente();
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
                                                            <input type="text" class="form-control datepicker" data-dateformat='yy-mm-dd' autocomplete="off" placeholder="Fecha promesa de entrega" name="fecha_promesa" >
                                                        </div>
                                                        <div class="form-group">
                                                            <a data-toggle="modal" class="btn btn-success" href="#myModal" onclick="showpopupclientes()" > <i class="fa fa-plus"></i></a>                                          
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-4">    
                                                        <div class="form-group">
                                                            <select style="width:100%" class="select2" name="id_aseguradora" id="id_aseguradora">
                                                                <option value="1" selected disabled>Selecciona Aseguradora</option>
                                                                <?php 
                                                                $obj = new Aseguradora();
                                                                $list=$obj->getAllArr();
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
                                                <div class="col-sm-12" >
                                                    <div class="col-sm-3"></div>
                                                    <div class="col-sm-6" id="contcliente"></div> 
                                                    <div class="col-sm-3"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    
                                    <div class="jarviswidget  jarviswidget-sortable jarviswidget-collapsed" id="wid-vehiculo" 
                                    data-widget-deletebutton="false" data-widget-colorbutton="false" data-widget-editbutton="false"  data-widget-fullscreenbutton="false" data-widget-collapsed="false">
                                        <header  onclick="$('.showvehiculo').toggle()"> <span class="widget-icon"> 
                                            <i class="far fa-car-crash"></i> </span><h2>Vehiculo</h2>
                                        </header>
                                        <div class="showvehiculo" style="display:none ;">
                                            <!-- widget edit box -->
                                            <div class="jarviswidget-editbox" style=""></div>
                                            <div class="widget-body">
                                                <div class="col-sm-12 col-md-12 col-lg-12">
                                                    <div class="col-sm-3 col-md-3 col-lg-3">
                                                        <div class="form-group">
                                                            <select style="width:100%" class="select2" name="id_marca" id="id_marca">
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
                                                        <div class="form-group" id="contsubmarca">
                                                            <select style="width:100%" class="select2" name="id_submarca" id="id_submarca">
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
                                                    <div class="col-sm-2 col-md-2 col-lg-2">
                                                        <div class="form-group">
                                                            <select style="width:100%" class="select2" name="modelo" id="modelo">
                                                                <option value="" selected disabled>Año</option>
                                                                <?php 
                                                                $objcat=catModelo();
                                                                for ($i=0; $i < count($objcat) ; $i++) { 
                                                                    echo "<option value='".$objcat[$i]."'>".htmlentities($objcat[$i])."</option>";
                                                                }  
                                                                ?>
                                                            </select>
                                                        </div>
                                                        <div class="form-group">
                                                            <input type="text" class="form-control" placeholder="Color" name="color" >
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-4 col-md-4 col-lg-4">
                                                        <div class="form-group">
                                                            <label class="col-sm-2 col-md-2 col-lg-2 control-label">Placas</label>
                                                            <input type="hidden" name="placas_num">
                                                            <div class="col-sm-10 col-md-12 col-lg-10 ">
                                                                <label class="radio-inline">
                                                                    <input type="radio" value="0" class="radiobox" name="optplacas_num">
                                                                    <span>0</span> 
                                                                </label>
                                                                <label class="radio radio-inline">
                                                                    <input type="radio" value="1" class="radiobox" name="optplacas_num">
                                                                    <span>1</span>  
                                                                </label>
                                                                <label class="radio radio-inline">
                                                                    <input type="radio" value="2" class="radiobox" name="optplacas_num">
                                                                    <span>2</span> 
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <input type="text" class="form-control" placeholder="Kilometraje" name="kilometraje" >
                                                        </div>
                                                    </div> 
                                                    <div class="col-sm-3 col-md-3 col-lg-3">
                                                       <div class="form-group">
                                                            <input type="text" class="form-control" placeholder="VIN" name="vin" >
                                                        </div>
                                                        <div class="form-group">
                                                            <input type="text" class="form-control" placeholder="Matricula" name="matricula" >
                                                        </div>
                                                    </div> 
                                                </div>
                                                <div class="col-sm-12 col-md-12 col-lg-12">
                                                    <div class="col-sm-3 col-md-3 col-lg-3">
                                                        <div class="form-group">
                                                            <label class="col-md-6 col-sm-3 col-lg-6 control-label">Transmision</label>
                                                            <input type="hidden" name="TransmisionTipo">
                                                            <div class="col-md-6 col-sm-3 col-lg-6">
                                                                <label class="radio ">
                                                                    <input type="radio" class="radiobox" value="STD" name="optTransmisionTipo"><span>STD</span> 
                                                                </label>
                                                                <label class="radio ">
                                                                    <input type="radio" class="radiobox" value="AUT"  name="optTransmisionTipo"><span>AUT</span> 
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-3 col-md-3 col-lg-3">
                                                        <div class="form-group">
                                                            <label class="col-md-6 col-sm-3 col-lg-6 control-label">Aire Acondicionado</label>
                                                            <input type="hidden" name="FuncionamientoAC">
                                                            <div class="col-md-6 col-sm-3 col-lg-6">
                                                                <label class="radio ">
                                                                    <input type="radio" class="radiobox" value="Si" name="optFuncionamientoAC"><span>Si</span> 
                                                                </label>
                                                                <label class="radio ">
                                                                    <input type="radio" class="radiobox" value="No"  name="optFuncionamientoAC"><span>No</span> 
                                                                </label>
                                                                <label class="radio ">
                                                                    <input type="radio" class="radiobox" value="C/Daño" name="optFuncionamientoAC"><span>C/Daño</span> 
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-3 col-md-3 col-lg-3">
                                                        <div class="form-group">
                                                            <label class="col-md-6 col-sm-3 col-lg-6 control-label">Vestiduras Tipo</label>
                                                            <input type="hidden" name="VestidurasTipo">
                                                            <div class="col-md-6 col-sm-3 col-lg-6">
                                                                <label class="radio ">
                                                                    <input type="radio" class="radiobox" value="Piel" name="optVestidurasTipo"><span>Piel</span> 
                                                                </label>
                                                                <label class="radio ">
                                                                    <input type="radio" class="radiobox" value="Tela"  name="optVestidurasTipo"><span>Tela</span> 
                                                                </label>
                                                                <label class="radio ">
                                                                    <input type="radio" class="radiobox" value="AirBaG" name="optVestidurasTipo"><span>AirBaG</span> 
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-3 col-md-3 col-lg-3">
                                                        <div class="form-group">
                                                            <label class="col-md-6 col-sm-3 col-lg-6 control-label">Interior Tipo </label>
                                                            <input type="hidden" name="InteriorTipo">
                                                            <div class="col-md-6 col-sm-3 col-lg-6">
                                                                <label class="radio ">
                                                                    <input type="radio" class="radiobox" value="Electrico" name="optInteriorTipo"><span>Electrico</span> 
                                                                </label>
                                                                <label class="radio ">
                                                                    <input type="radio" class="radiobox" value="Manual"  name="optInteriorTipo"><span>Manual</span> 
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-12" id="">
                                                    <div class="col-sm-3 col-md-3 col-lg-3">
                                                        <div class="form-group">
                                                            <label class="col-md-6 col-sm-3 col-lg-6 control-label">Rin Tipo</label>
                                                            <input type="hidden" name="RinTipo">
                                                            <div class="col-md-6 col-sm-3 col-lg-6">
                                                                <label class="radio ">
                                                                    <input type="radio" class="radiobox" value="Acero" name="optRinTipo"><span>Acero</span> 
                                                                </label>
                                                                <label class="radio ">
                                                                    <input type="radio" class="radiobox" value="Aleacion" name="optRinTipo"><span>Aleacion</span> 
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-3 col-md-3 col-lg-3">
                                                        <div class="form-group">
                                                            <label class="col-md-6 col-sm-3 col-lg-6 control-label">Direccion Tipo</label>
                                                            <input type="hidden" name="DirTipo">
                                                            <div class="col-md-6 col-sm-3 col-lg-6">
                                                                <label class="radio ">
                                                                    <input type="radio" class="radiobox" value="Hidraulica" name="optDirTipo"><span>Hidraulica</span> 
                                                                </label>
                                                                <label class="radio ">
                                                                    <input type="radio" class="radiobox" value="Mecanica" name="optDirTipo"><span>Mecanica</span> 
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-3 col-md-3 col-lg-3">
                                                        <div class="form-group">
                                                            <select style="width:100%" class="select2" name="Gasolina" id="Gasolina">
                                                                <option value="" selected disabled>--Gasolina--</option>
                                                                <option value="0-1/4">0-1/4</option>
                                                                <option value="1/4-1/2">1/4-1/2</option>
                                                                <option value="1/2-3/4">1/2-3/4</option>
                                                                <option value="3/4-1">3/4-1</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-3" style="text-align: center;">
                                                        <h2 class="lvh-label">Fotos de vehículo <span id="contfotosauto">0</span> Fotografías</h2>
                                                            <button type="button" title='Agregar fotografía de vehículo en tránsito' class="btn btn-primary btn-circle btn-xl" onclick="getFoto('filevehiculo'); return false;">
                                                                <i class="fa fa-camera"></i>
                                                            </button>
                                                            <input type="file" id="filevehiculo"  name="filevehiculo[]" accept="image/*" style="display:none"  multiple>
                                                            <input type="text" id="deletefilevehiculo"  name="deletefilevehiculo" style="display:none">
                                                    </div>
                                                </div>
                                                <div class="col-sm-12" id="contfilevehiculo">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="jarviswidget  jarviswidget-sortable jarviswidget-collapsed" id="wid-servicios" 
                                    data-widget-deletebutton="false" data-widget-colorbutton="false" data-widget-editbutton="false"  data-widget-fullscreenbutton="false" data-widget-collapsed="false" >
                                        <header onclick="$('.showservicios').toggle()"> <span class="widget-icon"> 
                                            <i class="far fa-people-carry"></i> </span><h2>Servicios</h2>
                                        </header>
                                        <div class="showservicios" style="display:none ;">
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
                                                    <div class="col-sm-1">
                                                         <a data-toggle="modal" class="btn btn-success" href="#myModal" onclick="showpopupservicio()" > <i class="fa fa-plus"></i></a>
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
                                                        <h6><strong >Total=<span id="total-num"></span></strong></h6>
                                                        <input type="hidden" name="total-global" id="total-global" value="0"/>
                                                    </div>
                                                </div>
                                                <div class='col-sm-12 col-md-12'>
                                                    <table style='width:100%' class='full-width' id="contservicios">
                                                        <tr>
                                                            <th>Codigo</th>
                                                            <th>Servicio</th>
                                                            <th>Total</th>
                                                            <th class="borrar-td"></th>
                                                        </tr>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="jarviswidget  jarviswidget-sortable jarviswidget-collapsed" id="wid-refacciones" 
                                    data-widget-deletebutton="false" data-widget-colorbutton="false" data-widget-editbutton="false"  data-widget-fullscreenbutton="false" data-widget-collapsed="false" >
                                        <header onclick="$('.showrefacciones').toggle()"> <span class="widget-icon"> 
                                            <i class="far fa-box-full"></i> </span><h2>Refacciones</h2>
                                        </header>
                                        <div class="showrefacciones" style="display:none ;">
                                            <!-- widget edit box -->
                                            <div class="jarviswidget-editbox" style=""></div>
                                            <div class="widget-body">
                                                <div class="col-sm-12">
                                                    <div class="col-sm-1"> <input style='' type='number' class="form-control" id='selectcantidad_refaccion' value='1'> </div>
                                                    <div class="col-sm-4">
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
                                <h3>Inventario </h3>
                                <article class="col-sm-12 col-md-12 col-lg-12"  id="article-2">
                                    <div class="jarviswidget  jarviswidget-sortable jarviswidget-collapsed" id="wid-id-1" 
                                    data-widget-deletebutton="false" data-widget-colorbutton="false" data-widget-editbutton="false"  data-widget-fullscreenbutton="false" data-widget-collapsed="false" >
                                        <header onclick="$('.showexterior').toggle()"> <span class="widget-icon"> 
                                            <i class="far fa-long-arrow-left"></i> </span>
                                            <h2>Exteriores</h2>
                                        </header>
                                        <div class="showexterior" style="display: none;">
                                            <!-- widget edit box -->
                                            <div class="jarviswidget-editbox" style="">
                                            </div>
                                            <div class="widget-body">
                                                <div class="col-sm-12 col-md-12 col-lg-12">
                                                    <div class="col-sm-3 col-md-3 col-lg-3">
                                                        <div class="form-group">
                                                            <label class="col-md-6 col-sm-3 col-lg-6 control-label">Faros</label>
                                                            <input type="hidden" name="Faros">
                                                            <div class="col-md-6 col-sm-3 col-lg-6">
                                                                <label class="radio ">
                                                                    <input type="radio" class="radiobox" value="Si" name="optFaros"><span>Si</span> 
                                                                </label>
                                                                <label class="radio ">
                                                                    <input type="radio" class="radiobox" value="No"  name="optFaros"><span>No</span> 
                                                                </label>
                                                                <label class="radio ">
                                                                    <input type="radio" class="radiobox" value="C/Daño" name="optFaros"><span>C/Daño</span> 
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-3 col-md-3 col-lg-3">
                                                        <div class="form-group">
                                                            <label class="col-md-6 col-sm-3 col-lg-6 control-label">1/4 Luces</label>
                                                            <input type="hidden" name="Lucesch">
                                                            <div class="col-md-6 col-sm-3 col-lg-6">
                                                                <label class="radio ">
                                                                    <input type="radio" class="radiobox" value="Si" name="optLucesch"><span>Si</span> 
                                                                </label>
                                                                <label class="radio ">
                                                                    <input type="radio" class="radiobox" value="No"  name="optLucesch"><span>No</span> 
                                                                </label>
                                                                <label class="radio ">
                                                                    <input type="radio" class="radiobox" value="C/Daño" name="optLucesch"><span>C/Daño</span> 
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-3 col-md-3 col-lg-3">
                                                        <div class="form-group">
                                                            <label class="col-md-6 col-sm-3 col-lg-6 control-label">Antena</label>
                                                            <input type="hidden" name="Antena">
                                                            <div class="col-md-6 col-sm-3 col-lg-6">
                                                                <label class="radio ">
                                                                    <input type="radio" class="radiobox" value="Si" name="optAntena"><span>Si</span> 
                                                                </label>
                                                                <label class="radio ">
                                                                    <input type="radio" class="radiobox" value="No"  name="optAntena"><span>No</span> 
                                                                </label>
                                                                <label class="radio ">
                                                                    <input type="radio" class="radiobox" value="C/Daño" name="optAntena"><span>C/Daño</span> 
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-3 col-md-3 col-lg-3">
                                                        <div class="form-group">
                                                            <label class="col-md-6 col-sm-3 col-lg-6 control-label">Espejos Laterales</label>
                                                            <input type="hidden" name="EspejosLaterales">
                                                            <div class="col-md-6 col-sm-3 col-lg-6">
                                                                <label class="radio ">
                                                                    <input type="radio" class="radiobox" value="Si" name="optEspejosLaterales"><span>Si</span> 
                                                                </label>
                                                                <label class="radio ">
                                                                    <input type="radio" class="radiobox" value="No"  name="optEspejosLaterales"><span>No</span> 
                                                                </label>
                                                                <label class="radio ">
                                                                    <input type="radio" class="radiobox" value="C/Daño" name="optEspejosLaterales"><span>C/Daño</span> 
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-12 col-md-12 col-lg-12">
                                                    <div class="col-sm-3 col-md-3 col-lg-3">
                                                        <div class="form-group">
                                                            <label class="col-md-6 control-label">Cristales</label>
                                                            <input type="hidden" name="Cristales">
                                                            <div class="col-md-6 col-sm-3 col-lg-6">
                                                                <label class="radio ">
                                                                    <input type="radio" class="radiobox" value="Si" name="optCristales"><span>Si</span> 
                                                                </label>
                                                                <label class="radio ">
                                                                    <input type="radio" class="radiobox" value="No"  name="optCristales"><span>No</span> 
                                                                </label>
                                                                <label class="radio ">
                                                                    <input type="radio" class="radiobox" value="C/Daño" name="optCristales"><span>C/Daño</span> 
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-3 col-md-3 col-lg-3">
                                                        <div class="form-group">
                                                            <label class="col-md-6 control-label">Emblemas</label>
                                                            <input type="hidden" name="Emblemas">
                                                            <div class="col-md-6 col-sm-3 col-lg-6">
                                                                <label class="radio ">
                                                                    <input type="radio" class="radiobox" value="Si" name="optEmblemas"><span>Si</span> 
                                                                </label>
                                                                <label class="radio ">
                                                                    <input type="radio" class="radiobox" value="No"  name="optEmblemas"><span>No</span> 
                                                                </label>
                                                                <label class="radio ">
                                                                    <input type="radio" class="radiobox" value="C/Daño" name="optEmblemas"><span>C/Daño</span> 
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-3 col-md-3 col-lg-3">
                                                        <div class="form-group">
                                                            <label class="col-md-6 control-label">Llantas</label>
                                                            <input type="hidden" name="Llantas">
                                                            <div class="col-md-6 col-sm-3 col-lg-6">
                                                                <label class="radio ">
                                                                    <input type="radio" class="radiobox" value="Si" name="optLlantas"><span>Si</span> 
                                                                </label>
                                                                <label class="radio ">
                                                                    <input type="radio" class="radiobox" value="No"  name="optLlantas"><span>No</span> 
                                                                </label>
                                                                <label class="radio ">
                                                                    <input type="radio" class="radiobox" value="C/Daño" name="optLlantas"><span>C/Daño</span> 
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-3 col-md-3 col-lg-3">
                                                        <div class="form-group">
                                                            <label class="col-md-6 control-label">Tapones/ Centro Rin</label>
                                                            <input type="hidden" name="Taponesrin">
                                                            <div class="col-md-6 col-sm-3 col-lg-6">
                                                                <label class="radio ">
                                                                    <input type="radio" class="radiobox" value="Si" name="optTaponesrin"><span>Si</span> 
                                                                </label>
                                                                <label class="radio ">
                                                                    <input type="radio" class="radiobox" value="No"  name="optTaponesrin"><span>No</span> 
                                                                </label>
                                                                <label class="radio ">
                                                                    <input type="radio" class="radiobox" value="C/Daño" name="optTaponesrin"><span>C/Daño</span> 
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-12 col-md-12 col-lg-12">
                                                    <div class="col-sm-3 col-md-3 col-lg-3">
                                                        <div class="form-group">
                                                            <label class="col-md-6 control-label">Molduras</label>
                                                            <input type="hidden" name="Molduras">
                                                            <div class="col-md-6 col-sm-3 col-lg-6">
                                                                <label class="radio ">
                                                                    <input type="radio" class="radiobox" value="Si" name="optMolduras"><span>Si</span> 
                                                                </label>
                                                                <label class="radio ">
                                                                    <input type="radio" class="radiobox" value="No"  name="optMolduras"><span>No</span> 
                                                                </label>
                                                                <label class="radio ">
                                                                    <input type="radio" class="radiobox" value="C/Daño" name="optMolduras"><span>C/Daño</span> 
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-3 col-md-3 col-lg-3">
                                                        <div class="form-group">
                                                            <label class="col-md-6 control-label">Tapon Gasolina</label>
                                                            <input type="hidden" name="TaponGasolina">
                                                            <div class="col-md-6 col-sm-3 col-lg-6">
                                                                <label class="radio ">
                                                                    <input type="radio" class="radiobox" value="Si" name="optTaponGasolina"><span>Si</span> 
                                                                </label>
                                                                <label class="radio ">
                                                                    <input type="radio" class="radiobox" value="No"  name="optTaponGasolina"><span>No</span> 
                                                                </label>
                                                                <label class="radio ">
                                                                    <input type="radio" class="radiobox" value="C/Daño" name="optTaponGasolina"><span>C/Daño</span> 
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-3 col-md-3 col-lg-3">
                                                        <div class="form-group">
                                                            <label class="col-md-6 control-label">Calaveras</label>
                                                            <input type="hidden" name="Calaveras">
                                                            <div class="col-md-6 col-sm-3 col-lg-6">
                                                                <label class="radio ">
                                                                    <input type="radio" class="radiobox" value="Si" name="optCalaveras"><span>Si</span> 
                                                                </label>
                                                                <label class="radio ">
                                                                    <input type="radio" class="radiobox" value="No"  name="optCalaveras"><span>No</span> 
                                                                </label>
                                                                <label class="radio ">
                                                                    <input type="radio" class="radiobox" value="C/Daño" name="optCalaveras"><span>C/Daño</span> 
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-3 col-md-3 col-lg-3">
                                                        <div class="form-group">
                                                            <label class="col-md-6 control-label">FarosNiebla</label>
                                                            <input type="hidden" name="FarosNiebla">
                                                            <div class="col-md-6 col-sm-3 col-lg-6">
                                                                <label class="radio ">
                                                                    <input type="radio" class="radiobox" value="Si" name="optFarosNiebla"><span>Si</span> 
                                                                </label>
                                                                <label class="radio ">
                                                                    <input type="radio" class="radiobox" value="No"  name="optFarosNiebla"><span>No</span> 
                                                                </label>
                                                                <label class="radio ">
                                                                    <input type="radio" class="radiobox" value="C/Daño" name="optFarosNiebla"><span>C/Daño</span> 
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-12 col-md-12 col-lg-12">
                                                    <div class="form-group">
                                                        <label class="col-md-12 control-label">Comentarios Exteriores</label>
                                                        <div class="col-md-12 col-sm-12 col-lg-12">
                                                          <input type="text" class="form-control" name="ComentariosExt" style="width: 100%">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="jarviswidget  jarviswidget-sortable jarviswidget-collapsed" id="wid-id-2" 
                                    data-widget-deletebutton="false" data-widget-colorbutton="false" data-widget-editbutton="false"  data-widget-fullscreenbutton="false" data-widget-collapsed="false" >
                                        <header onclick="$('.showinterior').toggle()"> <span class="widget-icon"> 
                                            <i class="far fa-long-arrow-right"></i> </span>
                                            <h2>Interiores</h2>
                                        </header>
                                        <div class="showinterior" style="display: none;">
                                            <!-- widget edit box -->
                                            <div class="jarviswidget-editbox" style="">
                                            </div>
                                            <div class="widget-body">
                                                <div class="col-sm-12 col-md-12 col-lg-12">
                                                    <div class="col-sm-3 col-md-3 col-lg-3">
                                                        <div class="form-group">
                                                            <label class="col-md-6 col-sm-3 col-lg-6 control-label">Limpiadores</label>
                                                            <input type="hidden" name="Limpiadores">
                                                            <div class="col-md-6 col-sm-3 col-lg-6">
                                                                <label class="radio ">
                                                                    <input type="radio" class="radiobox" value="Si" name="optLimpiadores"><span>Si</span> 
                                                                </label>
                                                                <label class="radio ">
                                                                    <input type="radio" class="radiobox" value="No"  name="optLimpiadores"><span>No</span> 
                                                                </label>
                                                                <label class="radio ">
                                                                    <input type="radio" class="radiobox" value="C/Daño" name="optLimpiadores"><span>C/Daño</span> 
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-3 col-md-3 col-lg-3">
                                                        <div class="form-group">
                                                            <label class="col-md-6 col-sm-3 col-lg-6 control-label">Flasher</label>
                                                            <input type="hidden" name="Flasher">
                                                            <div class="col-md-6 col-sm-3 col-lg-6">
                                                                <label class="radio ">
                                                                    <input type="radio" class="radiobox" value="Si" name="optFlasher"><span>Si</span> 
                                                                </label>
                                                                <label class="radio ">
                                                                    <input type="radio" class="radiobox" value="No"  name="optFlasher"><span>No</span> 
                                                                </label>
                                                                <label class="radio ">
                                                                    <input type="radio" class="radiobox" value="C/Daño" name="optFlasher"><span>C/Daño</span> 
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-3 col-md-3 col-lg-3">
                                                        <div class="form-group">
                                                            <label class="col-md-6 col-sm-3 col-lg-6 control-label">Calefaccion</label>
                                                            <input type="hidden" name="Calefaccion">
                                                            <div class="col-md-6 col-sm-3 col-lg-6">
                                                                <label class="radio ">
                                                                    <input type="radio" class="radiobox" value="Si" name="optCalefaccion"><span>Si</span> 
                                                                </label>
                                                                <label class="radio ">
                                                                    <input type="radio" class="radiobox" value="No"  name="optCalefaccion"><span>No</span> 
                                                                </label>
                                                                <label class="radio ">
                                                                    <input type="radio" class="radiobox" value="C/Daño" name="optCalefaccion"><span>C/Daño</span> 
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-3 col-md-3 col-lg-3">
                                                        <div class="form-group">
                                                            <label class="col-md-6 col-sm-3 col-lg-6 control-label">Radio</label>
                                                            <input type="hidden" name="Radio">
                                                            <div class="col-md-6 col-sm-3 col-lg-6">
                                                                <label class="radio ">
                                                                    <input type="radio" class="radiobox" value="Si" name="optRadio"><span>Si</span> 
                                                                </label>
                                                                <label class="radio ">
                                                                    <input type="radio" class="radiobox" value="No"  name="optRadio"><span>No</span> 
                                                                </label>
                                                                <label class="radio ">
                                                                    <input type="radio" class="radiobox" value="C/Daño" name="optRadio"><span>C/Daño</span> 
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-12 col-md-12 col-lg-12">
                                                    <div class="col-sm-3 col-md-3 col-lg-3">
                                                        <div class="form-group">
                                                            <label class="col-md-6 control-label">Encendedor</label>
                                                            <input type="hidden" name="Encendedor">
                                                            <div class="col-md-6 col-sm-3 col-lg-6">
                                                                <label class="radio ">
                                                                    <input type="radio" class="radiobox" value="Si" name="optEncendedor"><span>Si</span> 
                                                                </label>
                                                                <label class="radio ">
                                                                    <input type="radio" class="radiobox" value="No"  name="optEncendedor"><span>No</span> 
                                                                </label>
                                                                <label class="radio ">
                                                                    <input type="radio" class="radiobox" value="C/Daño" name="optEncendedor"><span>C/Daño</span> 
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-3 col-md-3 col-lg-3">
                                                        <div class="form-group">
                                                            <label class="col-md-6 control-label">Retrovisor</label>
                                                            <input type="hidden" name="Retrovisor">
                                                            <div class="col-md-6 col-sm-3 col-lg-6">
                                                                <label class="radio ">
                                                                    <input type="radio" class="radiobox" value="Si" name="optRetrovisor"><span>Si</span> 
                                                                </label>
                                                                <label class="radio ">
                                                                    <input type="radio" class="radiobox" value="No"  name="optRetrovisor"><span>No</span> 
                                                                </label>
                                                                <label class="radio ">
                                                                    <input type="radio" class="radiobox" value="C/Daño" name="optRetrovisor"><span>C/Daño</span> 
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-3 col-md-3 col-lg-3">
                                                        <div class="form-group">
                                                            <label class="col-md-6 control-label">Cenicero</label>
                                                            <input type="hidden" name="Cenicero">
                                                            <div class="col-md-6 col-sm-3 col-lg-6">
                                                                <label class="radio ">
                                                                    <input type="radio" class="radiobox" value="Si" name="optCenicero"><span>Si</span> 
                                                                </label>
                                                                <label class="radio ">
                                                                    <input type="radio" class="radiobox" value="No"  name="optCenicero"><span>No</span> 
                                                                </label>
                                                                <label class="radio ">
                                                                    <input type="radio" class="radiobox" value="C/Daño" name="optCenicero"><span>C/Daño</span> 
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-3 col-md-3 col-lg-3">
                                                        <div class="form-group">
                                                            <label class="col-md-6 control-label">Cinturones</label>
                                                            <input type="hidden" name="Cinturones">
                                                            <div class="col-md-6 col-sm-3 col-lg-6">
                                                                <label class="radio ">
                                                                    <input type="radio" class="radiobox" value="Si" name="optCinturones"><span>Si</span> 
                                                                </label>
                                                                <label class="radio ">
                                                                    <input type="radio" class="radiobox" value="No"  name="optCinturones"><span>No</span> 
                                                                </label>
                                                                <label class="radio ">
                                                                    <input type="radio" class="radiobox" value="C/Daño" name="optCinturones"><span>C/Daño</span> 
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-12 col-md-12 col-lg-12">
                                                    <div class="col-sm-3 col-md-3 col-lg-3">
                                                        <div class="form-group">
                                                            <label class="col-md-6 control-label">Reclinables</label>
                                                            <input type="hidden" name="Reclinables">
                                                            <div class="col-md-6 col-sm-3 col-lg-6">
                                                                <label class="radio ">
                                                                    <input type="radio" class="radiobox" value="Si" name="optReclinables"><span>Si</span> 
                                                                </label>
                                                                <label class="radio ">
                                                                    <input type="radio" class="radiobox" value="No"  name="optReclinables"><span>No</span> 
                                                                </label>
                                                                <label class="radio ">
                                                                    <input type="radio" class="radiobox" value="C/Daño" name="optReclinables"><span>C/Daño</span> 
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-3 col-md-3 col-lg-3">
                                                        <div class="form-group">
                                                            <label class="col-md-6 control-label">Tapetes</label>
                                                            <input type="hidden" name="Tapetes">
                                                            <div class="col-md-6 col-sm-3 col-lg-6">
                                                                <label class="radio ">
                                                                    <input type="radio" class="radiobox" value="Si" name="optTapetes"><span>Si</span> 
                                                                </label>
                                                                <label class="radio ">
                                                                    <input type="radio" class="radiobox" value="No"  name="optTapetes"><span>No</span> 
                                                                </label>
                                                                <label class="radio ">
                                                                    <input type="radio" class="radiobox" value="C/Daño" name="optTapetes"><span>C/Daño</span> 
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-3 col-md-3 col-lg-3">
                                                        <div class="form-group">
                                                            <label class="col-md-6 control-label">Vestiduras</label>
                                                            <input type="hidden" name="Vestiduras">
                                                            <div class="col-md-6 col-sm-3 col-lg-6">
                                                                <label class="radio ">
                                                                    <input type="radio" class="radiobox" value="Si" name="optVestiduras"><span>Si</span> 
                                                                </label>
                                                                <label class="radio ">
                                                                    <input type="radio" class="radiobox" value="No"  name="optVestiduras"><span>No</span> 
                                                                </label>
                                                                <label class="radio ">
                                                                    <input type="radio" class="radiobox" value="C/Daño" name="optVestiduras"><span>C/Daño o sucias</span> 
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-3 col-md-3 col-lg-3">
                                                        <div class="form-group">
                                                            <label class="col-md-6 control-label">Guantera</label>
                                                            <input type="hidden" name="Guantera">
                                                            <div class="col-md-6 col-sm-3 col-lg-6">
                                                                <label class="radio ">
                                                                    <input type="radio" class="radiobox" value="Si" name="optGuantera"><span>Si</span> 
                                                                </label>
                                                                <label class="radio ">
                                                                    <input type="radio" class="radiobox" value="No"  name="optGuantera"><span>No</span> 
                                                                </label>
                                                                <label class="radio ">
                                                                    <input type="radio" class="radiobox" value="C/Daño" name="optGuantera"><span>C/Daño</span> 
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-12 col-md-12 col-lg-12">
                                                    <div class="form-group">
                                                        <label class="col-md-12 control-label">Comentarios Interiores</label>
                                                        <div class="col-md-12 col-sm-12 col-lg-12">
                                                          <input type="text" class="form-control" name="ComentariosInt" style="width: 100%">
                                                        </div>
                                                        
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="jarviswidget  jarviswidget-sortable jarviswidget-collapsed" id="wid-id-3" 
                                    data-widget-deletebutton="false" data-widget-colorbutton="false" data-widget-editbutton="false"  data-widget-fullscreenbutton="false" data-widget-collapsed="false" >
                                        <header onclick="$('.showaccesorios').toggle()"> <span class="widget-icon"> 
                                            <i class="far fa-list-alt"></i> </span>
                                            <h2>Accesorios</h2>
                                        </header>
                                        <div class="showaccesorios" style="display: none;">
                                            <!-- widget edit box -->
                                            <div class="jarviswidget-editbox" style="">
                                            </div>
                                            <div class="widget-body">
                                                <div class="col-sm-12 col-md-12 col-lg-12">
                                                    <div class="col-sm-3 col-md-3 col-lg-3">
                                                        <div class="form-group">
                                                            <label class="col-md-6 col-sm-3 col-lg-6 control-label">Gato</label>
                                                            <input type="hidden" name="Gato">
                                                            <div class="col-md-6 col-sm-3 col-lg-6">
                                                                <label class="radio ">
                                                                    <input type="radio" class="radiobox" value="Si" name="optGato"><span>Si</span> 
                                                                </label>
                                                                <label class="radio ">
                                                                    <input type="radio" class="radiobox" value="No"  name="optGato"><span>No</span> 
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-3 col-md-3 col-lg-3">
                                                        <div class="form-group">
                                                            <label class="col-md-6 col-sm-3 col-lg-6 control-label">Maneral Gato</label>
                                                            <input type="hidden" name="ManeralGato">
                                                            <div class="col-md-6 col-sm-3 col-lg-6">
                                                                <label class="radio ">
                                                                    <input type="radio" class="radiobox" value="Si" name="optManeralGato"><span>Si</span> 
                                                                </label>
                                                                <label class="radio ">
                                                                    <input type="radio" class="radiobox" value="No"  name="optManeralGato"><span>No</span> 
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-3 col-md-3 col-lg-3">
                                                        <div class="form-group">
                                                            <label class="col-md-6 col-sm-3 col-lg-6 control-label">Llave de Ruedas L</label>
                                                            <input type="hidden" name="LlavedeLlantas">
                                                            <div class="col-md-6 col-sm-3 col-lg-6">
                                                                <label class="radio ">
                                                                    <input type="radio" class="radiobox" value="Si" name="optLlavedeLlantas"><span>Si</span> 
                                                                </label>
                                                                <label class="radio ">
                                                                    <input type="radio" class="radiobox" value="No"  name="optLlavedeLlantas"><span>No</span> 
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-3 col-md-3 col-lg-3">
                                                        <div class="form-group">
                                                            <label class="col-md-6 col-sm-3 col-lg-6 control-label">Kit Herramientas</label>
                                                            <input type="hidden" name="Herramientas">
                                                            <div class="col-md-6 col-sm-3 col-lg-6">
                                                                <label class="radio ">
                                                                    <input type="radio" class="radiobox" value="Si" name="optHerramientas"><span>Si</span> 
                                                                </label>
                                                                <label class="radio ">
                                                                    <input type="radio" class="radiobox" value="No"  name="optHerramientas"><span>No</span> 
                                                                </label>
                                                                
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-12 col-md-12 col-lg-12">
                                                    <div class="col-sm-3 col-md-3 col-lg-3">
                                                        <div class="form-group">
                                                            <label class="col-md-6 control-label">Señales Reflejantes</label>
                                                            <input type="hidden" name="SenalesReflejantes">
                                                            <div class="col-md-6 col-sm-3 col-lg-6">
                                                                <label class="radio ">
                                                                    <input type="radio" class="radiobox" value="Si" name="optSenalesReflejantes"><span>Si</span> 
                                                                </label>
                                                                <label class="radio ">
                                                                    <input type="radio" class="radiobox" value="No"  name="optSenalesReflejantes"><span>No</span> 
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-3 col-md-3 col-lg-3">
                                                        <div class="form-group">
                                                            <label class="col-md-6 control-label">Extintor</label>
                                                            <input type="hidden" name="Extinguidor">
                                                            <div class="col-md-6 col-sm-3 col-lg-6">
                                                                <label class="radio ">
                                                                    <input type="radio" class="radiobox" value="Si" name="optExtinguidor"><span>Si</span> 
                                                                </label>
                                                                <label class="radio ">
                                                                    <input type="radio" class="radiobox" value="No"  name="optExtinguidor"><span>No</span> 
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-3 col-md-3 col-lg-3">
                                                        <div class="form-group">
                                                            <label class="col-md-6 control-label">Llanta Refaccion</label>
                                                            <input type="hidden" name="LlantaRefaccion">
                                                            <div class="col-md-6 col-sm-3 col-lg-6">
                                                                <label class="radio ">
                                                                    <input type="radio" class="radiobox" value="Si" name="optLlantaRefaccion"><span>Si</span> 
                                                                </label>
                                                                <label class="radio ">
                                                                    <input type="radio" class="radiobox" value="No"  name="optLlantaRefaccion"><span>No</span> 
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-3 col-md-3 col-lg-3">
                                                        <div class="form-group">
                                                            <label class="col-md-6 control-label">Control Alarma</label>
                                                            <input type="hidden" name="AlarmaControl">
                                                            <div class="col-md-6 col-sm-3 col-lg-6">
                                                                <label class="radio ">
                                                                    <input type="radio" class="radiobox" value="Si" name="optAlarmaControl"><span>Si</span> 
                                                                </label>
                                                                <label class="radio ">
                                                                    <input type="radio" class="radiobox" value="No"  name="optAlarmaControl"><span>No</span> 
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-12 col-md-12 col-lg-12">
                                                    <div class="col-sm-3 col-md-3 col-lg-3">
                                                        <div class="form-group">
                                                            <label class="col-md-6 control-label">Equipo A/V</label>
                                                            <input type="hidden" name="EquipoAV">
                                                            <div class="col-md-6 col-sm-3 col-lg-6">
                                                                <label class="radio ">
                                                                    <input type="radio" class="radiobox" value="Si" name="optEquipoAV"><span>Si</span> 
                                                                </label>
                                                                <label class="radio ">
                                                                    <input type="radio" class="radiobox" value="No"  name="optEquipoAV"><span>No</span> 
                                                                </label>
                                                                <label class="radio ">
                                                                    <input type="radio" class="radiobox" value="C/Daño" name="optEquipoAV"><span>C/Daño</span> 
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-3 col-md-3 col-lg-3">
                                                        <div class="form-group">
                                                            <label class="col-md-6 control-label">Cables P/Corriente</label>
                                                            <input type="hidden" name="CablesPasaCorriente">
                                                            <div class="col-md-6 col-sm-3 col-lg-6">
                                                                <label class="radio ">
                                                                    <input type="radio" class="radiobox" value="Si" name="optCablesPasaCorriente"><span>Si</span> 
                                                                </label>
                                                                <label class="radio ">
                                                                    <input type="radio" class="radiobox" value="No"  name="optCablesPasaCorriente"><span>No</span> 
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-3 col-md-3 col-lg-3">
                                                        <div class="form-group">
                                                            <label class="col-md-6 control-label">Dado de Seg.</label>
                                                            <input type="hidden" name="DadoSeg">
                                                            <div class="col-md-6 col-sm-3 col-lg-6">
                                                                <label class="radio ">
                                                                    <input type="radio" class="radiobox" value="Si" name="optDadoSeg"><span>Si</span> 
                                                                </label>
                                                                <label class="radio ">
                                                                    <input type="radio" class="radiobox" value="No"  name="optDadoSeg"><span>No</span> 
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    
                                                </div>
                                                <div class="col-sm-12 col-md-12 col-lg-12">
                                                    <div class="form-group">
                                                        <label class="col-md-12 control-label">Comentarios Accesorios</label>
                                                        <div class="col-md-12 col-sm-12 col-lg-12">
                                                          <input type="text" class="form-control" name="ComentariosAcces" style="width: 100%">
                                                        </div>
                                                        
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="jarviswidget  jarviswidget-sortable jarviswidget-collapsed" id="wid-id-4" 
                                    data-widget-deletebutton="false" data-widget-colorbutton="false" data-widget-editbutton="false"  data-widget-fullscreenbutton="false" data-widget-collapsed="false" >
                                        <header onclick="$('.showcompmec').toggle()"> <span class="widget-icon"> 
                                            <i class="far fa-wrench"></i> </span>
                                            <h2>Componentes Mecanicos</h2>
                                        </header>
                                        <div class="showcompmec" style="display: none;">
                                            <!-- widget edit box -->
                                            <div class="jarviswidget-editbox" style="">
                                            </div>
                                            <div class="widget-body">
                                                <div class="col-sm-12 col-md-12 col-lg-12">
                                                    <div class="col-sm-3 col-md-3 col-lg-3">
                                                        <div class="form-group">
                                                            <label class="col-md-6 col-sm-6 col-lg-6 control-label">Tapon Aceite</label>
                                                            <input type="hidden" name="TaponAceite">
                                                            <div class="col-md-6 col-sm-6 col-lg-6">
                                                                <label class="radio ">
                                                                    <input type="radio" class="radiobox" value="Si" name="optTaponAceite"><span>Si</span> 
                                                                </label>
                                                                <label class="radio ">
                                                                    <input type="radio" class="radiobox" value="No"  name="optTaponAceite"><span>No</span> 
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-3 col-md-3 col-lg-3">
                                                        <div class="form-group">
                                                            <label class="col-md-6 col-sm-6 col-lg-6 control-label">Tapon Dep. H/D</label>
                                                            <input type="hidden" name="TaponDirHD">
                                                            <div class="col-md-6 col-sm-6 col-lg-6">
                                                                <label class="radio ">
                                                                    <input type="radio" class="radiobox" value="Si" name="optTaponDirHD"><span>Si</span> 
                                                                </label>
                                                                <label class="radio ">
                                                                    <input type="radio" class="radiobox" value="No"  name="optTaponDirHD"><span>No</span> 
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-3 col-md-3 col-lg-3">
                                                        <div class="form-group">
                                                            <label class="col-md-6 col-sm-6 col-lg-6 control-label">Tapon Dep. Frenos</label>
                                                            <input type="hidden" name="TaponDepFrenos">
                                                            <div class="col-md-6 col-sm-6 col-lg-6">
                                                                <label class="radio ">
                                                                    <input type="radio" class="radiobox" value="Si" name="optTaponDepFrenos"><span>Si</span> 
                                                                </label>
                                                                <label class="radio ">
                                                                    <input type="radio" class="radiobox" value="No"  name="optTaponDepFrenos"><span>No</span> 
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-3 col-md-3 col-lg-3">
                                                        <div class="form-group">
                                                            <label class="col-md-6 col-sm-6 col-lg-6 control-label">Tapon Limpiaparabrisas</label>
                                                            <input type="hidden" name="TaponLimpiaparabrisas">
                                                            <div class="col-md-6 col-sm-6 col-lg-6">
                                                                <label class="radio ">
                                                                    <input type="radio" class="radiobox" value="Si" name="optTaponLimpiaparabrisas"><span>Si</span> 
                                                                </label>
                                                                <label class="radio ">
                                                                    <input type="radio" class="radiobox" value="No"  name="optTaponLimpiaparabrisas"><span>No</span> 
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-12 col-md-12 col-lg-12">
                                                    <div class="col-sm-3 col-md-3 col-lg-3">
                                                        <div class="form-group">
                                                            <label class="col-md-6 control-label">Bateria</label>
                                                            <input type="hidden" name="Bateria">
                                                            <div class="col-md-6 col-sm-6 col-lg-6">
                                                                <label class="radio ">
                                                                    <input type="radio" class="radiobox" value="Si" name="optBateria"><span>Si <input type="text" class="" style="width: 90px;" value="" placeholder="Marca" name="MarcaBateria"></span> 
                                                                </label>
                                                                <label class="radio ">
                                                                    <input type="radio" class="radiobox" value="No"  name="optBateria"><span>No</span> 
                                                                </label>
                                                                
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-3 col-md-3 col-lg-3">
                                                        <div class="form-group">
                                                            <label class="col-md-6 control-label">Claxon</label>
                                                            <input type="hidden" name="Claxon">
                                                            <div class="col-md-6 col-sm-6 col-lg-6">
                                                                <label class="radio ">
                                                                    <input type="radio" class="radiobox" value="Si" name="optClaxon"><span>Si</span> 
                                                                </label>
                                                                <label class="radio ">
                                                                    <input type="radio" class="radiobox" value="No"  name="optClaxon"><span>No</span> 
                                                                </label>
                                                                
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <br>
                                                            <label class="col-md-12 control-label">Comentarios Componentes</label>
                                                            <div class="col-md-12 col-sm-12 col-lg-12">
                                                                <input type="text" class="form-control" name="ComentariosComp" style="width: 100%">
                                                            </div>
                                                        </div>
                                                    </div>
                                                   
                                                </div>
                                                    
                                            
                                            </div>
                                        </div>
                                    </div>
                                    <div class="jarviswidget  jarviswidget-sortable jarviswidget-collapsed" id="wid-id-5" 
                                    data-widget-deletebutton="false" data-widget-colorbutton="false" data-widget-editbutton="false"  data-widget-fullscreenbutton="false" data-widget-collapsed="false" >
                                        <header onclick="$('.showdocumentos').toggle()"> <span class="widget-icon"> 
                                            <i class="far fa-folder-open"></i> </span>
                                            <h2>Documentos</h2>
                                        </header>
                                        <div class="showdocumentos" style="display: none;">
                                            <!-- widget edit box -->
                                            <div class="jarviswidget-editbox" style="">
                                            </div>
                                            <div class="widget-body">
                                                <div class="col-sm-12 col-md-12 col-lg-12">
                                                    <div class="col-sm-3 col-md-3 col-lg-3">
                                                        <div class="form-group">
                                                            <label class="col-md-6 col-sm-6 col-lg-6 control-label"> Tarjeta Circulacion</label>
                                                            <input type="hidden" name="TarjetaCirc">
                                                            <div class="col-md-6 col-sm-6 col-lg-6">
                                                                <label class="radio ">
                                                                    <input type="radio" class="radiobox" value="Si" name="optTarjetaCirc"><span>Si</span> 
                                                                </label>
                                                                <label class="radio ">
                                                                    <input type="radio" class="radiobox" value="No"  name="optTarjetaCirc"><span>No</span> 
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <div class="form-group documentos-aseguradora" hidden>
                                                            <br>
                                                            <label class="col-md-12 control-label">No. de Reporte</label>
                                                            <div class="col-md-12 col-sm-12 col-lg-12">
                                                                <input type="text" class="form-control" placeholder='Numero de reporte' name="ReporteNum" style="width: 100%">
                                                            </div>
                                                        </div>
                                                       
                                                    </div>
                                                    <div class="col-sm-3 col-md-3 col-lg-3">
                                                        <div class="form-group">
                                                            <label class="col-md-6 col-sm-6 col-lg-6 control-label">Poliza de Seguro</label>
                                                            <input type="hidden" name="PolizaSeg">
                                                            <div class="col-md-6 col-sm-6 col-lg-6">
                                                                <label class="radio ">
                                                                    <input type="radio" class="radiobox" value="Si" name="optPolizaSeg"><span>Si</span> 
                                                                </label>
                                                                <label class="radio ">
                                                                    <input type="radio" class="radiobox" value="No"  name="optPolizaSeg"><span>No</span> 
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <div class="form-group documentos-aseguradora" hidden>
                                                            <br>
                                                            <label class="col-md-12 control-label">No. de Póliza</label>
                                                            <div class="col-md-12 col-sm-12 col-lg-12">
                                                                <input type="text" class="form-control" placeholder='Numero de Poliza' name="PolizaNum" style="width: 100%">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-3 col-md-3 col-lg-3">
                                                        <div class="form-group">
                                                            <label class="col-md-6 col-sm-6 col-lg-6 control-label">Manual Prop</label>
                                                            <input type="hidden" name="ManualProp">
                                                            <div class="col-md-6 col-sm-6 col-lg-6">
                                                                <label class="radio ">
                                                                    <input type="radio" class="radiobox" value="Si" name="optManualProp"><span>Si</span> 
                                                                </label>
                                                                <label class="radio ">
                                                                    <input type="radio" class="radiobox" value="No"  name="optManualProp"><span>No</span> 
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <div class="form-group documentos-aseguradora" hidden>
                                                            <br>
                                                            <label class="col-md-12 control-label">No. de Siniestro</label>
                                                            <div class="col-md-12 col-sm-12 col-lg-12">
                                                                <input type="text" class="form-control" placeholder='Numero siniestro' name="siniestro" style="width: 100%">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-3 col-md-3 col-lg-3">
                                                        <div class="form-group">
                                                            <label class="col-md-6 col-sm-6 col-lg-6 control-label">Talon Verif.</label>
                                                            <input type="hidden" name="TalonVerif">
                                                            <div class="col-md-6 col-sm-6 col-lg-6">
                                                                <label class="radio ">
                                                                    <input type="radio" class="radiobox" value="Si" name="optTalonVerif"><span>Si</span> 
                                                                </label>
                                                                <label class="radio ">
                                                                    <input type="radio" class="radiobox" value="No"  name="optTalonVerif"><span>No</span> 
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <div class="form-group documentos-aseguradora" hidden>
                                                            <br>
                                                            <label class="col-md-12 control-label">Deducible</label>
                                                            <div class="col-md-12 col-sm-12 col-lg-12">
                                                                <input type="text" class="form-control" placeholder='Monto deducible' name="siniestro" style="width: 100%">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-12 col-md-12 col-lg-12">
                                                    <div class="col-sm-12">
                                                        <div class="form-group">
                                                            <br>
                                                            <label class="col-md-12 control-label">Comentarios Documentacion</label>
                                                            <div class="col-md-12 col-sm-12 col-lg-12">
                                                                <input type="text" class="form-control" placeholder='Comentarios documentacion' name="ComentariosDoc" style="width: 100%">
                                                            </div>
                                                        </div>
                                                    </div>
                                                   
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


        /*************FOTOS**************/
    function getFoto(id, e)
    {
        var fileElem = document.getElementById(id);
        if (fileElem) {
            $('#contfilevehiculo').html('');
            fileElem.click();
        }
    }
  
    num=0;
    contfotosauto=0;
    numdel=1;
    var arraydeleteauto=[];
    
    
    function deleteimage(num){
       imagen = document.getElementById("image_"+num);   

        if (!imagen){
            alert("El elemento selecionado no existe");
        } else {
            arraydeleteauto[numdel]=$('#image_'+num).attr("nameimage");
            padre = imagen.parentNode;
            padre.removeChild(imagen);
           $("#deletefilevehiculo").val(arraydeleteauto);
            numdel++;
            contfotosauto--;
        }
        $("#contfotosauto").html(contfotosauto);

    }
    
    function uploadimages(evt) {
        var files = evt.target.files; // FileList object
        $numfotos=0;
        for (var i = 0, f; f = files[i]; i++) {
            $numfotos++;
        }
        if($numfotos<=15){
            // Loop through the FileList and render image files as thumbnails.
            for (var i = 0, f; f = files[i]; i++) {
                var nameimage=files[i].name;
                if(files[i].size >= 3856819) {
                  alert("La imagen "+nameimage+" es muy grande, El tamaño maximo es de 3.67 MB");
                  files[i].value = null;
                  continue;
                }
                contfotosauto++;
                // Only process image files.
                if (!f.type.match('image.*')) {
                    notify("error","Solo puedes seleccionar imagenes");
                    continue;
                }
                var reader = new FileReader();
                // Closure to capture the file information.
                reader.onload = (function(theFile) {
                    return function(e) {
                        var num=Math.floor(Math.random() * 1000); 
                        var span = document.createElement('span');
                        span.innerHTML = ['<img title="click para eliminar" onclick="deleteimage(',num,');  return false;"  class="thumb" id="image_',num,'" width="150px" height="150px" src="', e.target.result,
                                        '" nameimage="', escape(theFile.name), '"/>'].join('');
                      document.getElementById('contfilevehiculo').insertBefore(span, null);
                    };
                })(f);
                // Read in the image file as a data URL.
                reader.readAsDataURL(f);     
            }
            $("#contfotosauto").html(contfotosauto);
        }else{
            notify("error","Solo puedes seleccionar 15 imagenes");
        } 
    }

       //*************END FOTOS************* /
   
    $(document).ready(function() {
        document.getElementById('filevehiculo').addEventListener('change', uploadimages, false);

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
            var id_cliente    = $("#id_cliente").val();
            var id_marca      = $("#id_marca").val();
            var id_submarca   = $("#id_submarca").val();
            var modelo        = $("#modelo").val();
            if ( ! fecha_alta )    return notify("info","La fecha de alta es requerida");
            if ( ! fecha_promesa ) return notify("info","La fecha de promesa es requerida");
            if ( fecha_promesa < fecha_alta ) return notify("info","La fecha de promesa no puede ser menor a la fecha de alta");
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
        $('body').on('click', '.radiobox', function(){
            var namecolumn = $(this).attr("name");
            namecolumn     = namecolumn.split("opt");
            var val= $(this).val();
            if(namecolumn.length>0){
                namecolumn = namecolumn[1];
                $('input[name='+namecolumn+']').val( val );
            }else{
                notify("error","Error al registrar dato");
            }
        });
        $('body').on('change', '#id_marca', function(){
            if( $(this).val() ){
                var id = $("#id_marca").val();
                getsubmarca(id);
            }
        });
        $('body').on('change', '#id_submarca', function(){
            if( $(this).val() ){
                var id = $("#id_submarca").val();
                getselectrefaccion(id);
            }
        });
        $('body').on('change', '#id_aseguradora', function(){
            if( $(this).val()>1 ){
                $(".documentos-aseguradora").show();
            }else{
                $(".documentos-aseguradora").hide();
            }
        });

        //**********Clients*************/
        showpopupclientes = function(){
            $('#titlemodal').html('<span class="widget-icon"><i class="far fa-plus"></i> Nuevo Cliente</span>');
            $.get(config.base+"/Clientes/ajax/?action=get&object=showpopup", null, function (response) {
                    if ( response ){
                        $("#contentpopup").html(response);
                    }else{
                        return notify('error', 'Error al obtener los datos del Formulario');
                        
                    }     
            });
        }
        getcliente =function(id){
            if ( ! id ) return;
            $("#contcliente").html("<div align='center'><i class='far fa-cog fa-spin fa-5x'></i></div>");
            $.get(config.base+"/Vehiculos/ajax/?action=get&object=getcliente&id=" + id, null, function (response) {
                    if ( response ){
                        $("#contcliente").html(response);
                    }else{
                        notify('error', 'Error al obtener los datos del cliente');
                        return false;
                    }     
            });
        }
        $('body').on('click', '#savenewclient', function(){
            var nombre       = $("input[name=nombre]", $(this).parents('form:first')).val();
            var apellido_pat = $("input[name=apellido_pat]", $(this).parents('form:first')).val();
            var apellido_mat = $("input[name=apellido_mat]", $(this).parents('form:first')).val();
            var telefono     = $("input[name=telefono]", $(this).parents('form:first')).val();
            
            if(!nombre) {  notify('error',"Se necesita el nombre del cliente."); return false; }
            var url = config.base+"/Clientes/ajax/?action=get&object=savenewclient"; // El script a dónde se realizará la petición.
            $.ajax({
                type: "POST",
                url: url,
                data: $(this).parents('form:first').serialize(), // Adjuntar los campos del formulario enviado.
                success: function(response){
                    if(response>0){
                        //alert("Group successfully added");
                        $('#id_cliente').append($('<option>', {
                            value: response,
                            text: nombre+" "+apellido_pat+" "+apellido_mat,
                            selected:true
                        }));  
                        $("#id_cliente").select2({
                            multiple: false,
                            header: "Selecciona una opcion",
                            noneSelectedText: "Seleccionar",
                            selectedList: 1
                        });
                        $('#myModal').modal('hide');
                        notify('success',"Cliente agregado correctamente:"+response);
                        getcliente(response);
                    }else{
                        notify('error',"Oopss error al agregar cliente"+response);
                    }
                }
             });
            return false; // Evitar ejecutar el submit del formulario.
        });
        $('body').on('change', '#id_cliente', function(){
            if( $(this).val() ){
                var id = $("#id_cliente").val();
                getcliente(id);
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
            var id_submarca = $("#id_submarca").val();
            var id_marca    = $("#id_marca").val();
            $.get(config.base+"/Catalogos/ajax/?action=get&object=showpopuprefaccion&id_submarca="+id_submarca+"&id_marca="+id_marca, null, function (response) {
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
            var modelohasta = $("#modelo_hasta").val();
          
            var url = config.base+"/Catalogos/ajax/?action=get&object=savenewrefaccion"; // El script a dónde se realizará la petición.
            $.ajax({
                type: "POST",
                url: url,
                data: "codigo="+code+"&nombre="+nombre+"&descripcion="+descripcion+"&id_marca="+id_marca+"&id_submarca="+id_submarca+"&modelo="+modelo+"&costo_aprox="+costoaprox+"&modelo_hasta="+modelohasta, // Adjuntar los campos del formulario enviado.
                success: function(response){
                    if(response>0){
                        //alert("Group successfully added");
                        if(!$('#idrefaccion').length > 0){
                            var id = $("#id_submarca").val();
                            getselectrefaccion(id);
                            $('#myModal').modal('hide');
                        }else{
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
                        }
                        
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
        //**********Servicio*************/
        calcTotal = function () {
            var totales = $(".totales");
            var total = 0;
            for (var i = 0, len = totales.length; i < len; i++) {
                var valor=$(totales[i]).val();
                if (valor>0) {
                    total += parseFloat(valor);
                }                
            }

            $("#total-num").html(total);
            $("#total-global").val(total);
        }
        showpopupservicio= function(){
            $('#titlemodal').html('<span class="widget-icon"><i class="far fa-plus"></i> Nuevo Servicio</span>');
            $.get(config.base+"/Catalogos/ajax/?action=get&object=showpopupservicio", null, function (response) {
                    if ( response ){
                        $("#contentpopup").html(response);
                    }else{
                        return notify('error', 'Error al obtener los datos del Formulario');
                        
                    }     
            });
        }
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
            calcTotal();
        });
        $('body').on('click', '#savenewservice', function(){
            
            var code        = $("input[name=codigo]", $(this).parents('form:first')).val();
            var nombre      = $("input[name=nombre]", $(this).parents('form:first')).val();
            var descripcion = $("input[name=descripcion]", $(this).parents('form:first')).val();
          
            var url = config.base+"/Catalogos/ajax/?action=get&object=savenewservice"; // El script a dónde se realizará la petición.
            $.ajax({
                type: "POST",
                url: url,
                data: $(this).parents('form:first').serialize(), // Adjuntar los campos del formulario enviado.
                success: function(response){
                    if(response>0){
                        //alert("Group successfully added");
                        $('#idservicio').append($('<option>', {
                            value: response,
                            text: code+"||"+nombre,
                            selected:true
                        }));  
                        $("#idservicio").select2({
                            multiple: false,
                            header: "Selecciona una opcion",
                            noneSelectedText: "Seleccionar",
                            selectedList: 1
                        });
                        $('#myModal').modal('hide');
                        $("#idservicio"). change();
                        notify('success',"Servicio agregado correctamente:"+response);
                    }else{
                        notify('error',"Oopss error al agregar servicio"+response);
                    }
                }
             });
            return false; // Evitar ejecutar el submit del formulario.
        });
        $('body').on('blur', '.totales', function(){
            if( $(this).val()>0 ) calcTotal();
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
