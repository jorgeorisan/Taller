
<?php
//initilize the page
require_once(SYSTEM_DIR . "/inc/init.php");
//require UI configuration (nav, ribbon, etc.)
require_once(SYSTEM_DIR . "/inc/config.ui.php");

/*---------------- PHP Custom Scripts ---------
YOU CAN SET CONFIGURATION VARIABLES HERE BEFORE IT GOES TO NAV, RIBBON, ETC.
E.G. $page_title = "Custom Title" */
$page_title = "Gastos";

/* ---------------- END PHP Custom Scripts ------------- */
$page_css[] = "your_style.css";
include(SYSTEM_DIR . "/inc/header.php");

//include left panel (navigation)
include(SYSTEM_DIR . "/inc/nav.php");


$obj = new Gastos();
$data = $obj->getAllArr();

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
			 <p><a class="btn btn-success" href="<?php echo make_url("Gastos","add")?>" >Nuevo Gastos</a></p>
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
											<th class = "col-md-1" data-hide="phone,tablet">
												<i class="fa fa-fw fa-user text-muted hidden-md hidden-sm hidden-xs"></i> No. Gastos
											</th>
											<th class = "col-md-1" data-class="expand">
												<i class="fa fa-fw fa-user text-muted hidden-md hidden-sm hidden-xs"></i> Concepto
											</th>
											<th class = "col-md-1" data-class="expand">
												<i class="fa fa-fw fa-user text-muted hidden-md hidden-sm hidden-xs"></i> Tipo Gasto
											</th>
											<th class = "col-md-1" data-class="expand">
												<i class="fa fa-fw fa-user text-muted hidden-md hidden-sm hidden-xs"></i> Gasto
											</th>
											<th class = "col-md-1" data-hide="">
												<i class="fa fa-fw  fa-certificate text-muted hidden-md hidden-sm hidden-xs"></i> Total
											</th>
											<th class = "col-md-1" data-hide="phone,tablet">
												<i class="fa fa-fw  fa-check-square  text-muted hidden-md hidden-sm hidden-xs"></i>Usuario Alta
											</th>
											<th class = "col-md-1" data-hide="phone,tablet">
												<i class="fa fa-fw  fa-check-square  text-muted hidden-md hidden-sm hidden-xs"></i>Fecha Alta
											</th>
											<th class = "col-md-1" data-hide="phone,tablet">
												<i class="fa fa-fw  text-muted hidden-md hidden-sm hidden-xs"></i>Action
											</th>
										</tr>
									</thead>
									<tbody>
										<?php  foreach($data as $row) {
											?>
											<tr>
												<td><?php echo htmlentities($row['id'])?></td>
												<td><?php echo htmlentities($row['nombre'])?></td>
												<td><?php echo htmlentities($row['tipo'])?></td>
												<td><?php echo htmlentities($row['gastostipo'])?></td>
												<td><?php echo htmlentities($row['total']) ?></td>
												<td><?php echo htmlentities($row['nombre']." ".$row['apellido_pat']." ".$row['apellido_mat']." ") ?></td>
												<td><?php echo htmlentities($row['created_date']) ?></td>
												<td>
													<div class="btn-group">
														<button class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
															Accion <span class="caret"></span>
														</button>
														<ul class="dropdown-menu">
															<li>
																<a class="" href="<?php echo make_url("Gastos","view",array('id'=>$row['id'])); ?>">Ver</a>
															</li>
															<li>
																<a class="" href="<?php echo make_url("Gastos","edit",array('id'=>$row['id'])); ?>">Editar</a>
															</li>
															
															<li class="divider"></li>
															<li>
																<a href="#" class="red" onclick="borrar('<?php echo make_url("Gastos","gastosdelete",array('id'=>$row['id'])); ?>',<?php echo $row['id']; ?>);">Eliminar</a>
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
	
		/* DO NOT REMOVE : GLOBAL FUNCTIONS!
		 *
		 * pageSetUp(); WILL CALL THE FOLLOWING FUNCTIONS
		 *
		
		 */

		 pageSetUp();
	})

</script>

<?php
	//include footer
	include(SYSTEM_DIR . "/inc/close-html.php");
?>
