<?php
//initilize the page
require_once(SYSTEM_DIR . "/inc/init.php");
//require UI configuration (nav, ribbon, etc.)
require_once(SYSTEM_DIR . "/inc/config.ui.php");

/*---------------- PHP Custom Scripts ---------
YOU CAN SET CONFIGURATION VARIABLES HERE BEFORE IT GOES TO NAV, RIBBON, ETC.
E.G. $page_title = "Custom Title" */
$page_title = "Ver Nomina";

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
    informError(true,make_url("Nomina","index"));


$obj = new Nomina();
$data = $obj->getTable($id);
if ( !$data ) {
    informError(true,make_url("Nomina","index"));
}
$status = htmlentities($data['status']);

$objtaller = new Taller();
$datataller = $objtaller->getTable($data['id_taller']);

$objUser = new User();
$datauser = $objUser->getTable($data['id_user']);
?>

<!-- ==========================CONTENT STARTS HERE ========================== -->
<!-- MAIN PANEL -->
<div id="main" role="main">
    <?php $breadcrumbs["Nomina"] = APP_URL."/Nomina"; include(SYSTEM_DIR . "/inc/ribbon.php"); ?>

    <!-- MAIN CONTENT -->
    <div id="content">
        <section id="widget-grid" class="">
			
			<div class="row">   
                <div class="widget-body" style='padding-left: 15px;'>
					<a class="btn btn-success" target="_blank" href="<?php echo make_url("Nomina","print",array('id'=>$id,'page'=>'nomina'))?>" ><i class="fa fa-print"></i> &nbsp;Imprimir</a>
					
                </div>
            </div>
			<div class=""> &nbsp; </div>
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
                                <table style="width:100%;">
                                    <tr>
                                        <td>
                                            <table>
                                                <tr>
                                                    <td height="100" style="width:15%;border:none;">
                                                        <img src="<?php echo ASSETS_URL; ?>/img/logo.png" border="0" height="80" width="160"/>
                                                    </td>
                                                    <td style="width:40%; text-align:center;border:none;">
                                                        <h3>MAXIMUS BODY SHOP S, RL DE CV</h3>
                                                        <p style=" line-height:1.5em; font-weight:bold;">CALZADA DEL HUESO #777<br />
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
                                                                <td style="background-color:#d0d0cf; font-weight:bold; text-align:left; width:40%;">Folio No.</td>
																<td colspan="2" style="color:red;"><?php echo $data["id"]; ?></td>
                                                            </tr>
                                                           
                                                            <tr>
                                                                <td style="background-color:#d0d0cf; font-weight:bold; text-align:left; width:30%;">Fecha</td>
                                                                <td colspan="2" style=""><?php echo date("Y-m-d",strtotime($data["created_date"])); ?></td>
                                                            </tr>
                                                           <tr>
                                                                <td style="background-color:#d0d0cf; font-weight:bold; text-align:left; width:30%;"> Usuario </td>
																<td colspan="2"><?php echo htmlentities($datauser['nombre']); ?></td>
                                                            </tr>

                                                            <tr>
                                                                <td style="background-color:#d0d0cf; font-weight:bold; text-align:left; width:30%;"> Taller </td>
																<td colspan="2"><?php echo htmlentities($datataller['nombre']); ?></td>
                                                            </tr>
															<tr>
                                                                <td style="background-color:#d0d0cf; font-weight:bold; text-align:left; width:30%;"> Validacion </td>
																<td colspan="2" class="<?php echo $class; ?>"><?php echo $status; ?></td>
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
                                                    <td colspan="4" style="width:20%;background-color:#d0d0cf; font-weight:bold; text-align: center">DATOS DE NOMINA </td>
                                                </tr>
                                                <tr>
                                                    <td colspan="" style="width:20%;background-color:#d0d0cf; font-weight:bold;">Fecha Inicial: </td>
													<td colspan="" style="width:30%;"><?php echo date("Y-m-d",strtotime($data['fecha_inicial'])); ?></td>
													<td colspan="" style="width:20%;background-color:#d0d0cf; font-weight:bold;">Fecha Final: </td>
													<td colspan=""><?php echo date("Y-m-d",strtotime($data['fecha_final'])); ?></td>
                                                </tr>
                                                <tr>
                                                    <td colspan="" style="width:20%;background-color:#d0d0cf; font-weight:bold;">Concepto: </td>
													<td colspan="" style="width:30%;"><?php echo htmlentities($data['nombre']); ?></td>
													<td colspan="" style="width:20%;background-color:#d0d0cf; font-weight:bold;">Comentarios: </td>
													<td colspan=""><?php echo htmlentities($data['comentarios']); ?></td>
                                                </tr>
                                                <tr>
                                                    <td colspan="4" style="width:20%;background-color:#FFFFF; font-weight:bold; text-align: center"> </td>
                                                </tr>
                                                <tr>
                                                    <td colspan="4" style="width:20%;background-color:#d0d0cf; font-weight:bold; text-align: center">SERVICIOS DEL PERSONAL: </td>
                                                </tr>
                                                <tr>
                                                    <td colspan="4" style="width:100%;">
														<table style="height: 100%;width:100%;">
                                                            <tr>
                                                                <td colspan="5" style="width:20%;background-color:#FFFFF; font-weight:bold; text-align: center"></td>
                                                            </tr>
                                                            <tr>
                                                                <td colspan="" style="width:10%;background-color:#d0d0cf; font-weight:bold;">Cant. Serv.</td>
                                                                <td colspan="" style="width:10%;background-color:#d0d0cf; font-weight:bold;">Personal</td>
                                                                <td colspan="" style="width:10%;background-color:#d0d0cf; font-weight:bold;">Auto</td>
                                                                <td colspan="" style="width:10%;background-color:#d0d0cf; font-weight:bold;">Fecha</td>
                                                                <td colspan="" style="width:10%;background-color:#d0d0cf; font-weight:bold;">Total</td>
                                                            </tr>
                                                            <?php 
                                                            $objref = new NominaPersonal();
                                                            $dataref = $objref->getAllArr($id);
                                                            $totalgral = 0 ;
                                                            $class = '';
                                                            foreach($dataref as $row) {
                                                                $nombre = htmlentities($row['nombre']." ".$row['apellido_pat']." ".$row['apellido_mat']) ;
                                                                $status = htmlentities($row['status']);
                                                                $nombreauto = htmlentities($row['marca']." ".$row['submarca']." ".$row['modelo']) ;
                                                                $totalgral+=$row['total'];
                                                            ?>
                                                            <tr class="<?php echo $class; ?>">
                                                                <td><?php echo htmlentities($row['cantidad']); ?></td>
                                                                <td><?php echo htmlentities($nombre); ?></td>
                                                                <td><?php echo htmlentities($nombreauto); ?></td>
                                                                <td><?php echo date("Y-m-d",strtotime($row['fecha'])); ?></td>
                                                                <td><?php echo htmlentities($row['total']); ?></td>
                                                            </tr>

                                                            <?php
                                                            } 
                                                            ?>
                                                            <tr>
                                                                <td></td>
                                                                <td></td>
																<td></td>
                                                                <td style='font-weight:bold;'>Total:</td>
                                                                <td><strong><?php echo $totalgral; ?></strong></td>
                                                               
                                                            </tr>
                                                           
                                                        </table>
													</td>
                                                </tr>
                                                
                                            </table>
                                        </td>
                                    </tr>
                                    
                                </table>
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
	function validar(id){ 
		if ( ! id ) return;	
		swal({
			title: "Deseas validar este nomina?",
			text: "El nomina se agregara al inventario.",
			type: "info",
			showCancelButton: true,
			confirmButtonColor: '#396bf2',
			confirmButtonText: 'Si, Validar!',
			closeOnConfirm: true
			},
			function(){
				swal("Validado!", "Validado con exito!", "Exito");
				
				var url  = config.base+"/Nomina/ajax/?action=get&object=validar"; 
				var data = "id=" + id ;
				$.ajax({
					type: "POST",
					url: url,
					data: data, // Adjuntar los campos del formulario enviado.
					success: function(response){
						if(response==1){
							location.reload();
						}else{
							notify('error',"Oopss error al cambiar estatus: "+response);
						}
					}
				});
       
			}
		);
	}
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
