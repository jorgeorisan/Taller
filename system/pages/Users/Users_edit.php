<?php

//initilize the page
require_once(SYSTEM_DIR . "/inc/init.php");

//require UI configuration (nav, ribbon, etc.)
require_once(SYSTEM_DIR . "/inc/config.ui.php");

/*---------------- PHP Custom Scripts ---------

YOU CAN SET CONFIGURATION VARIABLES HERE BEFORE IT GOES TO NAV, RIBBON, ETC.
E.G. $page_title = "Custom Title" */

$page_title = "Edit user";

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
	{$user_id=$request['params']['id'];}
else
	{die("No user selected to edit!");}


$u = new User();
$user=$u->getUser($user_id);

//$user->load($user_id);
$error_message="";
$success_message="";
$warning_message="";
if(isset($_POST['email']) && isset($_POST['first_name']) && isset($_POST['last_name']))//&& validateCSRFToken() )
{

	if(isset($_POST['enabled']) && $_POST['enabled']==1)
		$enabled_int=1;
	else
		$enabled_int=0;

		$result=$u->saveUser($user_id,$_POST['email'],$_POST['first_name'],$_POST['last_name'],$enabled_int);

		if($result)
		{
			redirect(make_url("Users"));
			//$success_message="User saved correctly";
		}
		else
		{
			$error_message="Error saving user";

		}

		/*$user -> setEmail($_POST['email']);
		$user -> setFirstName($_POST['first_name']);
		$user -> setLastName($_POST['last_name']);

		$user -> setEnabled($enabled_int);
		$user -> save();

		if ($user->getValid()){
			redirect(make_url("Users"));
		}else{
			if (empty($user->getStatus()) )
			{
				$error_message="There was an error while saving !";
			}else{
				//print_r($user->getStatus());
				$error_message="User status error!";
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
		$breadcrumbs["Users"] = APP_URL."/Users/index";
		include(SYSTEM_DIR . "/inc/ribbon.php");
		//echo $user['enabled'];
	?>

	<!-- MAIN CONTENT -->
	<div id="content">
		<div class="row">
				<div class="col-sm-8 col-md-8">
						<!-- Widget ID (each widget will need unique ID)-->
						<div class="jarviswidget" id="wid-id-4" data-widget-editbutton="false" data-widget-custombutton="false">
							<div class="widget-body no-padding">
								<form id="main-form" class="smart-form" role="form" method=post action="<?php echo make_url("Users","add");?>" onsubmit="return checkSubmit();">
									<header>Add user</header>
									<fieldset>
										<section>
											<label class="input"> <i class="icon-append fa fa-envelope"></i>
												<input type="email" id="email" name="email" placeholder="Email" value="<?php echo $user['email']; ?>">
											</label>
										</section>
										<section>
											<label class="input"> <i class="icon-append fa fa-user"></i>
												<input type="text" id="nombre" name="nombre" placeholder="Nombre">
											</label>
										</section>
										<section>
											<label class="input"> <i class="icon-append fa fa-user"></i>
												<input type="text" id="apellido_pat" name="apellido_pat" placeholder="Apellido Paterno">
											</label>
										</section>
										<section>
											<label class="input"> <i class="icon-append fa fa-user"></i>
												<input type="text" id="apellido_mat" name="apellido_mat" placeholder="Apellido Materno">
											</label>
										</section>
										<section>
											<label class="input"> <i class="icon-append fa fa-list-alt"></i>
												<input type="text" id="direccion" name="direccion" placeholder="Direccion">
											</label>
										</section>
											<section>
												<label class="label">Company</label>
												<select style="width:100%" class="select2">
													<?php 
													$obj = new Company();
													$list=$obj->getAll();
													if (is_array($list) || is_object($list)){
														foreach($list as $val){
															echo "<option value='".$val['id']."'>".$val['name']."</option>";
														}
													}
													 ?>
												</select>
											</section>
									</fieldset>
									<footer>
										<button type="button" onclick=" validateForm();" class="btn btn-primary">
											Save
										</button>
									</footer>
								</form>

							</div>
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
