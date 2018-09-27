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
$page_css[] = "your_style.css";
include(SYSTEM_DIR . "/inc/header.php");

//include left panel (navigation)
//follow the tree in inc/config.ui.php
//$page_nav["misc"]["sub"]["blank"]["active"] = true;
include(SYSTEM_DIR . "/inc/nav.php");
if(isPost()){
    $obj = new Vehiculo();
    //$id=$obj->addAll(getPost());
    $id=1;
    if($id>0){
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
                if ($_FILES['filevehiculo']['type'][$i]=='image/png' || $_FILES['filevehiculo']['type'][$i]=='image/jpeg'){
                    if ( isset($_POST['deletefilevehiculo'] ) ) {
                        $imagesdeleted = $_POST['deletefilevehiculo'];
                        $pos = strpos($imagesdeleted, $_FILES["filevehiculo"]["name"][$i]); //quitamos las imagenes eliminadas
                        if ($pos === false) {
                            echo  $_FILES["filevehiculo"]["name"][$i];
                            move_uploaded_file($_FILES["filevehiculo"]["tmp_name"][$i], $carpetaimg."/".$_FILES["filevehiculo"]["name"][$i]);
                        }   
                    }else{
                        echo  $_FILES["filevehiculo"]["name"][$i];
                        move_uploaded_file($_FILES["filevehiculo"]["tmp_name"][$i], $carpetaimg."/".$_FILES["filevehiculo"]["name"][$i]);
                    }                   
                $validar=true;
                }
                else $validar=false;
                    
            }
        }
        exit;
        informSuccess(true, make_url("Vehiculos","add"));
    }else{
        informError(true,make_url("Vehiculos","add"));
    }
    
   
}
?>
<style type="text/css">
    .jarviswidget{
        margin: 0 0 10px;
    }
   .control-label 
   {
       font-weight: bold;
    }

