<?php
$obj = new Refaccion();
$data = $obj->getAllArrSearch($marca,$submarca,$year);
?>
<div class="widget-body">
    <table id="dt_basic" class="table table-striped table-bordered table-hover" width="100%">
        <thead>
            <tr>
                <th class = "col-md-2" data-class="expand"> Marca</th>
                <th class = "col-md-2" data-hide=""> Modelo</th>
                <th class = "col-md-1" data-hide=""> Año</th>
                <th class = "col-md-2" data-hide=""> Codigo</th>
                <th class = "col-md-2" data-hide=""> Nombre </th>
                <th class = "col-md-1" data-hide=""> Costo Aprox. </th>
                <th class = "col-md-1" data-hide=""> Costo Real </th>
                <th class = "col-md-1" data-hide=""> </th>
            </tr>
        </thead>
        <tbody>
        <?php 
            foreach($data as $key => $row){
                $nommarca       = "";
                $nomsubmarca    = "";
                
                if($row["id_marca"]){
                    $objmarca = new Marca();
                    $datamarca = $objmarca->getTable($row["id_marca"]);
                    if($datamarca){ $nommarca = $datamarca["nombre"]; }
                }
                if($row["id_submarca"]){
                    $objsubmarca = new SubMarca();
                    $datasubmarca = $objsubmarca->getTable($row["id_submarca"]);
                    if($datasubmarca){ $nomsubmarca = $datasubmarca["nombre"]; }
                }
                $key++;
                ?>
                <tr>
                    <td><?php echo htmlentities($nommarca)?></td>
                    <td><?php echo htmlentities($nomsubmarca)?></td>
                    <td><?php echo htmlentities($row['modelo'])?></td>
                    <td><?php echo htmlentities($row['codigo'])?></td>
                    <td><?php echo htmlentities($row['nombre'])?></td>
                    <td><?php echo htmlentities($row['costo_aprox'])?></td>
                    <td><?php echo htmlentities($row['costo_real'])?></td>
                    <td>
                        <div class="btn-group">
                            <a class="btn btn-info btn-xs" href="javascript:getrefaccion(<?php echo  $row['id']; ?>);  $('#myModal').modal('hide');">Usar</a>
                        </div>
                    </td>
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

	$(document).ready(function() {
		var responsiveHelper_dt_basic = undefined;
		var responsiveHelper_datatable_fixed_column = undefined;
		var responsiveHelper_datatable_col_reorder = undefined;
		var responsiveHelper_datatable_tabletools = undefined;
		
		var breakpointDefinition = {
			tablet : 1024,
			phone : 480
		};
		$('#dt_basic').dataTable({
			"sDom": "<'dt-toolbar'<'col-xs-12 col-sm-6'f><'col-sm-6 col-xs-12 hidden-xs'l>r>"+
				"t"+
				"<'dt-toolbar-footer'<'col-sm-6 col-xs-12 hidden-xs'i><'col-xs-12 col-sm-6'p>>",
			"autoWidth" : true,
			"preDrawCallback" : function() {
				// Initialize the responsive datatables helper once.
				if (!responsiveHelper_dt_basic) {
					responsiveHelper_dt_basic = new ResponsiveDatatablesHelper($('#dt_basic'), breakpointDefinition);
				}
			},
			"rowCallback" : function(nRow) {
				responsiveHelper_dt_basic.createExpandIcon(nRow);
			},
			"drawCallback" : function(oSettings) {
				responsiveHelper_dt_basic.respond();
			}
		});
        
	
	})

</script>


