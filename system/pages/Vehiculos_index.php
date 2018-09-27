
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
$page_css[] = "your_style.css";
include(SYSTEM_DIR . "/inc/header.php");

//include left panel (navigation)
include(SYSTEM_DIR . "/inc/nav.php");

$obj = new Vehiculo();
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
			<div class="col-sm-6 col-md-6 col-lg-2">
				<p><a class="btn btn-success" href="<?php echo make_url("Vehiculos","add")?>" >Orden de Reparacion</a></p>
			</div>
			<div class="col-sm-6 col-md-6 col-lg-2">
				  <p><a class="btn btn-info" href="<?php echo make_url("Vehiculos","indexlist")?>" >Modo Lista</a></p>
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
							
								<?php foreach($data as $row){
									$nomtaller      = "";
									$nommarca       = "";
									$nomsubmarca    = "";
									$nomaseguradora = "";
									$nomcliente     = "";
									if($row["id_taller"]){
										$objtaller = new Taller();
										$datataller = $objtaller->getTable($row["id_taller"]);
										if($datataller){ $nomtaller = $datataller["nombre"]; }
									}
									if($row["id_marca"]){
										$objmarca = new Marca();
										$datamarca = $objmarca->getTable($row["id_marca"]);
										if($datamarca){ $nommarca = $datamarca["nombre"]; }
									}
									if($row["id_submarca"]){
										$objsubmarca = new SubMarca();
										$datasubmarca = $objsubmarca->getTable($row["id_submarca"]);
										if($datasubmarca){ $nomsubmarca = $datasubmarca["nombre"]; }
									}
									if($row["id_aseguradora"]){
										$objaseguradora = new Aseguradora();
										$dataaseguradora = $objaseguradora->getTable($row["id_aseguradora"]);
										if($dataaseguradora){ $nomaseguradora = $dataaseguradora["nombre"]; }
									}
									if($row["id_cliente"]){
										$objcliente = new Cliente();
										$datacliente = $objcliente->getTable($row["id_cliente"]);
										if($datacliente){ $nomcliente = $datacliente["nombre"] ." ". $datacliente["apellido_pat"] ." ". $datacliente["apellido_mat"]; }
									}
									$fechaalta = ($row['fecha_alta']) ?    date('Y-m-d',strtotime($row['fecha_alta'])) : "";
									$fechaprom = ($row['fecha_promesa']) ? date('Y-m-d',strtotime($row['fecha_promesa'])) : "";
								    $carpetaimg = ASSETS_URL.'/expediente/auto'.DIRECTORY_SEPARATOR.'auto_'.$row["id"].DIRECTORY_SEPARATOR.'images';
                                    $objimg = new ImagenesVehiculo();
                                    $dataimagenes = $objimg->getAllArr($row["id"]);
                                    $link="";
                                    foreach($dataimagenes as $key => $rowimg) {
                                    	if($link) continue;

                                        $link = $carpetaimg.DIRECTORY_SEPARATOR.$rowimg['nombre'];


                                    }
									?>
									<div class="col-sm-6 col-md-6 col-lg-4">
										<!-- product -->
										<div class="product-content product-wrap clearfix">
											<div class="row">
													<div class="col-md-5 col-sm-12 col-xs-12">
														<div class="product-image"> 
															<img src="<?php echo $link; ?>" alt="194x228" class="img-responsive"> 
															<span class="tag2 hot">
																HOT
															</span> 
														</div>
													</div>
													<div class="col-md-7 col-sm-12 col-xs-12">
													<div class="product-deatil">
															<h5 class="name">
																<?php echo $nommarca." ".$nomsubmarca." - ". $row['modelo'] ?>
																<small><strong>Cliente:</strong> <?php echo $nomcliente ?></small>
																<small><strong>Fecha Alta:</strong> <?php echo htmlentities($fechaalta) ?></small>
																<small><strong>Fecha Prom:</strong> <?php echo htmlentities($fechaprom) ?></small>

															</h5>
															<p class="price-container">
																<span><?php echo htmlentities($row['matricula'])?></span>
															</p>
															<span class="tag1"></span> 
													</div>
													<div class="description">
															<p>Pendientes </p>
													</div>

													<div class="product-info smart-form">
														
														<div class="row">
															<div class="col-md-6 col-sm-6 col-xs-6"> 
																<div class="btn-group">
																	<button class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
																		Accion <span class="caret"></span>
																	</button>
																	<ul class="dropdown-menu">
																		<li>
																			<a class="" href="<?php echo make_url("Vehiculos","show",array('id'=>$row['id'])); ?>"><i class="fa fa-plus"></i>Add Inf. Adic.</a>
																		</li>
																		<li>
																			<a class="" href="<?php echo make_url("Vehiculos","view",array('id'=>$row['id'])); ?>"> <i class="fa fa-eye"></i>Ver Detalles</a>
																		</li>
																		<li>
																			<a class="" href="<?php echo make_url("Vehiculos","showorden",array('id'=>$row['id'])); ?>"> <i class="fa fa-th-list"></i>Ver Orden</a>
																		</li>
																		<li>
																			<a class="" href="<?php echo make_url("Vehiculos","edit",array('id'=>$row['id'])); ?>"><i class="fa fa-edit"></i>Editar</a>
																		</li>
																		<li class="divider"></li>
																		<li>
																			<a href="#" class="red" onclick="borrar('<?php echo make_url("Vehiculos","deletevehiculo",array('id'=>$row['id'])); ?>',<?php echo $row['id']; ?>);">Eliminar</a>
																		</li>
																	</ul>
																</div>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
										<!-- end product -->
									</div>	
								<?php }?>
							
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