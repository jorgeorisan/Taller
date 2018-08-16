
<?php

//initilize the page
require_once(SYSTEM_DIR . "/inc/init.php");

//require UI configuration (nav, ribbon, etc.)
require_once(SYSTEM_DIR . "/inc/config.ui.php");

/*---------------- PHP Custom Scripts ---------

YOU CAN SET CONFIGURATION VARIABLES HERE BEFORE IT GOES TO NAV, RIBBON, ETC.
E.G. $page_title = "Custom Title" */

$page_title = "Edit campaign";

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
	{$campaign_id=$request['params']['id'];}
else
	{die("No campaign selected to edit!");}


$client = new Client();
$activeprojects=$client->getActiveProjects();

$campaign = new Campaign();
$camp = $campaign->getCampaign($campaign_id);
$campaigntypes = $campaign->getCampaignTypes();

?>
<!-- ==========================CONTENT STARTS HERE ========================== -->
<!-- MAIN PANEL -->
<div id="main" role="main">
	<?php
		//configure ribbon (breadcrumbs) array("name"=>"url"), leave url empty if no url
		//$breadcrumbs["New Crumb"] => "http://url.com"
		//$breadcrumbs["Misc"] = "";
		$breadcrumbs["Campaigns"] = APP_URL."/Campaigns/index";
		include(SYSTEM_DIR . "/inc/ribbon.php");
	?>

	<!-- MAIN CONTENT -->
	<div id="content">

    <!--<div class="modal show" id="modalCompose">-->
    <div class="row">
				<div class="col-sm-8">
					<!-- widget content -->
					<div class="widget-body no-padding">

						<form id="smart-form-register" class="smart-form">
							<header>
								Edit campaign
							</header>

							<fieldset>
								<section class="col-sm-10">
									<label class="input"> <i class="icon-append fa fa-user"></i>
										<input type="text" name="name" placeholder="Name" value="<?=$camp['name']?>">
										<b class="tooltip tooltip-bottom-right">Needed to enter campaign name</b> </label>
								</section>

								<section class="col-sm-10">
									<label class="input"> <i class="icon-append fa fa-file-text"></i>
										<input type="email" name="email" placeholder="Description" value="<?=$camp['description']?>">
										<b class="tooltip tooltip-bottom-right">Needed to enter campaign description</b> </label>
								</section>

								<div class="row">
									<section class="col col-6">
										<label class="select">
											<select name="type">
												<option value="0" selected="" disabled="">Project</option>
												<?php
												foreach($activeprojects as $projectrow){?>
												<option value="<?php echo($projectrow['id']);?>"><?php echo($projectrow['name']);?></option>
												<?php }?>
											</select> <i></i> </label>
									</section>
								</div>
                <div class="row">
									<section class="col col-6">
										<label class="select">
											<select name="type">
												<option value="0" selected="" disabled="">Type</option>
												<?php
												foreach($campaigntypes as $typerow){?>
												<option value="<?php echo($typerow['id']);?>"<?php if($camp['status']=='ACTIVE') {echo 'selected';}?>><?php echo($typerow['name']);?></option>
												<?php }?>
											</select> <i></i> </label>
									</section>
								</div>

									<div class="row">
										<section class="col col-6">
											<label class="select">
												<select name="type">
													<option value="0" selected="" disabled="">Status</option>

													<option value="1"<?php if($camp['status']=='ACTIVE') {echo 'selected';}?>>Enabled</option>
													<option value="2"<?php if($camp['status']=='DISABLED') {echo 'selected';}?>>Disabled</option>

												</select> <i></i> </label>
										</section>

								</div>


							</fieldset>
              <footer>
              <button type="submit" class="btn btn-primary">
                Save
              </button>
            </footer>

						</form>

					</div>
					<!-- end widget content -->

				</div>
				<!-- end widget div -->

			</div>


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
