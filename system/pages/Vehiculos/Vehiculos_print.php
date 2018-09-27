<?php
//initilize the page
require_once(SYSTEM_DIR . "/inc/init.php");
//require UI configuration (nav, ribbon, etc.)
require_once(SYSTEM_DIR . "/inc/config.ui.php");

/*---------------- PHP Custom Scripts ---------
YOU CAN SET CONFIGURATION VARIABLES HERE BEFORE IT GOES TO NAV, RIBBON, ETC.
E.G. $page_title = "Custom Title" */
$page_title = "Autos";

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
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="images/favicon.ico" rel="shortcut icon">
    <title>Maximus Body Shop</title>
    <script type="text/javascript">
        window.print();
    </script>
    <style>
        body { font-family:"Arial",sans-serif; font-size:11px;color:#666;}
        table td table td{ padding:4px 6px;border:1px solid #d0d0cf; line-height:1em; height:1em;}
        th {background-color:#d0d0cf; font-weight:bold;padding:4px 6px;border:1px solid #d0d0cf; line-height:1.5em; height:1em;}
        p { margin:0;}
        .td-inventario{
                height: 0em;
        }
    </style>
</head>

<body>
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
<div style="width:90%; margin:0 auto;padding:1px 2px;border:1px solid #d0d0cf;">
    <p style="text-align:justify;">Los precios indicados en esta orden no incluyen IVA. No nos hacemos responsables por fallas mecanicas y electricas derivadas por el desgaste natural del vehiculo, ni por pertenencias olvidadas. El presente documento es expedido por el consumidor como pagare a favor del prestador del servicio el importe de este documento el dia de la entrega del vehiculo. Indispensable presentar identificacion oficial vigente para poder realizar la entrega del vehiculo.<br> No nos hacemos responsables por objetos personales olvidades en el vehiculo no reportados a recepcion, ni manifestado en el inventario. </p>
    <p></p>
</div>
</body>

</html>

<?php
//------    CONVERTIR NUMEROS A LETRAS         ---------------
//------    Máxima cifra soportada: 18 dígitos con 2 decimales
//------    999,999,999,999,999,999.99
// NOVECIENTOS NOVENTA Y NUEVE MIL NOVECIENTOS NOVENTA Y NUEVE BILLONES
// NOVECIENTOS NOVENTA Y NUEVE MIL NOVECIENTOS NOVENTA Y NUEVE MILLONES
// NOVECIENTOS NOVENTA Y NUEVE MIL NOVECIENTOS NOVENTA Y NUEVE PESOS 99/100 M.N.
//------    Creada por:                        ---------------
//------             ULTIMINIO RAMOS GALÁN     ---------------
//------            uramos@gmail.com           ---------------
//------    10 de junio de 2009. México, D.F.  ---------------
//------    PHP Version 4.3.1 o mayores (aunque podría funcionar en versiones anteriores, tendrías que probar)
function numtoletras($xcifra)
{

    $xarray = array(0 => "Cero",
        1 => "UN", "DOS", "TRES", "CUATRO", "CINCO", "SEIS", "SIETE", "OCHO", "NUEVE",
        "DIEZ", "ONCE", "DOCE", "TRECE", "CATORCE", "QUINCE", "DIECISEIS", "DIECISIETE", "DIECIOCHO", "DIECINUEVE",
        "VEINTI", 30 => "TREINTA", 40 => "CUARENTA", 50 => "CINCUENTA", 60 => "SESENTA", 70 => "SETENTA", 80 => "OCHENTA", 90 => "NOVENTA",
        100 => "CIENTO", 200 => "DOSCIENTOS", 300 => "TRESCIENTOS", 400 => "CUATROCIENTOS", 500 => "QUINIENTOS", 600 => "SEISCIENTOS", 700 => "SETECIENTOS", 800 => "OCHOCIENTOS", 900 => "NOVECIENTOS"
    );
//
    $xcifra = trim($xcifra);
    $xlength = strlen($xcifra);
    $xpos_punto = strpos($xcifra, ".");
    $xaux_int = $xcifra;
    $xdecimales = "00";
    if (!($xpos_punto === false)) {
        if ($xpos_punto == 0) {
            $xcifra = "0" . $xcifra;
            $xpos_punto = strpos($xcifra, ".");
        }
        $xaux_int = substr($xcifra, 0, $xpos_punto); // obtengo el entero de la cifra a covertir
        $xdecimales = substr($xcifra . "00", $xpos_punto + 1, 2); // obtengo los valores decimales
    }

    $XAUX = str_pad($xaux_int, 18, " ", STR_PAD_LEFT); // ajusto la longitud de la cifra, para que sea divisible por centenas de miles (grupos de 6)
    $xcadena = "";
    for ($xz = 0; $xz < 3; $xz++) {
        $xaux = substr($XAUX, $xz * 6, 6);
        $xi = 0;
        $xlimite = 6; // inicializo el contador de centenas xi y establezco el límite a 6 dígitos en la parte entera
        $xexit = true; // bandera para controlar el ciclo del While
        while ($xexit) {
            if ($xi == $xlimite) { // si ya llegó al límite máximo de enteros
                break; // termina el ciclo
            }

            $x3digitos = ($xlimite - $xi) * -1; // comienzo con los tres primeros digitos de la cifra, comenzando por la izquierda
            $xaux = substr($xaux, $x3digitos, abs($x3digitos)); // obtengo la centena (los tres dígitos)
            for ($xy = 1; $xy < 4; $xy++) { // ciclo para revisar centenas, decenas y unidades, en ese orden
                switch ($xy) {
                    case 1: // checa las centenas
                        if (substr($xaux, 0, 3) < 100) { // si el grupo de tres dígitos es menor a una centena ( < 99) no hace nada y pasa a revisar las decenas

                        } else {
                            $key = (int) substr($xaux, 0, 3);
                            if (TRUE === array_key_exists($key, $xarray)){  // busco si la centena es número redondo (100, 200, 300, 400, etc..)
                                $xseek = $xarray[$key];
                                $xsub = subfijo($xaux); // devuelve el subfijo correspondiente (Millón, Millones, Mil o nada)
                                if (substr($xaux, 0, 3) == 100)
                                    $xcadena = " " . $xcadena . " CIEN " . $xsub;
                                else
                                    $xcadena = " " . $xcadena . " " . $xseek . " " . $xsub;
                                $xy = 3; // la centena fue redonda, entonces termino el ciclo del for y ya no reviso decenas ni unidades
                            }
                            else { // entra aquí si la centena no fue numero redondo (101, 253, 120, 980, etc.)
                                $key = (int) substr($xaux, 0, 1) * 100;
                                $xseek = $xarray[$key]; // toma el primer caracter de la centena y lo multiplica por cien y lo busca en el arreglo (para que busque 100,200,300, etc)
                                $xcadena = " " . $xcadena . " " . $xseek;
                            } // ENDIF ($xseek)
                        } // ENDIF (substr($xaux, 0, 3) < 100)
                        break;
                    case 2: // checa las decenas (con la misma lógica que las centenas)
                        if (substr($xaux, 1, 2) < 10) {

                        } else {
                            $key = (int) substr($xaux, 1, 2);
                            if (TRUE === array_key_exists($key, $xarray)) {
                                $xseek = $xarray[$key];
                                $xsub = subfijo($xaux);
                                if (substr($xaux, 1, 2) == 20)
                                    $xcadena = " " . $xcadena . " VEINTE " . $xsub;
                                else
                                    $xcadena = " " . $xcadena . " " . $xseek . " " . $xsub;
                                $xy = 3;
                            }
                            else {
                                $key = (int) substr($xaux, 1, 1) * 10;
                                $xseek = $xarray[$key];
                                if (20 == substr($xaux, 1, 1) * 10)
                                    $xcadena = " " . $xcadena . " " . $xseek;
                                else
                                    $xcadena = " " . $xcadena . " " . $xseek . " Y ";
                            } // ENDIF ($xseek)
                        } // ENDIF (substr($xaux, 1, 2) < 10)
                        break;
                    case 3: // checa las unidades
                        if (substr($xaux, 2, 1) < 1) { // si la unidad es cero, ya no hace nada

                        } else {
                            $key = (int) substr($xaux, 2, 1);
                            $xseek = $xarray[$key]; // obtengo directamente el valor de la unidad (del uno al nueve)
                            $xsub = subfijo($xaux);
                            $xcadena = " " . $xcadena . " " . $xseek . " " . $xsub;
                        } // ENDIF (substr($xaux, 2, 1) < 1)
                        break;
                } // END SWITCH
            } // END FOR
            $xi = $xi + 3;
        } // ENDDO

        if (substr(trim($xcadena), -5, 5) == "ILLON") // si la cadena obtenida termina en MILLON o BILLON, entonces le agrega al final la conjuncion DE
            $xcadena.= " DE";

        if (substr(trim($xcadena), -7, 7) == "ILLONES") // si la cadena obtenida en MILLONES o BILLONES, entoncea le agrega al final la conjuncion DE
            $xcadena.= " DE";

        // ----------- esta línea la puedes cambiar de acuerdo a tus necesidades o a tu país -------
        if (trim($xaux) != "") {
            switch ($xz) {
                case 0:
                    if (trim(substr($XAUX, $xz * 6, 6)) == "1")
                        $xcadena.= "UN BILLON ";
                    else
                        $xcadena.= " BILLONES ";
                    break;
                case 1:
                    if (trim(substr($XAUX, $xz * 6, 6)) == "1")
                        $xcadena.= "UN MILLON ";
                    else
                        $xcadena.= " MILLONES ";
                    break;
                case 2:
                    if ($xcifra < 1) {
                        $xcadena = "CERO PESOS $xdecimales/100 M.N.";
                    }
                    if ($xcifra >= 1 && $xcifra < 2) {
                        $xcadena = "UN PESO $xdecimales/100 M.N. ";
                    }
                    if ($xcifra >= 2) {
                        $xcadena.= " PESOS $xdecimales/100 M.N. "; //
                    }
                    break;
            } // endswitch ($xz)
        } // ENDIF (trim($xaux) != "")
        // ------------------      en este caso, para México se usa esta leyenda     ----------------
        $xcadena = str_replace("VEINTI ", "VEINTI", $xcadena); // quito el espacio para el VEINTI, para que quede: VEINTICUATRO, VEINTIUN, VEINTIDOS, etc
        $xcadena = str_replace("  ", " ", $xcadena); // quito espacios dobles
        $xcadena = str_replace("UN UN", "UN", $xcadena); // quito la duplicidad
        $xcadena = str_replace("  ", " ", $xcadena); // quito espacios dobles
        $xcadena = str_replace("BILLON DE MILLONES", "BILLON DE", $xcadena); // corrigo la leyenda
        $xcadena = str_replace("BILLONES DE MILLONES", "BILLONES DE", $xcadena); // corrigo la leyenda
        $xcadena = str_replace("DE UN", "UN", $xcadena); // corrigo la leyenda
    } // ENDFOR ($xz)

    return trim($xcadena);
}

// END FUNCTION

function subfijo($xx)
{ // esta función regresa un subfijo para la cifra
    $xx = trim($xx);
    $xstrlen = strlen($xx);
    if ($xstrlen == 1 || $xstrlen == 2 || $xstrlen == 3)
        $xsub = "";
    //
    if ($xstrlen == 4 || $xstrlen == 5 || $xstrlen == 6)
        $xsub = "MIL";
    //
    return $xsub;
}

// END FUNCTION

?>