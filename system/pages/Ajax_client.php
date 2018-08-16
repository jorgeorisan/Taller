<?php

if (  isset($_POST["oper"]) && $_POST["oper"] == "edit" && isset($_POST["id"]) && $_POST["id"]*1 > 0    ){
		$client=new Client();
		$client->load($_POST["id"] * 1 );
	
		if (isset($_POST["id"]) ){
			$client->setId($_POST["id"]);
		}
			
		if (isset($_POST["name"]) ){
			$client->setName($_POST["name"]);
		}
			
		if (isset($_POST["created"]) ){
			$client->setCreated($_POST["created"]);
		}
			
		if (isset($_POST["deleted"]) ){
			$client->setDeleted($_POST["deleted"]);
		}
			
		if (isset($_POST["user_deleted"]) ){
			$client->setUserDeleted($_POST["user_deleted"]);
		}
			
		if (isset($_POST["status"]) ){
			$client->setStatus($_POST["status"]);
		}
			
		if (isset($_POST["user_id"]) ){
			$client->setUserId($_POST["user_id"]);
		}
			
		if (isset($_POST["modified"]) ){
			$client->setModified($_POST["modified"]);
		}
				$client->save();

}elseif (  isset($_POST["oper"]) && $_POST["oper"] == "add"    ){
		$client=new Client();
	
		if (isset($_POST["name"]) ){
			$client->setName($_POST["name"]);
		}
			
		if (isset($_POST["created"]) ){
			$client->setCreated($_POST["created"]);
		}
			
		if (isset($_POST["deleted"]) ){
			$client->setDeleted($_POST["deleted"]);
		}
			
		if (isset($_POST["user_deleted"]) ){
			$client->setUserDeleted($_POST["user_deleted"]);
		}
			
		if (isset($_POST["status"]) ){
			$client->setStatus($_POST["status"]);
		}
			
		if (isset($_POST["user_id"]) ){
			$client->setUserId($_POST["user_id"]);
		}
			
		if (isset($_POST["modified"]) ){
			$client->setModified($_POST["modified"]);
		}
				$client->save();

}

if (  isset($_POST["rows"]) && isset($_POST["page"]) && isset($_POST["sidx"]) &&  isset($_POST["sord"])   ){

	$aaa=new Client();
	$res=$aaa->getAjaxClientRows(1*$_POST["page"], $_POST["rows"], $_POST["sidx"] , $_POST["sord"]);

if (isset($_GET["callback"])) {echo htmlspecialchars($_GET["callback"]);} echo "".$res."";die;?>{

}<?php

}