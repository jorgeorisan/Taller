
<?php

//initilize the page
require_once(SYSTEM_DIR . "/inc/init.php");

//require UI configuration (nav, ribbon, etc.)
require_once(SYSTEM_DIR . "/inc/config.ui.php");

$c = new Client();
//$users = $u->getAllUsers();
$clients = $c->getAllClients();

/*---------------- PHP Custom Scripts ---------

YOU CAN SET CONFIGURATION VARIABLES HERE BEFORE IT GOES TO NAV, RIBBON, ETC.
E.G. $page_title = "Custom Title" */

$page_title = "Clients";

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

?>
<!-- ==========================CONTENT STARTS HERE ========================== -->
<!-- MAIN PANEL -->
<div id="main" role="main">
	<?php
		//configure ribbon (breadcrumbs) array("name"=>"url"), leave url empty if no url
		//$breadcrumbs["New Crumb"] => "http://url.com"
		//$breadcrumbs["Add client"] = APP_URL."/Clients/add";
		include(SYSTEM_DIR . "/inc/ribbon.php");
	?>

	<!-- MAIN CONTENT -->
	<div id="content">

		<!-- widget grid -->
		<section id="widget-grid" class="">
			 <p><a class="btn btn-success" href="<?php echo make_url("Clients","add")?>" >Add client</a></p>
			<!-- row -->
			<div class="row">

				<!-- NEW WIDGET START -->
				<article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">

					<!-- Widget ID (each widget will need unique ID)-->
					<div class="jarviswidget jarviswidget-color-white" id="wid-id-0" data-widget-editbutton="false" data-widget-colorbutton="false" data-widget-deletebutton="false">
						<!-- widget options:
						usage: <div class="jarviswidget" id="wid-id-0" data-widget-editbutton="false">

						data-widget-colorbutton="false"
						data-widget-editbutton="false"
						data-widget-togglebutton="false"
						data-widget-deletebutton="false"
						data-widget-fullscreenbutton="false"
						data-widget-custombutton="false"
						data-widget-collapsed="true"
						data-widget-sortable="false"

						-->
						<header>
							<span class="widget-icon"> <i class="fa fa-table"></i> </span>
							<h2>Clients</h2>

						</header>

						<!-- widget div-->
						<div>

							<!-- widget edit box -->
							<div class="jarviswidget-editbox">
								<!-- This area used as dropdown edit box -->

							</div>
							<!-- end widget edit box -->

							<!-- widget content -->
							<div class="widget-body">
								<!--<p>
									Adds borders to any table row within <code>
										&lt;table&gt;</code>
									by adding the <code>
										.table-bordered</code>
									with the base class
								</p>-->
								<table class="table table-bordered">
									<thead>
										<tr>
											<th class="col-md-3">Name</th>
											<th class="col-md-3">Description</th>
											<th class="col-md-3">Date added</th>
											<th class="col-md-1"><i class="fa fa-fw  fa-certificate text-muted hidden-md hidden-sm hidden-xs"></i>Status</th>
											<th class="col-md-2">Actions</th>
										</tr>
									</thead>
									<tbody>

										<?php foreach($clients as $clientrow){
											//print_r($userrow);
											/*print_r($userrow['first_name']);
											print_r($userrow['last_name']);
											print_r($userrow['email']);
											print_r($userrow['type']);
											print_r($userrow['enabled']);*/
											?>
											<tr>
											<!--<td><img src="<?php/*$clientrow->getImage()*/?>" class="img-thumbnail"></td>-->
											<td><?php echo $clientrow['name']?></td>
											<td><?php echo $clientrow['description']?></td>
											<td><?php echo $clientrow['created_at']?></td>
											<td><?=$clientrow['status']?></td>
											<td><a class="btn btn-danger btn-xs" href="<?php echo make_url("Clients","edit",array('id'=>$clientrow['id'])); ?>">Edit</a>
											<a class="btn btn-primary btn-xs" href="<?php echo make_url("Projects","index",array('id'=>$clientrow['id'])); ?>">Projects</a></td>
											</tr>
										<?php }?>



									</tbody>
								</table>

							</div>
							<!-- end widget content -->

						</div>
						<!-- end widget div -->

					</div>
		<!--<div class="row">
				<div class="col-sm-12">
					<div class="well">
						<div class="row">
							<div class="col-sm-2">
						</div>
					</div>

					</div>

				</div>

			</div>
		-->


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

<!-- PAGE RELATED PLUGIN(S)
<script src="<?php echo ASSETS_URL; ?>/js/plugin/YOURJS.js"></script>-->

<script>

	$(document).ready(function() {
		/* DO NOT REMOVE : GLOBAL FUNCTIONS!
		 *
		 * pageSetUp(); WILL CALL THE FOLLOWING FUNCTIONS
		 *
		 * // activate tooltips
		 * $("[rel=tooltip]").tooltip();
		 *
		 * // activate popovers
		 * $("[rel=popover]").popover();
		 *
		 * // activate popovers with hover states
		 * $("[rel=popover-hover]").popover({ trigger: "hover" });
		 *
		 * // activate inline charts
		 * runAllCharts();
		 *
		 * // setup widgets
		 * setup_widgets_desktop();
		 *
		 * // run form elements
		 * runAllForms();
		 *
		 ********************************
		 *
		 * pageSetUp() is needed whenever you load a page.
		 * It initializes and checks for all basic elements of the page
		 * and makes rendering easier.
		 *
		 */

		 pageSetUp();
	
		 <?php if($error_message!=""){?>
			 var message = <?php echo json_encode($error_message); ?>;
			showError(message);<?php }?>

			<?php if($success_message!=""){?>
 			 var message = <?php echo json_encode($success_message); ?>;
 			showSuccess(message);<?php }?>

			<?php if($warning_message!=""){?>
 			 var message = <?php echo json_encode($warning_message); ?>;
 			showWarning(message);<?php }?>
		/*
		 * ALL PAGE RELATED SCRIPTS CAN GO BELOW HERE
		 * eg alert("my home function");
		 *
		 * var pagefunction = function() {
		 *   ...
		 * }
		 * loadScript("js/plugin/_PLUGIN_NAME_.js", pagefunction);
		 *
		 * TO LOAD A SCRIPT:
		 * var pagefunction = function (){
		 *  loadScript(".../plugin.js", run_after_loaded);
		 * }
		 *
		 * OR
		 *
		 * loadScript(".../plugin.js", run_after_loaded);
		 */
	})

</script>

<?php
	//include footer
	include(SYSTEM_DIR . "/inc/close-html.php");
?>
