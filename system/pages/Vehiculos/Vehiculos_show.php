<?php
//initilize the page
require_once(SYSTEM_DIR . "/inc/init.php");
//require UI configuration (nav, ribbon, etc.)
require_once(SYSTEM_DIR . "/inc/config.ui.php");

/*---------------- PHP Custom Scripts ---------
YOU CAN SET CONFIGURATION VARIABLES HERE BEFORE IT GOES TO NAV, RIBBON, ETC.
E.G. $page_title = "Custom Title" */
$page_title = "Ver Auto";

/* ---------------- END PHP Custom Scripts ------------- */
$page_css[] = "your_style.css";
include(SYSTEM_DIR . "/inc/header.php");

//include left panel (navigation)
include(SYSTEM_DIR . "/inc/nav.php");
/* ---------------- END PHP Custom Scripts ------------- */


//include left panel (navigation)

$obj = new Vehiculo();
$data = $obj->getTable($id);
if ( !$data ) {
    informError(true,make_url("Vehiculo","index"));
}
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
?>

    <style>
        body { font-family:"Arial",sans-serif; font-size:11px;color:#666;}
        table td table td{ padding:4px 6px;border:1px solid #d0d0cf; line-height:1em; height:1em;}
        th {background-color:#d0d0cf; font-weight:bold;padding:4px 6px;border:1px solid #d0d0cf; line-height:1.5em; height:1em;}
        p { margin:0;}
        img{
            padding: 2.5px;
        }
       


.superbox {
    font-size: 0
}

.superbox-list {
    display: inline-block;
    width: 12.5%;
    margin: 0;
    position: relative
}

.superbox-list.active:after {
    content: '';
    position: absolute;
    left: 50%;
    bottom: 0;
    border: 10px solid transparent;
    border-bottom-color: #2d353c;
    margin-left: -10px
}

.superbox-show {
    text-align: center;
    position: relative;
    background: #2d353c;
    width: 100%;
    float: left;
    padding: 25px;
    display: none
}

.superbox-img {
    max-width: 100%;
    width: 100%;
    cursor: pointer
}

.superbox-current-img {
    -webkit-box-shadow: 0 5px 35px rgba(0, 0, 0, .65);
    box-shadow: 0 5px 35px rgba(0, 0, 0, .65);
    max-width: 100%
}

.superbox-img:hover {
    opacity: .8
}

.superbox-close {
    opacity: .7;
    cursor: pointer;
    position: absolute;
    top: 25px;
    right: 25px;
    background: url(assets/plugins/superbox/img/close.gif) center center no-repeat;
    width: 35px;
    height: 35px
}
        
    </style>
<!-- ==========================CONTENT STARTS HERE ========================== -->
<!-- MAIN PANEL -->
<div id="main" role="main">
    <?php $breadcrumbs["Vehiculos"] = APP_URL."/Vehiculos"; include(SYSTEM_DIR . "/inc/ribbon.php"); ?>

    <!-- MAIN CONTENT -->
    <div id="content">
        <section id="widget-grid" class="">
             <p><a class="btn btn-success" target="_blank" href="<?php echo make_url("Vehiculos","print",array('id'=>$id))?>" ><i class="fa fa-print"></i>Imprimir</a></p>
            <div class="row">
                <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
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
                                                                <td colspan="2" style=""><?php echo date("Y-m-d",strtotime($data["fecha_alta"])); ?></td>
                                                            </tr>
                                                           <tr>
                                                                <td style="background-color:#d0d0cf; font-weight:bold; text-align:left; width:30%;"> Acesor </td><td colspan="2"><?php echo htmlentities($nombreasesor); ?></td>
                                                            </tr>

                                                            <tr>
                                                                <td style="background-color:#d0d0cf; font-weight:bold; text-align:left; width:30%;"> Torre </td><td colspan="2"><?php echo htmlentities($nomtaller); ?></td>
                                                            </tr>
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
                                                    <td colspan="2" style="width:20%;background-color:#d0d0cf; font-weight:bold;">Nombre: </td><td colspan="2" style="width:30%;"><?php echo htmlentities($nomcliente); ?></td><td colspan="2" style="width:20%;background-color:#d0d0cf; font-weight:bold;">Fecha Promesa: </td><td colspan="2"><?php echo htmlentities($data['fecha_promesa']); ?></td>
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
                                                                <td colspan="1" style="width:20%;background-color:#d0d0cf; font-weight:bold; text-align: center">Comentarios </td>
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
                                                                <td colspan="1" style="width:20%;background-color:#d0d0cf; font-weight:bold; text-align: center">Comentarios </td>
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
                                                                <td colspan="1" style="width:20%;background-color:#d0d0cf; font-weight:bold; text-align: center">Comentarios </td>
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
                                                                <td colspan="" style="width:10%;"><?php echo htmlentities($data['PolizaSeg'])   ?></td>
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
                                                                <td colspan="" style="width:10%;background-color:#d0d0cf; font-weight:bold;">  </td>
                                                                <td colspan="" style="width:20%;"><?php  ?></td>
                                                            </tr>
                                                            <tr>
                                                                <td colspan="" style="width:10%;background-color:#d0d0cf; font-weight:bold;">Claxon : </td>
                                                                <td colspan="" style="width:20%;"><?php echo htmlentities($data['Claxon'])   ?></td>
                                                                <td colspan="" style="width:10%;background-color:#d0d0cf; font-weight:bold;"> </td>
                                                                <td colspan="" style="width:20%;"><?php ?></td>
                                                            </tr>
                                                            <tr>
                                                             
                                                                <td colspan="2" style="width:20%;"><?php echo htmlentities($data['ComentariosComp'])   ?></td>
                                                                <td colspan="2" style="width:20%;"><?php echo htmlentities($data['ComentariosDoc'])   ?></td>
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
                                    $carpetaimg = ASSETS_URL.'/expediente/auto'.DIRECTORY_SEPARATOR.'auto_'.$id.DIRECTORY_SEPARATOR.'images';
                                    $objimg = new ImagenesVehiculo();
                                    $dataimagenes = $objimg->getAllArr();

                                    foreach($dataimagenes as $row) {
                                        echo "<div class='superbox-list'>
                                                <img src='".$carpetaimg.DIRECTORY_SEPARATOR.$row['nombre']."' 
                                                data-img='".$carpetaimg.DIRECTORY_SEPARATOR.$row['nombre']."'
                                                alt='".$row['nombre']."' title='".$row['nombre']."'
                                                width='150px'  height='150px'
                                                class='superbox-img'
                                                >
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
