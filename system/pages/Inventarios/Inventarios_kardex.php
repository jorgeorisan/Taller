
<?php
//initilize the page
require_once(SYSTEM_DIR . "/inc/init.php");
//require UI configuration (nav, ribbon, etc.)
require_once(SYSTEM_DIR . "/inc/config.ui.php");

/*---------------- PHP Custom Scripts ---------
YOU CAN SET CONFIGURATION VARIABLES HERE BEFORE IT GOES TO NAV, RIBBON, ETC.
E.G. $page_title = "Custom Title" */
$page_title = "Kardex";

/* ---------------- END PHP Custom Scripts ------------- */
$page_css[] = "your_style.css";
include(SYSTEM_DIR . "/inc/header.php");

//include left panel (navigation)
include(SYSTEM_DIR . "/inc/nav.php");

//include left panel (navigation)
if(isset($request['params']['id'])   && $request['params']['id']>0)
    $id=$request['params']['id'];
else
    informError(true,make_url("Inventario","index"));

$obj = new Inventario();
$data = $obj->getTable($id);
$datatotales = $obj->getTotalesKardex($data['id_refaccion'],$data['id_almacen']);
$datarows    = $obj->getTableKardex($data['id_refaccion'],$data['id_almacen']);
$datapedidos = $obj->getTablePedidos($data['id_refaccion'],$data['id_almacen']);

//print_r($users);
?>
<!-- ==========================CONTENT STARTS HERE ========================== -->
<!-- MAIN PANEL -->
<div id="main" role="main">
	<?php
		//configure ribbon (breadcrumbs) array("name"=>"url"), leave url empty if no url
		//$breadcrumbs["New Crumb"] => "http://url.com"
		//$breadcrumbs["Add client"] = APP_URL."/Clients/add";
		include(SYSTEM_DIR . "/inc/ribbon.php");
	?>

	<!-- MAIN CONTENT -->
	<div id="content">
		<section id="widget-grid" class="">
			
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
								<div>
									<table id="dt_basic2" class="table table-striped table-bordered table-hover" width="100%">
										<thead>
											<tr>
												<th>Almacen</th>
												<th>Refaccion</th>
												<th>Entradas</th>
												<th>Salidas</th>
												<th>Inventario</td>
												<th>Kardex</th>
											</tr>
										</thead>
										<tbody>
											<tr>
												<td><?php echo $datatotales['almacen']?></td>
												<td><?php echo $datatotales['refaccion']?></td>
												<td><?php echo $datatotales['totalentradas']?></td>
												<td><?php echo $datatotales['totalsalidas']?></td>
												<td><?php echo $datatotales['existencia']?></td>
												<td><?php echo $datatotales['totalkardex']?></td>
											</tr>
										</tbody>
									</table>
								
								</div>
								
								<div><h2><?php echo "Entradas" ?></h2></div>
								<table id="dt_basic" class="table table-striped table-bordered table-hover" width="100%">
									<thead>
										<tr>
											<td colspan="" style="width:10%;background-color:#d0d0cf; font-weight:bold;">Cant</td>
											<td colspan="" style="width:10%;background-color:#d0d0cf; font-weight:bold;">Refaccion</td>
											<td colspan="" style="width:10%;background-color:#d0d0cf; font-weight:bold;">Almacen</td>
											<td colspan="" style="width:10%;background-color:#d0d0cf; font-weight:bold;">Usuario</td>
											<td colspan="" style="width:10%;background-color:#d0d0cf; font-weight:bold;">Pedido</td>
											<td colspan="" style="width:10%;background-color:#d0d0cf; font-weight:bold;">Status</td>
											<td colspan="" style="width:10%;background-color:#d0d0cf; font-weight:bold;">Fecha</td>
											<td colspan="" style="width:10%;background-color:#d0d0cf; font-weight:bold;">Tipo</td>
										</tr>
									</thead>
									<tbody>
										<?php foreach($datapedidos as $row){
															
											?>
											<tr>
												<td><?php echo htmlentities($row['cantidad'])?></td>
												<td><a class="" href="<?php echo make_url("Catalogos","refaccionshow",array('id'=>$row['id_refaccion'])); ?>">
													<?php echo htmlentities($row['refaccion']) ?></a>
												</td>
												<td><?php echo htmlentities($row['almacen'])?></td>
												<td><?php echo htmlentities($row['usuario'])?></td>
												<td><?php echo htmlentities($row['pedido'])?></td>
												<td><?php echo htmlentities($row['status']) ?></td>
												<td><?php echo htmlentities($row['fecha']) ?></td>
												<td><?php echo htmlentities($row['tipo']) ?></td>
												
												
											</tr>
										<?php }?>
									</tbody>
								</table>
								<div><h2><?php echo "Salidas" ?></h2></div>
								<table id="dt_basic" class="table table-striped table-bordered table-hover" width="100%">
									<thead>
										<tr>
											<td colspan="" style="width:10%;background-color:#d0d0cf; font-weight:bold;">Cant</td>
											<td colspan="" style="width:10%;background-color:#d0d0cf; font-weight:bold;">Refaccion</td>
											<td colspan="" style="width:10%;background-color:#d0d0cf; font-weight:bold;">Almacen</td>
											<td colspan="" style="width:10%;background-color:#d0d0cf; font-weight:bold;">Usuario</td>
											<td colspan="" style="width:10%;background-color:#d0d0cf; font-weight:bold;">Personal</td>
											<td colspan="" style="width:10%;background-color:#d0d0cf; font-weight:bold;">Comentarios</td>
											<td colspan="" style="width:10%;background-color:#d0d0cf; font-weight:bold;">Status</td>
											<td colspan="" style="width:10%;background-color:#d0d0cf; font-weight:bold;">Fecha</td>
											<td colspan="" style="width:10%;background-color:#d0d0cf; font-weight:bold;">Tipo</td>
										</tr>
									</thead>
									<tbody>
										<?php foreach($datarows as $row){
															
											?>
											<tr>
												<td><?php echo htmlentities($row['cantidad'])?></td>
												<td><a class="" href="<?php echo make_url("Catalogos","refaccionshow",array('id'=>$row['id_refaccion'])); ?>">
													<?php echo htmlentities($row['refaccion']) ?></a>
												</td>
												<td><?php echo htmlentities($row['almacen'])?></td>
												<td><?php echo htmlentities($row['usuario'])?></td>
												<td><?php echo htmlentities($row['personal'])?></td>
												<td><?php echo htmlentities($row['comentarios'])?></td>
												<td><?php echo htmlentities($row['status']) ?></td>
												<td><?php echo htmlentities($row['fecha']) ?></td>
												<td><?php echo htmlentities($row['tipo']) ?></td>
												
												
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
