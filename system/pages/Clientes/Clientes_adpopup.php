
<section id="widget-grid" class="">
  
    <form id="main-form" class="form-cliente" role="form" method=post action="#" onsubmit="return checkSubmit();" enctype="multipart/form-data">
        <fieldset>    
            <div class="col-sm-6">
                <div class="form-group">
                    <label for="name">Nombre</label>
                    <input type="text" class="form-control" placeholder="Nombre" name="nombre" > 
                </div>
                <div class="form-group">
                    <label for="name">Correo</label>
                    <input type="email" class="form-control" placeholder="example@email.com" name="email">                                                          
                </div>
                <div class="form-group">
                    <label for="name">Calle</label>
                    <input type="text" class="form-control" placeholder="Calle" name="calle" >                                                                                               
                </div>
                 <div class="form-group">
                    <label for="name">Colonia</label>
                    <input type="text" class="form-control" placeholder="Colonia" name="colonia" >                                                                                               
                </div>
            </div>
            <div class="col-sm-3">
                 <div class="form-group">
                    <label for="name">Apellido Paterno</label>
                    <input type="text" class="form-control" placeholder="Apellido Paterno" name="apellido_pat" >                                                                                               
                </div>
                <div class="form-group">
                    <label for="name">Teléfono</label>
                    <input type="text" class="form-control" placeholder="Teléfono" name="telefono" >                                                                                               
                </div>
                
                
                <div class="form-group">
                    <label for="name">Número Exterior</label>
                    <input type="text" class="form-control" placeholder="Número Exterior" name="num_ext" >                                                                                               
                </div>
                <div class="form-group">
                    <label for="name">Ciudad</label>
                    <input type="text" class="form-control" placeholder="Ciudad" name="ciudad" >                                                                                               
                </div>
            </div>
            <div class="col-sm-3">
                <div class="form-group">
                    <label for="name">Apellido Materno</label>
                    <input type="text" class="form-control" placeholder="Apellido Materno" name="apellido_mat" >                                                                                               
                </div>
                <div class="form-group">
                    <label for="name">Estado</label>
                    <input type="text" class="form-control" placeholder="Estado" name="estado" >                                                                                               
                </div>
                <div class="form-group">
                    <label for="name">Número Interior</label>
                    <input type="text" class="form-control" placeholder="Número Interior" name="num_int" >                                                                                               
                </div>
                <div class="form-group">
                    <label for="name">CP</label>
                    <input type="text" class="form-control" placeholder="CP" name="cp" >                                                                                               
                </div>
            </div>
        </fieldset> 
        <div class="form-actions" style="text-align: center;width: 100%;margin-left: 0px;">
            <div class="row">
               <div class="col-md-12">
                    <button class="btn btn-default btn-md" type="button" class="close" data-dismiss="modal" aria-hidden="true">
                        Cancelar
                    </button>
                    <button class="btn btn-primary btn-md" type="button" id="savenewclient">
                        <i class="fa fa-save"></i>
                        Guardar
                    </button>
                </div>
            </div>
        </div>                              
    </form>
               
</section>

