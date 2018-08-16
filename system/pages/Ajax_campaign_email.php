<?php

if (  isset($_POST["oper"]) && $_POST["oper"] == "edit" && isset($_POST["id"]) && $_POST["id"]*1 > 0    ){
		$campaign_email=new CampaignEmail();
		$campaign_email->load($_POST["id"] * 1 );
	
		if (isset($_POST["id"]) ){
			$campaign_email->setId($_POST["id"]);
		}
			
		if (isset($_POST["campaign_id"]) ){
			$campaign_email->setCampaignId($_POST["campaign_id"]);
		}
			
		if (isset($_POST["email"]) ){
			$campaign_email->setEmail($_POST["email"]);
		}
			
		if (isset($_POST["status"]) ){
			$campaign_email->setStatus($_POST["status"]);
		}
			
		if (isset($_POST["created"]) ){
			$campaign_email->setCreated($_POST["created"]);
		}
			
		if (isset($_POST["deleted"]) ){
			$campaign_email->setDeleted($_POST["deleted"]);
		}
			
		if (isset($_POST["user_deleted"]) ){
			$campaign_email->setUserDeleted($_POST["user_deleted"]);
		}
			
		if (isset($_POST["modified"]) ){
			$campaign_email->setModified($_POST["modified"]);
		}
				$campaign_email->save();

}elseif (  isset($_POST["oper"]) && $_POST["oper"] == "add"    ){
		$campaign_email=new CampaignEmail();
	
		if (isset($_POST["campaign_id"]) ){
			$campaign_email->setCampaignId($_POST["campaign_id"]);
		}
			
		if (isset($_POST["email"]) ){
			$campaign_email->setEmail($_POST["email"]);
		}
			
		if (isset($_POST["status"]) ){
			$campaign_email->setStatus($_POST["status"]);
		}
			
		if (isset($_POST["created"]) ){
			$campaign_email->setCreated($_POST["created"]);
		}
			
		if (isset($_POST["deleted"]) ){
			$campaign_email->setDeleted($_POST["deleted"]);
		}
			
		if (isset($_POST["user_deleted"]) ){
			$campaign_email->setUserDeleted($_POST["user_deleted"]);
		}
			
		if (isset($_POST["modified"]) ){
			$campaign_email->setModified($_POST["modified"]);
		}
				$campaign_email->save();

}

if (  isset($_POST["rows"]) && isset($_POST["page"]) && isset($_POST["sidx"]) &&  isset($_POST["sord"])   ){

	$aaa=new CampaignEmail();
	$res=$aaa->getAjaxCampaignEmailRows(1*$_POST["page"], $_POST["rows"], $_POST["sidx"] , $_POST["sord"]);

if (isset($_GET["callback"])) {echo htmlspecialchars($_GET["callback"]);} echo "".$res."";die;?>{

}<?php

}