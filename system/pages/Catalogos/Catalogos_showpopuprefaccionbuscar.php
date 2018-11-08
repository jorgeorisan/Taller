
<section id="widget-grid" class="">
  
  <form id="main-form" class="form-refaccion-buscar" role="form" method=post action="#" onsubmit="return checkSubmit();" enctype="multipart/form-data">
    <fieldset>    
        <div class="col-sm-5 col-md-5">
            <div class="form-group">
                <label for="name"></label>
                <select style="width:100%" class="select2" name="id_marca_refaccion" id="id_marca_refaccion">
                    <option value="">Selecciona Marca</option>
                    <?php 
                    $objref = new Marca();
                    $listref=$objref->getAllArr();
                    if (is_array($listref) || is_object($listref)){
                        foreach($listref as $valref){
                            echo "<option value='".$valref['id']."'>".htmlentities($valref['nombre'])."</option>";
                        }
                    }
                    ?>
                </select>
            </div>                                                 
        </div>
        
        <div class="col-sm-5 col-md-5"> 
            <label for="name"></label>
            <div class="form-group" id="contsubmarca_refaccion">
                
                <select style="width:100%" class="select2" name="id_submarca_refaccion" id="id_submarca_refaccion">
                    <option value="">Selecciona Modelo</option>
                    <?php 
                    $objref = new SubMarca();
                    $listref=$objref->getAllArr();
                    if (is_array($listref) || is_object($listref)){
                        foreach($listref as $valref){
                            echo "<option value='".$valref['id']."'>".htmlentities($valref['nombre'])."</option>";
                        }
                    }
                    ?>
                </select>
            </div>
            
        </div>
        <div class="col-sm-2 col-md-2">
            <div class="form-group">
                <label for="name"></label>
                <select style="width:100%" class="select2" name="modelo_refaccion" id="modelo_refaccion">
                    <option value="">Año</option>
                    <?php 
                    $objcat=catModelo();
                    for ($i=0; $i < count($objcat) ; $i++) { 
                        echo "<option value='".$objcat[$i]."'>".htmlentities($objcat[$i])."</option>";
                    }  
                    ?>
                </select>
            </div>
                                                 
        </div> 
        <div class="col-sm-12 col-md-12" id='contresrefaccion'>
           
                                                 
        </div>
                      
    </fieldset> 
      <div class="form-actions" style="text-align: center;width: 100%;margin-left: 0px;">
          <div class="row">
             <div class="col-md-12">
                  <button class="btn btn-default btn-md" type="button" class="close" data-dismiss="modal" aria-hidden="true">
                      Cancelar
                  </button>
                  <button class="btn btn-info btn-md" type="button" id="savenewservice">
                      <i class="fa fa-save"></i>
                      Buscar
                  </button>
              </div>
          </div>
      </div>                              
  </form>
             
</section>

<script>
    function getsubmarcarefaccion(id){
        if ( ! id ) return;
        $.get(config.base+"/Vehiculos/ajax/?action=get&object=getsubmarcapopup&id=" + id, null, function (response) {
                if ( response ){
                    $("#contsubmarca_refaccion").html(response);
                    $('#id_submarca_refaccion').select2();
                   
                }else{
                    notify('error', 'Error al obtener los datos de la submarca');
                    return false;
                }     
        });
    }
    function getresrefaccion(){
        var marca = submarca = year = '';
        if ($("#id_marca_refaccion").val())    marca    = $("#id_marca_refaccion").val();
        if ($("#id_submarca_refaccion").val()) submarca = $("#id_submarca_refaccion").val();
        if ($("#modelo_refaccion").val())      year     = $("#modelo_refaccion").val();
        $("#contresrefaccion").html("<div align='center'><i class='far fa-cog fa-spin fa-7x'></i></div>");

        $.get(config.base+"/Catalogos/ajax/?action=get&object=getresrefaccion&marca=" + marca + "&submarca=" + submarca + "&year=" +year, null, function (response) {
                if ( response ){
                    $("#contresrefaccion").html(response);
                   
                }else{
                    notify('error', 'Error al obtener los datos de la refaccionS');
                    return false;
                }     
        });
    }
    $(document).ready(function() { 
         $('body').on('change', '#id_marca_refaccion', function(){
            if( $(this).val() ){
                var id = $("#id_marca_refaccion").val();
                getsubmarcarefaccion(id);
            }
        });
        $("#id_marca_refaccion").select2({
            multiple: false,
            header: "Selecciona una opcion",
            noneSelectedText: "Seleccionar",
            selectedList: 1
        });
        $("#id_submarca_refaccion").select2({
            multiple: false,
            header: "Selecciona una opcion",
            noneSelectedText: "Seleccionar",
            selectedList: 1
        });
        $("#modelo_refaccion").select2({
            multiple: false,
            header: "Selecciona una opcion",
            noneSelectedText: "Seleccionar",
            selectedList: 1
        });
        $('body').on('change', '#id_marca_refaccion', function(){
            if( $(this).val() ){
                var id = $("#id_marca_refaccion").val();
                getresrefaccion(id);
            }
        });
        $('body').on('change', '#id_submarca_refaccion', function(){
            if( $(this).val() ){
                var id = $("#id_submarca_refaccion").val();
                getresrefaccion(id);
            }
        });
        $('body').on('change', '#modelo_refaccion', function(){
            if( $(this).val() ){
                var id = $("#modelo_refaccion").val();
                getresrefaccion(id);
            }
        });
    });
</script>