<section id="widget-grid" class="">
    <fieldset>
        <table id="dt_basic" class="table table-striped table-bordered table-hover" width="100%">
            <thead>
                <tr>
                    <th class = "col-md-2" data-class="expand">
                        <i class="fa fa-fw  fa-user  text-muted hidden-md hidden-sm hidden-xs"></i> No.
                    </th>
                    <th class = "col-md-2" data-class="">
                        <i class="fa fa-fw  fa-user  text-muted hidden-md hidden-sm hidden-xs"></i> Codigo
                    </th>
                    <th class = "col-md-4" data-hide="">
                        <i class="fa fa-fw fa-envelope text-muted hidden-md hidden-sm hidden-xs"></i> Nombre
                    </th>
                </tr>
            </thead>
            <tbody>    
        
          
        <?php
        $u  = new ServicioPaquete();
        if($res=$u->getTable($id)){
            foreach($res as $key => $row){ 
            $key++;
        ?>
               <tr>
                    <td><?php echo htmlentities($key); ?></td>
                    <td><?php echo htmlentities($row['codigo'])?></td>
                    <td><?php echo htmlentities($row['nombre'])?></td>
                </tr>
            <?php }
        }
        ?>
    </fieldset>                                            
</section>

