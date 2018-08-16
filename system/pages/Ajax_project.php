<?php

if (  isset($_POST["oper"]) && $_POST["oper"] == "edit" && isset($_POST["id"]) && $_POST["id"]*1 > 0    ){
		$project=new Project();
		$project->load($_POST["id"] * 1 );
	
		if (isset($_POST["id"]) ){
			$project->setId($_POST["id"]);
		}
			
		if (isset($_POST["name"]) ){
			$project->setName($_POST["name"]);
		}
			
		if (isset($_POST["created"]) ){
			$project->setCreated($_POST["created"]);
		}
			
		if (isset($_POST["status"]) ){
			$project->setStatus($_POST["status"]);
		}
			
		if (isset($_POST["user_id"]) ){
			$project->setUserId($_POST["user_id"]);
		}
			
		if (isset($_POST["start_date"]) ){
			$project->setStartDate($_POST["start_date"]);
		}
			
		if (isset($_POST["end_date"]) ){
			$project->setEndDate($_POST["end_date"]);
		}
			
		if (isset($_POST["client_id"]) ){
			$project->setClientId($_POST["client_id"]);
		}
			
		if (isset($_POST["deleted"]) ){
			$project->setDeleted($_POST["deleted"]);
		}
			
		if (isset($_POST["user_deleted"]) ){
			$project->setUserDeleted($_POST["user_deleted"]);
		}
			
		if (isset($_POST["modified"]) ){
			$project->setModified($_POST["modified"]);
		}
				$project->save();

}elseif (  isset($_POST["oper"]) && $_POST["oper"] == "add"    ){
		$project=new Project();
	
		if (isset($_POST["name"]) ){
			$project->setName($_POST["name"]);
		}
			
		if (isset($_POST["created"]) ){
			$project->setCreated($_POST["created"]);
		}
			
		if (isset($_POST["status"]) ){
			$project->setStatus($_POST["status"]);
		}
			
		if (isset($_POST["user_id"]) ){
			$project->setUserId($_POST["user_id"]);
		}
			
		if (isset($_POST["start_date"]) ){
			$project->setStartDate($_POST["start_date"]);
		}
			
		if (isset($_POST["end_date"]) ){
			$project->setEndDate($_POST["end_date"]);
		}
			
		if (isset($_POST["client_id"]) ){
			$project->setClientId($_POST["client_id"]);
		}
			
		if (isset($_POST["deleted"]) ){
			$project->setDeleted($_POST["deleted"]);
		}
			
		if (isset($_POST["user_deleted"]) ){
			$project->setUserDeleted($_POST["user_deleted"]);
		}
			
		if (isset($_POST["modified"]) ){
			$project->setModified($_POST["modified"]);
		}
				$project->save();

}

if (  isset($_POST["rows"]) && isset($_POST["page"]) && isset($_POST["sidx"]) &&  isset($_POST["sord"])   ){

	$aaa=new Project();
	$res=$aaa->getAjaxProjectRows(1*$_POST["page"], $_POST["rows"], $_POST["sidx"] , $_POST["sord"]);

if (isset($_GET["callback"])) {echo htmlspecialchars($_GET["callback"]);} echo "".$res."";die;?>{

}<?php

}