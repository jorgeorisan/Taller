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
if(isPost()){
    $obj = new Refaccion();
    $obj->updateAll($id,getPost());
    if($id>0){
        $uploadimages = $contimages = 0;

        //imagenes anteriores
        if (isset($_POST['filelastrefaccion'])){
            echo 1;
            $cantidad = count($_POST['filelastrefaccion']);
            $objimg = new ImagenesRefaccion();
            $idimg  = $objimg->deleteAll($id);
            $arraynum =[];
            for ($i=0; $i < $cantidad; $i++){
                if(!$_POST['filelastrefaccion'][$i]) continue;
                
                $idimg  = $objimg->addImage($id,$_POST['filelastrefaccion'][$i]);  
                $ultimonum  = explode("_", $_POST['filelastrefaccion'][$i]);
                $uploadimages++;
                $arraynum[$i]=$ultimonum[0];
            }  
            $contimages = max($arraynum);
        }
        //nuevas imagenes
        if (isset($_FILES['filerefaccion'])){
            $cantidad = count($_FILES["filerefaccion"]["tmp_name"]);
            for ($i=0; $i < $cantidad; $i++){
                if(!$_FILES['filerefaccion']['type'][$i]) continue;
                
                $uploadimages++;
            }
            if($uploadimages){
                echo 2;
                $carpeta  = REFACCION_DIR .DIRECTORY_SEPARATOR. 'marca_'.$_POST['id_marca'].DIRECTORY_SEPARATOR.'submarca_'.$_POST['id_submarca'].DIRECTORY_SEPARATOR.'modelo_'.$_POST['modelo'];
                if ( !file_exists($carpeta) ) {
                    mkdir($carpeta, 0777, true);
                    $carpetaimg = $carpeta;
                }else{
                    $carpetaimg = $carpeta;
                }
                $objimg = new ImagenesRefaccion();
                if($uploadimages==0)  $objimg->deleteAll($id);

                for ($i=0; $i < $cantidad; $i++){
                    $code = rand(1000, 100000);
                    $contimages++;
                    if(!$_FILES['filerefaccion']['type'][$i]) continue;
                    //Comprobamos si el fichero es una imagen
                    $subir=0;
                    if ($_FILES['filerefaccion']['type'][$i]=='image/png' || $_FILES['filerefaccion']['type'][$i]=='image/jpeg'){
                        if ( isset($_POST['deletefilerefaccion'] ) ) {
                            $imagesdeleted = $_POST['deletefilerefaccion'];
                            $pos = strpos($imagesdeleted, $_FILES["filerefaccion"]["name"][$i]); //quitamos las imagenes eliminadas
                            if ($pos === false) {
                                move_uploaded_file($_FILES["filerefaccion"]["tmp_name"][$i], $carpetaimg."/".$contimages."_".$_POST['nombre']."_". $code.'.png');
                                $subir=1;
                            }   
                        }else{
                            move_uploaded_file($_FILES["filerefaccion"]["tmp_name"][$i], $carpetaimg."/".$contimages."_".$_POST['nombre']."_". $code.'.png');
                            $subir=1;
                        } 
                        if($subir)  {
                          
                            $idimg  = $objimg->addImage($id,$contimages."_".$_POST['nombre']."_". $code.'.png');  
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
        }
           
            echo $uploadimages;
        if ($uploadimages == 0) { echo 3; $objimg = new ImagenesRefaccion();  $idimg  = $objimg->deleteAll($id); }
    
    
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
                                <form id="main-form" class="" role="form" method=post action="<?php echo make_url("Catalogos","refaccionedit",array('id'=>$id))?>" onsubmit="return checkSubmit();" enctype="multipart/form-data">     
                                    <fieldset>    
                                        <div class="col-sm-6 col-md-6">
                                            <div class="form-group">
                                                <label for="name">Codigo</label>
                                                <input type="text" class="form-control" placeholder="Codigo Refaccion" name="codigo" value="<?php echo $data['codigo']; ?>">                                                                                             
                                            </div>
                                            <div class="form-group">
                                                <select style="width:100%" class="select2" name="id_marca" id="id_marca" >
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
                                                <select style="width:100%" class="select2" name="modelo" id="modelo">
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
                                                <input type="number" class="form-control" placeholder="Costo Aproximado Refaccion" name="costo_aprox" value="<?php echo $data['costo_aprox']; ?>" >                                                                                             
                                            </div>                                           
                                        </div>
                                        <div class="col-sm-6 col-md-6"> 
                                            <div class="form-group">
                                                <label for="name">Refaccion</label>
                                                <input type="text" class="form-control" placeholder="Nombre Refaccion" name="nombre" value="<?php echo $data['nombre']; ?>" >                                                                                             
                                            </div>
                                            <div class="form-group" id="contsubmarca">
                                                <select style="width:100%" class="select2" name="id_submarca" id="id_submarca">
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
                                                <input type="text" class="form-control" placeholder="Descripcion" name="descripcion" value="<?php echo $data['descripcion']; ?>">
                                            </div>
                                            <div class="form-group">
                                                <label for="name">Costo Real</label>
                                                <input type="number" class="form-control" placeholder="Costo Real Refaccion" name="costo_real" value="<?php echo $data['costo_real']; ?>">                                                                                             
                                            </div>
                                            <div class="form-group" id="">
                                                <label for="name">Poder agregar mas detalles</label>
                                                <select style="width:100%" class="select2" name="detalles" id="detalles">
                                                    <option <?php if(!$data['detalles']) echo 'selected'; ?> value="0">NO</option>
                                                    <option <?php if($data['detalles']) echo 'selected'; ?> value="1">SI</option>
                                                  
                                                </select>
                                            </div>
                                        </div>
                                        <div class='col-sm-12 col-md-12'>
                                            <div class="form-group">
                                                <button type="button" title='Agregar imagen' class="btn btn-primary btn-circle btn-xl" onclick="getFoto('filerefaccion'); return false;">
                                                    <i class="fa fa-camera"></i>
                                                </button>
                                                <input type="file" id="filerefaccion"  name="filerefaccion[]" accept="image/*" style="display:none"  multiple>
                                                <input type="hidden" id="deletefilerefaccion"  name="deletefilerefaccion" style="">
                                            </div>
                                            <div  id="contfilerefaccion">
                                            <?php 
                                                $carpetaimg  =ASSETS_URL . '/refaccion' .DIRECTORY_SEPARATOR. 'marca_'.$data['id_marca'].DIRECTORY_SEPARATOR.'submarca_'.$data['id_submarca'].DIRECTORY_SEPARATOR.'modelo_'.$data['modelo'];
                                                $objimg = new ImagenesRefaccion();
                                                $dataimagenes = $objimg->getAllArr($id);
                                                $key = 0;
                                                foreach($dataimagenes as $key => $row) {
                                                    
                                                    echo "<div class='superbox-list'  id='image_".$key."'>
                                                            <img title='click para eliminar' onclick='deleteimage(".$key.");  return false;' 
                                                            src='".$carpetaimg.DIRECTORY_SEPARATOR.$row['nombre']."'
                                                            alt='".$row['nombre']."' title='".$row['nombre']."'
                                                            nameimage='".$row['nombre']."'
                                                            width='150px'  height='150px' >
                                                            <input type='hidden'  name='filelastrefaccion[]' value='".$row['nombre']."'>
                                                        </div>";
                                                }
                                            ?>    
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
   /*************FOTOS**************/
    function getFoto(id, e)
    {
        var fileElem = document.getElementById(id);
        if (fileElem) {
           
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
                       
                        var span = document.createElement('div');
                        span.className = "superbox-list";
                        span.innerHTML = ['<img title="click para eliminar" onclick="deleteimage(',num,');  return false;"  class="thumb" id="image_',num,'" width="150px" height="150px" src="', e.target.result,
                                        '" nameimage="', escape(theFile.name), '"/>'].join('');
                      document.getElementById('contfilerefaccion').append(span);
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
        $(function(){
            $('.superbox-img').click(function(){
                $('#showPhoto .modal-body').html($(this).clone().attr("height","100%"));
                $('#showPhoto').modal('show');
            })
        });
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