</style>
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
                                            <i class="fa fa-file-text"></i> </span><h2>Recepcion</h2>
                                        </header>
                                        <div class="showrecepcion" style="display: ;">
                                            <!-- widget edit box -->
                                            <div class="jarviswidget-editbox" style=""></div>
                                            <div class="widget-body">
                                                <div class="col-sm-12">
                                                    <div class="col-sm-4">
                                                        <div class="form-group">
                                                            <input type="text" class="form-control datepicker" data-dateformat='yy-mm-dd' placeholder="Fecha de orden" name="fecha_alta" >
                                                            
                                                        </div>
                                                        <div class="form-group">
                                                            <select style="width:100%" class="select2" name="id_taller" id="id_taller">
                                                                <option value="">Selecciona Asessor</option>
                                                                <?php 
                                                                $obj = new User();
                                                                $list=$obj->getAllArr();
                                                                if (is_array($list) || is_object($list)){
                                                                    foreach($list as $val){
                                                                        echo "<option value='".$val['id']."'>".$val['nombre']."</option>";
                                                                    }
                                                                }
                                                                 ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-4">
                                                         <div class="form-group">
                                                            <select style="width:100%" class="select2" name="id_taller" id="id_taller">
                                                                <option value="">Selecciona Taller</option>
                                                                <?php 
                                                                $obj = new Taller();
                                                                $list=$obj->getAllArr();
                                                                if (is_array($list) || is_object($list)){
                                                                    foreach($list as $val){
                                                                        echo "<option value='".$val['id']."'>".$val['nombre']."</option>";
                                                                    }
                                                                }
                                                                 ?>
                                                            </select>
                                                        </div>
                                                        <div class="form-group">
                                                                                                                                                         
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-4">                                                     
                                                    </div> 
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="jarviswidget  jarviswidget-sortable jarviswidget-collapsed" id="wid-cliente" 
                                    data-widget-deletebutton="false" data-widget-colorbutton="false" data-widget-editbutton="false"  data-widget-fullscreenbutton="false" data-widget-collapsed="false" >
                                        <header onclick="$('.showcliente').toggle()"> <span class="widget-icon"> 
                                            <i class="fa fa-child"></i> </span><h2>Cliente</h2>
                                        </header>
                                        <div class="showcliente" style="display: ;">
                                            <!-- widget edit box -->
                                            <div class="jarviswidget-editbox" style=""></div>
                                            <div class="widget-body">
                                                <div class="col-sm-12">
                                                    <div class="col-sm-4">
                                                        <div class="form-group">
                                                            <select style="width:100%" class="select2" name="id_cliente" id="id_cliente">
                                                                <option value="">Selecciona Cliente</option>
                                                                <?php 
                                                                $obj = new Cliente();
                                                                $list=$obj->getAllArr();
                                                                if (is_array($list) || is_object($list)){
                                                                    foreach($list as $val){
                                                                        echo "<option value='".$val['id']."'>".$val['nombre']."</option>";
                                                                    }
                                                                }
                                                                 ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-2">
                                                         <a data-toggle="modal" class="btn btn-success" href="#myModal" onclick="showpopup()" > <i class="fa fa-plus"></i>Nuevo </a>
                                                    </div>
                                                    <div class="col-sm-6" id="contcliente">
                                                    
                                                    </div> 
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="jarviswidget  jarviswidget-sortable jarviswidget-collapsed" id="wid-vehiculo" 
                                    data-widget-deletebutton="false" data-widget-colorbutton="false" data-widget-editbutton="false"  data-widget-fullscreenbutton="false" data-widget-collapsed="false">
                                        <header  onclick="$('.showvehiculo').toggle()"> <span class="widget-icon"> 
                                            <i class="fa fa-automobile"></i> </span><h2>Vehiculo</h2>
                                        </header>
                                        <div class="showvehiculo" style="display: ;">
                                            <!-- widget edit box -->
                                            <div class="jarviswidget-editbox" style=""></div>
                                            <div class="widget-body">
                                                <div class="col-sm-12">
                                                    <div class="col-sm-3">
                                                        <div class="form-group">
                                                            <select style="width:100%" class="select2" name="id_marca" id="id_marca">
                                                                <option value="">Selecciona Marca</option>
                                                                <?php 
                                                                $obj = new Marca();
                                                                $list=$obj->getAllArr();
                                                                if (is_array($list) || is_object($list)){
                                                                    foreach($list as $val){
                                                                        echo "<option value='".$val['id']."'>".$val['nombre']."</option>";
                                                                    }
                                                                }
                                                                 ?>
                                                            </select>
                                                        </div>
                                                         <div class="form-group" id="contsubmarca">
                                                            <select style="width:100%" class="select2" name="id_submarca" id="id_submarca">
                                                                <option value="">Selecciona Modelo</option>
                                                                <?php 
                                                                $obj = new SubMarca();
                                                                $list=$obj->getAllArr();
                                                                if (is_array($list) || is_object($list)){
                                                                    foreach($list as $val){
                                                                        echo "<option value='".$val['id']."'>".$val['nombre']."</option>";
                                                                    }
                                                                }
                                                                 ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <div class="form-group">
                                                            <select style="width:100%" class="select2" name="modelo" id="modelo">
                                                                <option value="">Selecciona Año</option>
                                                                <?php 
                                                                $objcat=catModelo();
                                                                for ($i=0; $i < count($objcat) ; $i++) { 
                                                                    echo "<option value='".$objcat[$i]."'>".$objcat[$i]."</option>";
                                                                }  
                                                                ?>
                                                            </select>
                                                        </div>
                                                        <div class="form-group">
                                                            <input type="text" class="form-control" placeholder="Color" name="color" >
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <div class="form-group">
                                                            <label class="col-md-2 control-label">Placas</label>
                                                            <div class="col-md-10 col-sm-10 col-lg-10">
                                                                <label class="radio-inline">
                                                                    <input type="radio" class="radiobox" name="placas_h">
                                                                    <span>0</span> 
                                                                </label>
                                                                <label class="radio radio-inline">
                                                                    <input type="radio" class="radiobox" name="placas_h">
                                                                    <span>1</span>  
                                                                </label>
                                                                <label class="radio radio-inline">
                                                                    <input type="radio" class="radiobox" name="placas_h">
                                                                    <span>2</span> 
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <input type="text" class="form-control" placeholder="Kilometraje" name="kilometraje" >
                                                        </div>
                                                    </div> 
                                                    <div class="col-sm-3">
                                                       <div class="form-group">
                                                            <input type="text" class="form-control" placeholder="VIN" name="serie" >
                                                        </div>
                                                        <div class="form-group">
                                                            <input type="text" class="form-control" placeholder="Matricula" name="matricula" >
                                                        </div>
                                                    </div> 
                                                </div>
                                                <div class="col-sm-12" id="">
                                                     <h2 class="lvh-label">Fotos de vehículo <span id="contfotosauto">0</span> Fotografías</h2>
                                                </div>
                                                <div class="col-sm-12" id="fotosAutoTransito">
                                                    <div class="col-sm-2 col-md-2 col-lg-2">
                                                            <button type="button" title='Agregar fotografía de vehículo en tránsito' class="btn btn-primary btn-circle btn-xl" onclick="getFoto('filevehiculo'); return false;">
                                                                <i class="fa fa-camera"></i>
                                                            </button>
                                                            <input type="file" id="filevehiculo"  name="filevehiculo[]" accept="image/*" style="display:none"  multiple>
                                                            <input type="text" id="deletefilevehiculo"  name="deletefilevehiculo" style="display:none">
                                                    </div>
                                                    <div class="col-sm-10 col-md-10 col-lg-10 photos" id="contfilevehiculo">                     
                                                          
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </article> 
                                <h3>Inventario Basico</h3>
                                <article class="col-sm-12 col-md-12 col-lg-12"  id="article-4">
                                    
                                    <div class="jarviswidget  jarviswidget-sortable jarviswidget-collapsed" id="wid-id-2" 
                                    data-widget-deletebutton="false" data-widget-colorbutton="false" data-widget-editbutton="false"  data-widget-fullscreenbutton="false" data-widget-collapsed="false" >
                                        <header onclick="$('.showinterior').toggle()"> <span class="widget-icon"> 
                                            <i class="fa fa-list-alt"></i> </span>
                                            <h2>Interiores</h2>
                                        </header>
                                        <div class="showinterior" style="display: none;">
                                            <!-- widget edit box -->
                                            <div class="jarviswidget-editbox" style="">
                                            </div>
                                            <div class="widget-body">
                                                <div class="col-sm-12 col-md-12">
                                                    <div class="col-sm-3">
                                                        <div class="form-group">
                                                            <label class="col-md-6 col-sm-3 col-lg-6 control-label">Tablero</label>
                                                            <div class="col-md-6 col-sm-3 col-lg-6">
                                                                <label class="radio ">
                                                                    <input type="radio" class="radiobox" value="1" name="tablero"><span>Si</span> 
                                                                </label>
                                                                <label class="radio ">
                                                                    <input type="radio" class="radiobox" value="2"  name="tablero"><span>No</span> 
                                                                </label>
                                                                <label class="radio ">
                                                                    <input type="radio" class="radiobox" value="3" name="tablero"><span>C/Daño</span> 
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <div class="form-group">
                                                            <label class="col-md-6 col-sm-3 col-lg-6 control-label">Función de Indicadores</label>
                                                            <div class="col-md-6 col-sm-3 col-lg-6">
                                                                <label class="radio ">
                                                                    <input type="radio" class="radiobox" value="1" name="funcionIndicadores"><span>Si</span> 
                                                                </label>
                                                                <label class="radio ">
                                                                    <input type="radio" class="radiobox" value="2"  name="funcionIndicadores"><span>No</span> 
                                                                </label>
                                                                <label class="radio ">
                                                                    <input type="radio" class="radiobox" value="3" name="funcionIndicadores"><span>C/Daño</span> 
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <div class="form-group">
                                                            <label class="col-md-6 col-sm-3 col-lg-6 control-label">Tanque de Gasolina</label>
                                                            <div class="col-md-6 col-sm-3 col-lg-6">
                                                                <select id="tanqueGasolina" name="tanqueGasolina" class="form-control" style="padding-left:2px; padding-right: 2px;">
                                                                    <option value="1" selected>R</option>
                                                                    <option value="2">1/4</option>
                                                                    <option value="3">1/2</option>
                                                                    <option value="4">3/4</option>
                                                                    <option value="5">Lleno</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <div class="form-group">
                                                            <label class="col-md-2 col-sm-2 col-lg-3 control-label">KM.</label>
                                                            <div class="col-md-10 col-sm-10 col-lg-10">
                                                                 <input type="text" class="form-control input-xs" placeholder="Kilometraje" name="Kilometraje" style="padding-left:2px; padding-right: 2px;" required>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-12 col-md-12">
                                                    <div class="col-sm-3">
                                                        <div class="form-group">
                                                            <label class="col-md-6 control-label">Func. A/C</label>
                                                            <div class="col-md-6 col-sm-3 col-lg-6">
                                                                <label class="radio ">
                                                                    <input type="radio" class="radiobox" value="1" name="FuncionamientoAC"><span>Si</span> 
                                                                </label>
                                                                <label class="radio ">
                                                                    <input type="radio" class="radiobox" value="2"  name="FuncionamientoAC"><span>No</span> 
                                                                </label>
                                                                <label class="radio ">
                                                                    <input type="radio" class="radiobox" value="3" name="FuncionamientoAC"><span>C/Daño</span> 
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <div class="form-group">
                                                            <label class="col-md-6 control-label">Controles A/C</label>
                                                            <div class="col-md-6 col-sm-3 col-lg-6">
                                                                <label class="radio ">
                                                                    <input type="radio" class="radiobox" value="1" name="ControlesAC"><span>Si</span> 
                                                                </label>
                                                                <label class="radio ">
                                                                    <input type="radio" class="radiobox" value="2"  name="ControlesAC"><span>No</span> 
                                                                </label>
                                                                <label class="radio ">
                                                                    <input type="radio" class="radiobox" value="3" name="ControlesAC"><span>C/Daño</span> 
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <div class="form-group">
                                                            <label class="col-md-6 control-label">Cenicero</label>
                                                            <div class="col-md-6 col-sm-3 col-lg-6">
                                                                <label class="radio ">
                                                                    <input type="radio" class="radiobox" value="1" name="Cenicero"><span>Si</span> 
                                                                </label>
                                                                <label class="radio ">
                                                                    <input type="radio" class="radiobox" value="2"  name="Cenicero"><span>No</span> 
                                                                </label>
                                                                <label class="radio ">
                                                                    <input type="radio" class="radiobox" value="3" name="Cenicero"><span>C/Daño</span> 
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <div class="form-group">
                                                            <label class="col-md-6 control-label">Encendedor</label>
                                                            <div class="col-md-6 col-sm-3 col-lg-6">
                                                                <label class="radio ">
                                                                    <input type="radio" class="radiobox" value="1" name="Encendedor"><span>Si</span> 
                                                                </label>
                                                                <label class="radio ">
                                                                    <input type="radio" class="radiobox" value="2"  name="Encendedor"><span>No</span> 
                                                                </label>
                                                                <label class="radio ">
                                                                    <input type="radio" class="radiobox" value="3" name="Encendedor"><span>C/Daño</span> 
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-12 col-md-12">
                                                    <div class="col-sm-3">
                                                        <div class="form-group">
                                                            <label class="col-md-6 control-label">Guantera</label>
                                                            <div class="col-md-6 col-sm-3 col-lg-6">
                                                                <label class="radio ">
                                                                    <input type="radio" class="radiobox" value="1" name="Guantera"><span>Si</span> 
                                                                </label>
                                                                <label class="radio ">
                                                                    <input type="radio" class="radiobox" value="2"  name="Guantera"><span>No</span> 
                                                                </label>
                                                                <label class="radio ">
                                                                    <input type="radio" class="radiobox" value="3" name="Guantera"><span>C/Daño</span> 
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <div class="form-group">
                                                            <label class="col-md-6 control-label">Retrovisor</label>
                                                            <div class="col-md-6 col-sm-3 col-lg-6">
                                                                <label class="radio ">
                                                                    <input type="radio" class="radiobox" value="1" name="Retrovisor"><span>Si</span> 
                                                                </label>
                                                                <label class="radio ">
                                                                    <input type="radio" class="radiobox" value="2"  name="Retrovisor"><span>No</span> 
                                                                </label>
                                                                <label class="radio ">
                                                                    <input type="radio" class="radiobox" value="3" name="Retrovisor"><span>C/Daño</span> 
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <div class="form-group">
                                                            <label class="col-md-6 control-label">Luz Interior</label>
                                                            <div class="col-md-6 col-sm-3 col-lg-6">
                                                                <label class="radio ">
                                                                    <input type="radio" class="radiobox" value="1" name="LuzInterior"><span>Si</span> 
                                                                </label>
                                                                <label class="radio ">
                                                                    <input type="radio" class="radiobox" value="2"  name="LuzInterior"><span>No</span> 
                                                                </label>
                                                                <label class="radio ">
                                                                    <input type="radio" class="radiobox" value="3" name="LuzInterior"><span>C/Daño</span> 
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <div class="form-group">
                                                            <label class="col-md-6 control-label">Viseras</label>
                                                            <div class="col-md-6 col-sm-3 col-lg-6">
                                                                <label class="radio ">
                                                                    <input type="radio" class="radiobox" value="1" name="Viseras"><span>Si</span> 
                                                                </label>
                                                                <label class="radio ">
                                                                    <input type="radio" class="radiobox" value="2"  name="Viseras"><span>No</span> 
                                                                </label>
                                                                <label class="radio ">
                                                                    <input type="radio" class="radiobox" value="3" name="Viseras"><span>C/Daño</span> 
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-12 col-md-12">
                                                    <div class="col-sm-3">
                                                        <div class="form-group">
                                                            <label class="col-md-6 control-label">Claxon</label>
                                                            <div class="col-md-6 col-sm-3 col-lg-6">
                                                                <label class="radio ">
                                                                    <input type="radio" class="radiobox" value="1" name="Claxon"><span>Si</span> 
                                                                </label>
                                                                <label class="radio ">
                                                                    <input type="radio" class="radiobox" value="2"  name="Claxon"><span>No</span> 
                                                                </label>
                                                                <label class="radio ">
                                                                    <input type="radio" class="radiobox" value="3" name="Claxon"><span>C/Daño</span> 
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </article> 
                                <h3>Inventario Avanzado</h3>
                                <article class="col-sm-12 col-md-12 col-lg-12"  id="incidente">
                                    <div class="jarviswidget  jarviswidget-sortable jarviswidget-collapsed" id="wid-id-2" 
                                    data-widget-deletebutton="false" data-widget-colorbutton="false" data-widget-editbutton="false"  data-widget-fullscreenbutton="false" data-widget-collapsed="false">
                                        <header  onclick="$('.showincidente').toggle()"> <span class="widget-icon"> 
                                            <i class="fa fa-frown-o"></i> </span><h2>Incidente</h2>
                                        </header>
                                        <div  class="showincidente" style="display: none;">
                                            <!-- widget edit box -->
                                            <div class="jarviswidget-editbox" style="">
                                            </div>
                                                <div class="widget-body">
                                                    <div class="col-sm-4">
                                                        <div class="form-group">
                                                            <label for="name">No. de Expediente</label>
                                                            <input type="text" required class="form-control" placeholder="Capture No. Expediente" name="NoExpediente" >
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="name">Siniestro</label>
                                                            <input type="text" required class="form-control" placeholder="Capture No. de Siniestro" name="Siniestro">
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <div class="form-group">
                                                            <label for="name">No. de Póliza</label>
                                                            <input type="text" class="form-control" placeholder="Capture No. de Póliza" name="noPoliza" required> 
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="name">Aseguradora</label>
                                                            <select id="idAseguradora" name="idAseguradora" class="form-control" style="padding-left:2px; padding-right: 2px;">
                                                                    <option value="0">Seleccionar...</option>
                                                                    <option value="0">Ninguna</option>
                                                            </select>
                                                        </div>
                                                    </div> 
                                                    <div class="col-sm-4">
                                                        <div class="form-group">
                                                            <label for="name">No. de Reporte</label>
                                                            <input type="text" class="form-control" placeholder="Capture No. de Reporte" name="Reporte" required> 
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="name">Deducible</label>
                                                            <input type="text" class="form-control" placeholder="Monto deducible" name="deducible" onkeypress="return justNumbers(event);"  required>
                                                        </div>   
                                                    </div> 
                                                </div>
                                        </div>
                                    </div>
                                    
                                    <div class="jarviswidget  jarviswidget-sortable jarviswidget-collapsed" id="wid-id-2" 
                                    data-widget-deletebutton="false" data-widget-colorbutton="false" data-widget-editbutton="false"  data-widget-fullscreenbutton="false" data-widget-collapsed="false" >
                                        <header onclick="$('.showeqaudio').toggle()"> <span class="widget-icon"> 
                                            <i class="fa fa-music"></i> </span><h2>Equipo de audio</h2>
                                        </header>
                                        <div class="showeqaudio" style="display: none;">
                                             <div class="jarviswidget-editbox" style="">
                                            </div>
                                            <div class="widget-body">
                                                <div class="col-sm-12 col-md-12">
                                                    <div class="col-sm-3">
                                                        <div class="form-group">
                                                            <label class="col-md-6 col-sm-3 col-lg-6 control-label">Equipo original</label>
                                                            <div class="col-md-6 col-sm-3 col-lg-6">
                                                                <label class="radio ">
                                                                    <input type="radio" class="radiobox" value="1" name="EquipoAudioOriginal"><span>Si</span> 
                                                                </label>
                                                                <label class="radio ">
                                                                    <input type="radio" class="radiobox" value="2"  name="EquipoAudioOriginal"><span>No</span> 
                                                                </label>
                                                                <label class="radio ">
                                                                    <input type="radio" class="radiobox" value="3" name="EquipoAudioOriginal"><span>C/Daño</span> 
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <div class="form-group">
                                                            <label class="col-md-6 col-sm-3 col-lg-6 control-label">Equipo adaptado</label>
                                                            <div class="col-md-6 col-sm-3 col-lg-6">
                                                                <label class="radio ">
                                                                    <input type="radio" class="radiobox" value="1" name="EquipoAudioAdaptado"><span>Si</span> 
                                                                </label>
                                                                <label class="radio ">
                                                                    <input type="radio" class="radiobox" value="2"  name="EquipoAudioAdaptado"><span>No</span> 
                                                                </label>
                                                                <label class="radio ">
                                                                    <input type="radio" class="radiobox" value="3" name="EquipoAudioAdaptado"><span>C/Daño</span> 
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <div class="form-group">
                                                            <label class="col-md-2 col-sm-2 col-lg-3 control-label">Marca</label>
                                                            <div class="col-md-10 col-sm-10 col-lg-10">
                                                                 <input type="text" class="form-control input-xs" placeholder="Marca Eq. Audio" name="MarcaEquipoAudio" style="padding-left:2px; padding-right: 2px;" required>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <div class="form-group">
                                                            <label class="col-md-6 control-label">Ecualizador</label>
                                                            <div class="col-md-6 col-sm-3 col-lg-6">
                                                                <label class="radio ">
                                                                    <input type="radio" class="radiobox" value="1" name="Ecualizador"><span>Si</span> 
                                                                </label>
                                                                <label class="radio ">
                                                                    <input type="radio" class="radiobox" value="2"  name="Ecualizador"><span>No</span> 
                                                                </label>
                                                                <label class="radio ">
                                                                    <input type="radio" class="radiobox" value="3" name="Ecualizador"><span>C/Daño</span> 
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-12 col-md-12">
                                                    <div class="col-sm-3">
                                                        <div class="form-group">
                                                            <label class="col-md-6 control-label">Amplificador</label>
                                                            <div class="col-md-6 col-sm-3 col-lg-6">
                                                                <label class="radio ">
                                                                    <input type="radio" class="radiobox" value="1" name="Amplificador"><span>Si</span> 
                                                                </label>
                                                                <label class="radio ">
                                                                    <input type="radio" class="radiobox" value="2"  name="Amplificador"><span>No</span> 
                                                                </label>
                                                                <label class="radio ">
                                                                    <input type="radio" class="radiobox" value="3" name="Amplificador"><span>C/Daño</span> 
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <div class="form-group">
                                                            <label class="col-md-6 control-label">Caja de CD's</label>
                                                            <div class="col-md-6 col-sm-3 col-lg-6">
                                                                <label class="radio ">
                                                                    <input type="radio" class="radiobox" value="1" name="CajadeCDs"><span>Si</span> 
                                                                </label>
                                                                <label class="radio ">
                                                                    <input type="radio" class="radiobox" value="2"  name="CajadeCDs"><span>No</span> 
                                                                </label>
                                                                <label class="radio ">
                                                                    <input type="radio" class="radiobox" value="3" name="CajadeCDs"><span>C/Daño</span> 
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <div class="form-group">
                                                            <label class="col-md-6 control-label">Bocinas</label>
                                                            <div class="col-md-6 col-sm-3 col-lg-6">
                                                                <label class="radio ">
                                                                    <input type="radio" class="radiobox" value="1" name="Bocinas"><span>Si</span> 
                                                                </label>
                                                                <label class="radio ">
                                                                    <input type="radio" class="radiobox" value="2"  name="Bocinas"><span>No</span> 
                                                                </label>
                                                                <label class="radio ">
                                                                    <input type="radio" class="radiobox" value="3" name="Bocinas"><span>C/Daño</span> 
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="jarviswidget  jarviswidget-sortable jarviswidget-collapsed" id="wid-id-2" 
                                    data-widget-deletebutton="false" data-widget-colorbutton="false" data-widget-editbutton="false"  data-widget-fullscreenbutton="false" data-widget-collapsed="false" >
                                        <header onclick="$('.showalarma').toggle()"> <span class="widget-icon"> 
                                            <i class="fa fa-bell"></i> </span><h2>Alarma</h2>
                                        </header>
                                        <div  class="showalarma" style="display: none;">
                                            <table style="margin: 0px auto; width:100%">
                                                <tr>
                                                   <td style="padding:5px; margin:2px; background-color: #eee;">De fabrica</td>
                                                   <td style="padding:5px; margin:2px; background-color: #eee;">
                                                       <select id="AlarmadeFabrica" name="AlarmadeFabrica" class="form-control" style="padding-left:2px; padding-right: 2px;">
                                                            <option value="1" selected>Si</option>
                                                            <option value="2">No</option>
                                                            <option value="3">Si con daño</option>
                                                       </select>
                                                   </td>
                                                   <td style="padding:5px; margin:2px; background-color: #eee;">Instalada</td>
                                                   <td style="padding:5px; margin:2px; background-color: #eee;">
                                                       <select id="AlarmaInstalada" name="AlarmaInstalada" class="form-control" style="padding-left:2px; padding-right: 2px;">
                                                            <option value="1" selected>Si</option>
                                                            <option value="2">No</option>
                                                            <option value="3">Si con daño</option>
                                                        </select>
                                                   </td>
                                                   <td style="padding:5px; margin:2px; background-color: #eee;">Tapetes</td>
                                                   <td style="padding:5px; margin:2px; background-color: #eee;">
                                                       <select id="Tapetes" name="Tapetes" class="form-control" style="padding-left:2px; padding-right: 2px;">
                                                            <option value="1" selected>Si</option>
                                                            <option value="2">No</option>
                                                            <option value="3">Si con daño</option>
                                                    </select>
                                                   </td>
                                                   <td style="padding:5px; margin:2px; background-color: #eee;">Tapiceria</td>
                                                   <td style="padding:5px; margin:2px; background-color: #eee;">
                                                       <select id="Tapiceria" name="Tapiceria" class="form-control" style="padding-left:2px; padding-right: 2px;">
                                                            <option value="1" selected>Si</option>
                                                            <option value="2">No</option>
                                                            <option value="3">Si con daño</option>
                                                       </select>
                                                   </td>
                                                   <td style="padding:5px; margin:2px; background-color: #eee;">Intermitentes</td>
                                                   <td style="padding:5px; margin:2px; background-color: #eee;">
                                                       <select id="Intermitentes" name="Intermitentes" class="form-control" style="padding-left:2px; padding-right: 2px;">
                                                            <option value="1" selected>Si</option>
                                                            <option value="2">No</option>
                                                            <option value="3">Si con daño</option>
                                                       </select>
                                                   </td>
                                               </tr>
                                               <tr>
                                                   <td style="padding:5px; margin:2px; background-color: #eee;">Luces exteriores</td>
                                                   <td style="padding:5px; margin:2px; background-color: #eee;">
                                                       <select id="LucesExteriores" name="LucesExteriores" class="form-control" style="padding-left:2px; padding-right: 2px;">
                                                            <option value="1" selected>Si</option>
                                                            <option value="2">No</option>
                                                            <option value="3">Si con daño</option>
                                                       </select>
                                                   </td>
                                                   <td style="padding:5px; margin:2px; background-color: #eee;">&nbsp;</td>
                                                   <td style="padding:5px; margin:2px; background-color: #eee;">
                                                       &nbsp;
                                                   </td>
                                                   <td style="padding:5px; margin:2px; background-color: #eee;">&nbsp;</td>
                                                   <td style="padding:5px; margin:2px; background-color: #eee;">
                                                       &nbsp;
                                                   </td>
                                                   <td style="padding:5px; margin:2px; background-color: #eee;">&nbsp;</td>
                                                   <td style="padding:5px; margin:2px; background-color: #eee;">
                                                       &nbsp;
                                                   </td>
                                                   <td style="padding:5px; margin:2px; background-color: #eee;">&nbsp;</td>
                                                   <td style="padding:5px; margin:2px; background-color: #eee;">
                                                       &nbsp;
                                                   </td>
                                               </tr>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="jarviswidget  jarviswidget-sortable jarviswidget-collapsed" id="wid-id-2" 
                                    data-widget-deletebutton="false" data-widget-colorbutton="false" data-widget-editbutton="false"  data-widget-fullscreenbutton="false" data-widget-collapsed="false" ">
                                        <header onclick="$('.showmotor').toggle()"> <span class="widget-icon"> 
                                            <i class="fa fa-wrench"></i> </span><h2>Motor</h2>
                                        </header>
                                        <div class="showmotor"  style="display: none;">        
                                
                                            <table  style="margin: 0px auto; width:100%">
                                                <tr>
                                                   <td style="padding:5px; margin:2px; background-color: #eee;">Bateria</td>
                                                   <td style="padding:5px; margin:2px; background-color: #eee;">
                                                       <select id="Bateria" name="Bateria" class="form-control" style="padding-left:2px; padding-right: 2px;">
                                                            <option value="1" selected>Si</option>
                                                            <option value="2">No</option>
                                                            <option value="3">Si con daño</option>
                                                       </select>
                                                   </td>
                                                   <td style="padding:5px; margin:2px; background-color: #eee;">Tapón Radiador</td>
                                                   <td style="padding:5px; margin:2px; background-color: #eee;">
                                                       <select id="TaponRadiador" name="TaponRadiador" class="form-control" style="padding-left:2px; padding-right: 2px;">
                                                            <option value="1" selected>Si</option>
                                                            <option value="2">No</option>
                                                            <option value="3">Si con daño</option>
                                                        </select>
                                                   </td>
                                                   <td style="padding:5px; margin:2px; background-color: #eee;">Radiador</td>
                                                   <td style="padding:5px; margin:2px; background-color: #eee;">
                                                       <select id="Radiador" name="Radiador" class="form-control" style="padding-left:2px; padding-right: 2px;">
                                                            <option value="1" selected>Si</option>
                                                            <option value="2">No</option>
                                                            <option value="3">Si con daño</option>
                                                    </select>
                                                   </td>
                                                   <td style="padding:5px; margin:2px; background-color: #eee;">Tapon aceite</td>
                                                   <td style="padding:5px; margin:2px; background-color: #eee;">
                                                       <select id="TaponAceite" name="TaponAceite" class="form-control" style="padding-left:2px; padding-right: 2px;">
                                                            <option value="1" selected>Si</option>
                                                            <option value="2">No</option>
                                                            <option value="3">Si con daño</option>
                                                        </select>
                                                   </td>
                                                   <td style="padding:5px; margin:2px; background-color: #eee;">Bandas</td>
                                                   <td style="padding:5px; margin:2px; background-color: #eee;">
                                                       <select id="Bandas" name="Bandas" class="form-control" style="padding-left:2px; padding-right: 2px;">
                                                            <option value="1" selected>Si</option>
                                                            <option value="2">No</option>
                                                            <option value="3">Si con daño</option>
                                                       </select>
                                                   </td>
                                               </tr>
                                               <tr>
                                                   <td style="padding:5px; margin:2px; background-color: #eee;">Bayoneta motor</td>
                                                   <td style="padding:5px; margin:2px; background-color: #eee;">
                                                       <select id="BayonetaMotor" name="BayonetaMotor" class="form-control" style="padding-left:2px; padding-right: 2px;">
                                                            <option value="1" selected>Si</option>
                                                            <option value="2">No</option>
                                                            <option value="3">Si con daño</option>
                                                       </select>
                                                   </td>
                                                   <td style="padding:5px; margin:2px; background-color: #eee;">Bayoneta transmision</td>
                                                   <td style="padding:5px; margin:2px; background-color: #eee;">
                                                       <select id="BayonetaTransmision" name="BayonetaTransmision" class="form-control" style="padding-left:2px; padding-right: 2px;">
                                                            <option value="1" selected>Si</option>
                                                            <option value="2">No</option>
                                                            <option value="3">Si con daño</option>
                                                        </select>
                                                   </td>
                                                   <td style="padding:5px; margin:2px; background-color: #eee;">Purificador</td>
                                                   <td style="padding:5px; margin:2px; background-color: #eee;">
                                                       <select id="Purificador" name="Purificador" class="form-control" style="padding-left:2px; padding-right: 2px;">
                                                            <option value="1" selected>Si</option>
                                                            <option value="2">No</option>
                                                            <option value="3">Si con daño</option>
                                                    </select>
                                                   </td>
                                                   <td style="padding:5px; margin:2px; background-color: #eee;">Cables bujías</td>
                                                   <td style="padding:5px; margin:2px; background-color: #eee;">
                                                       <select id="CablesBujias" name="CablesBujias" class="form-control" style="padding-left:2px; padding-right: 2px;">
                                                            <option value="1" selected>Si</option>
                                                            <option value="2">No</option>
                                                            <option value="3">Si con daño</option>
                                                    </select>
                                                   </td>
                                                   <td style="padding:5px; margin:2px; background-color: #eee;">Depósito agua</td>
                                                   <td style="padding:5px; margin:2px; background-color: #eee;">
                                                       <select id="DepositoAgua" name="DepositoAgua" class="form-control" style="padding-left:2px; padding-right: 2px;">
                                                            <option value="1" selected>Si</option>
                                                            <option value="2">No</option>
                                                            <option value="3">Si con daño</option>
                                                    </select>
                                                   </td>
                                               </tr>
                                            </table>
                                        </div>
                                    </div> 
                                    <div class="jarviswidget  jarviswidget-sortable jarviswidget-collapsed" id="wid-id-2" 
                                    data-widget-deletebutton="false" data-widget-colorbutton="false" data-widget-editbutton="false"  data-widget-fullscreenbutton="false" data-widget-collapsed="false">
                                        <header  onclick="$('.showfrontal').toggle()"> <span class="widget-icon"> 
                                            <i class="fa fa-long-arrow-up"></i> </span><h2>Frontal</h2>
                                        </header>
                                        <div class="showfrontal" style="display: none;">
                                            <table  style="margin: 0px auto; width:100%">
                                                <tr>
                                                   <td style="padding:5px; margin:2px; background-color: #eee;">Facia</td>
                                                   <td style="padding:5px; margin:2px; background-color: #eee;">
                                                       <select id="FaciaFrontal" name="FaciaFrontal" class="form-control" style="padding-left:2px; padding-right: 2px;">
                                                            <option value="1" selected>Si</option>
                                                            <option value="2">No</option>
                                                            <option value="3">Si con daño</option>
                                                       </select>
                                                   </td>
                                                   <td style="padding:5px; margin:2px; background-color: #eee;">Placa</td>
                                                   <td style="padding:5px; margin:2px; background-color: #eee;">
                                                       <select id="Placa" name="Placa" class="form-control" style="padding-left:2px; padding-right: 2px;">
                                                            <option value="1" selected>Si</option>
                                                            <option value="2">No</option>
                                                            <option value="3">Si con daño</option>
                                                        </select>
                                                   </td>
                                                   <td style="padding:5px; margin:2px; background-color: #eee;">Parrilla</td>
                                                   <td style="padding:5px; margin:2px; background-color: #eee;">
                                                       <select id="Parrilla" name="Parrilla" class="form-control" style="padding-left:2px; padding-right: 2px;">
                                                            <option value="1" selected>Si</option>
                                                            <option value="2">No</option>
                                                            <option value="3">Si con daño</option>
                                                    </select>
                                                   </td>
                                                   <td style="padding:5px; margin:2px; background-color: #eee;">Faros</td>
                                                   <td style="padding:5px; margin:2px; background-color: #eee;">
                                                       <select id="Faros" name="Faros" class="form-control" style="padding-left:2px; padding-right: 2px;">
                                                            <option value="1" selected>Si</option>
                                                            <option value="2">No</option>
                                                            <option value="3">Si con daño</option>
                                                        </select>
                                                   </td>
                                                   <td style="padding:5px; margin:2px; background-color: #eee;">Faros de Niebla</td>
                                                   <td style="padding:5px; margin:2px; background-color: #eee;">
                                                       <select id="FarosNiebla" name="FarosNiebla" class="form-control" style="padding-left:2px; padding-right: 2px;">
                                                            <option value="1" selected>Si</option>
                                                            <option value="2">No</option>
                                                            <option value="3">Si con daño</option>
                                                    </select>
                                                   </td>
                                               </tr>
                                               <tr>
                                                   <td style="padding:5px; margin:2px; background-color: #eee;">Viceles</td>
                                                   <td style="padding:5px; margin:2px; background-color: #eee;">
                                                       <select id="Viceles" name="Viceles" class="form-control" style="padding-left:2px; padding-right: 2px;">
                                                            <option value="1" selected>Si</option>
                                                            <option value="2">No</option>
                                                            <option value="3">Si con daño</option>
                                                    </select>
                                                   </td>
                                                   <td style="padding:5px; margin:2px; background-color: #eee;">Cuartos delanteros</td>
                                                   <td style="padding:5px; margin:2px; background-color: #eee;">
                                                       <select id="CuartosFrontal" name="CuartosFrontal" class="form-control" style="padding-left:2px; padding-right: 2px;">
                                                            <option value="1" selected>Si</option>
                                                            <option value="2">No</option>
                                                            <option value="3">Si con daño</option>
                                                       </select>
                                                   </td>
                                                   <td style="padding:5px; margin:2px; background-color: #eee;">Emblema cofre</td>
                                                   <td style="padding:5px; margin:2px; background-color: #eee;">
                                                       <select id="EmblemaCofre" name="EmblemaCofre" class="form-control" style="padding-left:2px; padding-right: 2px;">
                                                            <option value="1" selected>Si</option>
                                                            <option value="2">No</option>
                                                            <option value="3">Si con daño</option>
                                                        </select>
                                                   </td>
                                                   <td style="padding:5px; margin:2px; background-color: #eee;">Emblema parrilla</td>
                                                   <td style="padding:5px; margin:2px; background-color: #eee;">
                                                       <select id="EmblemaParrilla" name="EmblemaParrilla" class="form-control" style="padding-left:2px; padding-right: 2px;">
                                                            <option value="1" selected>Si</option>
                                                            <option value="2">No</option>
                                                            <option value="3">Si con daño</option>
                                                    </select>
                                                   </td>
                                                   <td style="padding:5px; margin:2px; background-color: #eee;">Parabrisas</td>
                                                   <td style="padding:5px; margin:2px; background-color: #eee;">
                                                       <select id="ParabrisasFrontal" name="ParabrisasFrontal" class="form-control" style="padding-left:2px; padding-right: 2px;">
                                                            <option value="1" selected>Si</option>
                                                            <option value="2">No</option>
                                                            <option value="3">Si con daño</option>
                                                    </select>
                                                   </td>
                                               </tr>
                                               <tr>
                                                   <td style="padding:5px; margin:2px; background-color: #eee;">Brazos limpia parabrisas</td>
                                                   <td style="padding:5px; margin:2px; background-color: #eee;">
                                                       <select id="BrazosLimpiaParabrisas" name="BrazosLimpiaParabrisas" class="form-control" style="padding-left:2px; padding-right: 2px;">
                                                            <option value="1" selected>Si</option>
                                                            <option value="2">No</option>
                                                            <option value="3">Si con daño</option>
                                                    </select>
                                                   </td>
                                                   <td style="padding:5px; margin:2px; background-color: #eee;">Plumas limpia parabrisas</td>
                                                   <td style="padding:5px; margin:2px; background-color: #eee;">
                                                       <select id="PlumasLimpiaParabrisas" name="PlumasLimpiaParabrisas" class="form-control" style="padding-left:2px; padding-right: 2px;">
                                                            <option value="1" selected>Si</option>
                                                            <option value="2">No</option>
                                                            <option value="3">Si con daño</option>
                                                       </select>
                                                   </td>
                                                   <td style="padding:5px; margin:2px; background-color: #eee;">Cofre</td>
                                                   <td style="padding:5px; margin:2px; background-color: #eee;">
                                                       <select id="Cofre" name="Cofre" class="form-control" style="padding-left:2px; padding-right: 2px;">
                                                            <option value="1" selected>Si</option>
                                                            <option value="2">No</option>
                                                            <option value="3">Si con daño</option>
                                                        </select>
                                                   </td>
                                                   <td style="padding:5px; margin:2px; background-color: #eee;">&nbsp;</td>
                                                   <td style="padding:5px; margin:2px; background-color: #eee;">
                                                       &nbsp;
                                                   </td>
                                                   <td style="padding:5px; margin:2px; background-color: #eee;">&nbsp;</td>
                                                   <td style="padding:5px; margin:2px; background-color: #eee;">
                                                       &nbsp;
                                                   </td>
                                               </tr>
                                            </table>
                                        </div>
                                    </div>
                                    
                                    <div class="jarviswidget  jarviswidget-sortable jarviswidget-collapsed" id="wid-id-2" 
                                    data-widget-deletebutton="false" data-widget-colorbutton="false" data-widget-editbutton="false"  data-widget-fullscreenbutton="false" data-widget-collapsed="false" >
                                        <header onclick="$('.showtrasero').toggle()"> <span class="widget-icon"> 
                                            <i class="fa fa-long-arrow-down"></i> </span><h2>Trasero</h2>
                                        </header>
                                        <div  class="fa-long-arrow-down" style="display: none;">
                                            <table  style="margin: 0px auto; width:100%">
                                                <tr>
                                                   <td style="padding:5px; margin:2px; background-color: #eee;">Medallon</td>
                                                   <td style="padding:5px; margin:2px; background-color: #eee;">
                                                       <select id="Medallon" name="Medallon" class="form-control" style="padding-left:2px; padding-right: 2px;">
                                                            <option value="1" selected>Si</option>
                                                            <option value="2">No</option>
                                                            <option value="3">Si con daño</option>
                                                       </select>
                                                   </td>
                                                   <td style="padding:5px; margin:2px; background-color: #eee;">Calaveras</td>
                                                   <td style="padding:5px; margin:2px; background-color: #eee;">
                                                       <select id="Calaveras" name="Calaveras" class="form-control" style="padding-left:2px; padding-right: 2px;">
                                                            <option value="1" selected>Si</option>
                                                            <option value="2">No</option>
                                                            <option value="3">Si con daño</option>
                                                        </select>
                                                   </td>
                                                   <td style="padding:5px; margin:2px; background-color: #eee;">Molduras</td>
                                                   <td style="padding:5px; margin:2px; background-color: #eee;">
                                                       <select id="Molduras" name="Molduras" class="form-control" style="padding-left:2px; padding-right: 2px;">
                                                            <option value="1">Si</option>
                                                            <option value="2">No</option>
                                                            <option value="3">Si con daño</option>
                                                    </select>
                                                   </td>
                                                   <td style="padding:5px; margin:2px; background-color: #eee;">Brazo limpiador</td>
                                                   <td style="padding:5px; margin:2px; background-color: #eee;">
                                                       <select id="BrazoLimpiador" name="BrazoLimpiador" class="form-control" style="padding-left:2px; padding-right: 2px;">
                                                            <option value="1" selected>Si</option>
                                                            <option value="2">No</option>
                                                            <option value="3">Si con daño</option>
                                                        </select>
                                                   </td>
                                                   <td style="padding:5px; margin:2px; background-color: #eee;">Pluma limpiadora</td>
                                                   <td style="padding:5px; margin:2px; background-color: #eee;">
                                                       <select id="PlumaLimpiadora" name="PlumaLimpiadora" class="form-control" style="padding-left:2px; padding-right: 2px;">
                                                            <option value="1" selected>Si</option>
                                                            <option value="2">No</option>
                                                            <option value="3">Si con daño</option>
                                                    </select>
                                                   </td>
                                               </tr>
                                               <tr>
                                                   <td style="padding:5px; margin:2px; background-color: #eee;">Emblemas</td>
                                                   <td style="padding:5px; margin:2px; background-color: #eee;">
                                                       <select id="Emblemas" name="Emblemas" class="form-control" style="padding-left:2px; padding-right: 2px;">
                                                            <option value="1" selected>Si</option>
                                                            <option value="2">No</option>
                                                            <option value="3">Si con daño</option>
                                                       </select>
                                                   </td>
                                                   <td style="padding:5px; margin:2px; background-color: #eee;">Spoiler</td>
                                                   <td style="padding:5px; margin:2px; background-color: #eee;">
                                                       <select id="Spoiler" name="Spoiler" class="form-control" style="padding-left:2px; padding-right: 2px;">
                                                            <option value="1" selected>Si</option>
                                                            <option value="2">No</option>
                                                            <option value="3">Si con daño</option>
                                                        </select>
                                                   </td>
                                                   <td style="padding:5px; margin:2px; background-color: #eee;">Placa</td>
                                                   <td style="padding:5px; margin:2px; background-color: #eee;">
                                                       <select id="PlacaTrasera" name="PlacaTrasera" class="form-control" style="padding-left:2px; padding-right: 2px;">
                                                            <option value="1" selected>Si</option>
                                                            <option value="2">No</option>
                                                            <option value="3">Si con daño</option>
                                                    </select>
                                                   </td>
                                                   <td style="padding:5px; margin:2px; background-color: #eee;">Escape</td>
                                                   <td style="padding:5px; margin:2px; background-color: #eee;">
                                                       <select id="Escape" name="Escape" class="form-control" style="padding-left:2px; padding-right: 2px;">
                                                            <option value="1" selected>Si</option>
                                                            <option value="2">No</option>
                                                            <option value="3">Si con daño</option>
                                                       </select>
                                                   </td>
                                                   <td style="padding:5px; margin:2px; background-color: #eee;">Facia</td>
                                                   <td style="padding:5px; margin:2px; background-color: #eee;">
                                                       <select id="FaciaTrasera" name="FaciaTrasera" class="form-control" style="padding-left:2px; padding-right: 2px;">
                                                            <option value="1" selected>Si</option>
                                                            <option value="2">No</option>
                                                            <option value="3">Si con daño</option>
                                                       </select>
                                                   </td>
                                               </tr>
                                            </table>
                                        </div>
                                    </div>
                                        
                                    <div class="jarviswidget  jarviswidget-sortable jarviswidget-collapsed" id="wid-id-2" 
                                    data-widget-deletebutton="false" data-widget-colorbutton="false" data-widget-editbutton="false"  data-widget-fullscreenbutton="false" data-widget-collapsed="false">
                                        <header onclick="$('.showlatizq').toggle()"> <span class="widget-icon"> 
                                            <i class="fa fa-long-arrow-left"></i> </span><h2>Lateral Izquierdo</h2>
                                        </header>
                                        <div  class="showlatizq" style="display: none;">
                                            <table  style="margin: 0px auto; width:100%">
                                                <tr>
                                                   <td style="padding:5px; margin:2px; background-color: #eee;">Cuartos</td>
                                                   <td style="padding:5px; margin:2px; background-color: #eee;">
                                                       <select id="CuartosLatIzq" name="CuartosLatIzq" class="form-control" style="padding-left:2px; padding-right: 2px;">
                                                            <option value="1" selected>Si</option>
                                                            <option value="2">No</option>
                                                            <option value="3">Si con daño</option>
                                                       </select>
                                                   </td>
                                                   <td style="padding:5px; margin:2px; background-color: #eee;">Emblemas</td>
                                                   <td style="padding:5px; margin:2px; background-color: #eee;">
                                                       <select id="EmblemasLatIzq" name="EmblemasLatIzq" class="form-control" style="padding-left:2px; padding-right: 2px;">
                                                            <option value="1" selected>Si</option>
                                                            <option value="2">No</option>
                                                            <option value="3">Si con daño</option>
                                                        </select>
                                                   </td>
                                                   <td style="padding:5px; margin:2px; background-color: #eee;">Espejo lateral</td>
                                                   <td style="padding:5px; margin:2px; background-color: #eee;">
                                                       <select id="EspejoLatIzq" name="EspejoLatIzq" class="form-control" style="padding-left:2px; padding-right: 2px;">
                                                            <option value="1" selected>Si</option>
                                                            <option value="2">No</option>
                                                            <option value="3">Si con daño</option>
                                                    </select>
                                                   </td>
                                                   <td style="padding:5px; margin:2px; background-color: #eee;">Cristales</td>
                                                   <td style="padding:5px; margin:2px; background-color: #eee;">
                                                       <select id="CristalesLatIzq" name="CristalesLatIzq" class="form-control" style="padding-left:2px; padding-right: 2px;">
                                                            <option value="1" selected>Si</option>
                                                            <option value="2">No</option>
                                                            <option value="3">Si con daño</option>
                                                        </select>
                                                   </td>
                                                   <td style="padding:5px; margin:2px; background-color: #eee;">Manijas</td>
                                                   <td style="padding:5px; margin:2px; background-color: #eee;">
                                                       <select id="ManijasLatIzq" name="ManijasLatIzq" class="form-control" style="padding-left:2px; padding-right: 2px;">
                                                            <option value="1" selected>Si</option>
                                                            <option value="2">No</option>
                                                            <option value="3">Si con daño</option>
                                                    </select>
                                                   </td>
                                               </tr>
                                               <tr>
                                                   <td style="padding:5px; margin:2px; background-color: #eee;">Molduras</td>
                                                   <td style="padding:5px; margin:2px; background-color: #eee;">
                                                       <select id="MoldurasLatIzq" name="MoldurasLatIzq" class="form-control" style="padding-left:2px; padding-right: 2px;">
                                                            <option value="1" selected>Si</option>
                                                            <option value="2">No</option>
                                                            <option value="3">Si con daño</option>
                                                       </select>
                                                   </td>
                                                   <td style="padding:5px; margin:2px; background-color: #eee;">&nbsp;</td>
                                                   <td style="padding:5px; margin:2px; background-color: #eee;">
                                                       &nbsp;
                                                   </td>
                                                   <td style="padding:5px; margin:2px; background-color: #eee;">&nbsp;</td>
                                                   <td style="padding:5px; margin:2px; background-color: #eee;">
                                                       &nbsp;
                                                   </td>
                                                   <td style="padding:5px; margin:2px; background-color: #eee;">&nbsp;</td>
                                                   <td style="padding:5px; margin:2px; background-color: #eee;">
                                                       &nbsp;
                                                   </td>
                                                   <td style="padding:5px; margin:2px; background-color: #eee;">&nbsp;</td>
                                                   <td style="padding:5px; margin:2px; background-color: #eee;">
                                                       &nbsp;
                                                   </td>
                                               </tr>
                                            </table>
                                        </div>
                                    </div>
                                       
                                    <div class="jarviswidget  jarviswidget-sortable jarviswidget-collapsed" id="wid-id-2" 
                                    data-widget-deletebutton="false" data-widget-colorbutton="false" data-widget-editbutton="false"  data-widget-fullscreenbutton="false" data-widget-collapsed="false" >
                                        <header onclick="$('.showlatder').toggle()"> <span class="widget-icon"> 
                                            <i class="fa fa-long-arrow-right"></i> </span><h2>Lateral derecho</h2>
                                        </header>
                                        <div  class="showlatder" style="display: none;">
                                            <table  style="margin: 0px auto; width:100%">
                                                <tr>
                                                   <td style="padding:5px; margin:2px; background-color: #eee;">Cuartos</td>
                                                   <td style="padding:5px; margin:2px; background-color: #eee;">
                                                       <select id="CuartosLatDer" name="CuartosLatDer" class="form-control" style="padding-left:2px; padding-right: 2px;">
                                                            <option value="1" selected>Si</option>
                                                            <option value="2">No</option>
                                                            <option value="3">Si con daño</option>
                                                       </select>
                                                   </td>
                                                   <td style="padding:5px; margin:2px; background-color: #eee;">Emblemas</td>
                                                   <td style="padding:5px; margin:2px; background-color: #eee;">
                                                       <select id="EmblemasLatDer" name="EmblemasLatDer" class="form-control" style="padding-left:2px; padding-right: 2px;">
                                                            <option value="1" selected>Si</option>
                                                            <option value="2">No</option>
                                                            <option value="3">Si con daño</option>
                                                        </select>
                                                   </td>
                                                   <td style="padding:5px; margin:2px; background-color: #eee;">Espejo lateral</td>
                                                   <td style="padding:5px; margin:2px; background-color: #eee;">
                                                       <select id="EspejoLatDer" name="EspejoLatDer" class="form-control" style="padding-left:2px; padding-right: 2px;">
                                                            <option value="1" selected>Si</option>
                                                            <option value="2">No</option>
                                                            <option value="3">Si con daño</option>
                                                    </select>
                                                   </td>
                                                   <td style="padding:5px; margin:2px; background-color: #eee;">Cristales</td>
                                                   <td style="padding:5px; margin:2px; background-color: #eee;">
                                                       <select id="CristalesLatDer" name="CristalesLatDer" class="form-control" style="padding-left:2px; padding-right: 2px;">
                                                            <option value="1" selected>Si</option>
                                                            <option value="2">No</option>
                                                            <option value="3">Si con daño</option>
                                                        </select>
                                                   </td>
                                                   <td style="padding:5px; margin:2px; background-color: #eee;">Manijas</td>
                                                   <td style="padding:5px; margin:2px; background-color: #eee;">
                                                       <select id="ManijasLatDer" name="ManijasLatDer" class="form-control" style="padding-left:2px; padding-right: 2px;">
                                                            <option value="1" selected>Si</option>
                                                            <option value="2">No</option>
                                                            <option value="3">Si con daño</option>
                                                    </select>
                                                   </td>
                                               </tr>
                                               <tr>
                                                   <td style="padding:5px; margin:2px; background-color: #eee;">Molduras</td>
                                                   <td style="padding:5px; margin:2px; background-color: #eee;">
                                                       <select id="MoldurasLatDer" name="MoldurasLatDer" class="form-control" style="padding-left:2px; padding-right: 2px;">
                                                            <option value="1" selected>Si</option>
                                                            <option value="2">No</option>
                                                            <option value="3">Si con daño</option>
                                                       </select>
                                                   </td>
                                                   <td style="padding:5px; margin:2px; background-color: #eee;">&nbsp;</td>
                                                   <td style="padding:5px; margin:2px; background-color: #eee;">
                                                       &nbsp;
                                                   </td>
                                                   <td style="padding:5px; margin:2px; background-color: #eee;">&nbsp;</td>
                                                   <td style="padding:5px; margin:2px; background-color: #eee;">
                                                       &nbsp;
                                                   </td>
                                                   <td style="padding:5px; margin:2px; background-color: #eee;">&nbsp;</td>
                                                   <td style="padding:5px; margin:2px; background-color: #eee;">
                                                       &nbsp;
                                                   </td>
                                                   <td style="padding:5px; margin:2px; background-color: #eee;">&nbsp;</td>
                                                   <td style="padding:5px; margin:2px; background-color: #eee;">
                                                       &nbsp;
                                                   </td>
                                               </tr>
                                            </table>
                                            </div>
                                    </div>
                                       
                                    <div class="jarviswidget  jarviswidget-sortable jarviswidget-collapsed" id="wid-id-2" 
                                    data-widget-deletebutton="false" data-widget-colorbutton="false" data-widget-editbutton="false"  data-widget-fullscreenbutton="false" data-widget-collapsed="false" >
                                        <header onclick="$('.showcajuela').toggle()"> <span class="widget-icon"> 
                                            <i class="fa fa-archive"></i> </span><h2>Cajuela</h2>
                                        </header>
                                        <div  class="showcajuela" style="display: none;">
                                            <table  style="margin: 0px auto; width:100%">
                                                <tr>
                                                   <td style="padding:5px; margin:2px; background-color: #eee;">Herramientas</td>
                                                   <td style="padding:5px; margin:2px; background-color: #eee;">
                                                       <select id="Herramientas" name="Herramientas" class="form-control" style="padding-left:2px; padding-right: 2px;">
                                                            <option value="1" selected>Si</option>
                                                            <option value="2">No</option>
                                                            <option value="3">Si con daño</option>
                                                       </select>
                                                   </td>
                                                   <td style="padding:5px; margin:2px; background-color: #eee;">Gato</td>
                                                   <td style="padding:5px; margin:2px; background-color: #eee;">
                                                       <select id="Gato" name="Gato" class="form-control" style="padding-left:2px; padding-right: 2px;">
                                                            <option value="1" selected>Si</option>
                                                            <option value="2">No</option>
                                                            <option value="3">Si con daño</option>
                                                        </select>
                                                   </td>
                                                   <td style="padding:5px; margin:2px; background-color: #eee;">Llave de cruz o "L"</td>
                                                   <td style="padding:5px; margin:2px; background-color: #eee;">
                                                       <select id="LlavedeLlantas" name="LlavedeLlantas" class="form-control" style="padding-left:2px; padding-right: 2px;">
                                                            <option value="1" selected>Si</option>
                                                            <option value="2">No</option>
                                                            <option value="3">Si con daño</option>
                                                    </select>
                                                   </td>
                                                   <td style="padding:5px; margin:2px; background-color: #eee;">Llanta de refacción</td>
                                                   <td style="padding:5px; margin:2px; background-color: #eee;">
                                                       <select id="LlantaRefaccion" name="LlantaRefaccion" class="form-control" style="padding-left:2px; padding-right: 2px;">
                                                            <option value="1" selected>Si</option>
                                                            <option value="2">No</option>
                                                            <option value="3">Si con daño</option>
                                                        </select>
                                                   </td>
                                                   <td style="padding:5px; margin:2px; background-color: #eee;">Tapete cajuela</td>
                                                   <td style="padding:5px; margin:2px; background-color: #eee;">
                                                       <select id="TapeteCajuela" name="TapeteCajuela" class="form-control" style="padding-left:2px; padding-right: 2px;">
                                                            <option value="1" selected>Si</option>
                                                            <option value="2">No</option>
                                                            <option value="3">Si con daño</option>
                                                    </select>
                                                   </td>
                                               </tr>
                                               <tr>
                                                   <td style="padding:5px; margin:2px; background-color: #eee;">Extinguidor</td>
                                                   <td style="padding:5px; margin:2px; background-color: #eee;">
                                                       <select id="Extinguidor" name="Extinguidor" class="form-control" style="padding-left:2px; padding-right: 2px;">
                                                            <option value="1" selected>Si</option>
                                                            <option value="2">No</option>
                                                            <option value="3">Si con daño</option>
                                                       </select>
                                                   </td>
                                                   <td style="padding:5px; margin:2px; background-color: #eee;">Cables pasa corriente</td>
                                                   <td style="padding:5px; margin:2px; background-color: #eee;">
                                                       <select id="CablesPasaCorriente" name="CablesPasaCorriente" class="form-control" style="padding-left:2px; padding-right: 2px;">
                                                            <option value="1" selected>Si</option>
                                                            <option value="2">No</option>
                                                            <option value="3">Si con daño</option>
                                                       </select>
                                                   </td>
                                                   <td style="padding:5px; margin:2px; background-color: #eee;">Señales reflejantes</td>
                                                   <td style="padding:5px; margin:2px; background-color: #eee;">
                                                       <select id="SenalesReflejantes" name="SenalesReflejantes" class="form-control" style="padding-left:2px; padding-right: 2px;">
                                                            <option value="1" selected>Si</option>
                                                            <option value="2">No</option>
                                                            <option value="3">Si con daño</option>
                                                       </select>
                                                   </td>
                                                   <td style="padding:5px; margin:2px; background-color: #eee;">&nbsp;</td>
                                                   <td style="padding:5px; margin:2px; background-color: #eee;">
                                                       &nbsp;
                                                   </td>
                                                   <td style="padding:5px; margin:2px; background-color: #eee;">&nbsp;</td>
                                                   <td style="padding:5px; margin:2px; background-color: #eee;">
                                                       &nbsp;
                                                   </td>
                                               </tr>
                                            </table>
                                        </div>
                                    </div>
                                        
                                    <div class="jarviswidget  jarviswidget-sortable jarviswidget-collapsed" id="wid-id-2" 
                                    data-widget-deletebutton="false" data-widget-colorbutton="false" data-widget-editbutton="false"  data-widget-fullscreenbutton="false" data-widget-collapsed="false" >
                                        <header onclick="$('.showotros').toggle()"> <span class="widget-icon"> 
                                            <i class="fa fa-th-list"></i> </span><h2>Otros</h2>
                                        </header>
                                        <div  class="showotros" style="display: none;">
                                            <table  style="margin: 0px auto; width:100%">
                                                <tr>
                                                   <td style="padding:5px; margin:2px; background-color: #eee;">Antena</td>
                                                   <td style="padding:5px; margin:2px; background-color: #eee;">
                                                       <select id="Antena" name="Antena" class="form-control" style="padding-left:2px; padding-right: 2px;">
                                                            <option value="1" selected>Si</option>
                                                            <option value="2">No</option>
                                                            <option value="3">Si con daño</option>
                                                       </select>
                                                   </td>
                                                   <td style="padding:5px; margin:2px; background-color: #eee;">Tapa gasolina</td>
                                                   <td style="padding:5px; margin:2px; background-color: #eee;">
                                                       <select id="TapaGasolina" name="TapaGasolina" class="form-control" style="padding-left:2px; padding-right: 2px;">
                                                            <option value="1" selected>Si</option>
                                                            <option value="2">No</option>
                                                            <option value="3">Si con daño</option>
                                                        </select>
                                                   </td>
                                                   <td style="padding:5px; margin:2px; background-color: #eee;">Tapón gasolina</td>
                                                   <td style="padding:5px; margin:2px; background-color: #eee;">
                                                       <select id="TaponGasolina" name="TaponGasolina" class="form-control" style="padding-left:2px; padding-right: 2px;">
                                                            <option value="1" selected>Si</option>
                                                            <option value="2">No</option>
                                                            <option value="3">Si con daño</option>
                                                    </select>
                                                   </td>
                                                   <td style="padding:5px; margin:2px; background-color: #eee;">Canastilla viaje</td>
                                                   <td style="padding:5px; margin:2px; background-color: #eee;">
                                                       <select id="CanastillaViaje" name="CanastillaViaje" class="form-control" style="padding-left:2px; padding-right: 2px;">
                                                            <option value="1" selected>Si</option>
                                                            <option value="2">No</option>
                                                            <option value="3">Si con daño</option>
                                                        </select>
                                                   </td>
                                                   <td style="padding:5px; margin:2px; background-color: #eee;">&nbsp;</td>
                                                   <td style="padding:5px; margin:2px; background-color: #eee;">
                                                       &nbsp;
                                                   </td>
                                               </tr>
                                            </table>
                                        </div>
                                    </div>

                                    <div class="jarviswidget  jarviswidget-sortable jarviswidget-collapsed" id="wid-id-2" 
                                    data-widget-deletebutton="false" data-widget-colorbutton="false" data-widget-editbutton="false"  data-widget-fullscreenbutton="false" data-widget-collapsed="false">
                                        <header  onclick="$('.showllaves').toggle()"> <span class="widget-icon"> 
                                            <i class="fa fa-key"></i> </span><h2>Llaves</h2>
                                        </header>
                                        <div  class="showllaves" style="display: none;">
                                            <table  style="margin: 0px auto; width:100%">
                                                <tr>
                                                   <td style="padding:5px; margin:2px; background-color: #eee;">Llaves</td>
                                                   <td style="padding:5px; margin:2px; background-color: #eee;">
                                                       <select id="Llaves" name="Llaves" class="form-control" style="padding-left:2px; padding-right: 2px;">
                                                            <option value="1" selected>Si</option>
                                                            <option value="2">No</option>
                                                            <option value="3">Si con daño</option>
                                                       </select>
                                                   </td>
                                                   <td style="padding:5px; margin:2px; background-color: #eee;">Llavero</td>
                                                   <td style="padding:5px; margin:2px; background-color: #eee;">
                                                       <select id="Llavero" name="Llavero" class="form-control" style="padding-left:2px; padding-right: 2px;">
                                                            <option value="1" selected>Si</option>
                                                            <option value="2">No</option>
                                                            <option value="3">Si con daño</option>
                                                        </select>
                                                   </td>
                                                   <td style="padding:5px; margin:2px; background-color: #eee;">Tarjeta de circulación</td>
                                                   <td style="padding:5px; margin:2px; background-color: #eee;">
                                                       <select id="TarjetaCirc" name="TarjetaCirc" class="form-control" style="padding-left:2px; padding-right: 2px;">
                                                            <option value="1" selected>Si</option>
                                                            <option value="2">No</option>
                                                            <option value="3">Si con daño</option>
                                                    </select>
                                                   </td>
                                                   <td style="padding:5px; margin:2px; background-color: #eee;">&nbsp;</td>
                                                   <td style="padding:5px; margin:2px; background-color: #eee;">
                                                       &nbsp;
                                                   </td>
                                                   <td style="padding:5px; margin:2px; background-color: #eee;">&nbsp;</td>
                                                   <td style="padding:5px; margin:2px; background-color: #eee;">
                                                       &nbsp;
                                                   </td>
                                               </tr>
                                            </table>
                                        </div>
                                    </div>
                                        
                                    <div class="jarviswidget  jarviswidget-sortable jarviswidget-collapsed" id="wid-id-2" 
                                    data-widget-deletebutton="false" data-widget-colorbutton="false" data-widget-editbutton="false"  data-widget-fullscreenbutton="false" data-widget-collapsed="false">
                                        <header  onclick="$('.showllantas').toggle()"> <span class="widget-icon"> 
                                            <i class="fa  fa-life-ring"></i> </span><h2>Llantas</h2>
                                        </header>
                                        <div  class="showllantas" style="display: none;">
                                            <table  style="margin: 0px auto; width:100%">
                                                <tr>
                                                   <td style="padding:5px; margin:2px; background-color: #eee;">&nbsp;</td>
                                                   <td style="padding:5px; margin:2px; background-color: #eee;">Medida</td>
                                                   <td style="padding:5px; margin:2px; background-color: #eee;">Marca</td>
                                                   <td style="padding:5px; margin:2px; background-color: #eee;">T</td>
                                                   <td style="padding:5px; margin:2px; background-color: #eee;">R</td>
                                               </tr>
                                               <tr>
                                                   <td style="padding:5px; margin:2px; background-color: #eee;">Delt. RH</td>
                                                   <td style="padding:5px; margin:2px; background-color: #eee;">
                                                       <input type="text" class="form-control" placeholder="Medida" name="MedLlantaDelDer" style="padding-left:2px; padding-right: 2px;">
                                                   </td>
                                                   <td style="padding:5px; margin:2px; background-color: #eee;">
                                                       <input type="text" class="form-control" placeholder="Marca" name="MarcaLlantaDelDer" style="padding-left:2px; padding-right: 2px;">
                                                   </td>
                                                   <td style="padding:5px; margin:2px; background-color: #eee;">
                                                       <select id="LlantaDelDerT" name="LlantaDelDerT" class="form-control" style="padding-left:2px; padding-right: 2px;">
                                                            <option value="1" selected>Si</option>
                                                            <option value="2">No</option>
                                                            <option value="3">Si con daño</option>
                                                       </select>
                                                   </td>
                                                   <td style="padding:5px; margin:2px; background-color: #eee;">
                                                       <select id="LlantaDelDerR" name="LlantaDelDerR" class="form-control" style="padding-left:2px; padding-right: 2px;">
                                                            <option value="1" selected>Si</option>
                                                            <option value="2">No</option>
                                                            <option value="3">Si con daño</option>
                                                       </select>
                                                   </td>
                                               </tr>
                                               <tr>
                                                   <td style="padding:5px; margin:2px; background-color: #eee;">Delt. LH</td>
                                                   <td style="padding:5px; margin:2px; background-color: #eee;">
                                                       <input type="text" class="form-control" placeholder="Medida" name="MedLlantaDelIzq" style="padding-left:2px; padding-right: 2px;">
                                                   </td>
                                                   <td style="padding:5px; margin:2px; background-color: #eee;">
                                                       <input type="text" class="form-control" placeholder="Marca" name="MarcaLlantaDelIzq" style="padding-left:2px; padding-right: 2px;">
                                                   </td>
                                                   <td style="padding:5px; margin:2px; background-color: #eee;">
                                                       <select id="LlantaDelIzqT" name="LlantaDelIzqT" class="form-control" style="padding-left:2px; padding-right: 2px;">
                                                            <option value="1" selected>Si</option>
                                                            <option value="2">No</option>
                                                            <option value="3">Si con daño</option>
                                                       </select>
                                                   </td>
                                                   <td style="padding:5px; margin:2px; background-color: #eee;">
                                                       <select id="LlantaDelIzqR" name="LlantaDelIzqR" class="form-control" style="padding-left:2px; padding-right: 2px;">
                                                            <option value="1" selected>Si</option>
                                                            <option value="2">No</option>
                                                            <option value="3">Si con daño</option>
                                                       </select>
                                                   </td>
                                               </tr>
                                               <tr>
                                                   <td style="padding:5px; margin:2px; background-color: #eee;">Tras. RH</td>
                                                   <td style="padding:5px; margin:2px; background-color: #eee;">
                                                       <input type="text" class="form-control" placeholder="Medida" name="MedLlantaTrasDer" style="padding-left:2px; padding-right: 2px;">
                                                   </td>
                                                   <td style="padding:5px; margin:2px; background-color: #eee;">
                                                       <input type="text" class="form-control" placeholder="Marca" name="MarcaLlantaTrasDer" style="padding-left:2px; padding-right: 2px;">
                                                   </td>
                                                   <td style="padding:5px; margin:2px; background-color: #eee;">
                                                       <select id="LlantaTrasDerT" name="LlantaTrasDerT" class="form-control" style="padding-left:2px; padding-right: 2px;">
                                                            <option value="1" selected>Si</option>
                                                            <option value="2">No</option>
                                                            <option value="3">Si con daño</option>
                                                       </select>
                                                   </td>
                                                   <td style="padding:5px; margin:2px; background-color: #eee;">
                                                       <select id="LlantaTrasDerR" name="LlantaTrasDerR" class="form-control" style="padding-left:2px; padding-right: 2px;">
                                                            <option value="1" selected>Si</option>
                                                            <option value="2">No</option>
                                                            <option value="3">Si con daño</option>
                                                       </select>
                                                   </td>
                                               </tr>
                                               <tr>
                                                   <td style="padding:5px; margin:2px; background-color: #eee;">Tras. LH</td>
                                                   <td style="padding:5px; margin:2px; background-color: #eee;">
                                                       <input type="text" class="form-control" placeholder="Medida" name="MedLlantaTrasIzq" style="padding-left:2px; padding-right: 2px;">
                                                   </td>
                                                   <td style="padding:5px; margin:2px; background-color: #eee;">
                                                       <input type="text" class="form-control" placeholder="Marca" name="MarcaLlantaTrasIzq" style="padding-left:2px; padding-right: 2px;">
                                                   </td>
                                                   <td style="padding:5px; margin:2px; background-color: #eee;">
                                                       <select id="LlantaTrasIzqT" name="LlantaTrasIzqT" class="form-control" style="padding-left:2px; padding-right: 2px;">
                                                            <option value="1" selected>Si</option>
                                                            <option value="2">No</option>
                                                            <option value="3">Si con daño</option>
                                                       </select>
                                                   </td>
                                                   <td style="padding:5px; margin:2px; background-color: #eee;">
                                                       <select id="LlantaTrasIzqR" name="LlantaTrasIzqR" class="form-control" style="padding-left:2px; padding-right: 2px;">
                                                            <option value="1" selected>Si</option>
                                                            <option value="2">No</option>
                                                            <option value="3">Si con daño</option>
                                                       </select>
                                                   </td>
                                               </tr>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="jarviswidget  jarviswidget-sortable jarviswidget-collapsed" id="wid-id-2" 
                                    data-widget-deletebutton="false" data-widget-colorbutton="false" data-widget-editbutton="false"  data-widget-fullscreenbutton="false" data-widget-collapsed="false" >
                                        <header onclick="$('.showdanpreex').toggle()"> <span class="widget-icon"> 
                                            <i class="fa  fa-exclamation-circle"></i> </span><h2>Daños preexistentes</h2>
                                        </header>
                                        <div   class="showdanpreex" style="display: none;">
                                            <table  style="margin: 0px auto; width:100%">
                                                <tr>
                                                   <td style="padding:5px; margin:2px; background-color: #eee;">
                                                   <textarea rows="5" cols="50" class="form-control" name="descDanosPreexist" style="padding-left:2px; padding-right: 2px;"></textarea>
                                                   </td>
                                               </tr>
                                            </table>
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
                     <span class="widget-icon"> 
                        <i class="fa fa-plus"></i>
                    </span>
                    Nuevo Cliente
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
    }

    //************************** /
   
     function showpopup(){
        $.get(config.base+"/Clientes/ajax/?action=get&object=showpopup", null, function (response) {
                if ( response ){
                    $("#contentpopup").html(response);
                }else{
                    return notify('error', 'Error al obtener los datos del Formulario');
                    
                }     
        });
    }
    function getcliente(id){
        if ( ! id ) return;

        $.get(config.base+"/Vehiculos/ajax/?action=get&object=getcliente&id=" + id, null, function (response) {
                if ( response ){
                    $("#contcliente").html(response);
                }else{
                    notify('error', 'Error al obtener los datos del cliente');
                    return false;
                }     
        });
    }
    function getsubmarca(id){
        if ( ! id ) return;

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
    function validateForm()
    {
        var nombre = $("input[name=nombre]").val();
       // if ( ! nombre )  return notify("info","El nombre es requerido");
        
        $("#main-form").submit();       
    }


  
    $(document).ready(function() {
        document.getElementById('filevehiculo').addEventListener('change', uploadimages, false);

        $('body').on('click', '#savenewclient', function(){
            var nombre=$("input[name=nombre]", $(this).parents('form:first')).val();
            var apellido_pat=$("input[name=apellido_pat]", $(this).parents('form:first')).val();
            var apellido_mat=$("input[name=apellido_mat]", $(this).parents('form:first')).val();
            var telefono=$("input[name=telefono]", $(this).parents('form:first')).val();
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
                    console.log(getcliente(id));
                }
        });
        $('body').on('change', '#id_marca', function(){
                if( $(this).val() ){
                    var id = $("#id_marca").val();
                    console.log(getsubmarca(id));
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
