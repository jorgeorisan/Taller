
<section id="widget-grid" class="">
  
    <form id="main-form" class="form-servicio" role="form" method=post action="#" onsubmit="return checkSubmit();" enctype="multipart/form-data">
        <fieldset>    
            <div class="col-sm-6">
                <div class="form-group">
                    <label for="name">Codigo</label>
                    <input type="text" class="form-control" placeholder="Codigo Servicio" name="codigo" >                                                                                             
                </div>
                <div class="form-group">
                    <label for="name">Servicio</label>
                    <input type="text" class="form-control" placeholder="Nombre Servicio" name="nombre" >                                                                                             
                </div>
                <div class="form-group">
                    <label for="name">Descripcion</label>
                    <input type="text" class="form-control" placeholder="Descripcion" name="descripcion" >                                                                                               
                </div>
                <div class="form-group" id="">
                    <label for="name">Poder agregar mas detalles</label>
                    <select style="width:100%" class="select2" name="detalles" id="detalles">
                        <option  value="0">NO</option>
                        <option  value="1">SI</option>
                    </select>
                </div>
            </div>
        </fieldset> 
        <div class="form-actions" style="text-align: center;width: 100%;margin-left: 0px;">
            <div class="row">
               <div class="col-md-12">
                    <button class="btn btn-default btn-md" type="button" class="close" data-dismiss="modal" aria-hidden="true">
                        Cancelar
                    </button>
                    <button class="btn btn-primary btn-md" type="button" id="savenewservice">
                        <i class="fa fa-save"></i>
                        Guardar
                    </button>
                </div>
            </div>
        </div>                              
    </form>
               
</section>

