<?php
//initilize the page
require_once(SYSTEM_DIR . "/inc/init.php");
//require UI configuration (nav, ribbon, etc.)
require_once(SYSTEM_DIR . "/inc/config.ui.php");

/*---------------- PHP Custom Scripts ---------
YOU CAN SET CONFIGURATION VARIABLES HERE BEFORE IT GOES TO NAV, RIBBON, ETC.
E.G. $page_title = "Custom Title" */
$page_title = "Reporte de Gastos";

/* ---------------- END PHP Custom Scripts ------------- */
$page_css[] = "your_style.css";
include(SYSTEM_DIR . "/inc/header.php");

//include left panel (navigation)
include(SYSTEM_DIR . "/inc/nav.php");

$data = '';
if(isPost()){
	$begin = $_POST['fecha_inicial']; 
	$end   = $_POST['fecha_final'];
	$obj = new Gastos();
	$datagastos    = $obj->getReportGastos($begin,$end);
	
	$objper = new Personal();
	$datapersonal = $objper->getAllServicesGral($begin,$end);
	
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
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
					<!-- sparks -->
					<ul id="sparks" style="text-align:center">
						<li class="sparks-info">
							<h5> Servicios <span class="txt-color-blue"><i class="fa fa-arrow-circle-up" data-rel="bootstrap-tooltip" title="Increased"></i>&nbsp;$<span style='float: right;' id="total-numnomina"></span></span></h5>
							<div class="sparkline txt-color-blue hidden-mobile hidden-md hidden-sm">
								1300, 1877, 2500, 2577, 2000, 2100, 3000, 2700, 3631, 2471, 2700, 3631, 2471
							</div>
						</li>
						<li class="sparks-info">
							<h5> Gastos <span class="txt-color-purple"><i class="fa fa-arrow-circle-down" data-rel="bootstrap-tooltip" title="Increased"></i>&nbsp;$<span style='float: right;' id="total-globalgasto"></span></span></h5>
							<div class="sparkline txt-color-purple hidden-mobile hidden-md hidden-sm">
								110,150,300,130,400,240,220,310,220,300, 270, 210
							</div>
						</li>
						<li class="sparks-info">
							<h5> Utilidad <span class="txt-color-greenDark"><i class="fa fa-shopping-cart"></i>&nbsp;$<span style='float: right;' id="total-globalutilidades"></span></span></h5>
							<div class="sparkline txt-color-greenDark hidden-mobile hidden-md hidden-sm">
								110,150,300,130,400,240,220,310,220,300, 270, 210
							</div>
						</li>
					</ul>
					<!-- end sparks -->
				</div>
				<article class="col-xs-6 col-sm-12 col-md-6 col-lg-6">
					<div class="jarviswidget jarviswidget-color-white" id="wid-id-0" data-widget-editbutton="false" data-widget-colorbutton="false" data-widget-deletebutton="true">
						<header>
							<span class="widget-icon"> <i class="fa fa-table"></i> </span>
							<h2><?php echo $page_title ?></h2>
						</header>
						<div style="display: ;">
                            <div class="jarviswidget-editbox" style=""></div>
                            <div class="widget-body">
								<form id="main-form" class="" role="form" method='post' action="<?php echo make_url("Reportes","gastos");?>" onsubmit="return checkSubmit();" enctype="multipart/form-data">     
                                    <fieldset>    
                                        <div class="col-sm-6">
							                <div class="form-group">
							                    <label for="name">Fecha Inicial</label>
							                    <input type="text" class="form-control datepicker" data-dateformat='yy-mm-dd' autocomplete="off" value="<?php echo date('Y-m-d'); ?>" placeholder="Fecha Inicial" name="fecha_inicial" >
							                </div>
							                <div class="form-group">
							                    <label for="name">Fecha Final</label>
							                    <input type="text" class="form-control datepicker" data-dateformat='yy-mm-dd' autocomplete="off" value="<?php echo date('Y-m-d'); ?>" placeholder="Fecha Final" name="fecha_final" >
							                </div>
							            </div>
                                    </fieldset> 
                                    <div class="form-actions" style="text-align: center">
                                        <div class="row">
                                           <div class="col-md-12">
                                                <button class="btn btn-default btn-md" type="button" onclick="window.history.go(-1); return false;">
                                                    Cancelar
                                                </button>
                                                <button class="btn btn-primary btn-md" type="button" onclick=" validateForm();">
                                                    <i class="fa fa-save"></i>
                                                    Generar
                                                </button>
                                            </div>
                                        </div>
                                    </div>                              
                                </form>
                            </div>
                        </div>
					</div>
				</article>
				
			</div>
			

			<?php if(isset($datagastos) && $datagastos!=''){ ?>
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
												<th class = "col-md-1" data-hide="phone,tablet"> No. Gastos</th>
												<th class = "col-md-1" data-class="expand"> Concepto</th>
												<th class = "col-md-1" data-class="expand"> Tipo Gasto</th>
												<th class = "col-md-1" data-class="expand"> Gasto</th>
												<th class = "col-md-1" data-hide=""> Total</th>
												<th class = "col-md-1" data-hide="phone,tablet">Usuario Alta</th>
												<th class = "col-md-1" data-hide="phone,tablet">Fecha Alta</th>
												<th class = "col-md-1" data-hide="phone,tablet">Action</th>
											</tr>
										</thead>
										<tbody>
											<?php  foreach($datagastos as $row) {
												?>
												<tr>
												<input type='hidden' style='width: 80px;' class='form-control totalesgastos' name='totalesregistros[]' value='<?php echo htmlentities($row['total']) ?>' placeholder='00.00'>
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
			<?php }?>
			<?php if(isset($datapersonal) && $datapersonal!=''){ ?>
				<div class="row">
					<article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
						<div class="jarviswidget jarviswidget-color-white" id="wid-id-1" data-widget-editbutton="false" data-widget-colorbutton="false" data-widget-deletebutton="true">
							<header>
								<span class="widget-icon"> <i class="fa fa-table"></i> </span>
								<h2><?php echo "Reporte de Servicios" ?></h2>
							</header>
							<div>
								<div class="jarviswidget-editbox">
								</div>
								<div class="widget-body">
									<table id="dt_basic2" class="table table-striped table-bordered table-hover" width="100%">
										<thead>
											<tr>
												<th class = "col-md-1" data-hide="phone,tablet"> Cant. Serv.</th>
												<th class = "col-md-1" data-class="expand"> Personal </th>
												<th class = "col-md-1" data-class="pexpand"> Auto.</th>
												<th class = "col-md-1" data-hide=""> Fecha </th>
												<th class = "col-md-1" data-class="phone,tablet"> TOTAL </th>
												<th class = "col-md-1" data-hide="phone,tablet"> Actions</th>
											</tr>
										</thead>
										<tbody>
											<?php 
											$totalglobal = 0 ;
											foreach($datapersonal as $lineId => $row) {
												$idpersonal = $row['id_personal'];
												
												$nombre         = htmlentities($row['nombre'].' '.$row['apellido_pat'].' '.$row['apellido_mat']) ;
												$nombrevehiculo =  htmlentities($row['marca']." ".$row['submarca']." - ". $row['modelo']);
												$id_vehiculo    =  htmlentities($row['id_vehiculo']);
												$status         = htmlentities($row['status']);
												$total      = $row['total'];
												$queryAllServices = $objper->getAllServices($begin,$end,$row['id_personal']);
												
												$detalles = json_encode($queryAllServices);
												$detalles = $nombre."<input type='hidden' name='detalles[]' value='".$detalles."'>";
												
											?>
											<tr class='personal' lineidpersonal='<?php echo $lineId; ?>'>
												<td><?php echo $row['cantidad_servicios']; ?></td>
												<td><?php echo $detalles; ?></td>
												<td><?php echo $nombrevehiculo; ?></td>
												<td><?php echo $row['fecha']; ?></td>
												<td>
													<span style='float:left;padding-top: 10px;'>$&nbsp;</span>
													<input type='number' style='width: 80px;' class='form-control totalespersonal' name='totalpersonal[]' value='<?php echo htmlentities($total) ?>' placeholder='00.00'>
												</td>
												<td class='borrar-td'>
													<a data-toggle="modal" class="btn-historyservices" title="Ver Servicios" href="#myModal" idper='<?php echo $row['id_personal']; ?>' >
															<i class="fa fa-history"></i>&nbsp;Servicios
													</a>
													
												</td>
											</tr>

											<?php
											} 
											?>
										</tbody>
									</table>
								</div>
							</div>
						</div>
					</article>
				</div>
			<?php }?>
		</section>
	</div>
	<!-- END MAIN CONTENT -->
</div>
<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                    &times;
                </button>
                <h4 class="modal-title">
                    <img src="<?php echo ASSETS_URL; ?>/img/logo.png" width="50" alt="SmartAdmin">
                    <div id='titlemodal' style="float:right; margin-right: 20px;">
                        <span class="widget-icon"><i class="fa fa-plus"></i> Nuevo</span>
                    </div>
                    
                </h4>
            </div>
            <div class="modal-body no-padding" >
                <div id="contentpopup">

                </div>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
<!-- /.modal -->
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
 	function validateForm()
    {
        var fecha_inicial = $("input[name=fecha_inicial]").val();
        if ( ! fecha_inicial )  return notify("info","La fecha inicial es requerido");
		var fecha_final = $("input[name=fecha_final]").val();
        if ( ! fecha_final )  return notify("info","La fecha final es requerido");

        $("#main-form").submit();       
	}
	var totalgastos=totalservicios=0;
	calcTotalnomina = function() {
		var totalespersonal     = $(".totalespersonal");
		var total = 0;
		for (var i = 0, len = totalespersonal.length; i < len; i++) {
			var valor=$(totalespersonal[i]).val();
			if (! isNaN( valor )  && valor > 0 ){
				total += parseFloat(valor);
				
				console.log(total);    
			}
		}
		
		$("#total-numnomina").html(total);
		totalgastos=total;
	}
	calcTotalgasto = function() {
		var totalesgastos     = $(".totalesgastos");
		var total = 0;
		for (var i = 0, len = totalesgastos.length; i < len; i++) {
			var valor=$(totalesgastos[i]).val();
			if (! isNaN( valor )  && valor > 0 ){
				total += parseFloat(valor);
				
				console.log(total.toFixed(2));    
			}
		}
		$("#total-globalgasto").html(total.toFixed(2));
		totalservicios=total;
	}
	calcTotalUtilidad = function() {
		
		var totalutilidades = totalgastos - totalservicios;
		console.log(totalutilidades.toFixed(2));
		$("#total-globalutilidades").html(totalutilidades.toFixed(2));
	}
	$('body').on('click', '.btn-historyservices', function(){
		//history servicios personal
		var id        = $(this).attr("idper");
		var fechaini  = $('#fecha_inicial').val();
		var fechafin  = $('#fecha_final').val();
		$('#titlemodal').html('<span class="widget-icon"><i class="far fa-plus"></i> Historial Servicios</span>');
		$.get(config.base+"/Personal/ajax/?action=get&object=showpopupHistoryServices&id="+ id + '&fechaini=' + fechaini + '&fechafin=' +fechafin , null, function (response) {
			if ( response ){
				$("#contentpopup").html(response);
			}else{
				return notify('error', 'Error al obtener los datos del Formulario');
			}     
		});
    });
      
	calcTotalnomina();
	calcTotalgasto();
	calcTotalUtilidad();
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
		var table = $('#dt_basic2').dataTable();
		
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
