
<?php

//initilize the page
require_once(SYSTEM_DIR . "/inc/init.php");

//require UI configuration (nav, ribbon, etc.)
require_once(SYSTEM_DIR . "/inc/config.ui.php");

/*---------------- PHP Custom Scripts ---------

YOU CAN SET CONFIGURATION VARIABLES HERE BEFORE IT GOES TO NAV, RIBBON, ETC.
E.G. $page_title = "Custom Title" */

$page_title = "Campaign email";

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
		$breadcrumbs["Campaigns"] = APP_URL."/Campaigns/index";
		include(SYSTEM_DIR . "/inc/ribbon.php");
	?>

	<!-- MAIN CONTENT -->
	<div id="content">

		<div class="row">
				<div class="col-sm-12">
					<h2>Campaign name</h2>
					<h4>Campaign type</h4>
				</div>
		</div>
    <!--<div class="modal show" id="modalCompose">-->
		<div class= "row">
       <div class="modal-content">
         <div class="modal-header">
           <!--<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>-->
           <h4 class="modal-title">Customize email</h4>
         </div>
         <div class="modal-body">
           <form role="form" class="form-horizontal">
               <div class="form-group">
                 <label class="col-sm-2" for="inputTo">To</label>
                 <div class="col-sm-10"><input type="email" class="form-control" id="inputTo" placeholder="comma separated list of recipients"></div>
               </div>
               <div class="form-group">
                 <label class="col-sm-2" for="inputSubject">Subject</label>
                 <div class="col-sm-10"><input type="text" class="form-control" id="inputSubject" placeholder="subject"></div>
               </div>

							 <div class="form-group">
                <label class="col-sm-12" for="inputBody">Message</label>
               </div>

							 <div class="col-12-sm" style="padding:15px;">

								<input id="file-input" type="file" name="file-input" style="display: none;" onchange="">
								 <textarea name="text" id ="text" class="TextContent"><p style="text-align: justify;">
								 </textarea>
							 </div>

           </form>
         </div>
         <div class="modal-footer">
           <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancel</button>
           <button type="button" class="btn btn-primary ">Save <i class="fa fa-arrow-circle-right fa-lg"></i></button>

         </div>
       </div><!-- /.modal-content -->
    <!-- /.modal-dialog -->
      </div><!-- /.modal compose message -->


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
<script src="<?php echo ASSETS_URL;?>/js/tinymce/jquery.tinymce.min.js"></script>
<script src="<?php echo ASSETS_URL;?>/js/tinymce/tinymce.min.js"></script>

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
	});

	tinymce.init({

  mode : "specific_textareas",
  editor_selector : "TextContent",
  height: 500,
  plugins: [
  'advlist autolink  lists link image charmap print preview hr anchor pagebreak',
    'insertdatetime media nonbreaking save table contextmenu directionality'
  ],
  toolbar1: 'save | undo redo | insert | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image ',
  toolbar2: 'print preview | forecolor backcolor emoticons | codesample',
  //image_advtab: true,
  emplates: [
    { title: 'Test template 1', content: 'Test 1' },
    { title: 'Test template 2', content: 'Test 2' }
  ],
  content_css: [
    '//fonts.googleapis.com/css?family=Lato:300,300i,400,400i',
    '//www.tinymce.com/css/codepen.min.css'
  ],
	file_picker_callback: function (callback, value, meta) {
    if (meta.filetype == 'image') {
        var input = document.getElementById('file-input');
        input.click();
        input.onchange = function () {
            var file = input.files[0];
            var reader = new FileReader();
            reader.onload = function (e) {
                callback(e.target.result, {
                    alt: file.name
                });
            };
            reader.readAsDataURL(file);
        };
    }
	}
});

</script>

<?php
	//include footer
	include(SYSTEM_DIR . "/inc/close-html.php");
?>
