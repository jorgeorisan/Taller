<?php

//initilize the page
require_once(SYSTEM_DIR . "/inc/init.php");

//require UI configuration (nav, ribbon, etc.)
require_once(SYSTEM_DIR . "/inc/config.ui.php");

/*---------------- PHP Custom Scripts ---------

YOU CAN SET CONFIGURATION VARIABLES HERE BEFORE IT GOES TO NAV, RIBBON, ETC.
E.G. $page_title = "Custom Title" */

$page_title = "Add client";

/* ---------------- END PHP Custom Scripts ------------- */

//include header
//you can add your custom css in $page_css array.
//Note: all css files are inside css/ folder
$page_css[] = "your_style.css";
include(SYSTEM_DIR . "/inc/header.php");

//include left panel (navigation)
//follow the tree in inc/config.ui.php
$page_nav["misc"]["sub"]["blank"]["active"] = true;
include(SYSTEM_DIR . "/inc/nav.php");


$error_message="";
$success_message="";
$warning_message="";
if(isset($_POST['name']) && isset($_POST['description']))
	{
		//$error_message='ADDING CLIENT';
		$c = new Client();
		$c->addClient($_POST['name'],$_POST['description']);
		//$success_message="Client added correctly!";
		redirect(make_url("Clients"));


		/*$c -> setName($_POST['name']);
		$c -> setDescription($_POST['description']);
		$c -> setStatus($_POST['status']);

		$id=$c -> save();


		if ($id>0){
			redirect(make_url("Clients"));
		}else
		{$error_message="Error adding client";}
		*/
			//$success_message="User added correctly!";

		/*if ( empty($u->getStatus()) ) {
			$error_message="There was an error. Email my already be in system!";
		}else{
			$error_message="<p>".implode($u->getStatus(),"</p><p>")."</p>";
		}
		*/

		/*if(!$u->userExists($_POST['email']))
		{
			$u->addUser($_POST['email'],$_POST['first_name'],$_POST['last_name']);
			$success_message="User added correctly!";
		}
		else
		{
			$warning_message="Email already registered!";
		}
		*/
	}
?>


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

	<!-- MAIN CONTENT -->
	<div id="content">
		<h2>
			Add client
		</h2>
		<section id="widget-grid" class="">

			<div class="row">
					<div class="col-sm-8">
						<!-- widget content -->
						<div class="widget-body no-padding">

							<form id="smart-form-register" class="smart-form" role="form" method=post action="<?php echo make_url("Clients","add");?>" onsubmit="return validateForm();">
								<fieldset>
									<section>
										<label class="input"> <i class="icon-append fa fa-user"></i>
											<input type="text" id="name" name="name" placeholder="Name">
											<b class="tooltip tooltip-bottom-right">Needed to enter client name</b> </label>
									</section>

									<section>
										<label class="input"> <i class="icon-append fa fa-file-text"></i>
											<input type="text" id="description" name="description" placeholder="Description">
											<b class="tooltip tooltip-bottom-right">Needed to enter client description</b> </label>
									</section>



									<!--<div class="row">
										<section class="col col-6">
											<label class="select">
												<select id="status" name="status">
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

<!-- PAGE RELATED PLUGIN(S)-->

<!--<script src="<?php echo ASSETS_URL; ?>/js/plugin/dropzone/dropzone.min.js"></script>-->

<script type="text/javascript">

// DO NOT REMOVE : GLOBAL FUNCTIONS!


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

/*$(document).ready(function() {

	Dropzone.autoDiscover = false;
	$("#mydropzone").dropzone({
		//url: "/file/post",
		addRemoveLinks : true,
		maxFilesize: 0.5,
		dictDefaultMessage: '<span class="text-center"><span class="font-lg visible-xs-block visible-sm-block visible-lg-block"><span class="font-lg"><i class="fa fa-caret-right text-danger"></i> Drop files <span class="font-xs">to upload</span></span><span>&nbsp&nbsp<h4 class="display-inline"> (Or Click)</h4></span>',
		dictResponseError: 'Error uploading file!'
	});

})*/

</script>

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
		 //showWarning("WARNING");
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
