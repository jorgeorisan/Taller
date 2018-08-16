<?php

if (  isset($_POST["oper"]) && $_POST["oper"] == "edit" && isset($_POST["id"]) && $_POST["id"]*1 > 0    ){
		$campaign_type=new CampaignType();
		$campaign_type->load($_POST["id"] * 1 );
	
		if (isset($_POST["id"]) ){
			$campaign_type->setId($_POST["id"]);
		}
			
		if (isset($_POST["name"]) ){
			$campaign_type->setName($_POST["name"]);
		}
			
		if (isset($_POST["created"]) ){
			$campaign_type->setCreated($_POST["created"]);
		}
			
		if (isset($_POST["deleted"]) ){
			$campaign_type->setDeleted($_POST["deleted"]);
		}
			
		if (isset($_POST["user_deleted"]) ){
			$campaign_type->setUserDeleted($_POST["user_deleted"]);
		}
			
		if (isset($_POST["status"]) ){
			$campaign_type->setStatus($_POST["status"]);
		}
			
		if (isset($_POST["modified"]) ){
			$campaign_type->setModified($_POST["modified"]);
		}
				$campaign_type->save();

}elseif (  isset($_POST["oper"]) && $_POST["oper"] == "add"    ){
		$campaign_type=new CampaignType();
	
		if (isset($_POST["name"]) ){
			$campaign_type->setName($_POST["name"]);
		}
			
		if (isset($_POST["created"]) ){
			$campaign_type->setCreated($_POST["created"]);
		}
			
		if (isset($_POST["deleted"]) ){
			$campaign_type->setDeleted($_POST["deleted"]);
		}
			
		if (isset($_POST["user_deleted"]) ){
			$campaign_type->setUserDeleted($_POST["user_deleted"]);
		}
			
		if (isset($_POST["status"]) ){
			$campaign_type->setStatus($_POST["status"]);
		}
			
		if (isset($_POST["modified"]) ){
			$campaign_type->setModified($_POST["modified"]);
		}
				$campaign_type->save();

}

if (  isset($_POST["rows"]) && isset($_POST["page"]) && isset($_POST["sidx"]) &&  isset($_POST["sord"])   ){

	$aaa=new CampaignType();
	$res=$aaa->getAjaxCampaignTypeRows(1*$_POST["page"], $_POST["rows"], $_POST["sidx"] , $_POST["sord"]);

if (isset($_GET["callback"])) {echo htmlspecialchars($_GET["callback"]);} echo "".$res."";die;?>{

}<?php

}