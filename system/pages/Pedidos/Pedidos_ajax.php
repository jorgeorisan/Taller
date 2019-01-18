<?php
//initilize the page
require_once(SYSTEM_DIR . "/inc/init.php");

//require UI configuration (nav, ribbon, etc.)
require_once(SYSTEM_DIR . "/inc/config.ui.php");
 
if (  isset($_GET["action"]) && $_GET["object"]){

	switch ($_GET["object"]) {	
		case 'validar':
		    $obj = new Pedido();
			if(isPost()){
			    $id=$obj->validar($_POST['id']);
			    if($id){
			        echo 1;
			    }else{
					return false;
			    }
			}
			break;	
		default:
			# code...
			break;
	}
	
}

?>