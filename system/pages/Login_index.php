<?php
   $showlogoutnote=0;
   ## if loggingout show message
   if (isset($_SESSION['user_id']) && $_SESSION['user_id']>0){$_SESSION['user_id']=-1;	$showlogoutnote=1; }
   session_destroy();
   session_start();
   
   // PAGE LOGIC
   $showloginerror=0;
 
   
   
   //initilize the page
   require_once(SYSTEM_DIR . "/inc/init.php");
   
   //require UI configuration (nav, ribbon, etc.)
   require_once(SYSTEM_DIR . "/inc/config.ui.php");
   
   /*---------------- PHP Custom Scripts ---------
   
   YOU CAN SET CONFIGURATION VARIABLES HERE BEFORE IT GOES TO NAV, RIBBON, ETC.
   E.G. $page_title = "Custom Title" */
   
   $page_title = "Login";
   
   /* ---------------- END PHP Custom Scripts ------------- */
   
   //include header
   //you can add your custom css in $page_css array.
   //Note: all css files are inside css/ folder
   $page_css[] = "your_style.css";
   $no_main_header = true;
   $page_html_prop = array("id"=>"extr-page", "class"=>"animated fadeInDown");
   include(SYSTEM_DIR . "/inc/header.php");
   
   ?>
<!-- ==========================CONTENT STARTS HERE ========================== -->
<!-- possible classes: minified, no-right-panel, fixed-ribbon, fixed-header, fixed-width-->
<header id="header">
   <!--<span id="logo"></span>-->
</header>
<div id="main" role="main">
   <!-- MAIN CONTENT -->
   <div id="content" class="containerNOT">
      <div class="row">
         <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 col-xl-4"></div>
         <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 col-xl-4"">
            <?php if (isset($request['params']['message'])){?>
            <section>
               <div class="alert alert-success fade in W">
                  <button class="close" data-dismiss="alert">
                  ×
                  </button>
                  <i class="fa-fw fa fa-check"></i>
                  <strong>Success</strong>  <?php echo htmlentities($request['params']['message']);?>
               </div>
            </section>
            <?php  }  ?>
            <div class="well no-padding">
               <form action="<?php echo make_url("Login","index",array('action'=>'login','uid'=>uniqid())) ?>" id="login-form" class="smart-form client-form" method="POST">
                  <header>
                     Sign In
                  </header>
                  <fieldset>
                     <section>
                        <label class="label">E-mail</label>
                        <label class="input"> <i class="icon-append fa fa-user"></i>
                        <input type="email" name="email">
                        <b class="tooltip tooltip-top-right"><i class="fa fa-user txt-color-teal"></i> Please enter email address/username</b></label>
                     </section>
                     <section>
                        <label class="label">Password</label>
                        <label class="input"> <i class="icon-append fa fa-lock"></i>
                        <input type="password" name="password">
                        <b class="tooltip tooltip-top-right"><i class="fa fa-lock txt-color-teal"></i> Enter your password</b> </label>
                        <div class="note">
                           <a href="<?php echo make_url("Login","ResetPassword") ?>">Forgot password?</a>
                        </div>
                     </section>
                  </fieldset>
                  <footer>
                     <button type="submit" class="btn btn-primary">
                     Sign in
                     </button>
                  </footer>
               </form>
            </div>
         </div>
         <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4  col-xl-4""></div>
      </div>
   </div>
</div>
<!-- END MAIN PANEL -->
<!-- ==========================CONTENT ENDS HERE ========================== -->
<?php
   //include required scripts
   include(SYSTEM_DIR . "/inc/scripts.php");
   if ( isset($_POST['email']) && trim(strtolower($_POST['password'])) ) {
		$id=0;
		$a = new Auth();
		$id =  $a->validateCredentials($_POST['email'],$_POST['password']);
		
		if ($id>0){
			// is authorized
			// load user / start session
			$u = new User();
			$u->load($id);
			$_SESSION['user_id']=$id;
			$_SESSION['user_info']=array(
				'id'=>$u->getId,
				'email'=>$u->getEmail(),
				'nombre'=>$u->getNombre(),
				'apellido_pat'=>$u->getApellidoPat(),
				'initials'=>$u->getInitials(),
				'id_taller'=>$u->getIdTaller(),
				'type'=>$u->getType()
				);
			$_SESSION['CSRFToken']=CSRFToken();
			$_SESSION['getCSRF']=CSRFToken();
			
			// redirect to default page for authenticated user
			redirect(make_url());
		}else{
			$showloginerror=1;
			echo"<script>
			notify('error','Error to validate');
			</script>";
			
		}
	} elseif ( isset($_POST['email'])){
	$showloginerror=1;
	}

   ?>
<!-- PAGE RELATED PLUGIN(S)
   <script src="..."></script>-->
<script type="text/javascript">
   runAllForms();
   
   $(function() {
   	// Validation
   	$("#login-form").validate({
   		// Rules for form validation
   		rules : {
   			email : {
   				required : true,
   				email : true
   			},
   			password : {
   				required : true,
   				minlength : 3,
   				maxlength : 20
   			}
   		},
   
   		// Messages for form validation
   		messages : {
   			email : {
   				required : 'Please enter your email address',
   				email : 'Please enter a VALID email address'
   			},
   			password : {
   				required : 'Please enter your password'
   			}
   		},
   
   		// Do not change code below
   		errorPlacement : function(error, element) {
   			error.insertAfter(element.parent());
   		}
   	});
   });
</script>
<?php
   //include footer
   include(SYSTEM_DIR . "/inc/close-html.php");
   ?>