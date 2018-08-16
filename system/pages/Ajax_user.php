<?php

if (  isset($_POST["oper"]) && $_POST["oper"] == "edit" && isset($_POST["id"]) && $_POST["id"]*1 > 0    ){
		$user=new User();
		$user->load($_POST["id"] * 1 );

		if (isset($_POST["id"]) ){
			$user->setId($_POST["id"]);
		}
		
		if (isset($_POST["username"]) ){
			$user->setUsername($_POST["username"]);
		}
		
		if (isset($_POST["password"]) ){
			$user->setPassword($_POST["password"]);
		}
		
		if (isset($_POST["created_at"]) ){
			$user->setCreatedAt($_POST["created_at"]);
		}
		
		if (isset($_POST["deleted_at"]) ){
			$user->setDeletedAt($_POST["deleted_at"]);
		}
		
		if (isset($_POST["user_deleted"]) ){
			$user->setUserDeleted($_POST["user_deleted"]);
		}
		
		if (isset($_POST["status"]) ){
			$user->setStatus($_POST["status"]);
		}
		
		if (isset($_POST["first_name"]) ){
			$user->setFirstName($_POST["first_name"]);
		}
		
		if (isset($_POST["last_name"]) ){
			$user->setLastName($_POST["last_name"]);
		}
		
		if (isset($_POST["phone"]) ){
			$user->setPhone($_POST["phone"]);
		}
				$user->save();

}elseif (  isset($_POST["oper"]) && $_POST["oper"] == "add"    ){
		$user=new User();

		if (isset($_POST["username"]) ){
			$user->setUsername($_POST["username"]);
		}
		
		if (isset($_POST["password"]) ){
			$user->setPassword($_POST["password"]);
		}
		
		if (isset($_POST["created_at"]) ){
			$user->setCreatedAt($_POST["created_at"]);
		}
		
		if (isset($_POST["deleted_at"]) ){
			$user->setDeletedAt($_POST["deleted_at"]);
		}
		
		if (isset($_POST["user_deleted"]) ){
			$user->setUserDeleted($_POST["user_deleted"]);
		}
		
		if (isset($_POST["status"]) ){
			$user->setStatus($_POST["status"]);
		}
		
		if (isset($_POST["first_name"]) ){
			$user->setFirstName($_POST["first_name"]);
		}
		
		if (isset($_POST["last_name"]) ){
			$user->setLastName($_POST["last_name"]);
		}
		
		if (isset($_POST["phone"]) ){
			$user->setPhone($_POST["phone"]);
		}
				$user->save();

}

if (  isset($_POST["rows"]) && isset($_POST["page"]) && isset($_POST["sidx"]) &&  isset($_POST["sord"])   ){

	$aaa=new User();
	$res=$aaa->getAjaxUserRows(1*$_POST["page"], $_POST["rows"], $_POST["sidx"] , $_POST["sord"]);

if (isset($_GET["callback"])) {echo htmlspecialchars($_GET["callback"]);} echo "".$res."";die;?>{

}<?php

}