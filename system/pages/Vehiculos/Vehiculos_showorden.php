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
$page_css[] = "vehiculo_style.css";
include(SYSTEM_DIR . "/inc/header.php");

//include left panel (navigation)
include(SYSTEM_DIR . "/inc/nav.php");
/* ---------------- END PHP Custom Scripts ------------- */


//include left panel (navigation)
if(isset($request['params']['id'])   && $request['params']['id']>0)
    $id=$request['params']['id'];
else
    informError(true,make_url("Vehiculo","index"));


$obj = new Vehiculo();
$data = $obj->getTable($id);
if ( !$data ) {
    informError(true,make_url("Vehiculo","index"));
}

$carpetaexpediente = $obj->getCarpetaexpediente($id);
$nomtaller      = "";
$nommarca       = "";
$nomsubmarca    = "";
$nomaseguradora = "";
$nomcliente     = "";
$domicilio      = "";
$telefono       = ""; 
$email          = ""; 
$nombreasesor   = "";
if($data["id_user"]){
    $objacesor = new User();
    $dataasesor = $objacesor->getTable($data["id_user"]);
    if($dataasesor){ $nombreasesor   = $dataasesor["nombre"] ." ". $dataasesor["apellido_pat"]; }
}
if($data["id_taller"]){
    $objtaller = new Taller();
    $datataller = $objtaller->getTable($data["id_taller"]);
    if($datataller){ $nomtaller = $datataller["nombre"]; }
}
if($data["id_marca"]){
    $objmarca = new Marca();
    $datamarca = $objmarca->getTable($data["id_marca"]);
    if($datamarca){ $nommarca = $datamarca["nombre"]; }
}
if($data["id_submarca"]){
    $objsubmarca = new SubMarca();
    $datasubmarca = $objsubmarca->getTable($data["id_submarca"]);
    if($datasubmarca){ $nomsubmarca = $datasubmarca["nombre"]; }
}
if($data["id_aseguradora"]){
    $objaseguradora = new Aseguradora();
    $dataaseguradora = $objaseguradora->getTable($data["id_aseguradora"]);
    if($dataaseguradora){ $nomaseguradora = $dataaseguradora["nombre"]; }
}
if($data["id_cliente"]){
    $objcliente = new Cliente();
    $datacliente = $objcliente->getTable($data["id_cliente"]);
    if($datacliente){
        $nomcliente = $datacliente["nombre"] ." ". $datacliente["apellido_pat"] ." ". $datacliente["apellido_mat"];
        $domicilio = $datacliente["ciudad"]." ".$datacliente["estado"]. " Col." .$datacliente["colonia"] ." Call." .$datacliente["calle"]." ".$datacliente["num_ext"]. " " .$datacliente["num_int"];
        $telefono = $datacliente["telefono"];
        $email = $datacliente["email"];
    }
}
$fechaalta = ($data['fecha_alta']) ?    date('Y-m-d',strtotime($data['fecha_alta'])) : "";
$fechaprom = ($data['fecha_promesa']) ? date('Y-m-d',strtotime($data['fecha_promesa'])) : "";
?>

   
<!-- ==========================CONTENT STARTS HERE ========================== -->
<!-- MAIN PANEL -->
<div id="main" role="main">
    <?php $breadcrumbs["Vehiculos"] = APP_URL."/Vehiculos"; include(SYSTEM_DIR . "/inc/ribbon.php"); ?>

    <!-- MAIN CONTENT -->
    <div id="content">
        <section id="widget-grid" class="">
            <div class="row">   
                <div class="widget-body" style='padding-left: 15px;'>
                    <a class="btn btn-success" target="_blank" href="<?php echo make_url("Vehiculos","print",array('id'=>$id,'page'=>'orden'))?>" ><i class="fa fa-print"></i>&nbsp;Imprimir</a>
                    <a class="btn btn-success" target="_blank" href="<?php echo make_url("Vehiculos","print",array('id'=>$id,'page'=>'presupuesto'))?>" ><i class="fa fa-print"></i>&nbsp;Imprimir Presupuesto</a>
                    <a class="btn btn-success" target="_blank" href="<?php echo make_url("Vehiculos","print",array('id'=>$id,'page'=>'cotizaciontrabajo'))?>" ><i class="fa fa-print"></i>&nbsp;Imprimir Cotizacion</a>
               
                    <a class="btn btn-info" href="<?php echo make_url("Vehiculos","view",array('id'=>$id)); ?>"> <i class="fa fa-eye"></i>&nbsp;Detalles</a>
             
                    <a class="btn btn-info" target='_blank' href="<?php echo make_url("Vehiculos","pdf",array('id'=>$id,'page'=>'orden')); ?>"> <i class="fa fa-eye"></i>&nbsp;PDF</a>
                </div>
            </div>
			<div class=""> &nbsp; </div>
            <div class="row" style="padding-top:20px">
                <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12 content-view">
                    <div class="jarviswidget jarviswidget-color-white" id="wid-id-0" data-widget-editbutton="false" data-widget-colorbutton="false" data-widget-deletebutton="true">
                        <header>
                            <span class="widget-icon"> <i class="fa fa-table"></i> </span>
                            <h2><?php echo $page_title ?></h2>
                        </header>
                        <div>
                            <div class="jarviswidget-editbox">
                            </div>
                            <div class="widget-body" style="overflow: auto;">
                                <table style="max-width:1280px; width:100%;">
                                    <tr>
                                        <td>
                                            <table>
                                                <tr>
                                                    <td height="100" style="width:15%;border:none;">
                                                        <img src="<?php echo ASSETS_URL; ?>/img/logo.png" border="0" height="80" width="160"/>
                                                    </td>
                                                    <td style="width:40%; text-align:center;border:none;">
                                                        <h3>MAXIMUS BODY SHOP S, RL DE CV</h3>
                                                        <p style=" line-height:1.0em; font-weight:bold;">CALZADA DEL HUESO #777<br />
                                                            COLONIA: GRANJAS COAPA
                                                            DEL, TLALPAN C.P. 14330<br />
                                                            Tel.: (52)(55)56 03-1783 Correo:taller@maximus.mx<br>
                                                            Horario de Servicio: L-V 09 Hrs. a 18 Hrs.<br>
                                                            Sabado  09 Hrs. a 18 Hrs.
                                                        </p>
                                                    </td>
                                                    <td style="width:32%;border:none;">
                                                        <table style="width:100%; text-align:center;">
                                                            <tr>
                                                                <td style="background-color:#d0d0cf; font-weight:bold; text-align:left; width:40%;">Orden No.:</td><td colspan="2" style="color:red;"><?php echo $data["id"]; ?></td>
                                                            </tr>
                                                           
                                                            <tr>
                                                                <td style="background-color:#d0d0cf; font-weight:bold; text-align:left; width:30%;">Fecha</td>
                                                                <td colspan="2" style=""><?php echo $fechaalta; ?></td>
                                                            </tr>
                                                           <tr>
                                                                <td style="background-color:#d0d0cf; font-weight:bold; text-align:left; width:30%;"> Acesor </td><td colspan="2"><?php echo htmlentities($nombreasesor); ?></td>
                                                            </tr>

                                                            <tr>
                                                                <td style="background-color:#d0d0cf; font-weight:bold; text-align:left; width:30%;"> Torre </td><td colspan="2"><?php echo htmlentities($nomtaller); ?></td>
                                                            </tr>
                                                            <?php 
                                                            if($nomaseguradora){
                                                                ?>
                                                                <tr>
                                                                    <td style="background-color:#d0d0cf; font-weight:bold; text-align:left; width:30%;"> Aseguradora </td><td colspan="2"><?php echo htmlentities($nomaseguradora); ?></td>
                                                                </tr>
                                                            <?php
                                                            }?>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>
                                            <table style="width:100%;">
                                                <tr>
                                                    <td colspan="8" style="width:20%;background-color:#d0d0cf; font-weight:bold; text-align: center">DATOS DEL CLIENTE </td>
                                                </tr>
                                                <tr>
                                                    <td colspan="2" style="width:20%;background-color:#d0d0cf; font-weight:bold;">Nombre: </td><td colspan="2" style="width:30%;"><?php echo htmlentities($nomcliente); ?></td><td colspan="2" style="width:20%;background-color:#d0d0cf; font-weight:bold;">Fecha Promesa: </td><td colspan="2"><?php echo $fechaprom; ?></td>
                                                </tr>
                                                <tr>
                                                    <td colspan="2" style="width:20%;background-color:#d0d0cf; font-weight:bold;">Domicilio: </td><td colspan="6"><?php echo htmlentities($domicilio) ; ?></td>
                                                </tr>
                                                <tr>
                                                    <td colspan="2" style="width:20%;background-color:#d0d0cf; font-weight:bold;">Tel.: </td><td colspan="2" style="width:30%;"><?php echo htmlentities($telefono) ?></td><td colspan="2" style="width:20%;background-color:#d0d0cf; font-weight:bold;">Email : </td><td colspan="2"><?php echo htmlentities($email); ?></td>
                                                </tr>
                                                 <tr>
                                                    <td colspan="8" style="width:20%;background-color:#d0d0cf; font-weight:bold; text-align: center">DATOS DEL VEHICULO : </td>
                                                </tr>
                                                <tr>
                                                    <td colspan="" style="width:10%;background-color:#d0d0cf; font-weight:bold;">Marca: </td>
                                                    <td colspan="" style="width:10%;"><?php echo htmlentities($nommarca) ?></td>
                                                    <td colspan="" style="width:10%;background-color:#d0d0cf; font-weight:bold;">Modelo : </td>
                                                    <td colspan="" style="width:10%;"><?php echo htmlentities($nomsubmarca) ?></td>
                                                    <td colspan="" style="width:10%;background-color:#d0d0cf; font-weight:bold;">Año: </td>
                                                    <td colspan="" style="width:10%;"><?php echo htmlentities($data['modelo'])  ?></td>
                                                    <td colspan="" style="width:10%;background-color:#d0d0cf; font-weight:bold;">Vin : </td>
                                                    <td colspan="" style="width:20%;"><?php echo htmlentities($data['vin']); ?></td>
                                                </tr>
                                                <tr>
                                                    <td colspan="" style="width:10%;background-color:#d0d0cf; font-weight:bold;">Placas: </td>
                                                    <td colspan="" style="width:10%;"><?php echo htmlentities($data['placas_num']) ?></td>
                                                    <td colspan="" style="width:10%;background-color:#d0d0cf; font-weight:bold;">Color : </td>
                                                    <td colspan="" style="width:10%;"><?php echo htmlentities($data['color']) ?></td>
                                                    <td colspan="" style="width:10%;background-color:#d0d0cf; font-weight:bold;">Kilometraje: </td>
                                                    <td colspan="" style="width:10%;"><?php echo htmlentities($data['kilometraje']) ?></td>
                                                    <td colspan="" style="width:10%;background-color:#d0d0cf; font-weight:bold;">Matricula : </td>
                                                    <td colspan="" style="width:20%;"><?php echo htmlentities($data['matricula'])  ?></td>
                                                </tr>
                                                <tr>
                                                    <td colspan="8">
                                                        <table style="width: 100%">
                                                            <tr>
                                                                <td colspan="" style="width:10%;background-color:#d0d0cf; font-weight:bold;">Transmision</td>
                                                                <td colspan="" style="width:10%;background-color:#d0d0cf; font-weight:bold;">A/C</td>
                                                                <td colspan="" style="width:10%;background-color:#d0d0cf; font-weight:bold;">Vestiduras</td>
                                                                <td colspan="" style="width:10%;background-color:#d0d0cf; font-weight:bold;">Int. Ele.</td>
                                                                <td colspan="" style="width:10%;background-color:#d0d0cf; font-weight:bold;">Tipo Rin.</td>
                                                                <td colspan="" style="width:10%;background-color:#d0d0cf; font-weight:bold;">Tipo Dir.</td>
                                                                <td colspan="" style="width:10%;background-color:#d0d0cf; font-weight:bold;">Gasolina</td>
                                                            </tr> 
                                                            <tr>
                                                                <td colspan="" style="width:10%;"><?php echo htmlentities($data['TransmisionTipo'])  ?></td>
                                                                <td colspan="" style="width:10%;"><?php echo htmlentities($data['FuncionamientoAC'])  ?></td>
                                                                <td colspan="" style="width:10%;"><?php echo htmlentities($data['VestidurasTipo'])  ?></td>
                                                                <td colspan="" style="width:10%;"><?php echo htmlentities($data['InteriorTipo'])  ?></td>
                                                                <td colspan="" style="width:10%;"><?php echo htmlentities($data['RinTipo'])  ?></td>
                                                                <td colspan="" style="width:10%;"><?php echo htmlentities($data['DirTipo'])  ?></td>
                                                                <td colspan="" style="width:10%;"><?php echo htmlentities($data['Gasolina'])  ?></td>
                                                            </tr> 
                                                        </table>
                                                    </td>
                                                </tr>
                                                
                                            </table>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <table style="width:100%;    border-spacing: 0px;">
                                                <tr>
                                                    <td colspan="8" style="width:20%;background-color:#d0d0cf; font-weight:bold; text-align: center">INVENTARIO </td>
                                                </tr>
                                                <tr>
                                                    <td class="td-inventario">
                                                        <table style="height: 100%">
                                                            <tr>
                                                                <td colspan="4" style="width:20%;background-color:#d0d0cf; font-weight:bold; text-align: center">Exteriores </td>
                                                            </tr>
                                                            <tr>
                                                                <td colspan="" style="width:10%;background-color:#d0d0cf; font-weight:bold;">Faros: </td>
                                                                <td colspan="" style="width:10%;"><?php echo htmlentities($data['Faros'])  ?></td>
                                                                <td colspan="" style="width:10%;background-color:#d0d0cf; font-weight:bold;">Llantas: </td>
                                                                <td colspan="" style="width:10%;"><?php echo htmlentities($data['Llantas'])  ?></td>
                                                            </tr>
                                                            <tr>
                                                                <td colspan="" style="width:10%;background-color:#d0d0cf; font-weight:bold;">1/4 Luces : </td>
                                                                <td colspan="" style="width:10%;"><?php  echo htmlentities($data['Lucesch']) ?></td>
                                                                <td colspan="" style="width:10%;background-color:#d0d0cf; font-weight:bold;">Tapones Ctro-Rin : </td>
                                                                <td colspan="" style="width:10%;"><?php echo htmlentities($data['Taponesrin'])  ?></td>
                                                            </tr>
                                                            <tr>
                                                                <td colspan="" style="width:10%;background-color:#d0d0cf; font-weight:bold;">Antena: </td>
                                                                <td colspan="" style="width:10%;"><?php echo htmlentities($data['Antena'])  ?></td>
                                                                <td colspan="" style="width:10%;background-color:#d0d0cf; font-weight:bold;">Molduras: </td>
                                                                <td colspan="" style="width:10%;"><?php echo htmlentities($data['Molduras'])  ?></td>
                                                            </tr>
                                                            <tr>
                                                                <td colspan="" style="width:10%;background-color:#d0d0cf; font-weight:bold;">Espejos Laterales : </td>
                                                                <td colspan="" style="width:20%;"><?php echo htmlentities($data['EspejosLaterales'])  ?></td>
                                                                <td colspan="" style="width:10%;background-color:#d0d0cf; font-weight:bold;">Tapon Gasolina : </td>
                                                                <td colspan="" style="width:20%;"><?php echo htmlentities($data['TaponGasolina'])  ?></td>
                                                            </tr>
                                                            <tr>
                                                                <td colspan="" style="width:10%;background-color:#d0d0cf; font-weight:bold;">Cristales  </td>
                                                                <td colspan="" style="width:20%;"><?php echo htmlentities($data['Cristales'])  ?></td>
                                                                <td colspan="" style="width:10%;background-color:#d0d0cf; font-weight:bold;">Calaveras
                                                                </td>
                                                                <td colspan="" style="width:20%;"><?php echo htmlentities($data['Calaveras'])  ?></td>
                                                            </tr>
                                                            <tr>
                                                                <td colspan="" style="width:10%;background-color:#d0d0cf; font-weight:bold;">Emblemas : </td>
                                                                <td colspan="" style="width:20%;"><?php echo htmlentities($data['Emblemas'])  ?></td>
                                                                <td colspan="" style="width:10%;background-color:#d0d0cf; font-weight:bold;">Faros de niebla : </td>
                                                                <td colspan="" style="width:20%;"><?php echo htmlentities($data['FarosNiebla'])  ?></td>
                                                            </tr>
                                                            <tr>
                                                                <td colspan="1" style="width:20%;background-color:#d0d0cf; font-weight:bold; text-align: ">Comentarios: </td>
                                                                <td colspan="3" style="width:20%;"><?php echo htmlentities($data['ComentariosExt'])  ?></td>
                                                            </tr>
                                                        </table>
                                                    </td>
                                                    <td  class="td-inventario">
                                                        <table style="height: 100%">
                                                            <tr>
                                                                <td colspan="4" style="width:20%;background-color:#d0d0cf; font-weight:bold; text-align: center">Interiores </td>
                                                            </tr>
                                                            <tr>
                                                                <td colspan="" style="width:10%;background-color:#d0d0cf; font-weight:bold;">Limpiadores: </td>
                                                                <td colspan="" style="width:10%;"><?php echo htmlentities($data['Limpiadores'])  ?></td>
                                                                <td colspan="" style="width:10%;background-color:#d0d0cf; font-weight:bold;">Cenicero: </td>
                                                                <td colspan="" style="width:10%;"><?php echo htmlentities($data['Cenicero'])  ?></td>
                                                            </tr>
                                                            <tr>
                                                                <td colspan="" style="width:10%;background-color:#d0d0cf; font-weight:bold;">Flasher: </td>
                                                                <td colspan="" style="width:10%;"><?php echo htmlentities($data['Flasher'])  ?></td>
                                                                <td colspan="" style="width:10%;background-color:#d0d0cf; font-weight:bold;">Cinturones : </td>
                                                                <td colspan="" style="width:10%;"><?php echo htmlentities($data['Cinturones'])  ?></td>
                                                            </tr>
                                                            <tr>
                                                                <td colspan="" style="width:10%;background-color:#d0d0cf; font-weight:bold;">Calefaccion: </td>
                                                                <td colspan="" style="width:10%;"><?php echo htmlentities($data['Calefaccion'])  ?></td>
                                                                <td colspan="" style="width:10%;background-color:#d0d0cf; font-weight:bold;">Reclinables: </td>
                                                                <td colspan="" style="width:10%;"><?php echo htmlentities($data['Reclinables'])  ?></td>
                                                            </tr>
                                                            <tr>
                                                                <td colspan="" style="width:10%;background-color:#d0d0cf; font-weight:bold;">Radio : </td>
                                                                <td colspan="" style="width:20%;"><?php echo htmlentities($data['Radio'])  ?></td>
                                                                <td colspan="" style="width:10%;background-color:#d0d0cf; font-weight:bold;">Tapetes: </td>
                                                                <td colspan="" style="width:20%;"><?php echo htmlentities($data['Tapetes'])  ?></td>
                                                            </tr>
                                                            <tr>
                                                                <td colspan="" style="width:10%;background-color:#d0d0cf; font-weight:bold;">Encendedor : </td>
                                                                <td colspan="" style="width:20%;"><?php echo htmlentities($data['Encendedor'])  ?></td>
                                                                <td colspan="" style="width:10%;background-color:#d0d0cf; font-weight:bold;">Vestiduras  </td>
                                                                <td colspan="" style="width:20%;"><?php echo htmlentities($data['Vestiduras'])  ?></td>
                                                            </tr>
                                                            <tr>
                                                                <td colspan="" style="width:10%;background-color:#d0d0cf; font-weight:bold;">Retrovisor : </td>
                                                                <td colspan="" style="width:20%;"><?php echo htmlentities($data['Retrovisor'])  ?></td>
                                                                <td colspan="" style="width:10%;background-color:#d0d0cf; font-weight:bold;">Guantera: </td>
                                                                <td colspan="" style="width:20%;"><?php echo htmlentities($data['Guantera'])  ?></td>
                                                            </tr>
                                                            <tr>
                                                                <td colspan="1" style="width:20%;background-color:#d0d0cf; font-weight:bold; text-align: ">Comentarios: </td>
                                                                <td colspan="3" style="width:20%;"><?php echo htmlentities($data['ComentariosInt'])  ?></td>
                                                            </tr>
                                                        </table>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <table style="height: 100%">
                                                            <tr>
                                                                <td colspan="4" style="width:20%;background-color:#d0d0cf; font-weight:bold; text-align: center">Accesorios </td>
                                                            </tr>
                                                            <tr>
                                                                <td colspan="" style="width:10%;background-color:#d0d0cf; font-weight:bold;">Gato: </td>
                                                                <td colspan="" style="width:10%;"><?php  echo htmlentities($data['Gato'])  ?></td>
                                                                <td colspan="" style="width:10%;background-color:#d0d0cf; font-weight:bold;">Llanta de Refaccion: </td>
                                                                <td colspan="" style="width:10%;"><?php echo htmlentities($data['LlantaRefaccion'])   ?></td>
                                                            </tr>
                                                            <tr>
                                                                <td colspan="" style="width:10%;background-color:#d0d0cf; font-weight:bold;">Maneral de gato : </td>
                                                                <td colspan="" style="width:10%;"><?php echo htmlentities($data['ManeralGato'])   ?></td>
                                                                <td colspan="" style="width:10%;background-color:#d0d0cf; font-weight:bold;">Control Alarma : </td>
                                                                <td colspan="" style="width:10%;"><?php echo htmlentities($data['AlarmaControl'])   ?></td>
                                                            </tr>
                                                            <tr>
                                                                <td colspan="" style="width:10%;background-color:#d0d0cf; font-weight:bold;">Llave de ruedas: </td>
                                                                <td colspan="" style="width:10%;"><?php  echo htmlentities($data['LlavedeLlantas'])  ?></td>
                                                                <td colspan="" style="width:10%;background-color:#d0d0cf; font-weight:bold;">Equipo A/V: </td>
                                                                <td colspan="" style="width:10%;"><?php echo htmlentities($data['EquipoAV'])   ?></td>
                                                            </tr>
                                                            <tr>
                                                                <td colspan="" style="width:10%;background-color:#d0d0cf; font-weight:bold;">Kit Herramientas </td>
                                                                <td colspan="" style="width:20%;"><?php echo htmlentities($data['Herramientas'])   ?></td>
                                                                <td colspan="" style="width:10%;background-color:#d0d0cf; font-weight:bold;">Cables P/C  </td>
                                                                <td colspan="" style="width:20%;"><?php echo htmlentities($data['CablesPasaCorriente'])   ?></td>
                                                            </tr>
                                                            <tr>
                                                                <td colspan="" style="width:10%;background-color:#d0d0cf; font-weight:bold;">Reflejantes  </td>
                                                                <td colspan="" style="width:20%;"><?php echo htmlentities($data['SenalesReflejantes'])   ?></td>
                                                                <td colspan="" style="width:10%;background-color:#d0d0cf; font-weight:bold;">Dado de seguridad
                                                                </td>
                                                                <td colspan="" style="width:20%;"><?php echo htmlentities($data['DadoSeg'])   ?></td>
                                                            </tr>
                                                            <tr>
                                                                <td colspan="" style="width:10%;background-color:#d0d0cf; font-weight:bold;">Extintor : </td>
                                                                <td colspan="" style="width:20%;"><?php echo htmlentities($data['Extinguidor'])   ?></td>
                                                                <td colspan="" style="width:10%;background-color:#d0d0cf; font-weight:bold;"></td>
                                                                <td colspan="" style="width:20%;"></td>
                                                            </tr>
                                                            <tr>
                                                                <td colspan="1" style="width:20%;background-color:#d0d0cf; font-weight:bold; text-align: ">Comentarios: </td>
                                                                <td colspan="3" style="width:20%;"><?php echo htmlentities($data['ComentariosAcces'])   ?></td>
                                                            </tr>
                                                        </table>
                                                    </td>
                                                    <td>
                                                        <table style="height: 100%">
                                                            <tr>
                                                                <td colspan="2" style="width:20%;background-color:#d0d0cf; font-weight:bold; text-align: center">Componentes Mecanicos </td>
                                                                <td colspan="2" style="width:20%;background-color:#d0d0cf; font-weight:bold; text-align: center">Documentos </td>
                                                            </tr>
                                                            <tr>
                                                                <td colspan="" style="width:10%;background-color:#d0d0cf; font-weight:bold;">Tapon de Aceite: </td>
                                                                <td colspan="" style="width:10%;"><?php echo htmlentities($data['TaponAceite'])   ?></td>
                                                                <td colspan="" style="width:10%;background-color:#d0d0cf; font-weight:bold;">Tarjeta de Circulacion: </td>
                                                                <td colspan="" style="width:10%;"><?php echo htmlentities($data['TarjetaCirc'])   ?></td>
                                                            </tr>
                                                            <tr>
                                                                <td colspan="" style="width:10%;background-color:#d0d0cf; font-weight:bold;">Tapon Dir. HD: </td>
                                                                <td colspan="" style="width:10%;"><?php  echo htmlentities($data['TaponDirHD'])  ?></td>
                                                                <td colspan="" style="width:10%;background-color:#d0d0cf; font-weight:bold;">Poliza seguro: </td>
                                                                <td colspan="" style="width:10%;"><?php echo htmlentities($data['PolizaSeg']) ."<br>".htmlentities($data['PolizaNum'])   ?></td>
                                                            </tr>
                                                            <tr>
                                                                <td colspan="" style="width:10%;background-color:#d0d0cf; font-weight:bold;">Tapon Dep. Frenos: </td>
                                                                <td colspan="" style="width:10%;"><?php  echo htmlentities($data['TaponDepFrenos'])  ?></td>
                                                                <td colspan="" style="width:10%;background-color:#d0d0cf; font-weight:bold;">Manual Propietario: </td>
                                                                <td colspan="" style="width:10%;"><?php echo htmlentities($data['ManualProp'])   ?></td>
                                                            </tr>
                                                            <tr>
                                                                <td colspan="" style="width:10%;background-color:#d0d0cf; font-weight:bold;">Tapon Limpiaparabrisas: </td>
                                                                <td colspan="" style="width:20%;"><?php  echo htmlentities($data['TaponLimpiaparabrisas'])  ?></td>
                                                                <td colspan="" style="width:10%;background-color:#d0d0cf; font-weight:bold;">Talon Verificacion: </td>
                                                                <td colspan="" style="width:20%;"><?php echo htmlentities($data['TalonVerif'])   ?></td>
                                                            </tr>
                                                            <tr>
                                                                <td colspan="" style="width:10%;background-color:#d0d0cf; font-weight:bold;">Bateria : </td>
                                                                <td colspan="" style="width:20%;"><?php echo htmlentities($data['Bateria'])."<br>".htmlentities($data['MarcaBateria'])  ?></td>
                                                                <td colspan="" style="width:10%;background-color:#d0d0cf; font-weight:bold;">No. de Reporte  </td>
                                                                <td colspan="" style="width:20%;"><?php echo htmlentities($data['ReporteNum'])  ?></td>
                                                            </tr>
                                                            <tr>
                                                                <td colspan="" style="width:10%;background-color:#d0d0cf; font-weight:bold;">Claxon : </td>
                                                                <td colspan="" style="width:20%;"><?php echo htmlentities($data['Claxon'])   ?></td>
                                                                <td colspan="" style="width:10%;background-color:#d0d0cf; font-weight:bold;">No. de Siniestro  </td>
                                                                <td colspan="" style="width:20%;"><?php echo htmlentities($data['siniestro'])  ?></td>
                                                            </tr>
                                                            <tr>
                                                                <td colspan="" style="width:10%;background-color:#d0d0cf; font-weight:bold;"> </td>
                                                                <td colspan="" style="width:20%;"></td>
                                                                <td colspan="" style="width:10%;background-color:#d0d0cf; font-weight:bold;">Deducible  </td>
                                                                <td colspan="" style="width:20%;"><?php echo htmlentities($data['deducible'])  ?></td>
                                                            </tr>
                                                            <tr>
                                                             
                                                                <td colspan="2" style="width:20%;"><?php echo htmlentities($data['ComentariosComp'])   ?></td>
                                                                <td colspan="2" style="width:20%;"><?php echo htmlentities($data['ComentariosDoc'])   ?></td>
                                                            </tr>
                                                        </table>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <table style="height: 100%">
                                                            <tr>
                                                                <td colspan="6" style="width:20%;background-color:#d0d0cf; font-weight:bold; text-align: center">Refacciones </td>
                                                            </tr>
                                                            <tr>
                                                                <td colspan="" style="width:10%;background-color:#d0d0cf; font-weight:bold;">Status</td>
                                                                <td colspan="" style="width:10%;background-color:#d0d0cf; font-weight:bold;">Cant</td>
                                                                <td colspan="" style="width:10%;background-color:#d0d0cf; font-weight:bold;">Refaccion</td>
                                                                <td colspan="" style="width:10%;background-color:#d0d0cf; font-weight:bold;">Costo</td>
                                                                <td colspan="" style="width:10%;background-color:#d0d0cf; font-weight:bold;">Total</td>
                                                                <td colspan="" style="width:10%;background-color:#d0d0cf; font-weight:bold;">Fecha</td>
                                                            </tr>
                                                            <?php 
                                                            $objref = new VehiculoRefaccion();
                                                            $dataref = $objref->getAllArr($id);
                                                            $totalrefaccion = 0 ;
                                                            foreach($dataref as $row) {
                                                                $totalrefaccion+= $row['total_aprox'];  
                                                                $nombre = $row['nombre'] ;
                                                                if($row['detalles']){
                                                                    $nombre=$row['detalles'];
                                                                } 
                                                                $status = htmlentities($row['status']);
                                                                switch ($row['status']) {
                                                                    case 'active':
                                                                        $status = 'Pendiente';
                                                                        $class  = 'label label-danger';
                                                                        break;
                                                                    case 'Realizado':
                                                                        $class  = 'label label-success';
                                                                        break;
                                                                    case 'Stand-By':
                                                                        $class  = 'label label-warning';
                                                                        break;
                                                                    default:
                                                                        $class  = '';
                                                                        break;
                                                                } 
                                                            ?>
                                                            <tr>
                                                                <td><?php echo $status; ?></td>
                                                                <td><?php echo htmlentities($row['cantidad']); ?></td>
                                                                <td><?php echo htmlentities($nombre); ?></td>
                                                                <td><?php echo htmlentities($row['costo_aprox']); ?></td>
                                                                <td><?php echo htmlentities($row['total_aprox']); ?></td>
                                                                <td><?php echo date("Y-m-d",strtotime($row['created_date'])); ?></td>
                                                            </tr>

                                                            <?php
                                                            } 
                                                            ?>
                                                            <tr>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td style='font-weight:bold;'>Total:</td>
                                                                <td><strong><?php echo $totalrefaccion; ?></strong></td>
                                                                <td></td>
                                                            </tr>
                                                           
                                                        </table>
                                                    </td>
                                                    <td>
                                                        <table style="height: 100%">
                                                            <tr>
                                                                <td colspan="5" style="width:20%;background-color:#d0d0cf; font-weight:bold; text-align: center">Servicios </td>
                                                            </tr>
                                                            <tr>
                                                                <td colspan="" style="width:10%;background-color:#d0d0cf; font-weight:bold;">Status</td>
                                                                <td colspan="" style="width:10%;background-color:#d0d0cf; font-weight:bold;">Codigo</td>
                                                                <td colspan="" style="width:10%;background-color:#d0d0cf; font-weight:bold;">Servicio</td>
                                                                <td colspan="" style="width:10%;background-color:#d0d0cf; font-weight:bold;">Total</td>
                                                                <td colspan="" style="width:10%;background-color:#d0d0cf; font-weight:bold;">Fecha</td>
                                                            </tr>
                                                            <?php 
                                                            $objser = new VehiculoServicio();
                                                            $dataser = $objser->getAllArr($id);
                                                            $totalservicio = 0 ;
                                                            foreach($dataser as $row) {
                                                                $totalservicio+= $row['total'];   
                                                                $nombre = $row['nombre'] ;
                                                                if($row['detalles']){
                                                                    $nombre=$row['detalles'];
                                                                }
                                                                $status = htmlentities($row['status']);
                                                                switch ($row['status']) {
                                                                    case 'active':
                                                                        $status = 'Pendiente';
                                                                        $class  = 'label label-danger';
                                                                        break;
                                                                    case 'Realizado':
                                                                        $class  = 'label label-success';
                                                                        break;
                                                                    case 'Stand-By':
                                                                        $class  = 'label label-warning';
                                                                        break;
                                                                    default:
                                                                        $class  = '';
                                                                        break;
                                                                } 
                                                            ?>
                                                            <tr>
                                                                <td><?php echo $status; ?></td>
                                                                <td><?php echo htmlentities($row['codigo']); ?></td>
                                                                <td><?php echo htmlentities($nombre); ?></td>
                                                                <td><?php echo htmlentities($row['total']); ?></td>
                                                                <td><?php echo date("Y-m-d",strtotime($row['created_date'])); ?></td>
                                                            </tr>

                                                            <?php
                                                            } 
                                                            ?>
                                                            <tr>
                                                                <td></td>
                                                                <td></td>
                                                                <td style='font-weight:bold;'>Total:</td>
                                                                <td><strong><?php echo $totalservicio; ?></strong></td>
                                                                <td></td>
                                                            </tr>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                </table>
                                <div class="superbox col-sm-12">
                                    
                                    <?php 
                                    $carpetaimg = ASSETS_URL.'/'.$carpetaexpediente.'/auto'.DIRECTORY_SEPARATOR.'auto_'.$id.DIRECTORY_SEPARATOR.'images';
                                    $objimg = new ImagenesVehiculo();
                                    $dataimagenes = $objimg->getAllArr($id);

                                    foreach($dataimagenes as $row) {
                                        echo "<div class='superbox-list'>
                                                <img src='".$carpetaimg.DIRECTORY_SEPARATOR.$row['nombre']."' 
                                                data-img='".$carpetaimg.DIRECTORY_SEPARATOR.$row['nombre']."'
                                                alt='".$row['nombre']."' title='".$row['nombre']."'
                                                max-width='150px'  max-height='150px'
                                                class='superbox-img'>
                                            </div>";

                                    }
                                    ?>          
                                </div>

                            </div>
                        </div>
                    </div>
                </article>
            </div>
        </section>
    </div>
    <!-- END MAIN CONTENT -->
</div>
<div class="modal fade" id="showPhoto" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Visor de Imagenes</h4>
      </div>
      <div class="modal-body">
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

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

<!-- PAGE RELATED PLUGIN(S) -->
<script src="<?php echo ASSETS_URL; ?>/js/plugin/superbox/superbox.min.js"></script>

<script>

    $(document).ready(function() {
        //$('.superbox').SuperBox();

        $(function(){
            $('.superbox-img').click(function(){
                $('#showPhoto .modal-body').html($(this).clone().attr("height","100%"));
                $('#showPhoto').modal('show');
            })
        });
        /*$('body').on('click', '.superbox-img', function(e){
            $('html,body').animate({
                scrollTop: $(".superbox-show").offset().top
            }, 1000);

        });
        */
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
