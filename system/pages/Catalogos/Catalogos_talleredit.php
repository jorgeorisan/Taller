 <?php
//initilize the page
require_once(SYSTEM_DIR . "/inc/init.php");

//require UI configuration (nav, ribbon, etc.)
require_once(SYSTEM_DIR . "/inc/config.ui.php");

/*---------------- PHP Custom Scripts ---------

YOU CAN SET CONFIGURATION VARIABLES HERE BEFORE IT GOES TO NAV, RIBBON, ETC.
E.G. $page_title = "Custom Title" */

$page_title = "Editar taller";

/* ---------------- END PHP Custom Scripts ------------- */

//include header
//you can add your custom css in $page_css array.
//Note: all css files are inside css/ folder
$page_css[] = "your_style.css";
include(SYSTEM_DIR . "/inc/header.php");

//include left panel (navigation)
//follow the tree in inc/config.ui.php
//$page_nav["misc"]["sub"]["blank"]["active"] = true;
include(SYSTEM_DIR . "/inc/nav.php");


if(isset($request['params']['id'])   && $request['params']['id']>0)
    $id=$request['params']['id'];
else
    informError(true,make_url("Catalogos","taller"));

$obj = new Taller();
$data = $obj->getTable($id);
if ( !$data ) {
    informError(true,make_url("Catalogos","taller"));
}
if(isPost()){
    $obj = new Taller();
    $id = $obj->updateAll($id,getPost());
    if( $id  ) {
         informSuccess(true, make_url("Catalogos","taller"));
    }else{
        informError(true, make_url("Catalogos","talleredit",array('id'=>$id)),"talleredit");
    }
}
?>
<!-- ==========================CONTENT STARTS HERE ========================== -->
<!-- MAIN PANEL -->
<div id="main" role="main">
     <?php $breadcrumbs["Taller"] = APP_URL."/Catalogos/taller"; include(SYSTEM_DIR . "/inc/ribbon.php"); ?>
    <!-- MAIN CONTENT -->
    <div id="content">
        <div class="row">     
            <section id="widget-grid" class="">
                <article class="col-sm-12 col-md-12 col-lg-12"  id="">
                    <div class="jarviswidget  jarviswidget-sortables" id="wid-id-0"
                    data-widget-colorbutton="false" data-widget-editbutton="false" 
                    data-widget-deletebutton="false" data-widget-collapsed="false">
                        <!-- Widget ID (each widget will need unique ID)-->
                        <header>
                            <span class="widget-icon"> 
                                <i class="fa fa-edit"></i>
                            </span>
                            <h2><?php echo $page_title ?></h2>
                        </header>
                        <div style="display: ;">
                            <div class="jarviswidget-editbox" style=""></div>
                            <div class="widget-body">
                                <form id="main-form" class="" role="form" method=post 
                                action="<?php echo make_url("Catalogos","talleredit",array('id'=>$id));?>" onsubmit="return checkSubmit();" enctype="multipart/form-data">
                                    <input type="text" class="" name="idTaller" hidden>
                                    <fieldset>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="name">Nombre del Taller</label>
                                                <input type="text" class="form-control" placeholder="Nombre Taller" id="nombre" name="nombre" value="<?php echo htmlentities($data['nombre']); ?>">                                                    
                                            </div>
                                            <div class="form-group">
                                                <label for="name">Calle</label>
                                                <input type="text" class="form-control" placeholder="Calle" name="calle" value="<?php echo htmlentities($data['calle']); ?>">                        
                                            </div>
                                            <div class="form-group">
                                                <label for="name">Número Exterior</label>
                                                <input type="text" class="form-control" placeholder="Número exterior" name="numext" value="<?php echo htmlentities($data['numext']); ?>">                                               
                                            </div>
                                            <div class="form-group">
                                                <label for="name">Número Interior</label>
                                                <input type="text" class="form-control" placeholder="Número interior" name="numinte" value="<?php echo htmlentities($data['numinte']); ?>">                                                                       
                                            </div>
                                            <div class="form-group">
                                                <label for="name">Colonia</label>
                                                <input type="text" class="form-control" placeholder="Colonia" name="colonia" value="<?php echo htmlentities($data['colonia']); ?>">                                                           
                                            </div>
                                            <div class="form-group">
                                                <label for="name">Ciudad</label>
                                                <input type="text" class="form-control" placeholder="Ciudad" name="ciudad" value="<?php echo htmlentities($data['ciudad']); ?>"> 
                                            </div>
                                        </div>  
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="name">Estado</label>
                                                <input type="text" class="form-control" placeholder="Estado" name="estado" value="<?php echo htmlentities($data['estado']); ?>">                                                                                               
                                            </div>
                                            <div class="form-group">
                                                <label for="name">CP</label>
                                                <input type="text" maxlength="5" class="form-control" id="cp" placeholder="CP" name="cp" value="<?php echo htmlentities($data['cp']); ?>">                                                                                                                                                       
                                            </div>
                                            <div class="form-group">
                                                <label for="name">RFC</label>
                                                <input type="text" class="form-control" placeholder="RFC" name="rfc" value="<?php echo htmlentities(utf8_encode($data['rfc'])); ?>">                                                                                               
                                            </div>
                                            <div class="form-group">
                                                <label for="email">Correo</label>
                                                <input type="email" class="form-control" placeholder="example@email.com" name="correo" value="<?php echo htmlentities($data['correo']); ?>">                                                                                               
                                            </div>
                                            <div class="form-group">
                                                <label for="name">Teléfono</label>
                                                <input type="text" class="form-control" placeholder="" name="telefono" value="<?php echo htmlentities($data['telefono']); ?>">                                                                                                                     
                                            </div>
                                            <div class="form-group">
                                                <label for="name">Logotipo</label>
                                                <input type="file" class="form-control"  id="imagen1" name="logo" onchange="vistaPrevia(this, 'logoTallerPrev');" multiple>
                                                <fieldset id="logoTallerPrev" class="0">
                                                </fieldset>
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
                                                    Guardar
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </article>
            </section>
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

<!-- PAGE RELATED PLUGIN(S)
<script src="<?php echo ASSETS_URL; ?>/js/plugin/YOURJS.js"></script>-->

<script>
    
    function validateForm()
    {
        var nombre = $("input[name=nombre]").val();
        if ( ! nombre )  return notify("info","El nombre es requerido");

        $("#main-form").submit();       
    }
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
