
<?php
//initilize the page
require_once(SYSTEM_DIR . "/inc/init.php");
//require UI configuration (nav, ribbon, etc.)
require_once(SYSTEM_DIR . "/inc/config.ui.php");

/*---------------- PHP Custom Scripts ---------
YOU CAN SET CONFIGURATION VARIABLES HERE BEFORE IT GOES TO NAV, RIBBON, ETC.
E.G. $page_title = "Custom Title" */
$page_title = "Ver Vehiculo";

/* ---------------- END PHP Custom Scripts ------------- */
$page_css[] = "vehiculo_style.css";
include(SYSTEM_DIR . "/inc/header.php");

//include left panel (navigation)
include(SYSTEM_DIR . "/inc/nav.php");

if(isset($request['params']['id'])   && $request['params']['id']>0)
    $id=$request['params']['id'];
else
	informError(true,make_url("Vehiculo","index"));
	
$obj = new Vehiculo();
$data = $obj->getTable($id);
if ( !$data ) {
    informError(true,make_url("Vehiculo","index"));
}

$nombreasesor = $nomtaller = $nommarca = $nomsubmarca = $nomaseguradora = $nomcliente = "";
$domicilio    = "";
$telefono     = ""; 
$email        = ""; 
if($data["id_user"]){
    $objacesor    = new User();
    $dataasesor   = $objacesor->getTable($data["id_user"]);
    $nombreasesor = ($dataasesor) ? $dataasesor["nombre"] ." ". $dataasesor["apellido_pat"] : '';
}
if($data["id_taller"]){
    $objtaller  = new Taller();
    $datataller = $objtaller->getTable($data["id_taller"]);
    $nomtaller  = ($datataller) ? $datataller["nombre"]  : '';
}
if($data["id_marca"]){
    $objmarca  = new Marca();
    $datamarca = $objmarca->getTable($data["id_marca"]);
	$nommarca  = ($datamarca) ? $datamarca["nombre"] : '';
}
if($data["id_submarca"]){
    $objsubmarca  = new SubMarca();
    $datasubmarca = $objsubmarca->getTable($data["id_submarca"]);
	$nomsubmarca  = ($datasubmarca) ? $datasubmarca["nombre"] : '';
}
if($data["id_aseguradora"]){
    $objaseguradora  = new Aseguradora();
    $dataaseguradora = $objaseguradora->getTable($data["id_aseguradora"]);
	$nomaseguradora  = ($dataaseguradora) ? $dataaseguradora["nombre"] : 'N/E';
}
if($data["id_cliente"]){
    $objcliente  = new Cliente();
    $datacliente = $objcliente->getTable($data["id_cliente"]);
    if($datacliente){
        $nomcliente = $datacliente["nombre"] ." ". $datacliente["apellido_pat"] ." ". $datacliente["apellido_mat"];
        $domicilio  = $datacliente["ciudad"] ." ". $datacliente["estado"]. " Col." .$datacliente["colonia"] ." Call." .$datacliente["calle"]." ".$datacliente["num_ext"]. " " .$datacliente["num_int"];
        $telefono   = $datacliente["telefono"];
        $email      = $datacliente["email"];
    }
}
$fechaalta  = ($data['fecha_alta'])    ? date('Y-m-d',strtotime($data['fecha_alta']))    : "";
$fechaprom  = ($data['fecha_promesa']) ? date('Y-m-d',strtotime($data['fecha_promesa'])) : "";
$carpetaimg = ASSETS_URL.'/expediente/auto'.DIRECTORY_SEPARATOR.'auto_'.$id.DIRECTORY_SEPARATOR.'images';

