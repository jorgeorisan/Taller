
<?php
//initilize the page
require_once(SYSTEM_DIR . "/inc/init.php");
//require UI configuration (nav, ribbon, etc.)
require_once(SYSTEM_DIR . "/inc/config.ui.php");

/*---------------- PHP Custom Scripts ---------
YOU CAN SET CONFIGURATION VARIABLES HERE BEFORE IT GOES TO NAV, RIBBON, ETC.
E.G. $page_title = "Custom Title" */
$page_title = "Taller";

/* ---------------- END PHP Custom Scripts ------------- */
$page_css[] = "your_style.css";
include(SYSTEM_DIR . "/inc/header.php");

//include left panel (navigation)
include(SYSTEM_DIR . "/inc/nav.php");

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
$fechaalta = ($data['fecha_alta']) ?    date('Y-m-d',strtotime($data['fecha_alta'])) : "";
$fechaprom = ($data['fecha_promesa']) ? date('Y-m-d',strtotime($data['fecha_promesa'])) : "";
$carpetaimg = ASSETS_URL.'/expediente/auto'.DIRECTORY_SEPARATOR.'auto_'.$id.DIRECTORY_SEPARATOR.'images';
$objimg = new ImagenesVehiculo();
$dataimagenes = $objimg->getAllArr($id);
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
			<!--
			The ID "widget-grid" will start to initialize all widgets below 
			You do not need to use widgets if you dont want to. Simply remove 
			the <section></section> and you can use wells or panels instead 
			-->

		<!-- widget grid -->
		<section id="widget-grid" class="">

			<!-- row -->

			<div class="row">

				<div class="col-sm-12 col-md-12 col-lg-12">
					<!-- product -->
					<div class="product-content product-wrap clearfix product-deatil">
						<div class="row">
								<div class="col-md-5 col-sm-12 col-xs-12 ">
									<div class="product-image"> 
										<div id="myCarousel-2" class="carousel slide">
										<ol class="carousel-indicators">
											<li data-target="#myCarousel-2" data-slide-to="0" class=""></li>
											<li data-target="#myCarousel-2" data-slide-to="1" class="active"></li>
											<li data-target="#myCarousel-2" data-slide-to="2" class=""></li>
										</ol>
										<div class="carousel-inner">
											<?php 
			                                    foreach($dataimagenes as $key => $row) {
			                                    	$active = ($key==1) ? 'active' : '';

			                                        echo "<div class='item ".$active."'>
			                                                <img src='".$carpetaimg.DIRECTORY_SEPARATOR.$row['nombre']."'
			                                                alt='".$row['nombre']."' title='".$row['nombre']."'
			                                               max-width='430px'
			                                                >
			                                            </div>";
			                                    }
			                                ?>   
										</div>
										<a class="left carousel-control" href="#myCarousel-2" data-slide="prev"> <span class="glyphicon glyphicon-chevron-left"></span> </a>
										<a class="right carousel-control" href="#myCarousel-2" data-slide="next"> <span class="glyphicon glyphicon-chevron-right"></span> </a>
										</div>
									</div>
								</div>
								<div class="col-md-7 col-sm-12 col-xs-12">
							
								<h2 class="name">
									<?php echo $nommarca." ".$nomsubmarca." - ". $data['modelo'] ?>
									<small><strong>Cliente:</strong> <a class="" href="<?php echo make_url("Clientes","show",array('id'=>$data['id_cliente'])); ?>"><?php echo $nomcliente ?></a></small>
									<small><strong>Taller:</strong> <a class="" href="<?php echo make_url("Taller","show",array('id'=>$data['id_taller'])); ?>"><?php echo $nomtaller ?></a></small>
									<small><strong>Acesor:</strong> <a class="" href="<?php echo make_url("User","show",array('id'=>$data['id_user'])); ?>"><?php echo $nombreasesor ?></a></small>
									<small><strong>Aseguradora:</strong> <a class="" href="<?php echo make_url("Aseguradora","show",array('id'=>$data['id_aseguradora'])); ?>"><?php echo $nomaseguradora ?></a></small>
									<i class="fa fa-star fa-2x text-primary"></i>
									<i class="fa fa-star fa-2x text-primary"></i>
									<i class="fa fa-star fa-2x text-primary"></i>
									<i class="fa fa-star fa-2x text-primary"></i>
									<i class="fa fa-star fa-2x text-muted"></i>
									<span class="fa fa-2x"><h5>80 %</h5></span>	
									
									<a href="javascript:void(0);">Status Completed</a>
		 
								</h2>
								<hr>
								
							
								<div class="certified">
									<ul>
										<li><a href="javascript:void(0);">Fecha de Alta<span><?php echo $fechaalta?></span></a></li>
										<li><a href="javascript:void(0);">Fecha Promesa<span><?php echo $fechaprom ?></span></a></li>
									</ul>
								</div>
								<hr>
								<div class="description description-tabs">


									<ul id="myTab" class="nav nav-pills">
										<li class="active"><a href="#more-information" data-toggle="tab" class="no-margin">Trabajos a realizar </a></li>
										<li class=""><a href="#pendientes" data-toggle="tab">Pendientes</a></li>
										<li class=""><a href="#terminados" data-toggle="tab">Terminados</a></li>
										<li class=""><a href="#reviews" data-toggle="tab">Blog</a></li>
									</ul>
									<div id="myTabContent" class="tab-content">
										<div class="tab-pane fade active in" id="more-information">
											<br>
											<strong>Trabajos a realizar</strong>
											<p> </p>
										</div>
										<div class="tab-pane fade" id="pendientes">
											<br>
											<dl class="">
												<dt>Trabajos pendientes</dt>
		                                       	<p> </p> 
		                                    </dl>
										</div>
										<div class="tab-pane fade" id="terminados">
											<br>
											<dl class="">
												<dt>Trabajos terminados</dt>
		                                       	<p> </p> 
		                                    </dl>
										</div>
										<div class="tab-pane fade" id="reviews">
											<br>
											<form method="post" class="well padding-bottom-10" onsubmit="return false;">
												<textarea rows="2" class="form-control" placeholder="Write a review"></textarea>
												<div class="margin-top-10">
													<button type="submit" class="btn btn-sm btn-primary pull-right">
														Submit Review
													</button>
													
												</div>
											</form>

											<div class="chat-body no-padding profile-message">
												<ul>
													<li class="message">
														<img src="img/avatars/1.png" class="online">
														<span class="message-text"> 
															<a href="javascript:void(0);" class="username">
																Alisha Molly 
																<span class="badge">Purchase Verified</span> 
																<span class="pull-right">
																	<i class="fa fa-star fa-2x text-primary"></i>
																	<i class="fa fa-star fa-2x text-primary"></i>
																	<i class="fa fa-star fa-2x text-primary"></i>
																	<i class="fa fa-star fa-2x text-primary"></i>
																	<i class="fa fa-star fa-2x text-muted"></i>
																</span>
															</a> 
															
															
															Can't divide were divide fish forth fish to. Was can't form the, living life grass darkness very image let unto fowl isn't in blessed fill life yielding above all moved 
														</span>
														<ul class="list-inline font-xs">
															<li>
																<a href="javascript:void(0);" class="text-info"><i class="fa fa-thumbs-up"></i> This was helpful (22)</a>
															</li>
															<li class="pull-right">
																<small class="text-muted pull-right ultra-light"> Posted 1 year ago </small>
															</li>
														</ul>
													</li>
													<li class="message">
														<img src="img/avatars/2.png" class="online">
														<span class="message-text"> 
															<a href="javascript:void(0);" class="username">
																Aragon Zarko 
																<span class="badge">Purchase Verified</span> 
																<span class="pull-right">
																	<i class="fa fa-star fa-2x text-primary"></i>
																	<i class="fa fa-star fa-2x text-primary"></i>
																	<i class="fa fa-star fa-2x text-primary"></i>
																	<i class="fa fa-star fa-2x text-primary"></i>
																	<i class="fa fa-star fa-2x text-primary"></i>
																</span>
															</a> 
															
															
															Excellent product, love it!
														</span>
														<ul class="list-inline font-xs">
															<li>
																<a href="javascript:void(0);" class="text-info"><i class="fa fa-thumbs-up"></i> This was helpful (22)</a>
															</li>
															<li class="pull-right">
																<small class="text-muted pull-right ultra-light"> Posted 1 year ago </small>
															</li>
														</ul>
													</li>
												</ul>
											</div>
										</div>
									</div>
							

								</div>
								<hr>
								<div class="row">
									<div class="col-sm-12 col-md-6 col-lg-6">
											<a href="<?php echo make_url("Vehiculos","showorden",array('id'=>$data['id'])); ?>" class="btn btn-success btn-lg"><i class="fa fa-th-list"></i>Orden de Trabajo</a>
										
									</div>
									<div class="col-sm-12 col-md-6 col-lg-6">
										<div class="btn-group pull-right">
				                            <button class="btn btn-white btn-default"><i class="fa fa-star"></i> Add to wishlist </button>
				                            <button class="btn btn-white btn-default"><i class="fa fa-envelope"></i> Contact Seller</button>
				                        </div>
									</div>
								</div>
								
							</div>
						</div>
					</div>
					<!-- end product -->
				</div>	

			</div>

			<!-- end row -->

		</section>
		<!-- end widget grid -->
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