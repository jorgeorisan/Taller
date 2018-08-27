<?php

//initilize the page
require_once(SYSTEM_DIR . "/inc/init.php");

//require UI configuration (nav, ribbon, etc.)
require_once(SYSTEM_DIR . "/inc/config.ui.php");

/*---------------- PHP Custom Scripts ---------

YOU CAN SET CONFIGURATION VARIABLES HERE BEFORE IT GOES TO NAV, RIBBON, ETC.
E.G. $page_title = "Custom Title" */

$page_title = "Company";

/* ---------------- END PHP Custom Scripts ------------- */

//include header
//you can add your custom css in $page_css array.
//Note: all css files are inside css/ folder
$page_css[] = "your_style.css";
include(SYSTEM_DIR . "/inc/header.php");

//include left panel (navigation)
//follow the tree in inc/config.ui.php
$page_nav["company"]["active"] = true;
include(SYSTEM_DIR . "/inc/nav.php");



?>
<!-- ==========================CONTENT STARTS HERE ========================== -->
<!-- MAIN PANEL -->
<div id="main" role="main">
	<?php
		//configure ribbon (breadcrumbs) array("name"=>"url"), leave url empty if no url
		//$breadcrumbs["New Crumb"] => "http://url.com"
		//$breadcrumbs["activities"] = "";
		//include(SYSTEM_DIR . "/inc/ribbon.php");
	?>
    <link rel="stylesheet" type="text/css" media="screen" href="<?php echo ASSETS_URL . "/"  ?>css/ui.jqgrid-bootstrap.css" /> 
	<!-- MAIN CONTENT --> 
	<div id="content">


<div class="row">
		
				<div class="col-sm-12">
					 <div  class=jqGrid>
  						  

    <table id="jqGrid"></table>
    <div id="jqGridPager"></div>



					</div>
					
				</div>
		
			</div>

	</div>
	<!-- END MAIN CONTENT -->

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


<?php
 
?>
<!-- PAGE RELATED PLUGIN(S) 

<script src="<?php echo ASSETS_URL; ?>/js/plugin/YOURJS.js"></script>-->

<script src="<?php echo ASSETS_URL; ?>/js/plugin/jqgrid/jquery.jqGrid.min.js"></script>
<script src="<?php echo ASSETS_URL; ?>/js/plugin/jqgrid/grid.locale-en.min.js"></script>


		<!-- PAGE RELATED PLUGIN(S) -->
		
		<script type="text/javascript">
		 

        $(document).ready(function () {
            $("#jqGrid").jqGrid({
                url: '<?php echo make_url("Ajax","company")?>',
                editurl: '<?php echo make_url("Ajax","company")?>',
                mtype: 'POST',
                datatype: "json",
                colNames: ['id','name','status','created_date'],  //"id", "name"
                colModel: [
                    {
						label: 'Id',
                        name: 'id' 
                    }
                    ,
                    {
						label: 'name',
                        name: 'name',
                        editable: true 
                    },
                    {
						label: 'status',
                        name: 'status',
                        editable: true 
                    },
                    {
						label: 'created_date',
                        name: 'created_date',
                        editable: true 
                    }
                    /*,
                    
                    {
						label : 'Name',
                        name: 'name' ,
                        editable: true
                    }*/
                ],
				loadOnce : true,
				viewrecords: true,
                width:  'auto',
                height: 'auto',
                rowNum: 10,
                pager: "#jqGridPager"
            });

            $('#jqGrid').navGrid('#jqGridPager',
                // the buttons to appear on the toolbar of the grid
                { edit: true, add: true, del: true, search: false, refresh: false, view: false, position: "left", cloneToTop: false },
                // options for the Edit Dialog
                {
                    height: 'auto',
                    width: 'auto',
                    editCaption: "The Edit Dialog",
                    recreateForm: true,
                    closeAfterEdit: true,
                    errorTextFormat: function (data) {
                        return 'Error: ' + data.responseText
                    }
                },
                // options for the Add Dialog
                {
                    height: 'auto',
                    width: 'auto',
                    closeAfterAdd: true,
                    recreateForm: true,
                    errorTextFormat: function (data) {
                        return 'Error: ' + data.responseText
                    }
                },
                // options for the Delete Dailog
                {
                    errorTextFormat: function (data) {
                        return 'Error: ' + data.responseText
                    }
                });
        });
 
		// DO NOT REMOVE : GLOBAL FUNCTIONS!
		
		/*$(document).ready(function() {

		 <?php# echo $page_specific_js; ?>
		
		})*/



</script>

<?php 
	//include footer
	include(SYSTEM_DIR . "/inc/close-html.php"); 
?>