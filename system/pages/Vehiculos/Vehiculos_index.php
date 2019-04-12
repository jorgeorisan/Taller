
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
$page_css[] = "vehiculo_style.css";
include(SYSTEM_DIR . "/inc/header.php");

//include left panel (navigation)
include(SYSTEM_DIR . "/inc/nav.php");

$obj = new Vehiculo();
$data = $obj->getAllArr();
$status_vehiculo = "";
if(isPost()){
	$status_vehiculo = $_POST['status_vehiculo']; 
	$data = $obj->getAllArr($status_vehiculo);
}
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
                <div class="widget-body" style='padding-left: 15px;'>
					<a class="btn btn-success" href="<?php echo make_url("Vehiculos","add")?>" ><i class="fas fa-wrench"></i>&nbsp; Nueva Orden</a>
					<a class="btn btn-info" href="<?php echo make_url("Vehiculos","indexlist")?>" ><i class="fas fa-list-ol"></i>&nbsp;Modo Lista</a>
					<div class="row">
						<div  class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
							<form id="main-form" class="" role="form" method='post' action="<?php echo make_url("Vehiculos","index");?>" onsubmit="return checkSubmit();" enctype="multipart/form-data">     
								<div class="form-group"><br>
									<select style="width:100%" class="select2" name='status_vehiculo' id="status_vehiculo">
										<option value="">Selecciona Status Auto </option>
										<?php 
										$list= getStatusAutos();
										if (is_array($list)){
											foreach($list as $key => $val){
												$selected = ($key == $status_vehiculo) ? " selected ": "";
												
												echo "<option $selected value='".$key."'>".htmlentities($val)."</option>";
											}
										}
										?>
									</select>
								</div>
							</form>
						</div>
					</div>
                </div>
            </div>		 
			<div class="row">&nbsp;</div>
			<div class="row">
				<article class="col-xs-12 col-sm-12 col-md-12 col-lg-12 content-view" >
					<div class="jarviswidget jarviswidget-color-white" id="wid-id-0" data-widget-editbutton="false" data-widget-colorbutton="false" data-widget-deletebutton="true">
						<header>
							<span class="widget-icon"> <i class="fa fa-table"></i> </span>
							<h2><?php echo $page_title ?></h2>
						</header>
						<div>
							<div class="jarviswidget-editbox"></div>
							<div class="widget-body">
								<?php foreach($data as $key => $row){
									$carpetaexpediente = $obj->getCarpetaexpediente($row["id"]);
									$key++;
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
										if($datacliente){ $nomcliente = $datacliente["nombre"] ." ". $datacliente["apellido_pat"] ." ". $datacliente["apellido_mat"]."<br>Tel.".$datacliente["telefono"]; }
									}
									$fechaalta = ($row['fecha_alta'])    ? date('Y-m-d',strtotime($row['fecha_alta'])) : "";
									$fechaprom = ($row['fecha_promesa']) ? date('Y-m-d',strtotime($row['fecha_promesa'])) : "";
									$fechater  = ($row['fecha_termino']) ? date('Y-m-d',strtotime($row['fecha_termino'])) : "";
								    $carpetaimg = ASSETS_URL.'/'.$carpetaexpediente.'/auto'.DIRECTORY_SEPARATOR.'auto_'.$row["id"].DIRECTORY_SEPARATOR.'images';
                                    $objimg = new ImagenesVehiculo();
                                    $dataimagenes = $objimg->getAllArr($row["id"]);
                                    $link='';
                                    foreach($dataimagenes as $rowimg) {
                                    	if($link) continue;

                                        $link = $carpetaimg.DIRECTORY_SEPARATOR.$rowimg['nombre'];
									}
									$link = ($link) ? $link :ASSETS_URL.'/'.$carpetaexpediente.'/base_auto.png' ;
									$diastranscurridos = dias_transcurridos($row['fecha_alta'],date('Y-m-d'));
									if (($key % 3) == 0){
										echo "<div class='row ".$key."'>";
									} 
									?>
										<div class="col-sm-6 col-md-4 col-lg-4">
											<div class="product-content product-wrap clearfix">
												<div class="row">
													<div class="col-md-5 col-sm-12 col-xs-12">
														<a class="" href="<?php echo make_url("Vehiculos","view",array('id'=>$row['id'])); ?>"> 
															<div class="product-image"> 
																<a class="" href="<?php echo make_url("Vehiculos","view",array('id'=>$row['id'])); ?>"> 
																	<img src="<?php echo $link; ?>" alt="194x228" class="img-responsive" style='max-width:120px'> 
																	<?php 
																	if($row['status_vehiculo']=='Pendiente'){ ?>
																		<span title='<?php echo $diastranscurridos; ?> dias ' class="tag2 <?php if($diastranscurridos<10) echo  'sale'; else echo  'hot' ;?>">
																		<?php if($diastranscurridos<10) echo  'NEW'; else echo  'OLD' ;?>
																		</span>
																	<?php
																	}?>
																	 
																</a>
																<div class="description">
																	<small><strong>Cliente:</strong> <?php echo $nomcliente ?></small>
																</div>
															</div>
														</a>
													</div>
													<div class="col-md-7 col-sm-12 col-xs-12">
														<div class="product-deatil">
															<h6 class="name">
																<?php echo $nommarca." ".$nomsubmarca." - ". $row['modelo'] ?>
															</h6>
															<h5 class="name">
																
																<small><strong>Fecha Alta:</strong> <?php echo htmlentities($fechaalta) ?></small>
																<small><strong>Fecha Prom:</strong> <?php echo htmlentities($fechaprom) ?></small>
																<?php 
																if($row['status_vehiculo']!='Pendiente'){ ?>
																	<small><strong>Fecha Term:</strong> <?php echo htmlentities($fechater) ?></small>
																<?php
																}?>
																<?php
																if ($row["id_aseguradora"]>1) { ?>
																	<small><strong>Aseguradora:</strong> <?php echo htmlentities($nomaseguradora) ?></small> 
																<?php
																}
																$porcent = $obj->getPorcentaje($row['id']);
																$porcentdec= number_format(($porcent/10)/2,0);
																for($i=1; $i<=5; $i++){
																	if($i<=$porcentdec){
																		echo "<i class='fa fa-star fa-2x text-primary'></i>";
																	}else{
																		echo "<i class='fa fa-star fa-2x text-muted'></i>";
																	}
																}
																?>
																<span class="fa fa-2x"><h5><?php echo  $porcent; ?> %</h5></span>	
															</h5>
															<p class="price-container">
																<span><?php echo htmlentities($row['matricula'])?></span>
															</p>
															<span class="fa fa-2x">
																<h5><a href="javascript:void(0);"><strong><?php echo  $row['status_vehiculo'] ?></strong> </a>
																<?php 
																if($row['status_vehiculo']=='Terminado sin firma'){
																	?>
																	<a href="#" id='btn-firmado<?php $key ?>' onclick='ActualizarAuto(<?php echo $row["id"]; ?>)' class="btn btn-info" style='color:white'>
																		<i class="fa fa-check"></i>&nbsp;Firmar
																	</a>
																	<?php
																}?>
																</h5>
															</span>
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
																				<a class="" href="<?php echo make_url("Vehiculos","view",array('id'=>$row['id'])); ?>"> <i class="fa fa-eye"></i>&nbsp;Ver Detalles</a>
																			</li>
																			<li>
																				<a class="" href="<?php echo make_url("Vehiculos","showorden",array('id'=>$row['id'])); ?>"> <i class="fa fa-th-list"></i>&nbsp;Ver Orden</a>
																			</li>
																			<li>
																				<a class="" href="<?php echo make_url("Vehiculos","edit",array('id'=>$row['id'])); ?>"><i class="fa fa-edit"></i>&nbsp;Editar</a>
																			</li>
																			<li class="divider"></li>
																			<li>
																				<a href="#" class="red" onclick="borrar('<?php echo make_url("Vehiculos","vehiculodelete",array('id'=>$row['id'])); ?>',<?php echo $row['id']; ?>);"><i class="fa fa-trash"></i>&nbsp;Eliminar</a>
																			</li>
																		</ul>
																	</div>
																</div>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
								<?php 
									if (($key % 3) == 0){
										echo "</div>";
									} 
										
								}
								?>
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
		function ActualizarAuto(id){
			var id_vehiculo    = id;
			var url  = config.base+"/Vehiculos/ajax/?action=get&object=change-statusvehiculo"; 
			var data = "id_vehiculo=" + id_vehiculo ;
			$.ajax({
				type: "POST",
				url: url,
				data: data, 
				success: function(response){
					if(response){
						location.reload();
					}else{
						notify('error',"Oopss error al cambiar estatus: "+response);
					}
				}
				});
			return false; 
		}
		$('body').on('change', '#status_vehiculo', function(){
			$("#main-form").submit(); 
        });
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
