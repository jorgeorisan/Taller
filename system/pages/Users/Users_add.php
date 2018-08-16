<?php
//initilize the page
require_once(SYSTEM_DIR . "/inc/init.php");

//require UI configuration (nav, ribbon, etc.)
require_once(SYSTEM_DIR . "/inc/config.ui.php");

/*---------------- PHP Custom Scripts ---------

YOU CAN SET CONFIGURATION VARIABLES HERE BEFORE IT GOES TO NAV, RIBBON, ETC.
E.G. $page_title = "Custom Title" */

$page_title = "Add user";

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


$error_message="";
$success_message="";
$warning_message="";
if(isset($_POST['email']) && isset($_POST['first_name']) && isset($_POST['last_name']))
	{
		$u = new User();
		/*$u -> setEmail($_POST['email']);
		$u -> setFirstName($_POST['first_name']);
		$u -> setLastName($_POST['last_name']);
		//$u -> setInitials($_POST['initials']);
		$id=$u -> save();

		if ($id>0){
			redirect(make_url(    "Users"));
		}else
		{$error_message="Email already registered!";}
		*/
			//$success_message="User added correctly!";

		/*if ( empty($u->getStatus()) ) {
			$error_message="There was an error. Email my already be in system!";
		}else{
			$error_message="<p>".implode($u->getStatus(),"</p><p>")."</p>";
		}
		*/

		if(!$u->userExists($_POST['email']))
		{
			$u->addUser($_POST['email'],$_POST['first_name'],$_POST['last_name'],$_POST['test']);
			//$success_message="User added correctly!";
			redirect(make_url("Users"));
		}
		else
		{
			$warning_message="Email already registered!";
		}

	}
?>
<!-- ==========================CONTENT STARTS HERE ========================== -->
<!-- MAIN PANEL -->
<div id="main" role="main">
	<?php
		//configure ribbon (breadcrumbs) array("name"=>"url"), leave url empty if no url
		//$breadcrumbs["New Crumb"] => "http://url.com"
		$breadcrumbs["Users"] = APP_URL."/Users/index";
		include(SYSTEM_DIR . "/inc/ribbon.php");
	?>

	<!-- MAIN CONTENT -->
	<div id="content">

		<div class="row">
				<div class="col-sm-8">
					<!-- widget content -->
					<div class="widget-body no-padding">

						<form id="smart-form-register" class="smart-form" role="form" method=post action="<?php echo make_url("Users","add");?>" onsubmit="return validateForm();">
							<header>
								Add user
							</header>

							<fieldset>

								<section>
									<label class="input"> <i class="icon-append fa fa-envelope"></i>
										<input type="email" id="email" name="email" placeholder="Email">
										<b class="tooltip tooltip-bottom-right">Needed to enter email</b> </label>
								</section>

								<section>
									<label class="input"> <i class="icon-append fa fa-user"></i>
										<input type="text" id="first_name" name="first_name" placeholder="First name">
										<b class="tooltip tooltip-bottom-right">Needed to enter first name</b> </label>
								</section>

								<section>
									<label class="input"> <i class="icon-append fa fa-user"></i>
										<input type="text" id="last_name" name="last_name" placeholder="Last name">
										<b class="tooltip tooltip-bottom-right">Needed to enter last name</b> </label>
								</section>
								<section>
									<label class="input"> <i class="icon-append fa fa-user"></i>
										<input type="text" id="test" name="test" placeholder="otro">
										<b class="tooltip tooltip-bottom-right">otro</b> </label>
								</section>

								<!--<div class="row">
									<section class="col col-6">
										<label class="select">
											<select name="status">
												<option value="0" selected="" disabled="">Status</option>
												<option value="1">Enabled</option>
												<option value="2">Disabled</option>
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

<!-- PAGE RELATED PLUGIN(S)
<script src="<?php echo ASSETS_URL; ?>/js/plugin/YOURJS.js"></script>-->

<script>

function validateForm()
{
	//alert("validating form");

	var x = document.getElementById("email").value;
	showalert=true;

	if (x == "")
	{
		showWarning("Email is missing");
		return false;
	}
	else
	{
		var x = document.getElementById("first_name").value;
		if (x == "")
		{
				showWarning("First name must be filled out");
				return false;
		}
		else
		{
			var x = document.getElementById("last_name").value;
			if (x == "")
			{
				showWarning("Last name must be filled out");
				return false;
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