$objimg       = new ImagenesVehiculo();
$dataimagenes = $objimg->getAllArr($id);
$objref       = new VehiculoRefaccion();
$dataref      = $objref->getAllArr($id);
$objser       = new VehiculoServicio();
$dataser      = $objser->getAllArr($id);
if(isPost()){
    $obj = new Vehiculo();
    if($id>0){
        $uploadimages = $contimages = 0;

        //imagenes anteriores
        if (isset($_POST['filelastvehiculo'])){
            echo 1;
            $cantidad = count($_POST['filelastvehiculo']);
            $objimg = new ImagenesVehiculo();
            $idimg  = $objimg->deleteAll($id);
            $arraynum =[];
            for ($i=0; $i < $cantidad; $i++){
                if(!$_POST['filelastvehiculo'][$i]) continue;
                
                $idimg  = $objimg->addImage($id,$_POST['filelastvehiculo'][$i]);  
                $ultimonum  = explode("_", $_POST['filelastvehiculo'][$i]);
                $uploadimages++;
                $arraynum[$i]=$ultimonum[0];
            }  
            $contimages = max($arraynum);
        }
        //nuevas imagenes
        if (isset($_FILES['filevehiculo'])){
            $cantidad = count($_FILES["filevehiculo"]["tmp_name"]);
            for ($i=0; $i < $cantidad; $i++){
                if(!$_FILES['filevehiculo']['type'][$i]) continue;
                
                $uploadimages++;
            }
            if($uploadimages){
                $carpeta  = EXPEDIENTE_DIR .DIRECTORY_SEPARATOR. 'auto'.DIRECTORY_SEPARATOR.'auto_'.$id;
	            if ( !file_exists($carpeta) ) {
	                mkdir($carpeta, 0777, true);
	                if ( !file_exists($carpetaimg) ) {
	                    mkdir($carpetaimg, 0777, true);
	                }
	            }else{
                    $carpetaimg = $carpeta.DIRECTORY_SEPARATOR."images";
                }
                $objimg = new ImagenesVehiculo();
                if($uploadimages==0)  $objimg->deleteAll($id);
               
                for ($i=0; $i < $cantidad; $i++){
                    $code = rand(1000, 100000);
                    $contimages++;
                    if(!$_FILES['filevehiculo']['type'][$i]) continue;
                    //Comprobamos si el fichero es una imagen
                    $subir=0;
                    if ($_FILES['filevehiculo']['type'][$i]=='image/png' || $_FILES['filevehiculo']['type'][$i]=='image/jpeg'){
                        if ( isset($_POST['deletefilevehiculo'] ) ) {
                            $imagesdeleted = $_POST['deletefilevehiculo'];
                            $pos = strpos($imagesdeleted, $_FILES["filevehiculo"]["name"][$i]); //quitamos las imagenes eliminadas
                            if ($pos === false) {
                                 move_uploaded_file($_FILES["filevehiculo"]["tmp_name"][$i], $carpetaimg.DIRECTORY_SEPARATOR.$_FILES["filevehiculo"]["name"][$i]);
                                $subir=1;
                            }   
                        }else{
                            move_uploaded_file($_FILES["filevehiculo"]["tmp_name"][$i], $carpetaimg.DIRECTORY_SEPARATOR.$_FILES["filevehiculo"]["name"][$i]);
                            $subir=1;
                        } 
                        if($subir)  {
                            $objimg = new ImagenesVehiculo();
	                        $idimg  = $objimg->addImage($id,$_FILES["filevehiculo"]["name"][$i]);  
	                        if(!$idimg){
	                            echo "Error al añadir imagen".$id."->".$carpetaimg."->".$_FILES["filevehiculo"]["name"][$i];
	                            exit;
	                        }  
                        } 
                
                    $validar=true;
                    }
                    else $validar=false;
                        
                }
                
            }
        }
           
        if ($uploadimages == 0) { echo 3; $objimg = new ImagenesVehiculo();  $idimg  = $objimg->deleteAll($id); }
  
        informSuccess(true, make_url("Vehiculos","view",array('id'=>$id)));
    }else{
        informError(true,make_url("Vehiculos","view",array('id'=>$id)),"view");
    }
}
//print_r($users);
?>
<style type="text/css">
	.superbox-list{
		width:100px;
	}
