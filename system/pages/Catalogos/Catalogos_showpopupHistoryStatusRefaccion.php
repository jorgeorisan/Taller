<?php
$obj = new HistorialVehiculorefaccion();
$data = $obj->getAllArr($id);
?>
<div class="widget-body">
    <table id="dt_basic" class="table table-striped table-bordered table-hover" width="100%">
        <thead>
            <tr>
                <th class = "col-md-2" data-class="expand"> Status Anterior</th>
                <th class = "col-md-2" data-hide=""> Status</th>
                <th class = "col-md-1" data-hide=""> Comentarios</th>
                <th class = "col-md-2" data-hide=""> Usuario Asignado</th>
                <th class = "col-md-1" data-hide=""> Fecha Inicial </th>
                <th class = "col-md-1" data-hide=""> Fecha Estimada </th>
                <th class = "col-md-1" data-hide=""> Fecha Termino </th>
                <th class = "col-md-2" data-hide=""> Fecha Registro</th>
                
            </tr>
        </thead>
        <tbody>
        <?php 
            foreach($data as $key => $row){
                $nomuser        = "";
                if($row["id_userasigned"]){
                    $objuser = new User();
                    $datauser = $objuser->getTable($row["id_userasigned"]);
                    if($datauser){ $nomuser = $datauser["nombre"]; }
                }
                $key++;
                ?>
                <tr>
                    <td><?php echo htmlentities($row['status_anterior'])?></td>
                    <td><?php echo htmlentities($row['status'])?></td>
                    <td><?php echo htmlentities($row['comentarios'])?></td>
                    <td><?php echo htmlentities($nomuser)?></td>
                    <td><?php echo htmlentities($row['fecha_inicio'])?></td>
                    <td><?php echo htmlentities($row['fecha_estimada'])?></td>
                    <td><?php echo htmlentities($row['fecha_fin'])?></td>
                    
                    <td><?php echo date('Y-m-d', strtotime($row['created_date']))?></td>
                   
                </tr>
            <?php
            } 
            ?>
        </tbody>
    </table>
</div>
						
<!-- PAGE RELATED PLUGIN(S) -->
<script src="<?php echo ASSETS_URL; ?>/js/plugin/datatables/jquery.dataTables.min.js"></script>
<script src="<?php echo ASSETS_URL; ?>/js/plugin/datatables/dataTables.colVis.min.js"></script>
<script src="<?php echo ASSETS_URL; ?>/js/plugin/datatables/dataTables.tableTools.min.js"></script>
<script src="<?php echo ASSETS_URL; ?>/js/plugin/datatables/dataTables.bootstrap.min.js"></script>
<script src="<?php echo ASSETS_URL; ?>/js/plugin/datatable-responsive/datatables.responsive.min.js"></script>

<script>

	

</script>

