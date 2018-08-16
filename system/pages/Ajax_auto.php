<?php

if (  isset($_POST["oper"]) && $_POST["oper"] == "edit" && isset($_POST["id"]) && $_POST["id"]*1 > 0    ){
		$auto=new Auto();
		$auto->load($_POST["id"] * 1 );
	
				if (isset($_POST["id"]) ){
					$auto->setId($_POST["id"]);
				}
					
				if (isset($_POST["name_auto"]) ){
					$auto->setNameAuto($_POST["name_auto"]);
				}
					
				if (isset($_POST["created_date"]) ){
					$auto->setCreatedDate($_POST["created_date"]);
				}
					
				if (isset($_POST["token_expires"]) ){
					$auto->setTokenExpires($_POST["token_expires"]);
				}
					
				if (isset($_POST["token"]) ){
					$auto->setToken($_POST["token"]);
				}
						$auto->save();

}elseif (  isset($_POST["oper"]) && $_POST["oper"] == "add"    ){
		$auto=new Auto();
	
			if (isset($_POST["name_auto"]) ){
				$auto->setNameAuto($_POST["name_auto"]);
			}
				
			if (isset($_POST["created_date"]) ){
				$auto->setCreatedDate($_POST["created_date"]);
			}
				
			if (isset($_POST["token_expires"]) ){
				$auto->setTokenExpires($_POST["token_expires"]);
			}
				
			if (isset($_POST["token"]) ){
				$auto->setToken($_POST["token"]);
			}
					$auto->save();

}

if (  isset($_POST["rows"]) && isset($_POST["page"]) && isset($_POST["sidx"]) &&  isset($_POST["sord"])   ){

	$aaa=new Auto();
	$res=$aaa->getAjaxAutoRows(1*$_POST["page"], $_POST["rows"], $_POST["sidx"] , $_POST["sord"]);

if (isset($_GET["callback"])) {echo htmlspecialchars($_GET["callback"]);} echo "".$res."";die;?>{

}<?php

}