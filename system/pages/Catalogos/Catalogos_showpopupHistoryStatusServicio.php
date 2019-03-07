<?php
$obj = new HistorialVehiculoservicio();
$data = $obj->getAllArr($id);
?>
<div class="widget-body">
    <table id="dt_basic" class="table table-striped table-bordered table-hover" width="100%">
        <thead>
            <tr>
                <th class = "col-md-2" data-class="expand"> Status Anterior</th>
                <th class = "col-md-2" data-hide=""> Status</th>
                <th class = "col-md-2" data-hide=""> Personal</th>
                <th class = "col-md-1" data-hide=""> Fecha Inicial </th>
                <th class = "col-md-1" data-hide=""> Fecha Estimada </th>
                <th class = "col-md-1" data-hide=""> Fecha Termino </th>
                <th class = "col-md-1" data-hide=""> Comentarios</th>
                
            </tr>
        </thead>
        <tbody>
        <?php
        if(count($data)){

       
            foreach($data as $key => $row){
                $nomuser        = "";
                if($row["id_personal"]){
                    $objuser = new Personal();
                    $datauser = $objuser->getTable($row["id_personal"]);
                    if($datauser){ $nomuser = $datauser["nombre"]." ".$datauser["apellido_pat"]; }
                }
                $status = htmlentities($row['status']);
                switch ($row['status']) {
                    case 'active':  $status = 'Pendiente'; break;
                    default:
                        $class  = '';
                        break;
                } 
                $statusant = htmlentities($row['status_anterior']);
                switch ($row['status_anterior']) {
                    case 'active':  $statusant = 'Pendiente'; break;
                    default:
                        $class  = '';
                        break;
                } 
                $key++;
                ?>
                <tr>
                    <td><?php echo  $key."->".$statusant ?></td>
                    <td><?php echo $status ?></td>
                    <td><?php echo htmlentities($nomuser)?></td>
                    <td><?php echo htmlentities(date('Y-m-d H:i:s',strtotime($row['fecha_inicio'])))?></td>
                    <td><?php echo htmlentities(date('Y-m-d H:i:s',strtotime($row['fecha_estimada']))); ?></td>
                    <td><?php echo htmlentities(date('Y-m-d H:i:s',strtotime($row['fecha_fin'])))?></td>                    
                    <td><?php echo htmlentities($row['comentarios'])?></td>                   
                </tr>
            <?php
            } 
        }else{
            echo "<tr ><td colspan=7> No se encontraron resultados</td></tr>";
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