</style>
<!-- ==========================CONTENT STARTS HERE ========================== -->
<!-- MAIN PANEL -->
<div id="main" role="main">
	<?php $breadcrumbs["Vehiculos"] = APP_URL."/Vehiculos"; include(SYSTEM_DIR . "/inc/ribbon.php"); ?>
	<!-- MAIN CONTENT -->
	<div id="content">
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
											$image= "";
											foreach($dataimagenes as $key => $row) {
												$active = ($key==1) ? 'active' : '';
												$image.= "<div class='item ".$active."'>
														<img src='".$carpetaimg.DIRECTORY_SEPARATOR.$row['nombre']."'
														alt='".$row['nombre']."' title='".$row['nombre']."'
														max-width='430px'
														>
													</div>";
											}
											if(!$image) {
												$image = "
													<div class='item active '>
														<img src='".ASSETS_URL.'/expediente/base_auto.png'."' max-width='430px'
														alt='base_auto.png' title='base_auto.png' >
													</div>";
											}
											echo $image;
										?>   
									</div>
									<a class="left carousel-control" href="#myCarousel-2" data-slide="prev">  <span class="glyphicon glyphicon-chevron-left"></span> </a>
									<a class="right carousel-control" href="#myCarousel-2" data-slide="next"> <span class="glyphicon glyphicon-chevron-right"></span> </a>
									</div>
								</div>
							</div>
							<div class="col-md-7 col-sm-12 col-xs-12">
								<div class="col-sm-8 col-md-8 col-lg-8">
									<h2 class="name">
										<?php echo $nommarca." ".$nomsubmarca." - ". $data['modelo'] ?>
										<small><strong>Cliente:</strong> <a class="" href="<?php echo make_url("Clientes","show",array('id'=>$data['id_cliente'])); ?>"><?php echo $nomcliente ?></a></small>
										<small><strong>Taller:</strong> <a class="" href="<?php echo make_url("Taller","show",array('id'=>$data['id_taller'])); ?>"><?php echo $nomtaller ?></a></small>
										<small><strong>Acesor:</strong> <a class="" href="<?php echo make_url("User","show",array('id'=>$data['id_user'])); ?>"><?php echo $nombreasesor ?></a></small>
										<?php if($data["id_aseguradora"]){ ?>
											<small><strong>Aseguradora:</strong> <a class="" href="<?php echo make_url("Aseguradora","show",array('id'=>$data['id_aseguradora'])); ?>"><?php echo $nomaseguradora ?></a></small>
										<?php }?>
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
								</div>
								<form id="main-form" class="" role="form" method="post" action="<?php echo make_url("Vehiculos","view",array('id'=>$data['id']))?>" onsubmit="return checkSubmit();" enctype="multipart/form-data">     
									<div class="col-sm-3 col-md-3 col-lg-3" style="text-align: center;">
										<div class="btn-group">
											<a href="<?php echo make_url("Vehiculos","showorden",array('id'=>$data['id'])); ?>" 
											class="btn btn-success"><i class="fa fa-th-list"></i>&nbsp;Ver Orden</a>
										</div>
										<div class="form-group" style="padding-top: 20px;">
	                                        <button type="button" title='Agregar imagen' class="btn btn-primary btn-circle btn-xl" onclick="getFoto('filevehiculo'); return false;">
	                                            <i class="fa fa-camera"></i>
	                                        </button>
	                                        <input type="file" id="filevehiculo"  name="filevehiculo[]" accept="image/*" style="display:none"  multiple>
	                                        <input type="hidden" id="deletefilevehiculo"  name="deletefilevehiculo" style="">
	                                        <br>
	                                        <a href="javascript:$('.cont-imagesvehiculo').toggle()">Mostrar/Ocultar</a>
	                                        
	                                    </div>
									</div>
									<div class="col-sm-12 col-md-12 col-lg-12 cont-imagesvehiculo" hidden>
										<div  id="contfilevehiculo" >
											<?php 
		                                        
			                                    $objimg = new ImagenesVehiculo();
			                                    $dataimagenes = $objimg->getAllArr($id);
		                                        $key = 0;
		                                        foreach($dataimagenes as $key => $row) {
		                                            
		                                            echo "<div class='superbox-list' id='image_".$key."'>
		                                                    <img title='click para eliminar' id='image_".$key."' onclick='deleteimage(".$key.");  return false;' 
		                                                    src='".$carpetaimg.DIRECTORY_SEPARATOR.$row['nombre']."'
		                                                    alt='".$row['nombre']."' title='".$row['nombre']."'
		                                                    nameimage='".$row['nombre']."'
		                                                    width='100px'  height='100px' >
		                                                    <input type='hidden'  name='filelastvehiculo[]' value='".$row['nombre']."'>
		                                                </div>";
		                                        }
		                                    ?>    
										</div>
										<div class="form-actions cont-buttons" style="text-align: center" hidden>
	                                        <div class="row">
	                                           <div class="col-md-12">
	                                                <button class="btn btn-default btn-md" type="button" onclick="window.history.go(-1); return false;">
	                                                    Cancelar
	                                                </button>
	                                                <button class="btn btn-primary btn-md" type="submit" onclick="">
	                                                    <i class="fa fa-save"></i>
	                                                    Guardar
	                                                </button>
	                                            </div>
	                                        </div>
	                                    </div>       
									</div>
								</form>

								<div class="col-sm-12 col-md-12 col-lg-12">
									<div class="description description-tabs">


										<ul id="myTab" class="nav nav-pills">
											<li class="active"><a href="#more-information" data-toggle="tab" class="no-margin">Servicios </a></li>
											<li class=""><a href="#refacciones" data-toggle="tab">Refacciones</a></li>
											<li class=""><a href="#terminados" data-toggle="tab">Terminados</a></li>
										</ul>
										<div id="myTabContent" class="tab-content">
											<div class="tab-pane fade active in" id="more-information">
												<div class="col-sm-12 col-md-12 col-lg-12" style="padding:5px;text-align:right">
													<div class="btn-group">
														<a class="btn btn-success" target="_blank" href="<?php echo make_url("Vehiculos","print",array('id'=>$id,'page'=>'cotizaciontrabajo'))?>" style="margin-left: 10px;" ><i class="fa fa-print" ></i>&nbsp;Imprimir Orden de Trabajo</a>&nbsp;
														<a data-toggle="modal" class="btn btn-info" title="Agregar Servicio" id="btnaddservice" href="#myModal" style="margin-left: 10px;" ><i class="fa fa-plus"></i>&nbsp;Servicio</a>
													</div>
												</div>
												<table style="height: 100%;">
													<tr style="">
														<th style="width:10%;background-color:#d0d0cf; font-weight:bold; ">Estatus</th>
														<th style="width:10%;background-color:#d0d0cf; font-weight:bold;">Codigo.</th>
														<th style="width:10%;background-color:#d0d0cf; font-weight:bold; ">Servicio.</th>
														<th style="width:10%;background-color:#d0d0cf; font-weight:bold; text-align: right;">Total.</th>
														<th style="width:10%;background-color:#d0d0cf; font-weight:bold; text-align: right;">Fecha</th>
														<th style="width:10%;background-color:#d0d0cf; font-weight:bold; text-align: right;">Acciones</th>
													</tr>
													<?php 
													$totalservicio = 0 ;
													foreach($dataser as $key => $row) {
														$totalservicio += $row['total'];  
														$status = htmlentities($row['status']);
														$nombre = $row['nombre'] ;
														if($row['detalles']){
															$nombre=$row['detalles'];
														} 
														switch ($row['status']) {
															case 'En Proceso':
																$class  = 'label label-info';
															break;
															case 'active':
																$status = 'Pendiente';
																$class  = 'label label-danger';
																break;
															case 'Realizado':
																$class  = 'label label-success';
																break;
															case 'Stand-By':
																$class  = 'label label-warning';
																break;
															default:
																$class  = '';
																break;
														} 
														?>
														<tr style="height: 30px;">
															<td><span class='<?php echo $class; ?>'><?php echo $status;?></span></td>
															<td><?php echo htmlentities($row['codigo']); ?></td>
															<td><?php echo htmlentities($nombre); ?></td>
															<td style="text-align: right;">$<?php echo number_format(htmlentities($row['total']),2);  ?></td>
															<td style="text-align: right;"><?php echo date("Y-m-d",strtotime($row['created_date'])); ?></td>
															<td style="text-align: right;">
																<div class="btn-group">
																	<a data-toggle="modal" class="btn btn-xs btn-primary btn-statusservice " title="Cambiar status" href="#myModal" style="margin-left: 10px;" idserv='<?php echo $row['id']; ?>' statusant='<?php echo $row['status']; ?>' >
																	<i class="fa fa-exchange-alt"></i>&nbsp;Cambiar status</a>
																</div>
																<div class="btn-group">
																	<a data-toggle="modal" class="btn-historystatusservice" title="Ver Historial" href="#myModal" style="margin-left: 10px;" idserv='<?php echo $row['id']; ?>' statusant='<?php echo $row['status']; ?>' >
																	<i class="fa fa-history"></i>&nbsp;Historial</a>
																</div>
															</td>
														<tr>
														<?php
													} 
													?>
													<tr style="height: 30px; text-align: right;">
														<td></td>
														<td></td>
														<td>Total:</td>
														<td><strong>$<?php echo number_format($totalservicio,2); ?></strong></td>
														<td></td>
													</tr>
												</table>
												
											</div>
											<div class="tab-pane fade" id="refacciones">
												<div class="col-sm-12 col-md-12 col-lg-12" style="padding:5px;text-align:right">
													<div class="btn-group">
														<a class="btn btn-success" target="_blank" href="<?php echo make_url("Vehiculos","print",array('id'=>$id,'page'=>'presupuesto'))?>" style="margin-left: 10px;"><i class="fa fa-print" ></i>&nbsp;Imprimir Presupuesto</a>&nbsp;
														<a data-toggle="modal" class="btn btn-info" title="Agregar Refaccion" id="btnaddrefaccion" href="#myModal" style="margin-left: 10px;" ><i class="fa fa-plus"></i>&nbsp;Refaccion</a>
													</div>
												</div>
												<table style="height: 100%;" >
													<tr>
														<th style="width:10%;background-color:#d0d0cf; font-weight:bold; ">Estatus</th>
														<th style="width:10%;background-color:#d0d0cf;  font-weight:bold;">Cant.</th>
														<th style="width:10%;background-color:#d0d0cf; font-weight:bold;">Refaccion.</th>
														<th style="width:10%;background-color:#d0d0cf; text-align: right; font-weight:bold;">Costo </th>
														<th style="width:10%;background-color:#d0d0cf; text-align: right; font-weight:bold;">Total </th>
														<th style="width:10%;background-color:#d0d0cf; text-align: right; font-weight:bold;">Fecha </th>
														<th style="width:10%;background-color:#d0d0cf; text-align: right; font-weight:bold;">Acciones</th>
													</tr>
													<?php 
													$totalrefaccion = 0 ;
													foreach($dataref as $key => $row) {
														$totalrefaccion+= $row['total_aprox']; 
														$status = htmlentities($row['status']);
														$nombre = $row['nombre'] ;
														if($row['detalles']){
															$nombre=$row['detalles'];
														} 
														switch ($row['status']) {
															case 'active':
																$status = 'Solicitada';
																$class  = 'label label-danger';
																break;
															case 'Realizado':
																$class  = 'label label-success';
																break;
															case 'Stand-By':
																$class  = 'label label-warning';
																break;
															default:
																$class  = '';
																break;
														}  
														?>
														<tr style="height: 30px;">
															<td><span class='<?php echo $class; ?>'><?php echo $status;?></span></td>
															<td><?php echo htmlentities($row['cantidad']); ?></td>
															<td><?php echo htmlentities($nombre); ?></td>
															<td style="text-align: right;">$<?php echo number_format(htmlentities($row['costo_aprox']),2); ?></td>
															<td style="text-align: right;">$<?php echo number_format(htmlentities($row['total_aprox']),2); ?></td>
															<td style="text-align: right;"><?php echo date("Y-m-d",strtotime($row['created_date'])); ?></td>
															<td style="text-align: right;">
																<div class="btn-group">
																	<a data-toggle="modal" class="btn btn-xs btn-primary btn-statusrefaccion " title="Cambiar status" href="#myModal" style="margin-left: 10px;" idref='<?php echo $row['id']; ?>' statusant='<?php echo $row['status']; ?>' >
																	<i class="fa fa-exchange-alt"></i>&nbsp;Cambiar status</a>
																</div>
																<div class="btn-group">
																	<a data-toggle="modal" class="btn-historystatusrefaccion" title="Ver Historial" href="#myModal" style="margin-left: 10px;" idserv='<?php echo $row['id']; ?>' statusant='<?php echo $row['status']; ?>' >
																	<i class="fa fa-history"></i>&nbsp;Historial</a>
																</div>
															</td>
														</tr>
														<?php
													} 
													?>
													<tr style="height: 30px; text-align: right;">
														<td></td>
														<td></td>
														<td></td>
														<td>Total:</td>
														<td style="text-align: right;"><strong>$<?php echo number_format($totalrefaccion,2); ?></strong>
														</td>
														<td></td>
														<td></td>
													</tr>
												</table>
											</div>
											<div class="tab-pane fade" id="terminados">
												<table style="height: 100%;">
													<tr style="">
														<th style="width:10%;background-color:#d0d0cf; font-weight:bold; ">Estatus</th>
														<th style="width:10%;background-color:#d0d0cf; font-weight:bold;">Codigo.</th>
														<th style="width:10%;background-color:#d0d0cf; font-weight:bold; ">Servicio.</th>
														<th style="width:10%;background-color:#d0d0cf; font-weight:bold; text-align: right;">Total.</th>
														<th style="width:10%;background-color:#d0d0cf; font-weight:bold; text-align: right;">Fecha</th>
														<th style="width:10%;background-color:#d0d0cf; font-weight:bold; text-align: right;">Acciones</th>
													</tr>
													<?php 
													$totalservicio = 0 ;
													foreach($dataser as $row) {
														$status = htmlentities($row['status']);
														if ($status=="Realizado") {
															$totalservicio += $row['total'];  
															switch ($row['status']) {
																case 'active':
																	$status = 'Pendiente';
																	$class  = 'label label-danger';
																	break;
																case 'Realizado':
																	$class  = 'label label-success';
																	break;
																case 'Stand-By':
																	$class  = 'label label-warning';
																	break;
																default:
																	$class  = '';
																	break;
															} 
															?>
															<tr style="height: 30px;">
																<td><span class='<?php echo $class; ?>'><?php echo $status;?></span></td>
																<td><?php echo htmlentities($row['codigo']); ?></td>
																<td ><?php echo htmlentities($row['nombre']); ?></td>
																<td style="text-align: right;">$<?php echo number_format(htmlentities($row['total']),2);  ?></td>
																<td style="text-align: right;"><?php echo date("Y-m-d",strtotime($row['created_date'])); ?></td>
																<td style="text-align: right;">
																	<div class="btn-group">
																		<button class="btn btn-xs btn-primary dropdown-toggle" data-toggle="dropdown">
																			Cambiar status <span class="caret"></span>
																		</button>
																		<ul class="dropdown-menu">
																			
																		</ul>
																	</div>
																</td>
															<tr>
														<?php
														}
													} 
													?>
													<tr style="height: 30px; text-align: right;">
														<td></td>
														<td></td>
														<td>Total:</td>
														<td><strong>$<?php echo number_format($totalservicio,2); ?></strong></td>
														<td></td>
													</tr>
												</table>
											</div>
										</div>
									</div>
									<hr>
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
                        <span class="widget-icon"><i class="fa fa-plus"></i> </span>
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
	/*************FOTOS**************/
    function getFoto(id, e)
    {
        var fileElem = document.getElementById(id);
        if (fileElem) {
           
            fileElem.click();
        }
    }
  
    num=0;
    numdel=1;
    var arraydeleteauto=[];
    
    
    function deleteimage(num){
       imagen = document.getElementById("image_"+num);   

        if (!imagen){
            alert("El elemento selecionado no existe");
        } else {
            arraydeleteauto[numdel]=$('#image_'+num).attr("nameimage");
            padre = imagen.parentNode;
            padre.removeChild(imagen);
           $("#deletefilevehiculo").val(arraydeleteauto);
            numdel++;
        }

    }
    
    function uploadimages(evt) {
        var files = evt.target.files; // FileList object
        $numfotos=0;
        for (var i = 0, f; f = files[i]; i++) {
            $numfotos++;
        }
        if($numfotos<=15){
            // Loop through the FileList and render image files as thumbnails.
            for (var i = 0, f; f = files[i]; i++) {
                var nameimage=files[i].name;
                if(files[i].size >= 3856819) {
                  alert("La imagen "+nameimage+" es muy grande, El tamaño maximo es de 3.67 MB u 8mpx");
                  files[i].value = null;
                  continue;
                }
                // Only process image files.
                if (!f.type.match('image.*')) {
                    notify("error","Solo puedes seleccionar imagenes");
                    continue;
                }
                var reader = new FileReader();
                // Closure to capture the file information.
                reader.onload = (function(theFile) {
                    
                    return function(e) {
                        var num=Math.floor(Math.random() * 1000); 
                       
                        var span = document.createElement('div');
                        span.className = "superbox-list";
                        span.innerHTML = ['<img title="click para eliminar" onclick="deleteimage(',num,');  return false;"  class="thumb" id="image_',num,'" width="100px" height="100px" src="', e.target.result,
                                        '" nameimage="', escape(theFile.name), '"/>'].join('');
                      	document.getElementById('contfilevehiculo').append(span);
                      	$('.cont-buttons').show();
                    };
                })(f);
                // Read in the image file as a data URL.
                reader.readAsDataURL(f);     
            }
        }else{
            notify("error","Solo puedes seleccionar 15 imagenes");
        } 
    }
	$(document).ready(function() {
		document.getElementById('filevehiculo').addEventListener('change', uploadimages, false);

		$('body').on('click', '#SaveNewStatus', function(){
            var page = $(this).attr("page");
			var id   = $(this).attr("idaux");
            var url  = config.base+"/Vehiculos/ajax/?action=get&object=" + page; 
            var data = (page=='change-statusservicio') ? "&id_vehiculoservicio=" + id : "&id_vehiculorefaccion=" + id ;
            $.ajax({
                type: "POST",
                url: url,
                data: $( "form#form-"+ page ).serialize() + data, // Adjuntar los campos del formulario enviado.
                success: function(response){
					if(response>0){
						location.reload();
                    }else{
                        notify('error',"Oopss error al cambiar estatus: "+response);
                    }
                }
             });
            return false; // Evitar ejecutar el submit del formulario.
        });

		//servicios
		$('body').on('click', '.btn-statusservice', function(){
			//change status
			var id        = $(this).attr("idserv");
			var statusant = $(this).attr("statusant");
            $('#titlemodal').html('<span class="widget-icon"><i class="far fa-plus"></i> Editar Estatus Servicio</span>');
            $.get(config.base+"/Catalogos/ajax/?action=get&object=showpopupChangeStatusServicio&page=change-statusservicio&id="+ id + "&statusant=" + statusant, null, function (response) {
				if ( response ){
					$("#contentpopup").html(response);
				}else{
					return notify('error', 'Error al obtener los datos del Formulario');
				}     
            });
        });
		$('body').on('click', '.btn-historystatusservice', function(){
			//history status
			var id        = $(this).attr("idserv");
			var statusant = $(this).attr("statusant");
            $('#titlemodal').html('<span class="widget-icon"><i class="far fa-plus"></i> Historial Estatus Servicio</span>');
            $.get(config.base+"/Catalogos/ajax/?action=get&object=showpopupHistoryStatusServicio&id="+ id + "&statusant=" + statusant, null, function (response) {
				if ( response ){
					$("#contentpopup").html(response);
				}else{
					return notify('error', 'Error al obtener los datos del Formulario');
				}     
            });
        });
	
        $('body').on('click', '#btnaddservice', function(){
            $('#titlemodal').html('<span class="widget-icon"><i class="far fa-plus"></i> Agregar Servicio</span>');
            $.get(config.base+"/Catalogos/ajax/?action=get&object=showpopupaddservicetoorden", null, function (response) {
                    if ( response ){
                        $("#contentpopup").html(response);
                    }else{
                        return notify('error', 'Error al obtener los datos del Formulario');
                        
                    }     
            });
        });
        $('body').on('click', '#savenewservice', function(){
            
            var id_vehiculo = <?php echo $id ?>;
            var url  = config.base+"/Catalogos/ajax/?action=get&object=savenewservicetoorden"; 
            var data = "&id_vehiculo=" + id_vehiculo;
            $.ajax({
                type: "POST",
                url: url,
                data: $( "form#form-servicioadd" ).serialize() + data, // Adjuntar los campos del formulario enviado.
                success: function(response){
                    if(response>0){
                        //alert("Group successfully added");
                        notify('success',"Servicio agregado correctamente:"+response);
                        location.reload();
                    }else{
                        notify('error',"Oopss error al agregar servicio"+response);
                    }
                }
             });
            return false; // Evitar ejecutar el submit del formulario.
        });

        //refacciones
		$('body').on('click', '.btn-statusrefaccion', function(){
			//change status
			var id        = $(this).attr("idref");
			var statusant = $(this).attr("statusant");
            $('#titlemodal').html('<span class="widget-icon"><i class="far fa-plus"></i> Editar Estatus Refaccion</span>');
            $.get(config.base+"/Catalogos/ajax/?action=get&object=showpopupChangeStatusRefaccion&page=change-statusrefaccion&id="+ id + "&statusant=" + statusant, null, function (response) {
				if ( response ){
					$("#contentpopup").html(response);
				}else{
					return notify('error', 'Error al obtener los datos del Formulario');
				}     
            });
        });
		$('body').on('click', '.btn-historystatusrefaccion', function(){
			//history status
			var id        = $(this).attr("idserv");
			var statusant = $(this).attr("statusant");
            $('#titlemodal').html('<span class="widget-icon"><i class="far fa-plus"></i> Historial Estatus Refaccion</span>');
            $.get(config.base+"/Catalogos/ajax/?action=get&object=showpopupHistoryStatusRefaccion&id="+ id + "&statusant=" + statusant, null, function (response) {
				if ( response ){
					$("#contentpopup").html(response);
				}else{
					return notify('error', 'Error al obtener los datos del Formulario');
				}     
            });
        });
        $('body').on('click', '#btnaddrefaccion', function(){
            $('#titlemodal').html('<span class="widget-icon"><i class="far fa-plus"></i> Agregar Refaccion</span>');
            $.get(config.base+"/Catalogos/ajax/?action=get&object=showpopupaddrefacciontoorden&id="+<?php echo $id ?>, null, function (response) {
                    if ( response ){
                        $("#contentpopup").html(response);
                    }else{
                        return notify('error', 'Error al obtener los datos del Formulario');
                        
                    }     
            });
        });
        $('body').on('click', '#savenewrefaccion', function(){
            
            var id_vehiculo = <?php echo $id ?>;
            var url  = config.base+"/Catalogos/ajax/?action=get&object=savenewrefacciontoorden"; 
            var data = "&id_vehiculo=" + id_vehiculo;
            $.ajax({
                type: "POST",
                url: url,
                data: $( "form#form-refaccionadd" ).serialize() + data, // Adjuntar los campos del formulario enviado.
                success: function(response){
                    if(response>0){
                        //alert("Group successfully added");
                        notify('success',"Refaccion agregada correctamente:"+response);
                        location.reload();
                    }else{
                        notify('error',"Oopss error al agregar refaccion"+response);
                    }
                }
             });
            return false; // Evitar ejecutar el submit del formulario.
        });

		

		pageSetUp();
		
	});

</script>

<?php
	//include footer
	include(SYSTEM_DIR . "/inc/close-html.php");
?>