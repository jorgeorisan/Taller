 <?php

//initilize the page
require_once(SYSTEM_DIR . "/inc/init.php");

//require UI configuration (nav, ribbon, etc.)
require_once(SYSTEM_DIR . "/inc/config.ui.php");

/*---------------- PHP Custom Scripts ---------

YOU CAN SET CONFIGURATION VARIABLES HERE BEFORE IT GOES TO NAV, RIBBON, ETC.
E.G. $page_title = "Custom Title" */

$page_title = "Invetario del Auto";

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



//$user->load($user_id);
$error_message="";
$success_message="";
$warning_message="";
if(isset($_POST['email']) && isset($_POST['first_name']) && isset($_POST['last_name']))//&& validateCSRFToken() )
{

    if(isset($_POST['enabled']) && $_POST['enabled']==1)
        $enabled_int=1;
    else
        $enabled_int=0;

        $result=$u->saveUser($user_id,$_POST['email'],$_POST['first_name'],$_POST['last_name'],$enabled_int);

        if($result)
        {
            redirect(make_url("Users"));
            //$success_message="User saved correctly";
        }
        else
        {
            $error_message="Error saving user";

        }

        /*$user -> setEmail($_POST['email']);
        $user -> setFirstName($_POST['first_name']);
        $user -> setLastName($_POST['last_name']);

        $user -> setEnabled($enabled_int);
        $user -> save();

        if ($user->getValid()){
            redirect(make_url("Users"));
        }else{
            if (empty($user->getStatus()) )
            {
                $error_message="There was an error while saving !";
            }else{
                //print_r($user->getStatus());
                $error_message="User status error!";
                //(())$errormessage="<p>".implode($user->getStatus(),"</p><p>")."</p>";
            }
        }
        */
}
?>

