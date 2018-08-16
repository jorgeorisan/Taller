
<?php

//initilize the page
require_once(SYSTEM_DIR . "/inc/init.php");

//require UI configuration (nav, ribbon, etc.)
require_once(SYSTEM_DIR . "/inc/config.ui.php");

/*---------------- PHP Custom Scripts ---------

YOU CAN SET CONFIGURATION VARIABLES HERE BEFORE IT GOES TO NAV, RIBBON, ETC.
E.G. $page_title = "Custom Title" */

$page_title = "Edit project";

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
	{$project_id=$request['params']['id'];}
else
	{die("No project selected to edit!");}

if(isset($request['params']['client_id'])   && $request['params']['client_id']>0)
		{$client_id=$request['params']['client_id'];}
else
		{die("No client selected to edit!");}

$client = new Client();
$p=$client->getClientProject($project_id);

$error_message="";
$success_message="";
$warning_message="";
if( isset($_POST['name']) && isset($_POST['start_date']) && isset($_POST['end_date'])) // && validateCSRFToken() )
{

	if(isset($_POST['status']) && $_POST['status']==1)
		$status='ACTIVE';
	else
		$status='DISABLED';

		$result=$client->saveProject($project_id,$_POST['name'],$_POST['start_date'],$_POST['end_date'],$status);

		if($result)
		{
			redirect(make_url("Projects","index",array('id'=>$client_id)));
			//$success_message="Project saved correctly";
		}
		else
		{
			//echo '.........................ERROR SAVING Client';
			$error_message="Error saving project";

		}

		/*$client -> setName($_POST['name']);
		$client -> setDescription($_POST['description']);
		$client -> setStatus($_POST['status']);

		$client -> save();
		if ($client->getValid()){
			redirect(make_url("Clients"));
		}else{
			if (empty($client->getStatus()) )
			{
				$error_message="There was an error while saving client!";
			}else{
				//print_r($user->getStatus());
				$error_message="Client status error!";
				//(())$errormessage="<p>".implode($user->getStatus(),"</p><p>")."</p>";
			}
		}
		*/
}


?>
<!-- ==========================CONTENT STARTS HERE ========================== -->
<!-- MAIN PANEL -->
<div id="main" role="main">
	<?php
		//configure ribbon (breadcrumbs) array("name"=>"url"), leave url empty if no url
		//$breadcrumbs["New Crumb"] => "http://url.com"
		$breadcrumbs["Clients"] = APP_URL."/Clients";
		$breadcrumbs["Projects"] = make_url("Projects","index",array('id'=>'1'));

		include(SYSTEM_DIR . "/inc/ribbon.php");
	?>

	<!-- MAIN CONTENT -->
	<div id="content">

		<div class="row">
				<div class="col-sm-8">
					<!-- widget content -->
					<div class="widget-body no-padding">

						<form id="smart-form-register" class="smart-form" role="form" method=post action="<?php echo make_url("Projects","edit",array('id'=>$project_id,'client_id'=>$client_id));?>" onsubmit="return validateForm();">
							<header>
								Edit project
							</header>

							<fieldset>
								<section>
									<label class="input"> <i class="icon-append fa fa-user"></i>
										<input type="text" name="name" placeholder="Name" value="<?=$p['name']?>">
										<b class="tooltip tooltip-bottom-right">Needed to enter client name</b> </label>
								</section>

								<div class="row">
									<section class="col col-6">
										<label class="input"> <i class="icon-append fa fa-calendar"></i>
											<input type="text" name="start_date" id="start_date" placeholder="Start date" value="<?=$p['start_date']?>">
										</label>
									</section>
									<section class="col col-6">
										<label class="input"> <i class="icon-append fa fa-calendar"></i>
											<input type="text" name="end_date" id="end_date" placeholder="End date" value="<?=$p['end_date']?>">
										</label>
									</section>
								</div>

								<div class="row">
									<section class="col col-6">
										<label class="select">
											<select name="status">
												<option value="0" disabled="">Status</option>
												<option value="1"<?php if($p['status']=='ACTIVE') {echo 'selected';}?>>Enabled</option>
												<option value="2"<?php if($p['status']=='DISABLED') {echo 'selected';}?>>Disabled</option>
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
