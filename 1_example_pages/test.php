<?php

//initilize the page
require_once(SYSTEM_DIR.DIRECTORY_SEPARATOR."inc/init.php");

//require UI configuration (nav, ribbon, etc.)
require_once(SYSTEM_DIR.DIRECTORY_SEPARATOR."inc/config.ui.php");

/*---------------- PHP Custom Scripts ---------

YOU CAN SET CONFIGURATION VARIABLES HERE BEFORE IT GOES TO NAV, RIBBON, ETC.
E.G. $page_title = "Custom Title" */

$page_title = "Blank Page";

/* ---------------- END PHP Custom Scripts ------------- */

//include header
//you can add your custom css in $page_css array.
//Note: all css files are inside css/ folder
$page_css[] = "your_style.css";
include(SYSTEM_DIR.DIRECTORY_SEPARATOR."inc/header.php");

//include left panel (navigation)
//follow the tree in inc/config.ui.php
$page_nav["misc"]["sub"]["blank"]["active"] = true;
include(SYSTEM_DIR.DIRECTORY_SEPARATOR."inc/nav.php");

?>
<!-- ==========================CONTENT STARTS HERE ========================== -->
<!-- MAIN PANEL -->
<div id="main" role="main">
	<?php
		//configure ribbon (breadcrumbs) array("name"=>"url"), leave url empty if no url
		//$breadcrumbs["New Crumb"] => "http://url.com"
		$breadcrumbs["Misc"] = "";
		include(SYSTEM_DIR.DIRECTORY_SEPARATOR."inc/ribbon.php");
	?>

	<!-- MAIN CONTENT -->
	<div id="content">
	
	</div>
	<!-- END MAIN CONTENT -->

</div>
<!-- END MAIN PANEL -->
<!-- ==========================CONTENT ENDS HERE ========================== -->

<!-- PAGE FOOTER -->
<?php
	// include page footer
	include(SYSTEM_DIR.DIRECTORY_SEPARATOR."inc/footer.php");
?>
<!-- END PAGE FOOTER -->

<?php 
	//include required scripts
	include(SYSTEM_DIR.DIRECTORY_SEPARATOR."inc/scripts.php"); 
?>

<!-- PAGE RELATED PLUGIN(S) 
<script src="..."></script>-->
<script src="https://google-code-prettify.googlecode.com/svn/loader/run_prettify.js"></script>
<script>

	$(document).ready(function() {
		// PAGE RELATED SCRIPTS
	})

</script>

<?php 
	//include footer
	include(SYSTEM_DIR.DIRECTORY_SEPARATOR."inc/footer.php"); 
?>