<!-- MAIN PANEL -->
<div id="main" role="main">
    <!-- MAIN CONTENT -->
    <div id="content">
        <div class="row">     
            <section id="widget-grid" class="">
                <form action= "" method="POST" id="frmInventario"  enctype="multipart/form-data">
                    <div class="alert alert-info">
                        <strong>Información!</strong> Si el cliente y el vehículo son de primera vez en el taller, darlos de alta antes de realizar el inventario
                    </div>
                    <article class="col-sm-12 col-md-12 col-lg-12"  id="incidente">
                        <div class="jarviswidget  jarviswidget-sortable jarviswidget-collapsed" id="wid-id-0" 
                        data-widget-deletebutton="false" data-widget-colorbutton="false" data-widget-editbutton="false"  data-widget-fullscreenbutton="false" data-widget-collapsed="false">
                            <header> <span class="widget-icon"> 
                                <i class="fa fa-eye"></i> </span><h2>INCIDENTE</h2>
                            </header>
                            <div style="display: none;">
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
                    </article>
                        <dt class="c-blue f-700" style="cursor: pointer; " id="Cliente">CLIENTE<hr></dt>
                        <dd>
                            <div style="display: inline-block; width: 100%;">
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label for="name">RFC</label>
                                    <input type="text" class="form-control" placeholder="RFC" name="rfcCliente">
                                    <input type="text" class="form-control" name="idCliente" style="display: none;">
                                </div> 
                                <div class="form-group">
                                    <label for="name">Nombre Cliente</label>
                                    <input type="text" class="form-control" placeholder="Nombre Cliente" name="nomCliente">
                                </div>
                                <div class="form-group">
                                    <label for="name">Teléfono</label>
                                    <input type="text" class="form-control" placeholder="Teléfono" name="telefonoCli">                                
                                </div>                              
                                <div class="form-group">
                                    <label for="name">Ciudad</label>
                                    <input type="text" class="form-control" placeholder="Ciudad" name="ciudadCli">                                
                                </div>
                                
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <br>
                                    <button type="button" class="btn btn-primary btn-sm m-t-10 waves-effect" style='width:120px;' onclick="buscarCliente()">Buscar</button>&nbsp;                                                                                                               
                                </div>
                                <div class="form-group">
                                    <label for="name">Número Interior</label>
                                    <input type="text" class="form-control" placeholder="Número Interior" name="numIntCli">
                                </div>                                                        
                                <div class="form-group">
                                    <label for="name">Estado</label>
                                    <input type="text" class="form-control" placeholder="Estado" name="estadoCli">
                                </div>
                                <div class="form-group">
                                    <label for="name">Correo</label>
                                    <input type="text" class="form-control" placeholder="Correo" name="correoCli">
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label for="name">Calle</label>
                                    <input type="text" class="form-control" placeholder="calle" name="calleCli">
                                </div>  
                                <div class="form-group">
                                    <label for="name">Número Exterior</label>
                                    <input type="text" class="form-control" placeholder="Número Exterior" name="numExtCli">                                
                                </div>
                                <div class="form-group">
                                    <label for="name">Colonia</label>
                                    <input type="text" class="form-control" placeholder="colonia" name="coloniaCli">
                                </div>
                                <div class="form-group">
                                    <label for="name">CP</label>
                                    <input type="text" class="form-control" maxlength="5" placeholder="CP" name="cpCli">
                                </div>
                            </div>
                            </div>
                            <hr>
                        </dd>
                        <dt class="c-blue f-700 activo" style="cursor: pointer; " id="Vehiculo">VEHÍCULO<hr></dt>
                        <dd>
                            <div style="display: inline-block; width: 100%;">
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label for="name">Placas</label>
                                    <input type="text" class="form-control" placeholder="placas" name="placas">
                                    <input type="text" class="form-control" name="idVehiculo" style="display: none;">
                                </div>
                                <div class="form-group">
                                    <label for="name">Submarca</label>
                                    <input type="text" class="form-control" placeholder="Modelo" name="modelo">
                                </div>
                            </div>
                            <div class="col-sm-4"> 
                                <div class="form-group">
                                    <br>
                                    <button type="button" class="btn btn-primary btn-sm m-t-10 waves-effect" style='width:120px;' onclick="buscarAuto()">Buscar</button>&nbsp;                                                                                                               
                                </div>                       
                                <div class="form-group">
                                    <label for="name">Color</label>
                                    <input type="text" class="form-control" placeholder="Color" name="color">
                                </div>                        
                            </div>
                            <div class="col-sm-4"> 
                                <div class="form-group">
                                    <label for="name">Marca</label>
                                    <input type="text" class="form-control" placeholder="Marca" name="marca">
                                </div>                         
                                <div class="form-group">
                                    <label for="name">Serie</label>
                                    <input type="text" class="form-control" placeholder="Serie" name="serie">
                                </div>
                            </div>
                            <div class="col-sm-13 clearfix"> 
                                <div class="form-group">
                                    <label for="name">Ingreso a taller</label>
                                    <div class="checkbox m-b-15">
                                        <label>
                                            <input type="checkbox" value="" id="chkIngresa">
                                            <i class="input-helper"></i>
                                            Seleccione si el vehículo ingresará al taller
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-13 clearfix"></div>
                            <div class="col-sm-13 clearfix" id="fotosAutoTransito">
                                <div class="col-sm-13 clearfix">
                                    <div class="lv-header-alt clearfix m-b-5">
                                        <h2 class="lvh-label">Fotos de vehículo en tránsito, <span id="CuentaFotosTransito">0</span> Fotografías</h2>
                                        <ul class="lv-actions actions">
                                            <li >
                                                 <input type="file" id="fileInventario0"  name="fileAutosTransito[]" accept="image/*" style="display:none" onchange="subeFotoInventario(this)">
                                                <a href="" title='Agregar fotografía de vehículo en tránsito'  onclick="getFoto('fileInventario0'); return false;">
                                                    <i class="fa fa-camera"></i>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="" title='Seleccionar fotografías'  onclick="selectFotos('fotosAutoT');">
                                                    <i class="fa fa-check"></i>
                                                </a>
                                            </li>
                                            <li style="display:none;" id="delFoto">
                                                <a href="" title='Eliminar fotografías seleccionadas'  onclick="delFotos('fotosAutoT');">
                                                    <i class="fa fa-trash-o"></i>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="o-auto"  style="max-height: 250px;">                     
                                        <div class="lightbox photos" id="fotosAutoT">
                                        </div>
                                    </div>
                            </div>
                            </div>
                            </div>
                            <hr>
                        </dd>
                        <dt class="c-blue f-700" style="cursor: pointer; " id="Interiores">INTERIORES<hr></dt>
                        <dd>
                        <div style="display: inline-block; width: 100%;">
                           
                            <table  style="margin: 0px auto; width:100%">
                                <tr>
                                   <td style="padding:5px; margin:2px; background-color: #eee;">Tablero</td>
                                   <td style="padding:5px; margin:2px; background-color: #eee;">
                                       <select id="tablero" name="tablero" class="form-control" style="padding-left:2px; padding-right: 2px;">
                                           <option value="1" selected>Si</option>
                                            <option value="2">No</option>
                                            <option value="3">Si con daño</option>
                                       </select>
                                   </td>
                                   <td style="padding:5px; margin:2px; background-color: #eee;">Función de Indicadores</td>
                                   <td style="padding:5px; margin:2px; background-color: #eee;">
                                       <select id="funcionIndicadores" name="funcionIndicadores" class="form-control" style="padding-left:2px; padding-right: 2px;">
                                            <option value="1" selected>Si</option>
                                            <option value="2">No</option>
                                            <option value="3">Si con daño</option>
                                        </select>
                                   </td>
                                   <td style="padding:5px; margin:2px; background-color: #eee;">Tanque de Gasolina</td>
                                   <td style="padding:5px; margin:2px; background-color: #eee;">
                                       <select id="tanqueGasolina" name="tanqueGasolina" class="form-control" style="padding-left:2px; padding-right: 2px;">
                                            <option value="1" selected>R</option>
                                            <option value="2">1/4</option>
                                            <option value="3">1/2</option>
                                            <option value="4">3/4</option>
                                            <option value="5">Lleno</option>
                                    </select>
                                   </td>
                                   <td style="padding:5px; margin:2px; background-color: #eee;">Kilometraje</td>
                                   <td style="padding:5px; margin:2px; background-color: #eee;">
                                       <input type="text" class="form-control" placeholder="Kilometraje" name="Kilometraje" style="padding-left:2px; padding-right: 2px;" required>
                                   </td>
                                   <td style="padding:5px; margin:2px; background-color: #eee;">Funcionamiento A/C</td>
                                   <td style="padding:5px; margin:2px; background-color: #eee;">
                                       <select id="FuncionamientoAC" name="FuncionamientoAC" class="form-control" style="padding-left:2px; padding-right: 2px;">
                                            <option value="1" selected>Si</option>
                                            <option value="2">No</option>
                                            <option value="3">Si con daño</option>
                                    </select>
                                   </td>
                               </tr>
                               <tr>
                                   <td style="padding:5px; margin:2px; background-color: #eee;">Controles A/C</td>
                                   <td style="padding:5px; margin:2px; background-color: #eee;">
                                       <select id="ControlesAC" name="ControlesAC" class="form-control" style="padding-left:2px; padding-right: 2px;">
                                            <option value="1" selected>Si</option>
                                            <option value="2">No</option>
                                            <option value="3">Si con daño</option>
                                       </select>
                                   </td>
                                   <td style="padding:5px; margin:2px; background-color: #eee;">Cenicero</td>
                                   <td style="padding:5px; margin:2px; background-color: #eee;">
                                       <select id="Cenicero" name="Cenicero" class="form-control" style="padding-left:2px; padding-right: 2px;">
                                            <option value="1" selected>Si</option>
                                            <option value="2">No</option>
                                            <option value="3">Si con daño</option>
                                        </select>
                                   </td>
                                   <td style="padding:5px; margin:2px; background-color: #eee;">Encendedor</td>
                                   <td style="padding:5px; margin:2px; background-color: #eee;">
                                       <select id="Encendedor" name="Encendedor" class="form-control" style="padding-left:2px; padding-right: 2px;">
                                            <option value="1" selected>Si</option>
                                            <option value="2">No</option>
                                            <option value="3">Si con daño</option>
                                    </select>
                                   </td>
                                   <td style="padding:5px; margin:2px; background-color: #eee;">Guantera</td>
                                   <td style="padding:5px; margin:2px; background-color: #eee;">
                                       <select id="Guantera" name="Guantera" class="form-control" style="padding-left:2px; padding-right: 2px;">
                                            <option value="1" selected>Si</option>
                                            <option value="2">No</option>
                                            <option value="3">Si con daño</option>
                                    </select>
                                   </td>
                                   <td style="padding:5px; margin:2px; background-color: #eee;">Retrovisor</td>
                                   <td style="padding:5px; margin:2px; background-color: #eee;">
                                       <select id="Retrovisor" name="Retrovisor" class="form-control" style="padding-left:2px; padding-right: 2px;">
                                            <option value="1" selected>Si</option>
                                            <option value="2">No</option>
                                            <option value="3">Si con daño</option>
                                    </select>
                                   </td>
                               </tr>
                                <tr>
                                   <td style="padding:5px; margin:2px; background-color: #eee;">Luz Interior</td>
                                   <td style="padding:5px; margin:2px; background-color: #eee;">
                                       <select id="LuzInterior" name="LuzInterior" class="form-control" style="padding-left:2px; padding-right: 2px;">
                                            <option value="1" selected>Si</option>
                                            <option value="2">No</option>
                                            <option value="3">Si con daño</option>
                                       </select>
                                   </td>
                                   <td style="padding:5px; margin:2px; background-color: #eee;">Viseras</td>
                                   <td style="padding:5px; margin:2px; background-color: #eee;">
                                       <select id="Visera" name="Visera" class="form-control" style="padding-left:2px; padding-right: 2px;">
                                            <option value="1" selected>Si</option>
                                            <option value="2">No</option>
                                            <option value="3">Si con daño</option>
                                        </select>
                                   </td>
                                   <td style="padding:5px; margin:2px; background-color: #eee;">Claxon</td>
                                   <td style="padding:5px; margin:2px; background-color: #eee;">
                                       <select id="Claxon" name="Claxon" class="form-control" style="padding-left:2px; padding-right: 2px;">
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
                            <h2 class="c-blue f-700" style="font-size: 14px; margin-left:2%;">Equipo de audio</h2>
                            <table style="margin: 0px auto; width:100%">
                                <tr>
                                   <td style="padding:5px; margin:2px; background-color: #eee;">Equipo original</td>
                                   <td style="padding:5px; margin:2px; background-color: #eee;">
                                       <select id="EquipoAudioOriginal" name="EquipoAudioOriginal" class="form-control" style="padding-left:2px; padding-right: 2px;">
                                            <option value="1" selected>Si</option>
                                            <option value="2">No</option>
                                            <option value="3">Si con daño</option>
                                       </select>
                                   </td>
                                   <td style="padding:5px; margin:2px; background-color: #eee;">Equipo adaptado</td>
                                   <td style="padding:5px; margin:2px; background-color: #eee;">
                                       <select id="EquipoAudioAdaptado" name="EquipoAudioAdaptado" class="form-control" style="padding-left:2px; padding-right: 2px;">
                                            <option value="1" selected>Si</option>
                                            <option value="2">No</option>
                                            <option value="3">Si con daño</option>
                                        </select>
                                   </td>
                                   <td style="padding:5px; margin:2px; background-color: #eee;">Marca</td>
                                   <td style="padding:5px; margin:2px; background-color: #eee;">
                                       <input type="text" class="form-control" placeholder="Marca de equipo de audio" name="MarcaEquipoAudio">
                                   </td>
                                   <td style="padding:5px; margin:2px; background-color: #eee;">Ecualizador</td>
                                   <td style="padding:5px; margin:2px; background-color: #eee;">
                                       <select id="Ecualizador" name="Ecualizador" class="form-control" style="padding-left:2px; padding-right: 2px;">
                                            <option value="1" selected>Si</option>
                                            <option value="2">No</option>
                                            <option value="3">Si con daño</option>
                                       </select>
                                   </td>
                                   <td style="padding:5px; margin:2px; background-color: #eee;">Amplificador</td>
                                   <td style="padding:5px; margin:2px; background-color: #eee;">
                                       <select id="Amplificador" name="Amplificador" class="form-control" style="padding-left:2px; padding-right: 2px;">
                                            <option value="1" selected>Si</option>
                                            <option value="2">No</option>
                                            <option value="3">Si con daño</option>
                                       </select>
                                   </td>
                               </tr>
                               <tr>
                                   <td style="padding:5px; margin:2px; background-color: #eee;">Caja de CD's</td>
                                   <td style="padding:5px; margin:2px; background-color: #eee;">
                                       <select id="CajadeCDs" name="CajadeCDs" class="form-control" style="padding-left:2px; padding-right: 2px;">
                                            <option value="1" selected>Si</option>
                                            <option value="2">No</option>
                                            <option value="3">Si con daño</option>
                                       </select>
                                   </td>
                                   <td style="padding:5px; margin:2px; background-color: #eee;">Bocinas</td>
                                   <td style="padding:5px; margin:2px; background-color: #eee;">
                                       <select id="Bocinas" name="Bocinas" class="form-control" style="padding-left:2px; padding-right: 2px;">
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
                               </tr>
                            </table>
                            <h2 class="c-blue f-700" style="font-size: 14px; margin-left:2%;">Alarma</h2>
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
                            <div class="col-sm-13 clearfix"></div>
                            <div class="col-sm-13 clearfix">
                                <div class="col-sm-13 clearfix">
                                    <div class="lv-header-alt clearfix m-b-5">
                                        <h2 class="lvh-label">Fotos de interiores, <span id="CuentaFotosInteriores">0</span> Fotografías</h2>
                                        <ul class="lv-actions actions">
                                            <li >
                                                <input type="file" id="fileInventario1" name="fileInteriores[]" accept="image/*" style="display:none" onchange="subeFotoInventario(this)">
                                                <a href="" title='Agregar fotografía de interior'  onclick="getFoto('fileInventario1');">
                                                    <i class="fa fa-camera"></i>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="" title='Seleccionar fotografías'  onclick="selectFotos('fotosInteriores');">
                                                    <i class="fa fa-check"></i>
                                                </a>
                                            </li>
                                            <li style="" id="delFotoInt">
                                                <a href="" title='Eliminar fotografías seleccionadas'  onclick="delFotos('fotosInteriores');">
                                                    <i class="fa fa-trash-o"></i>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="o-auto"  style="max-height: 250px;">                     
                                        <div class="lightbox photos" id="fotosInteriores">
                                        </div>
                                    </div>
                            </div>
                            </div>
                            <hr>
                            </div>
                        </dd>
                        <dt class="c-blue f-700" style="cursor: pointer; " id="Motor">MOTOR<hr></dt>
                        <dd>
                            <div style="display: inline-block; width: 100%;">
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
                            <div class="col-sm-13 clearfix"></div>
                            <div class="col-sm-13 clearfix">
                                <div class="col-sm-13 clearfix">
                                    <div class="lv-header-alt clearfix m-b-5">
                                        <h2 class="lvh-label">Fotos del motor, <span id="CuentaFotosMotor">0</span> Fotografías</h2>
                                        <ul class="lv-actions actions">
                                            <li >
                                                <input type="file" id="fileInventario2" name="fileMotor[]" accept="image/*" style="display:none" onchange="subeFotoInventario(this)">
                                                <a href="" title='Agregar fotografía del motor'  onclick="getFoto('fileInventario2');">
                                                    <i class="fa fa-camera"></i>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="" title='Seleccionar fotografías'  onclick="selectFotos('fotosMotor');">
                                                    <i class="fa fa-check"></i>
                                                </a>
                                            </li>
                                            <li style="display:none;" id="delFotoMot">
                                                <a href="" title='Eliminar fotografías seleccionadas'  onclick="delFotos('fotosMotor');">
                                                    <i class="fa fa-trash-o"></i>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="o-auto"  style="max-height: 250px;">                     
                                        <div class="lightbox photos" id="fotosMotor">
                                        </div>
                                    </div>
                            </div>
                            </div>
                            <hr>
                            </div>
                        </dd>
                        <dt class="c-blue f-700" style="cursor: pointer; " id="Frontal">FRONTAL<hr></dt>
                        <dd>
                            <div style="display: inline-block; width: 100%;">
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
                            <div class="col-sm-13 clearfix"></div>
                            <div class="col-sm-13 clearfix">
                                <div class="col-sm-13 clearfix">
                                    <div class="lv-header-alt clearfix m-b-5">
                                        <h2 class="lvh-label">Fotos del frente, <span id="CuentaFotosFrente">0</span> Fotografías</h2>
                                        <ul class="lv-actions actions">
                                            <li >
                                                <input type="file" id="fileInventario3" name="fileMotor[]" accept="image/*" style="display:none" onchange="subeFotoInventario(this)">
                                                <a href="" title='Agregar fotografía del frente'  onclick="getFoto('fileInventario3');">
                                                    <i class="fa fa-camera"></i>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="" title='Seleccionar fotografías'  onclick="selectFotos('fotosFrontal');">
                                                    <i class="fa fa-check"></i>
                                                </a>
                                            </li>
                                            <li style="display:none;" id="delFotoDel">
                                                <a href="" title='Eliminar fotografías seleccionadas'  onclick="delFotos('fotosFrontal');">
                                                    <i class="fa fa-trash-o"></i>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="o-auto"  style="max-height: 250px;">                     
                                        <div class="lightbox photos" id="fotosFrontal">
                                        </div>
                                    </div>
                            </div>
                            </div>
                            <hr>
                            </div>
                        </dd>
                        <dt class="c-blue f-700" style="cursor: pointer; " id="Trasero">TRASERO<hr></dt>
                        <dd>
                            <div style="display: inline-block; width: 100%;">
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
                            <div class="col-sm-13 clearfix"></div>
                            <div class="col-sm-13 clearfix">
                                <div class="col-sm-13 clearfix">
                                    <div class="lv-header-alt clearfix m-b-5">
                                        <h2 class="lvh-label">Fotos de la parte trasera, <span id="CuentaFotosTrasero">0</span> Fotografías</h2>
                                        <ul class="lv-actions actions">
                                            <li >
                                                <input type="file" id="fileInventario4" name="fileTrasero[]" accept="image/*" style="display:none" onchange="subeFotoInventario(this)">
                                                <a href="" title='Agregar fotografía de la parte trasera'  onclick="getFoto('fileInventario4');">
                                                    <i class="fa fa-camera"></i>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="" title='Seleccionar fotografías'  onclick="selectFotos('fotosTrasero');">
                                                    <i class="fa fa-check"></i>
                                                </a>
                                            </li>
                                            <li style="display:none;" id="delFotoTras">
                                                <a href="" title='Eliminar fotografías seleccionadas'  onclick="delFotos('fotosTrasero');">
                                                    <i class="fa fa-trash-o"></i>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="o-auto"  style="max-height: 250px;">                     
                                        <div class="lightbox photos" id="fotosTrasero">
                                        </div>
                                    </div>
                            </div>
                            </div>
                            <hr>
                            </div>
                        </dd> 
                        <dt class="c-blue f-700" style="cursor: pointer; " id="Izquierdo">LATERAL IZQUIERDO<hr></dt>
                        <dd>
                            <div style="display: inline-block; width: 100%;">
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
                            <div class="col-sm-13 clearfix"></div>
                            <div class="col-sm-13 clearfix">
                                <div class="col-sm-13 clearfix">
                                    <div class="lv-header-alt clearfix m-b-5">
                                        <h2 class="lvh-label">Fotos del lado izquierdo, <span id="CuentaFotosIzquierdo">0</span> Fotografías</h2>
                                        <ul class="lv-actions actions">
                                            <li >
                                                <input type="file" id="fileInventario5" name="fileIzquierdo[]" accept="image/*" style="display:none" onchange="subeFotoInventario(this)">
                                                <a href="" title='Agregar fotografía del lado derecho'  onclick="getFoto('fileInventario5');">
                                                    <i class="fa fa-camera"></i>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="" title='Seleccionar fotografías'  onclick="selectFotos('fotosIzquierdo');">
                                                    <i class="fa fa-check"></i>
                                                </a>
                                            </li>
                                            <li style="display:none;" id="delFotoIzq">
                                                <a href="" title='Eliminar fotografías seleccionadas'  onclick="delFotos('fotosIzquierdo');">
                                                    <i class="fa fa-trash-o"></i>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="o-auto"  style="max-height: 250px;">                     
                                        <div class="lightbox photos" id="fotosIzquierdo">
                                        </div>
                                    </div>
                            </div>
                            </div>
                            <hr>
                            </div>
                        </dd>
                        <dt class="c-blue f-700" style="cursor: pointer; " id="Derecho">LATERAL DERECHO<hr></dt>
                        <dd>
                            <div style="display: inline-block; width: 100%;">
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
                            <div class="col-sm-13 clearfix"></div>
                            <div class="col-sm-13 clearfix">
                                <div class="col-sm-13 clearfix">
                                    <div class="lv-header-alt clearfix m-b-5">
                                        <h2 class="lvh-label">Fotos del lado derecho, <span id="CuentaFotosDerecho">0</span> Fotografías</h2>
                                        <ul class="lv-actions actions">
                                            <li >
                                                <input type="file" id="fileInventario6" name="fileDerecho[]" accept="image/*" style="display:none" onchange="subeFotoInventario(this)">
                                                <a href="" title='Agregar fotografía del lado derecho'  onclick="getFoto('fileInventario6');">
                                                    <i class="fa fa-camera"></i>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="" title='Seleccionar fotografías'  onclick="selectFotos('fotosDerecho');">
                                                    <i class="fa fa-check"></i>
                                                </a>
                                            </li>
                                            <li style="display:none;" id="delFotoDer">
                                                <a href="" title='Eliminar fotografías seleccionadas'  onclick="delFotos('fotosDerecho');">
                                                    <i class="fa fa-trash-o"></i>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="o-auto"  style="max-height: 250px;">                     
                                        <div class="lightbox photos" id="fotosDerecho">
                                        </div>
                                    </div>
                            </div>
                            </div>
                            <hr>
                            </div>
                        </dd>
                        <dt class="c-blue f-700" style="cursor: pointer; " id="Cajuela">CAJUELA<hr></dt>
                        <dd>
                            <div style="display: inline-block; width: 100%;">
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
                            <div class="col-sm-13 clearfix"></div>
                            <div class="col-sm-13 clearfix">
                                <div class="col-sm-13 clearfix">
                                    <div class="lv-header-alt clearfix m-b-5">
                                        <h2 class="lvh-label">Fotos de la cajuela, <span id="CuentaFotosCajuela">0</span> Fotografías</h2>
                                        <ul class="lv-actions actions">
                                            <li >
                                                <input type="file" id="fileInventario7" name="fileCajuela[]" accept="image/*" style="display:none" onchange="subeFotoInventario(this)">
                                                <a href="" title='Agregar fotografía de la cajuela'  onclick="getFoto('fileInventario7');">
                                                    <i class="fa fa-camera"></i>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="" title='Seleccionar fotografías'  onclick="selectFotos('fotosCajuela');">
                                                    <i class="fa fa-check"></i>
                                                </a>
                                            </li>
                                            <li style="display:none;" id="delFotoCaj">
                                                <a href="" title='Eliminar fotografías seleccionadas'  onclick="delFotos('fotosCajuela');">
                                                    <i class="fa fa-trash-o"></i>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="o-auto"  style="max-height: 250px;">                     
                                        <div class="lightbox photos" id="fotosCajuela">
                                        </div>
                                    </div>
                            </div>
                            </div>
                            <hr>
                            </div>
                        </dd>
                        <dt class="c-blue f-700" style="cursor: pointer; " id="Otros">OTROS<hr></dt>
                        <dd>
                            <div style="display: inline-block; width: 100%;">
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
                            <div class="col-sm-13 clearfix"></div>
                            <div class="col-sm-13 clearfix">
                                <div class="col-sm-13 clearfix">
                                    <div class="lv-header-alt clearfix m-b-5">
                                        <h2 class="lvh-label">Fotos de otros, <span id="CuentaFotosOtros">0</span> Fotografías</h2>
                                        <ul class="lv-actions actions">
                                            <li >
                                                <input type="file" id="fileInventario8" name="fileOtros[]" accept="image/*" style="display:none" onchange="subeFotoInventario(this)">
                                                <a href="" title='Agregar fotografía de otros'  onclick="getFoto('fileInventario8');">
                                                    <i class="fa fa-camera"></i>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="" title='Seleccionar fotografías'  onclick="selectFotos('fotosOtros');">
                                                    <i class="fa fa-check"></i>
                                                </a>
                                            </li>
                                            <li style="display:none;" id="delFotoOtr">
                                                <a href="" title='Eliminar fotografías seleccionadas'  onclick="delFotos('fotosOtros');">
                                                    <i class="fa fa-trash-o"></i>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="o-auto"  style="max-height: 250px;">                     
                                        <div class="lightbox photos" id="fotosOtros">
                                        </div>
                                    </div>
                            </div>
                            </div>
                            <hr>
                            </div>
                        </dd>
                        <dt class="c-blue f-700" style="cursor: pointer; " id="dtLlaves">LLAVES<hr></dt>
                        <dd>
                            <div style="display: inline-block; width: 100%;">
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
                            <div class="col-sm-13 clearfix"></div>
                            <div class="col-sm-13 clearfix">
                                <div class="col-sm-13 clearfix">
                                    <div class="lv-header-alt clearfix m-b-5">
                                        <h2 class="lvh-label">Fotos de llaves, <span id="CuentaFotosLlaves">0</span> Fotografías</h2>
                                        <ul class="lv-actions actions">
                                            <li >
                                                <input type="file" id="fileInventario9" name="fileLlaves[]" accept="image/*" style="display:none" onchange="subeFotoInventario(this)">
                                                <a href="" title='Agregar fotografía de llaves'  onclick="getFoto('fileInventario9');">
                                                    <i class="fa fa-camera"></i>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="" title='Seleccionar fotografías'  onclick="selectFotos('fotosLlaves');">
                                                    <i class="fa fa-check"></i>
                                                </a>
                                            </li>
                                            <li style="display:none;" id="delFotoLlav">
                                                <a href="" title='Eliminar fotografías seleccionadas'  onclick="delFotos('fotosLlaves');">
                                                    <i class="fa fa-trash-o"></i>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="o-auto"  style="max-height: 250px;">                     
                                        <div class="lightbox photos" id="fotosLlaves">
                                        </div>
                                    </div>
                            </div>
                            </div>
                            <hr>
                            </div>
                        </dd>
                        <dt class="c-blue f-700" style="cursor: pointer; " id="dtLlantas">LLANTAS<hr></dt>
                        <dd>
                            <div style="display: inline-block; width: 100%;">
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
                            <div class="col-sm-13 clearfix"></div>
                            <div class="col-sm-13 clearfix">
                                <div class="col-sm-13 clearfix">
                                    <div class="lv-header-alt clearfix m-b-5">
                                        <h2 class="lvh-label">Fotos de llantas, <span id="CuentaFotosLlantas">0</span> Fotografías</h2>
                                        <ul class="lv-actions actions">
                                            <li >
                                                <input type="file" id="fileInventario10" name="fileLlantas[]" accept="image/*" style="display:none" onchange="subeFotoInventario(this)">
                                                <a href="" title='Agregar fotografía de llantas'  onclick="getFoto('fileInventario10');">
                                                    <i class="fa fa-camera"></i>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="" title='Seleccionar fotografías'  onclick="selectFotos('fotosLlantas');">
                                                    <i class="fa fa-check"></i>
                                                </a>
                                            </li>
                                            <li style="display:none;" id="delFotoLlan">
                                                <a href="" title='Eliminar fotografías seleccionadas'  onclick="delFotos('fotosLlantas');">
                                                    <i class="fa fa-trash-o"></i>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="o-auto"  style="max-height: 250px;">                     
                                        <div class="lightbox photos" id="fotosLlantas">
                                        </div>
                                    </div>
                            </div>
                            </div>
                            <hr>
                            </div>
                        </dd>
                        <dt class="c-blue f-700" style="cursor: pointer; " id="dtPreexist">DAÑOS PREEXISTENTES<hr></dt>
                        <dd>
                            <div style="display: inline-block; width: 100%;">
                            <table  style="margin: 0px auto; width:100%">
                                <tr>
                                   <td style="padding:5px; margin:2px; background-color: #eee;">
                                   <textarea rows="5" cols="50" class="form-control" name="descDanosPreexist" style="padding-left:2px; padding-right: 2px;"></textarea>
                                   </td>
                               </tr>
                            </table>
                            <div class="col-sm-13 clearfix"></div>
                            <div class="col-sm-13 clearfix">
                                <div class="col-sm-13 clearfix">
                                    <div class="lv-header-alt clearfix m-b-5">
                                        <h2 class="lvh-label">Fotos de daños preexistentes, <span id="CuentaFotosPreexist">0</span> Fotografías</h2>
                                        <ul class="lv-actions actions">
                                            <li >
                                                <input type="file" id="fileInventario11" name="filePreexist[]" accept="image/*" style="display:none" onchange="subeFotoInventario(this)">
                                                <a href="" title='Agregar fotografía de daños preexistentes'  onclick="getFoto('fileInventario11');">
                                                    <i class="fa fa-camera"></i>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="" title='Seleccionar fotografías'  onclick="selectFotos('fotosPreexist');">
                                                    <i class="fa fa-check"></i>
                                                </a>
                                            </li>
                                            <li style="display:none;" id="delFotoPre">
                                                <a href="" title='Eliminar fotografías seleccionadas'  onclick="delFotos('fotosPreexist');">
                                                    <i class="fa fa-trash-o"></i>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="o-auto"  style="max-height: 250px;">                     
                                        <div class="lightbox photos" id="fotosPreexist">
                                        </div>
                                    </div>
                            </div>
                            </div>
                            <hr>
                            </div>
                        </dd>
                        <dt class="c-blue f-700" style="cursor: pointer; " id="dtObserv">OBSERVACIONES<hr></dt>
                        <dd>
                            <div style="display: inline-block; width: 100%;">
                            <table  style="margin: 0px auto; width:100%">
                                <tr>
                                   <td style="padding:5px; margin:2px; background-color: #eee;">
                                   <textarea rows="5" cols="50" class="form-control" name="observaciones" style="padding-left:2px; padding-right: 2px;"></textarea>
                                   </td>
                               </tr>
                            </table>
                            <hr>
                            </div>
                        </dd>
                        <dt class="c-blue f-700" style="cursor: pointer; " id="dtArticulos">ARTÍCULOS RESGUARDADOS<hr></dt>
                        <dd>
                            <div style="display: inline-block; width: 100%;">
                            <table  style="margin: 0px auto; width:100%">
                                <tr>
                                   <td style="padding:5px; margin:2px; background-color: #eee;">
                                   <textarea rows="5" cols="50" class="form-control" name="articulosResguardados" style="padding-left:2px; padding-right: 2px;"></textarea>
                                   </td>
                               </tr>
                            </table>
                            <hr>
                            </div>
                        </dd>
                    </dl>  
                </form> 
                <div class="col-sm-12 card-body card-padding" style="display:none;" id="botones">
                    <div class="col-sm-4">
                        <button type="button" class="btn btn-primary btn-sm m-t-10 waves-effect" style='width:120px;' onclick="guardar()">Guardar</button>                                                        
                    </div>                                                 
                    <div class="col-sm-4">
                        <label for="name"></label>
                    </div> 
                </div> 
            </section>            
            <div id="resultado"></div>
            </div>
        </div>
    </div>

    <div id="PrgrModal">
        <h1>Procesando...</h1>
        <div id="myProgress">
          <div id="myBar">10%</div>
        </div>
    </div>
</div>

<!-- PAGE FOOTER -->
<?php
    // include page footer
    include(SYSTEM_DIR . "/inc/footer.php");
?>
<!-- END PAGE FOOTER -->

<?php 
    //include required scripts
    include(SYSTEM_DIR.DIRECTORY_SEPARATOR."inc/scripts.php"); 
?>
<!-- ==========================CONTENT STARTS HERE ========================== -->
<script src="<?php echo ASSETS_URL; ?>/js/main.js"></script>
<script type="text/javascript" src="<?php echo ASSETS_URL; ?>/js/usuario.js"></script>
<script type="text/javascript" src="<?php echo ASSETS_URL; ?>/js/fotosInventario.js"></script>
<script type="text/javascript" src="<?php echo ASSETS_URL; ?>/js/altaInventario.js"></script>


<?php
    //include footer
    include(SYSTEM_DIR . "/inc/close-html.php");
?>
