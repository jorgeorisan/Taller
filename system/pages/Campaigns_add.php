<?php

//initilize the page
require_once(SYSTEM_DIR . "/inc/init.php");

//require UI configuration (nav, ribbon, etc.)
require_once(SYSTEM_DIR . "/inc/config.ui.php");

/*---------------- PHP Custom Scripts ---------

YOU CAN SET CONFIGURATION VARIABLES HERE BEFORE IT GOES TO NAV, RIBBON, ETC.
E.G. $page_title = "Custom Title" */

$page_title = "Add campaign";

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

$templatews = new Template_ws();
$activetemplatews=$templatews->getActiveTemplates();

$campaign = new Campaign();
//$campaigntypes = $campaign->getCampaignTypes();

$error_message="";
$success_message="";
$warning_message="";
if(isset($_POST['name']) && isset($_POST['description']) && isset($_POST['project']) && isset($_POST['type']))
{
		//$error_message='ADDING CLIENT';
		$c = new Campaign();
		//print_r($_POST);
		$c->addCampaign($_POST['name'],$_POST['description'],$_POST['project'],$_POST['type']);
		//$success_message="Campaign added correctly!";
		redirect(make_url("Campaigns"));

}
?>

?>
<!-- ==========================CONTENT STARTS HERE ========================== -->
<!-- MAIN PANEL -->
<div id="main" role="main">
	<?php
		//configure ribbon (breadcrumbs) array("name"=>"url"), leave url empty if no url
		//$breadcrumbs["New Crumb"] => "http://url.com"
		$breadcrumbs["Campaigns"] = APP_URL."/Campaigns/index";
		include(SYSTEM_DIR . "/inc/ribbon.php");
	?>

	<!-- MAIN CONTENT -->
	<div id="content">
		<h2>
			Add campaign
		</h2>
		<section id="widget-grid" class="">

			<div class="row">
					<div class="col-sm-8">
						<!-- widget content -->
						<div class="widget-body no-padding">

							<form id="smart-form-register" class="smart-form" role="form" method=post action="<?php echo make_url("Campaigns","add");?>" onsubmit="return validateForm();">
								<fieldset>
									<section>
										<label class="input"> <i class="icon-append fa fa-user"></i>
											<input type="text" id="name" name="name" placeholder="Name">
											<b class="tooltip tooltip-bottom-right">Needed to enter campaign name</b> </label>
									</section>

									<section>
										<label class="input"> <i class="icon-append fa fa-file-text"></i>
											<input type="text" id="description" name="description" placeholder="Description">
											<b class="tooltip tooltip-bottom-right">Needed to enter campaign description</b> </label>
									</section>

									<!--<div class="row">
										<section class="col col-6">
											<label class="select">
												<select name="client">
													<option value="0" selected="" disabled="">Client</option>
													<?php
													foreach($activeclients as $clientrow){?>
													<option value="<?php echo($clientrow['id']);?>"><?php echo($clientrow['name']);?></option>
													<?php }?>
												</select> <i></i> </label>
										</section>

									</div>-->

									<div class="row">
										<section class="col col-6">
											<label class="select">
												<select id="project" name="project">
													<option value="0" selected="" disabled="">Templates</option>
													<?php
													foreach($activetemplatews as $objrow){?>
													<option value="<?php echo($objrow['id']);?>"><?php echo($objrow['name']);?></option>
													<?php }?>
												</select> <i></i>
                                            </label>
										</section>

									</div>

									<div class="row">

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
				<!-- end widget -->
			<!-- row -->
			<div class="row">

				<!-- NEW WIDGET START -->
				<article class="col-sm-8">


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
							<span class="widget-icon"> <i class="fa fa-picture-o"></i></span>
							<h2>Organization logo</h2>


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

								<form action="upload.php" class="dropzone" id="mydropzone">
									<div class="dz-message needsclick" style=" " >
                      <h4 style="margin-right:8px;">Drop organization logo here or click to browse it!<br/>(Recommended ratio 1w:1h)</h4>
                  </div>
								</form>

							</div>
							<!-- end widget content -->

						</div>
						<!-- end widget div -->

					</div>
					<!-- end widget -->

				</article>
				<!-- WIDGET END -->

			</div>
		</div>

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

function validateForm()
{
	//alert("validating form");

	var x = document.getElementById("name").value;
	showalert=true;

	if (x == "")
	{
		showWarning("Name is missing");
		return false;

	}
	else
	{

		var x = document.getElementById("description").value;
		if (x == "")
		{
				showWarning("Description must be filled out");
				return false;
		}
		else
		{
			//alert("Project");
			//var sel = document.getElementById("project");
			//var x= sel.options[sel.selectedIndex].value;

			if (document.getElementById("project").value==0)
			{
				showWarning("Select a project for the campaign");
				return false;
			}

			else
			{
				//var sel = document.getElementById("type").value;
				//alert("Type");
				if (document.getElementById("type").value==0)
				{
					showWarning("Select a type for the campaign");
					return false;
				}
			}

		}
	}

}
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
