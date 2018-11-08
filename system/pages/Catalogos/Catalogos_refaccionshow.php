<?php
//initilize the page
require_once(SYSTEM_DIR . "/inc/init.php");

//require UI configuration (nav, ribbon, etc.)
require_once(SYSTEM_DIR . "/inc/config.ui.php");

/*---------------- PHP Custom Scripts ---------

YOU CAN SET CONFIGURATION VARIABLES HERE BEFORE IT GOES TO NAV, RIBBON, ETC.
E.G. $page_title = "Custom Title" */

$page_title = "Ver Refaccion";

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
    informError(true,make_url("Catalogos","refaccion"));

$obj = new Refaccion();
$data = $obj->getTable($id);
if ( !$data ) {
    informError(true,make_url("Catalogos","refaccion"));
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

?>
<!-- ==========================CONTENT STARTS HERE ========================== -->
<!-- MAIN PANEL -->
<div id="main" role="main">
     <?php $breadcrumbs["refaccion"] = APP_URL."/Catalogos/refaccion"; include(SYSTEM_DIR . "/inc/ribbon.php"); ?>
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
                                <i class="fa fa-plus"></i>
                            </span>
                            <h2><?php echo $page_title ?></h2>
                        </header>
                        <div style="display: ;">
                            <div class="jarviswidget-editbox" style=""></div>
                            <div class="widget-body">
                                    <fieldset>    
                                        <div class="col-sm-6 col-md-6">
                                            <div class="form-group">
                                                <label for="name">Codigo</label>
                                                <input type="text" class="form-control" readonly placeholder="Codigo Refaccion" name="codigo" value="<?php echo $data['codigo']; ?>">                                                                                             
                                            </div>
                                            <div class="form-group">
                                                <select style="width:100%" class="select2" readonly name="id_marca" id="id_marca" >
                                                    <option value="">Selecciona Marca</option>
                                                    <?php 
                                                    $obj = new Marca();
                                                    $list=$obj->getAllArr();
                                                    if (is_array($list) || is_object($list)){
                                                        foreach($list as $val){
                                                            $selected = ($data['id_marca'] == $val['id'] ) ? "selected" : '';
                                                            echo "<option $selected value='".$val['id']."'>".htmlentities($val['nombre'])."</option>";
                                                        }
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="name">Año</label>
                                                <select style="width:100%" class="select2" readonly name="modelo" id="modelo">
                                                    <option value="">Año</option>
                                                    <?php 
                                                    $objcat=catModelo();
                                                    for ($i=0; $i < count($objcat) ; $i++) { 
                                                        $selected = ($data['modelo'] == $objcat[$i] ) ? "selected" : '';
                                                        echo "<option $selected value='".$objcat[$i]."'>".htmlentities($objcat[$i])."</option>";
                                                    }  
                                                    ?>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="name">Costo Proximado</label>
                                                <input type="text" class="form-control" readonly placeholder="Costo Aproximado Refaccion" name="costo_aprox" value="<?php echo $data['costo_aprox']; ?>" >                                                                                             
                                            </div>                                           
                                        </div>
                                        <div class="col-sm-6 col-md-6"> 
                                            <div class="form-group">
                                                <label for="name">Refaccion</label>
                                                <input type="text" class="form-control" readonly placeholder="Nombre Refaccion" name="nombre" value="<?php echo $data['nombre']; ?>" >                                                                                             
                                            </div>
                                            <div class="form-group" id="contsubmarca">
                                                <select style="width:100%" class="select2" readonly name="id_submarca" id="id_submarca">
                                                    <option value="">Selecciona Modelo</option>
                                                    <?php 
                                                    $obj = new SubMarca();
                                                    $list=$obj->getAllArr();
                                                    if (is_array($list) || is_object($list)){
                                                        foreach($list as $val){
                                                            $selected = ($data['id_submarca'] == $val['id'] ) ? "selected" : '';
                                                            echo "<option $selected value='".$val['id']."'>".htmlentities($val['nombre'])."</option>";
                                                        }
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                            
                                            <div class="form-group">
                                                <label for="name">Descripcion</label>
                                                <input type="text" class="form-control" readonly placeholder="Descripcion" name="descripcion" value="<?php echo $data['descripcion']; ?>">
                                            </div>
                                            <div class="form-group">
                                                <label for="name">Costo Real</label>
                                                <input type="number" class="form-control" readonly placeholder="Costo Real Refaccion" name="costo_real" value="<?php echo $data['costo_real']; ?>">                                                                                             
                                            </div>
                                        </div>
                                        <div class='col-sm-12 col-md-12'>
                                            <div class="form-group">
                                                
                                            </div>
                                            <div  id="contfilerefaccion">
                                            <?php 
                                                $carpetaimg  =ASSETS_URL . '/refaccion' .DIRECTORY_SEPARATOR. 'marca_'.$data['id_marca'].DIRECTORY_SEPARATOR.'submarca_'.$data['id_submarca'].DIRECTORY_SEPARATOR.'modelo_'.$data['modelo'];
                                                $objimg = new ImagenesRefaccion();
                                                $dataimagenes = $objimg->getAllArr($id);

                                                foreach($dataimagenes as $row) {
                                                    echo "<div class='superbox-list'>
                                                            <img src='".$carpetaimg.DIRECTORY_SEPARATOR.$row['nombre']."' 
                                                            data-img='".$carpetaimg.DIRECTORY_SEPARATOR.$row['nombre']."'
                                                            alt='".$row['nombre']."' title='".$row['nombre']."'
                                                            width='150px'  height='150px'
                                                            class='superbox-img'
                                                            >
                                                        </div>";
                                                }
                                            ?>    
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
<div class="modal fade" id="showPhoto" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Visor de Imagenes</h4>
      </div>
      <div class="modal-body">
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
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

    //*************END FOTOS************* /
    
    $(document).ready(function() {
        $(function(){
            $('.superbox-img').click(function(){
                $('#showPhoto .modal-body').html($(this).clone().attr("height","100%"));
                $('#showPhoto').modal('show');
            })
        });
       /* DO NOT REMOVE : GLOBAL FUNCTIONS!
         * pageSetUp() is needed whenever you load a page.
         * It initializes and checks for all basic elements of the page
         * and makes rendering easier.
         *
         */
        pageSetUp();
    });

</script>

<?php
    //include footer
    include(SYSTEM_DIR . "/inc/close-html.php");

?>
