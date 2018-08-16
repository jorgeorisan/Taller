
<?php

//initilize the page
require_once(SYSTEM_DIR . "/inc/init.php");

//require UI configuration (nav, ribbon, etc.)
require_once(SYSTEM_DIR . "/inc/config.ui.php");

/*---------------- PHP Custom Scripts ---------

YOU CAN SET CONFIGURATION VARIABLES HERE BEFORE IT GOES TO NAV, RIBBON, ETC.
E.G. $page_title = "Custom Title" */

$page_title = "Add project";

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
	{die("No client selected to edit!************	");}


$error_message="";
$success_message="";
$warning_message="";
if(isset($_POST['name']) && isset($_POST['start_date']) && isset($_POST['end_date']))
{
		//echo '-----------------------ADDING PROJECT';
		//$error_message='ADDING PROJECT'.$client_id;
		$c = new Client();
		$c->addProject($client_id,$_POST['name'],$_POST['start_date'],$_POST['end_date']);
		//$success_message="Client added correctly!";
		redirect(make_url("Projects","index",array('id'=>$client_id)));
}
?>
<!-- ==========================CONTENT STARTS HERE ========================== -->
<!-- MAIN PANEL -->
<div id="main" role="main">
	<?php
		//configure ribbon (breadcrumbs) array("name"=>"url"), leave url empty if no url
		//$breadcrumbs["New Crumb"] => "http://url.com"
    $breadcrumbs["Clients"] = APP_URL."/Clients";
		$breadcrumbs["Projects"] = make_url("Projects","index",array('id'=>$client_id));

		include(SYSTEM_DIR . "/inc/ribbon.php");
	?>

	<!-- MAIN CONTENT -->
  <!-- MAIN CONTENT -->
	<div id="content">

		<div class="row">
				<div class="col-sm-8">
					<!-- widget content -->
					<div class="widget-body no-padding">

						<form id="smart-form-register" class="smart-form" role="form" method=post action="<?php echo make_url("Projects","add",array('id'=>$client_id));?>" onsubmit="return validateForm();">
							<header>
								Add project
							</header>

							<fieldset>
								<section>
									<label class="input"> <i class="icon-append fa fa-user"></i>
										<input type="text" name="name" placeholder="Name">
										<b class="tooltip tooltip-bottom-right">Needed to enter project name</b> </label>
								</section>

								<section>
									<label class="input"> <i class="icon-append fa fa-file-text"></i>
										<input type="text" name="description" placeholder="Description">
										<b class="tooltip tooltip-bottom-right">Needed to enter project description</b> </label>
								</section>

								<div class="row">
									<section class="col col-6">
										<label class="input"> <i class="icon-append fa fa-calendar"></i>

            					<input type="text" name="start_date" class="span2" value="" id="start_date" >

											<!--<input type="text" name="start_date" class="span2" value="2017-06-06" id="start_date" >-->
											<!--<input type="text" name="startdate" id="startdate" placeholder="Start date">-->
										</label>
									</section>
									<section class="col col-6">
										<label class="input"> <i class="icon-append fa fa-calendar"></i>
											<input type="text" name="end_date" class="span2" value="" id="end_date" >

										</label>
									</section>
								</div>

								<!--<div class="row">
									<section class="col col-6">
										<label class="select">
											<select name="status">
												<option value="0" selected="" disabled="">Status</option>
												<option value="1">Enabled</option>
												<option value="2">Disabled</option>
												<option value="3">Deleted</option>
											</select> <i></i> </label>
									</section>

								</div>-->
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
<link href="<?php echo SYSTEM_DIR; ?>/css/datepicker.css" rel="stylesheet">
<script src="<?php echo SYSTEM_DIR; ?>/js/bootstrap-datepicker/bootstrap-datepicker.js"></script>

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
		/*else
		{
			var x = document.getElementById("last_name").value;
			if (x == "")
			{
				showWarning("Last name must be filled out");
				return false;
			}
		}*/
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

	$('#start_date').datepicker({
				format: 'mm/dd/yyyy',
      	todayBtn: 'linked'
			});
	$('#end_date').datepicker({
				format: 'mm/dd/yyyy',
		    todayBtn: 'linked'
		});


</script>

<?php
	//include footer
	include(SYSTEM_DIR . "/inc/close-html.php");
?>
