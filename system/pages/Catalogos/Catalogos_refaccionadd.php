<?php
//initilize the page
require_once(SYSTEM_DIR . "/inc/init.php");

//require UI configuration (nav, ribbon, etc.)
require_once(SYSTEM_DIR . "/inc/config.ui.php");

/*---------------- PHP Custom Scripts ---------

YOU CAN SET CONFIGURATION VARIABLES HERE BEFORE IT GOES TO NAV, RIBBON, ETC.
E.G. $page_title = "Custom Title" */

$page_title = "Agregar Refaccion";

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
if(isPost()){
    $obj = new Refaccion();
    $id=$obj->addAll(getPost());
    if($id>0){
       
        if (isset($_FILES['filerefaccion'])){
            $cantidad = count($_FILES["filerefaccion"]["tmp_name"]);
            $carpeta  = REFACCION_DIR .DIRECTORY_SEPARATOR. 'marca_'.$_POST['id_marca'].DIRECTORY_SEPARATOR.'submarca_'.$_POST['id_submarca'].DIRECTORY_SEPARATOR.'modelo_'.$_POST['modelo'];
            if ( !file_exists($carpeta) ) {
                mkdir($carpeta, 0777, true);
                $carpetaimg = $carpeta;
            }else{
                $carpetaimg = $carpeta;
            }
            for ($i=0; $i < $cantidad; $i++){
                //Comprobamos si el fichero es una imagen
                $subir=0;
                if ($_FILES['filerefaccion']['type'][$i]=='image/png' || $_FILES['filerefaccion']['type'][$i]=='image/jpeg'){
                    if ( isset($_POST['deletefilerefaccion'] ) ) {
                        $imagesdeleted = $_POST['deletefilerefaccion'];
                        $pos = strpos($imagesdeleted, $_FILES["filerefaccion"]["name"][$i]); //quitamos las imagenes eliminadas
                        if ($pos === false) {
                            move_uploaded_file($_FILES["filerefaccion"]["tmp_name"][$i], $carpetaimg."/".$i."_".$_POST['nombre'].'.png');
                            $subir=1;
                        }   
                    }else{
                        move_uploaded_file($_FILES["filerefaccion"]["tmp_name"][$i], $carpetaimg."/".$i."_".$_POST['nombre'].'.png');
                        $subir=1;
                    } 
                    if($subir)  {
                        $objimg = new ImagenesRefaccion();
                        $idimg  = $objimg->addImage($id,$i."_".$_POST['nombre'].'.png');  
                        if(!$idimg){
                            echo "Error al añadir imagen".$id."->".$carpetaimg."->".$_FILES["filerefaccion"]["name"][$i];
                            exit;
                        }  
                    } 
                $validar=true;
                }
                else $validar=false;
                    
            }
        }
        informSuccess(true, make_url("Catalogos","refaccion"));
    }else{
        informError(true,make_url("Catalogos","refaccion"));
    }
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
                                <form id="main-form" class="" role="form" method=post action="<?php echo make_url("Catalogos","refaccionadd");?>" onsubmit="return checkSubmit();" enctype="multipart/form-data">     
                                    <fieldset>    
                                        <div class="col-sm-6 col-md-6">
                                            <div class="form-group">
                                                <label for="name">Codigo</label>
                                                <input type="text" class="form-control" placeholder="Codigo Refaccion" name="codigo" >                                                                                             
                                            </div>
                                            <div class="form-group">
                                                <select style="width:100%" class="select2" name="id_marca" id="id_marca">
                                                    <option value="">Selecciona Marca</option>
                                                    <?php 
                                                    $obj = new Marca();
                                                    $list=$obj->getAllArr();
                                                    if (is_array($list) || is_object($list)){
                                                        foreach($list as $val){
                                                            echo "<option value='".$val['id']."'>".htmlentities($val['nombre'])."</option>";
                                                        }
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="name">Año</label>
                                            </div>
                                            <div class="form-group" style="width:50%;float:left">
                                                <select style="width:100%" class="select2" name="modelo" id="modelo">
                                                    <option value="">Año desde</option>
                                                    <?php 
                                                    $objcat=catModelo();
                                                    for ($i=0; $i < count($objcat) ; $i++) { 
                                                        echo "<option value='".$objcat[$i]."'>".htmlentities($objcat[$i])."</option>";
                                                    }  
                                                    ?>
                                                </select>
                                            </div>
                                            <div class="form-group" style="width:50%;float:left">
                                                <select style="width:100%" class="select2" name="modelo_hasta" id="modelo_hasta">
                                                    <option value="">Año hasta</option>
                                                    <?php 
                                                    $objcat=catModelo();
                                                    for ($i=0; $i < count($objcat) ; $i++) { 
                                                        echo "<option value='".$objcat[$i]."'>".htmlentities($objcat[$i])."</option>";
                                                    }  
                                                    ?>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="name">Costo</label>
                                                <input type="number" class="form-control" placeholder="Costo Aproximado Refaccion" name="costo_aprox" >                                                                                             
                                            </div>                                           
                                        </div>
                                        <div class="col-sm-6 col-md-6"> 
                                            <div class="form-group">
                                                <label for="name">Refaccion</label>
                                                <input type="text" class="form-control" placeholder="Nombre Refaccion" name="nombre" >                                                                                             
                                            </div>
                                            <div class="form-group" id="contsubmarca">
                                                <select style="width:100%" class="select2" name="id_submarca" id="id_submarca">
                                                    <option value="">Selecciona Modelo</option>
                                                    <?php 
                                                    $obj = new SubMarca();
                                                    $list=$obj->getAllArr();
                                                    if (is_array($list) || is_object($list)){
                                                        foreach($list as $val){
                                                            echo "<option value='".$val['id']."'>".htmlentities($val['nombre'])."</option>";
                                                        }
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                            
                                            <div class="form-group">
                                                <label for="name">Descripcion</label>
                                                <input type="text" class="form-control" placeholder="Descripcion" name="descripcion" >                                                                                               
                                            </div>
                                           
                                            <div class="form-group" id="">
                                                <label for="name">Poder agregar mas detalles</label>
                                                <select style="width:100%" class="select2" name="detalles" id="detalles">
                                                    <option value="0">NO</option>
                                                    <option value="1">SI</option>
                                                  
                                                </select>
                                            </div>
                                        </div>
                                        <div class='col-sm-12 col-md-12'>
                                            <div class="form-group">
                                                <button type="button" title='Agregar imagen' class="btn btn-primary btn-circle btn-xl" onclick="getFoto('filerefaccion'); return false;">
                                                    <i class="fa fa-camera"></i>
                                                </button>
                                                <input type="file" id="filerefaccion"  name="filerefaccion[]" accept="image/*" style="display:none"  multiple>
                                                <input type="text" id="deletefilerefaccion"  name="deletefilerefaccion" style="display:none">
                                            </div>
                                            <div  id="contfilerefaccion"></div>
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
   /*************FOTOS**************/
    function getFoto(id, e)
    {
        var fileElem = document.getElementById(id);
        if (fileElem) {
            $('#contfilerefaccion').html('');
            fileElem.click();
        }
    }
  
    num=0;
    contfotosauto=0;
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
           $("#deletefilerefaccion").val(arraydeleteauto);
            numdel++;
            contfotosauto--;
        }
        $("#contfotosauto").html(contfotosauto);

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
                  alert("La imagen "+nameimage+" es muy grande, El tamaño maximo es de 3.67 MB");
                  files[i].value = null;
                  continue;
                }
                contfotosauto++;
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
                        var span = document.createElement('span');
                        span.innerHTML = ['<img title="click para eliminar" onclick="deleteimage(',num,');  return false;"  class="thumb" id="image_',num,'" width="150px" height="150px" src="', e.target.result,
                                        '" nameimage="', escape(theFile.name), '"/>'].join('');
                      document.getElementById('contfilerefaccion').insertBefore(span, null);
                    };
                })(f);
                // Read in the image file as a data URL.
                reader.readAsDataURL(f);     
            }
            $("#contfotosauto").html(contfotosauto);
        }else{
            notify("error","Solo puedes seleccionar 15 imagenes");
        } 
    }

    //*************END FOTOS************* /
    function validateForm()
    {
        if ( ! $("input[name=nombre]").val() )  return notify("info","El nombre es requerido");
        
        if ( ! $("#id_marca").val() )  return notify("info","La marca es requerida");

        if ( ! $("#id_submarca").val() )  return notify("info","La submarca es requerida");

        if ( ! $("#modelo").val() )  return notify("info","El año es requerido");

        $("#main-form").submit(); 
    }
    function getsubmarca(id){
        if ( ! id ) return;

        $.get(config.base+"/Vehiculos/ajax/?action=get&object=getsubmarca&id=" + id, null, function (response) {
                if ( response ){
                    $("#contsubmarca").html(response);
                    $('#id_submarca').select2();
                }else{
                    notify('error', 'Error al obtener los datos del cliente');
                    return false;
                }     
        });
    }
    $(document).ready(function() {
        document.getElementById('filerefaccion').addEventListener('change', uploadimages, false);
    

         $('body').on('change', '#id_marca', function(){
            if( $(this).val() ){
                var id = $("#id_marca").val();
                console.log(getsubmarca(id));
            }
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
