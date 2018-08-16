<?php

//initilize the page
require_once(SYSTEM_DIR . "/inc/init.php");

//require UI configuration (nav, ribbon, etc.)
require_once(SYSTEM_DIR . "/inc/config.ui.php");

/*---------------- PHP Custom Scripts ---------

YOU CAN SET CONFIGURATION VARIABLES HERE BEFORE IT GOES TO NAV, RIBBON, ETC.
E.G. $page_title = "Custom Title" */

$page_title = "Projects";

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
	{$client_id=$request['params']['id'];}
else
	{die("No project selected to edit!");}

//echo '-------------------------ID: '.$client_id;
$client = new Client();
$c=$client->getClient($client_id);
$projects=$client->getProjects($client_id);

$error_message="";
$success_message="";
$warning_message="";

?>
<!-- ==========================CONTENT STARTS HERE ========================== -->
<!-- MAIN PANEL -->
<div id="main" role="main">
	<?php
		//configure ribbon (breadcrumbs) array("name"=>"url"), leave url empty if no url
		//$breadcrumbs["New Crumb"] => "http://url.com"
		$breadcrumbs["Clients"] = APP_URL."/Clients/index";
		include(SYSTEM_DIR . "/inc/ribbon.php");
	?>

  <div id="content">

		<!-- widget grid -->
		<section id="widget-grid" class="purity">

      <h2><?=$c['name']?></h2>
      <p><a class="btn btn-success" href="<?php echo make_url("Projects","add",array('id'=>$client_id))?>" >Add project</a></p>
			<!-- row -->
			<div class="row">

				<!-- NEW WIDGET START -->
				<article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">

					<!-- Widget ID (each widget will need unique ID)-->
					<div class="jarviswidget jarviswidget-color-blueDark" id="wid-id-0" data-widget-editbutton="false">
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
							<h2>Projects</h2>

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
											<th class="col-md-2	">Start date</th>
                      <th class="col-md-2	">End date</th>
											<th class="col-md-2"><i class="fa fa-fw  fa-certificate text-muted hidden-md hidden-sm hidden-xs"></i>Status</th>
											<th class="col-md-2">Actions</th>
										</tr>
									</thead>
									<tbody>

										<?php
										//print_r($projects);
										if(empty($projects))
											{$warning_message="Client has no projects";}
										foreach($projects as $projectrow){?>
										<tr>
											<td><?php echo $projectrow['name']?></td>
                      <td><?php echo $projectrow['start_date']?></td>
                      <td><?php echo $projectrow['end_date']?></td>
											<td><?php echo $projectrow['status']?></td>
											<td><a class="btn btn-danger btn-xs" href="<?php echo make_url("Projects","edit",array('id'=>$projectrow['id'],'client_id'=>$client_id)); ?>">Edit</a>
												<a class="btn btn-info btn-xs" href="<?php echo make_url("Campaigns","index",array('id'=>$projectrow['id'])); ?>">Campaigns</a>
                      <a class="btn btn-warning btn-xs" href="<?php echo make_url("Results","index",array('id'=>$projectrow['id'])); ?>">Results</a></td>
										</tr>
										<?php }?>
										<!--<tr>
                      <td>Project 2</td>
                      <td>start date 2</td>
                      <td>end date 2</td>
											<td>Status 2</td>
											<td><a class="btn btn-danger btn-xs" href="<?php echo make_url("Projects","edit",array('id'=>'2')); ?>">Edit</a>
											<a class="btn btn-info btn-xs" href="<?php echo make_url("Campaigns","index",array('id'=>'2')); ?>">Campaigns</a>
                    <a class="btn btn-warning btn-xs" href="<?php echo make_url("Results","index",array('id'=>'2')); ?>">Results</a></td>
										</tr>
										<tr>
                      <td>Project 3</td>
                      <td>start date 3</td>
                      <td>end date 3</td>
											<td>Status 3</td>
											<td><a class="btn btn-danger btn-xs" href="<?php echo make_url("Projects","edit",array('id'=>'3')); ?>">Edit</a>
											<a class="btn btn-info btn-xs" href="<?php echo make_url("Campaigns","index",array('id'=>'3')); ?>">Campaigns</a>
                    <a class="btn btn-warning btn-xs" href="<?php echo make_url("Results","index",array('id'=>'3')); ?>">Results</a></td>
										</tr>-->


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
	//alert("SETUP!!");
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

		 <?php if($warning_message!=""){;?>
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
