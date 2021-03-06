
<?php
//initilize the page
require_once(SYSTEM_DIR . "/inc/init.php");
//require UI configuration (nav, ribbon, etc.)
require_once(SYSTEM_DIR . "/inc/config.ui.php");

/*---------------- PHP Custom Scripts ---------
YOU CAN SET CONFIGURATION VARIABLES HERE BEFORE IT GOES TO NAV, RIBBON, ETC.
E.G. $page_title = "Custom Title" */
$page_title = "Pedidos";

/* ---------------- END PHP Custom Scripts ------------- */
$page_css[] = "your_style.css";
include(SYSTEM_DIR . "/inc/header.php");

//include left panel (navigation)
include(SYSTEM_DIR . "/inc/nav.php");

$obj = new Pedido();
$data = $obj->getAllArr();
//print_r($users);
?>
<!-- ==========================CONTENT STARTS HERE ========================== -->
<!-- MAIN PANEL -->
<div id="main" role="main">
	<?php $breadcrumbs["Pedidos"] = APP_URL."/Pedidos/index"; include(SYSTEM_DIR . "/inc/ribbon.php"); ?>
    

	<!-- MAIN CONTENT -->
	<div id="content">
		<section id="widget-grid" class="">
			<div class="col-sm-6 col-md-6 col-lg-2 no-padding">
				<p><a class="btn btn-success" href="<?php echo make_url("Pedidos","add")?>" ><i class="fas fa-wrench"></i>&nbsp;Nuevo Pedido</a></p>
			</div>
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
							<div class="widget-body">
								<table id="dt_basic" class="table table-striped table-bordered table-hover" width="100%">
									<thead>
										<tr>
											<th class = "col-md-1" data-class="expand">
												<i class="fa fa-fw fa-list-ol  text-muted hidden-md hidden-sm hidden-xs"></i>&nbsp;No. Pedido
											</th>
											
											<th class = "col-md-1" >
												<i class="fa fa-fw  fa-credit-card-front text-muted hidden-md hidden-sm hidden-xs"></i>&nbsp;Nombre
											</th>
											<th class = "col-md-1" data-hide="">
												<i class="fa fa-fw fa-file-alt text-muted hidden-md hidden-sm hidden-xs"></i>&nbsp;Proveedor
											</th>
											<th class = "col-md-2" data-hide="phone,tablet">
												<i class="fa fa-fw  fa-user  text-muted hidden-md hidden-sm hidden-xs"></i>&nbsp;Estatus
											</th>
											<th class = "col-md-1" data-hide="">
												<i class="fa fa-fw  fa-calendar-alt  text-muted hidden-md hidden-sm hidden-xs"></i>Fecha Pedido
											</th>
											<th class = "col-md-1" data-hide="phone,tablet">
												<i class="fa fa-fw  fa-car-garage  text-muted hidden-md hidden-sm hidden-xs"></i>&nbsp;Almacen
											</th>
											<th class = "col-md-2" data-hide="phone,tablet">
												<i class="fa fa-fw    text-muted hidden-md hidden-sm hidden-xs"></i>Action
											</th>
										</tr>
									</thead>
									<tbody>
										<?php foreach($data as $row){
											$nomalmacen      = "";
											$nomrefaccion    = "";
											$nomproveedor    = "";
											if($row["id_almacen"]){
												$objalmacen = new Almacen();
												$dataalmacen = $objalmacen->getTable($row["id_almacen"]);
												if($dataalmacen){ $nomalmacen = $dataalmacen["nombre"]; }
											}
										
											if($row["id_proveedor"]){
												$objproveedor = new Proveedor();
												$dataproveedor = $objproveedor->getTable($row["id_proveedor"]);
												if($dataproveedor){ $nomproveedor = $dataproveedor["nombre"]; }
											}
											$status=htmlentities($row['status']);
											switch ($status) {
												case 'active':
													$status = 'Pendiente';
													$class  = 'label label-danger';
													break;
												case 'Validado':
													$status = 'Validado <br>'.date('Y-m-d',strtotime($row['fecha_validacion']));
													$class  = 'label label-success'; 
													break;
												case 'deleted':
													$status = 'Cancelado';
													$class  = 'label label-warning';
													break;
												default:
													$status = $status;
													$class  = '';
													break;
											}
											
										?>
											<tr>
												<td><a class="" href="<?php echo make_url("Pedidos","view",array('id'=>$row['id'])); ?>"><?php echo $row['id'] ?></a></td>
												<td><?php echo htmlentities($row['nombre']) ?></td>
												<td><?php echo htmlentities($nomproveedor) ?></td>
												<td><label class="<?php echo $class; ?>"><?php echo $status ?></label></td>
												<td><?php echo htmlentities(date('Y-m-d',strtotime($row['fecha_alta'])));?></td>
												<td><?php echo htmlentities($nomalmacen) ?></td>
												
												<td>
													<div class="btn-group">
														<button class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
															Accion <span class="caret"></span>
														</button>
														<ul class="dropdown-menu">
															
															<li>
																<a class="" href="<?php echo make_url("Pedidos","view",array('id'=>$row['id'])); ?>"> <i class="fa fa-eye"></i>Ver</a>
															</li>
															<?php if($status =="Pendiente"){
															?>
															<li>
																<a class="" href="javascript:validar(<?php echo $row['id'] ?>)" ><i class="fa fa-check"></i></i> &nbsp;Validar</a>
															</li>
															<li>
																<a class="" href="<?php echo make_url("Pedidos","edit",array('id'=>$row['id'])); ?>"><i class="fa fa-edit"></i>Editar</a>
															</li>
															
															<?php } ?>
															<li class="divider"></li>
															<li>
																<a href="#" class="red" onclick="borrar('<?php echo make_url("Pedidos","pedidodelete",array('id'=>$row['id'])); ?>',<?php echo $row['id']; ?>);">Eliminar</a>
															</li>
														</ul>
													</div>
												</td>
											</tr>
										<?php }?>
									</tbody>
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
<script src="<?php echo ASSETS_URL; ?>/js/plugin/datatables/jquery.dataTables.min.js"></script>
<script src="<?php echo ASSETS_URL; ?>/js/plugin/datatables/dataTables.colVis.min.js"></script>
<script src="<?php echo ASSETS_URL; ?>/js/plugin/datatables/dataTables.tableTools.min.js"></script>
<script src="<?php echo ASSETS_URL; ?>/js/plugin/datatables/dataTables.bootstrap.min.js"></script>
<script src="<?php echo ASSETS_URL; ?>/js/plugin/datatable-responsive/datatables.responsive.min.js"></script>

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
		var responsiveHelper_dt_basic = undefined;
		var responsiveHelper_datatable_fixed_column = undefined;
		var responsiveHelper_datatable_col_reorder = undefined;
		var responsiveHelper_datatable_tabletools = undefined;
		
		var breakpointDefinition = {
			tablet : 1024,
			phone : 480
		};
		$('#dt_basic').dataTable({
			"sDom": "<'dt-toolbar'<'col-xs-12 col-sm-6'f><'col-sm-6 col-xs-12 hidden-xs'l>r>"+
				"t"+
				"<'dt-toolbar-footer'<'col-sm-6 col-xs-12 hidden-xs'i><'col-xs-12 col-sm-6'p>>",
			"autoWidth" : true,
			"preDrawCallback" : function() {
				// Initialize the responsive datatables helper once.
				if (!responsiveHelper_dt_basic) {
					responsiveHelper_dt_basic = new ResponsiveDatatablesHelper($('#dt_basic'), breakpointDefinition);
				}
			},
			"rowCallback" : function(nRow) {
				responsiveHelper_dt_basic.createExpandIcon(nRow);
			},
			"drawCallback" : function(oSettings) {
				responsiveHelper_dt_basic.respond();
			}
		});
	
		 pageSetUp();
		
	});

</script>

<?php
	//include footer
	include(SYSTEM_DIR . "/inc/close-html.php");
?>
