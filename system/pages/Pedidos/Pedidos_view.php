<?php
//initilize the page
require_once(SYSTEM_DIR . "/inc/init.php");
//require UI configuration (nav, ribbon, etc.)
require_once(SYSTEM_DIR . "/inc/config.ui.php");

/*---------------- PHP Custom Scripts ---------
YOU CAN SET CONFIGURATION VARIABLES HERE BEFORE IT GOES TO NAV, RIBBON, ETC.
E.G. $page_title = "Custom Title" */
$page_title = "Ver Pedido";

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
    informError(true,make_url("Pedido","index"));


$obj = new Pedido();
$data = $obj->getTable($id);
if ( !$data ) {
    informError(true,make_url("Pedido","index"));
}
$status = htmlentities($data['status']);
switch ($status) {
	case 'active':
		$status = 'Pendiente';
		$class  = 'label label-danger';
		break;
	case 'Validado':
		$status = 'Validado '.$data['fecha_validacion'];
		$class  = 'label label-success'; 
		break;
	case 'delete':
		$status = 'Cancelado';
		$class  = 'label label-warning';
		break;
	default:
		$class  = '';
		break;
} 

$objprov = new Proveedor();
$dataprov = $objprov->getTable($data['id_proveedor']);

$objalm = new Almacen();
$dataalma = $objalm->getTable($data['id_almacen']);
?>

<!-- ==========================CONTENT STARTS HERE ========================== -->
<!-- MAIN PANEL -->
<div id="main" role="main">
    <?php $breadcrumbs["Pedidos"] = APP_URL."/Pedidos"; include(SYSTEM_DIR . "/inc/ribbon.php"); ?>

    <!-- MAIN CONTENT -->
    <div id="content">
        <section id="widget-grid" class="">
			
			<div class="row">   
                <div class="widget-body" style='padding-left: 15px;'>
					<a class="btn btn-success" target="_blank" href="<?php echo make_url("Pedidos","print",array('id'=>$id,'page'=>'pedido'))?>" ><i class="fa fa-print"></i> &nbsp;Imprimir</a>
					<?php if($status=='Pendiente'){
                    ?>
                    <a class="btn btn-info" target="" href="javascript:validar(<?php echo $id ?>)" ><i class="fa fa-check"></i></i> &nbsp;Validar</a>
                    <?php } ?>
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
                                                                <td colspan="2" style=""><?php echo date("Y-m-d",strtotime($data["fecha_alta"])); ?></td>
                                                            </tr>
                                                           <tr>
                                                                <td style="background-color:#d0d0cf; font-weight:bold; text-align:left; width:30%;"> Usuario </td>
																<td colspan="2"><?php echo htmlentities($data['usuarioalta']); ?></td>
                                                            </tr>

                                                            <tr>
                                                                <td style="background-color:#d0d0cf; font-weight:bold; text-align:left; width:30%;"> Almacen </td>
																<td colspan="2"><?php echo htmlentities($data['almacen']); ?></td>
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
                                                    <td colspan="4" style="width:20%;background-color:#d0d0cf; font-weight:bold; text-align: center">DATOS DEL PEDIDO </td>
                                                </tr>
                                                <tr>
                                                    <td colspan="" style="width:20%;background-color:#d0d0cf; font-weight:bold;">Nombre: </td>
													<td colspan="" style="width:30%;"><?php echo htmlentities($data['nombre']); ?></td>
													<td colspan="" style="width:20%;background-color:#d0d0cf; font-weight:bold;">Fecha Validacion: </td>
													<td colspan=""><?php echo htmlentities($data['fecha_validacion']); ?></td>
                                                </tr>
                                                <tr>
                                                    <td colspan="" style="width:20%;background-color:#d0d0cf; font-weight:bold;">Proveedor: </td>
													<td colspan="" style="width:30%;"><?php echo htmlentities($dataprov['nombre']); ?></td>
													<td colspan="" style="width:20%;background-color:#d0d0cf; font-weight:bold;">Almacen: </td>
													<td colspan=""><?php echo htmlentities($dataalma['nombre']); ?></td>
                                                </tr>
                                                 <tr>
                                                    <td colspan="4" style="width:20%;background-color:#d0d0cf; font-weight:bold; text-align: center">REFACCIONES DEL PEDIDO : </td>
                                                </tr>
                                                <tr>
                                                    <td colspan="4" style="width:100%;">
														<table style="height: 100%;width:100%;">
                                                            <tr>
                                                                <td colspan="6" style="width:20%;background-color:#d0d0cf; font-weight:bold; text-align: center">Refacciones </td>
                                                            </tr>
                                                            <tr>
                                                                <td colspan="" style="width:10%;background-color:#d0d0cf; font-weight:bold;">Cant</td>
                                                                <td colspan="" style="width:10%;background-color:#d0d0cf; font-weight:bold;">Refaccion</td>
                                                                <td colspan="" style="width:10%;background-color:#d0d0cf; font-weight:bold;">Costo Uni.</td>
                                                                <td colspan="" style="width:10%;background-color:#d0d0cf; font-weight:bold;">Precio Uni.</td>
                                                                <td colspan="" style="width:10%;background-color:#d0d0cf; font-weight:bold;">Total Costo</td>
                                                                <td colspan="" style="width:10%;background-color:#d0d0cf; font-weight:bold;">Fecha</td>
                                                            </tr>
                                                            <?php 
                                                            $objref = new PedidoRefaccion();
                                                            $dataref = $objref->getAllArr($id);
                                                            $totalrefaccion = 0 ;
                                                            foreach($dataref as $row) {
                                                                $nombre = htmlentities($row['refaccion']) ;
                                                                $status = htmlentities($row['status']);
                                                                switch ($row['status']) {
																	case 'delete':
																		$status = 'Cancelado';
                                                                        $class  = 'cancelada';
                                                                        break;
                                                                    default:
																		$class  = '';
																		$totalrefaccion+= $row['totalcosto'];
                                                                        break;
                                                                } 
                                                            ?>
                                                            <tr class="<?php echo $class; ?>">
                                                                <td><?php echo htmlentities($row['cantidad']); ?></td>
                                                                <td><?php echo htmlentities($nombre); ?></td>
                                                                <td><?php echo htmlentities($row['costo']); ?></td>
                                                                <td><?php echo htmlentities($row['precio']); ?></td>
                                                                <td><?php echo htmlentities($row['totalcosto']); ?></td>
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
			title: "Deseas validar este pedido?",
			text: "El pedido se agregara al inventario.",
			type: "info",
			showCancelButton: true,
			confirmButtonColor: '#396bf2',
			confirmButtonText: 'Si, Validar!',
			closeOnConfirm: true
			},
			function(){
				swal("Validado!", "Validado con exito!", "Exito");
				
				var url  = config.base+"/Pedidos/ajax/?action=get&object=validar"; 
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
