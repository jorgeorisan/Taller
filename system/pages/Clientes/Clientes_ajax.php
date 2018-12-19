<?php
//initilize the page
require_once(SYSTEM_DIR . "/inc/init.php");

//require UI configuration (nav, ribbon, etc.)
require_once(SYSTEM_DIR . "/inc/config.ui.php");
 
if (  isset($_GET["action"]) && $_GET["object"]){

	switch ($_GET["object"]) {
		case 'showpopup':
		    $html = file_get_contents(SYSTEM_DIR.'/pages/Clientes/Clientes_adpopup.php');
			if( $html ){
					echo $data=$html;
			}else{
				echo 0;
			}
			
			break;
		case 'savenewclient':
		    $obj = new Cliente();
			if(isPost()){
			    $obj = new Cliente();
			    $id=$obj->addAll(getPost());
			    if($id>0){
			        echo $id;
			    }else{
			        echo 0;
			    }
			}
			break;
		default:
			# code...
			break;
	}
	
}

?>