<?php

//initilize the page
require_once(SYSTEM_DIR . "/inc/init.php");

//require UI configuration (nav, ribbon, etc.)
require_once(SYSTEM_DIR . "/inc/config.ui.php");

/*---------------- PHP Custom Scripts ---------

YOU CAN SET CONFIGURATION VARIABLES HERE BEFORE IT GOES TO NAV, RIBBON, ETC.
E.G. $page_title = "Custom Title" */

$page_title = "Ver cliente";

/* ---------------- END PHP Custom Scripts ------------- */

//include header
//you can add your custom css in $page_css array.
//Note: all css files are inside css/ folder
$page_css[] = "your_style.css";
include(SYSTEM_DIR . "/inc/header.php");

//include left panel (navigation)
//follow the tree in inc/config.ui.php
include(SYSTEM_DIR . "/inc/nav.php");
if(isset($request['params']['id'])   && $request['params']['id']>0)
    $id=$request['params']['id'];
else
    informError(true,make_url("Clientes","index"));

$obj = new Cliente();
$data = $obj->getTable($id);
if ( !$data ) {
    informError(true,make_url("Clientes","index"));
}


?>
<!-- ==========================CONTENT STARTS HERE ========================== -->
<!-- MAIN PANEL -->
<div id="main" role="main">
     <?php $breadcrumbs["Clientes"] = APP_URL."/Clientes/index"; include(SYSTEM_DIR . "/inc/ribbon.php"); ?>
    <!-- MAIN CONTENT -->
    <div id="content">
        <div class="row">     
            <section id="widget-grid" class="">
                <article class="col-sm-9 col-md-9 col-lg-9"  id="">
                    <div class="jarviswidget  jarviswidget-sortables" id="wid-id-0"
                    data-widget-colorbutton="false" data-widget-editbutton="false" 
                    data-widget-deletebutton="false" data-widget-collapsed="false">
                        <!-- Widget ID (each widget will need unique ID)-->
                        <header>
                            <span class="widget-icon"> 
                                <i class="fa fa-plus"></i>
                            </span>
                            <h2><?php echo $page_title ?></h2>
                        </header>
                        <div style="display: ;">
                            <div class="jarviswidget-editbox" style=""></div>
                            <div class="widget-body"> 
                                <fieldset>    
                                    <div class="col-sm-6">
						                <div class="form-group">
						                    <label for="name">Nombre</label>
						                    <input type="text" class="form-control" placeholder="Nombre" name="nombre"  value="<?php echo $data['nombre']; ?>">
						                </div>
						                <div class="form-group">
						                    <label for="name">Correo</label>
						                    <input type="email" class="form-control" placeholder="example@email.com" name="email" value="<?php echo $data['email']; ?>">                                                          
						                </div>
						                <div class="form-group">
						                    <label for="name">Calle</label>
						                    <input type="text" class="form-control" placeholder="Calle" name="calle"  value="<?php echo $data['calle']; ?>">                                                                                               
						                </div>
						                 <div class="form-group">
						                    <label for="name">Colonia</label>
						                    <input type="text" class="form-control" placeholder="Colonia" name="colonia" value="<?php echo $data['colonia']; ?>">                                                                                               
						                </div>
						            </div>
						            <div class="col-sm-3">
						                 <div class="form-group">
						                    <label for="name">Apellido Paterno</label>
						                    <input type="text" class="form-control" placeholder="Apellido Paterno" name="apellido_mat"  value="<?php echo $data['apellido_mat']; ?>">                                                                                               
						                </div>
						                <div class="form-group">
						                    <label for="name">Teléfono</label>
						                    <input type="text" class="form-control" placeholder="Teléfono" name="telefono"  value="<?php echo $data['telefono']; ?>">                                                                                               
						                </div>
						                
						                
						                <div class="form-group">
						                    <label for="name">Número Exterior</label>
						                    <input type="text" class="form-control" placeholder="Número Exterior" name="num_ext"  value="<?php echo $data['num_ext']; ?>">                                                                                               
						                </div>
						                <div class="form-group">
						                    <label for="name">Ciudad</label>
						                    <input type="text" class="form-control" placeholder="Ciudad" name="ciudad"  value="<?php echo $data['ciudad']; ?>">                                                                                               
						                </div>
						            </div>
						            <div class="col-sm-3">
						                <div class="form-group">
						                    <label for="name">Apellido Materno</label>
						                    <input type="text" class="form-control" placeholder="Apellido Materno" name="apellido_pat"  value="<?php echo $data['apellido_pat']; ?>">                                                                                               
						                </div>
						                <div class="form-group">
						                    <label for="name">Estado</label>
						                    <input type="text" class="form-control" placeholder="Estado" name="estado" value="<?php echo $data['estado']; ?>">                                                                                               
						                </div>
						                <div class="form-group">
						                    <label for="name">Número Interior</label>
						                    <input type="text" class="form-control" placeholder="Número Interior" name="num_int"  value="<?php echo $data['num_int']; ?>">                                                                                               
						                </div>
						                <div class="form-group">
						                    <label for="name">CP</label>
						                    <input type="text" class="form-control" placeholder="CP" name="cp"  value="<?php echo $data['cp']; ?>">                                                                                               
						                </div>
						            </div>
                                </fieldset>     
                            </div>
                        </div>
                    </div>
                </article>
            </section>
        </div>
    </div>
</div>
<!-- END MAIN PANEL -->

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

<!-- PAGE RELATED PLUGIN(S)
<script src="<?php echo ASSETS_URL; ?>/js/plugin/YOURJS.js"></script>-->

<script>
   
    $(document).ready(function() {
    
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
