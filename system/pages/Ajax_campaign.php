<?php

if (  isset($_POST["oper"]) && $_POST["oper"] == "edit" && isset($_POST["id"]) && $_POST["id"]*1 > 0    ){
		$campaign=new Campaign();
		$campaign->load($_POST["id"] * 1 );
	
		if (isset($_POST["id"]) ){
			$campaign->setId($_POST["id"]);
		}
			
		if (isset($_POST["name"]) ){
			$campaign->setName($_POST["name"]);
		}
			
		if (isset($_POST["created"]) ){
			$campaign->setCreated($_POST["created"]);
		}
			
		if (isset($_POST["status"]) ){
			$campaign->setStatus($_POST["status"]);
		}
			
		if (isset($_POST["campaign_type_id"]) ){
			$campaign->setCampaignTypeId($_POST["campaign_type_id"]);
		}
			
		if (isset($_POST["name_organization"]) ){
			$campaign->setNameOrganization($_POST["name_organization"]);
		}
			
		if (isset($_POST["from_email"]) ){
			$campaign->setFromEmail($_POST["from_email"]);
		}
			
		if (isset($_POST["from_name"]) ){
			$campaign->setFromName($_POST["from_name"]);
		}
			
		if (isset($_POST["get_variables"]) ){
			$campaign->setGetVariables($_POST["get_variables"]);
		}
			
		if (isset($_POST["subject"]) ){
			$campaign->setSubject($_POST["subject"]);
		}
			
		if (isset($_POST["user_id"]) ){
			$campaign->setUserId($_POST["user_id"]);
		}
			
		if (isset($_POST["project_id"]) ){
			$campaign->setProjectId($_POST["project_id"]);
		}
			
		if (isset($_POST["modified"]) ){
			$campaign->setModified($_POST["modified"]);
		}
				$campaign->save();

}elseif (  isset($_POST["oper"]) && $_POST["oper"] == "add"    ){
		$campaign=new Campaign();
	
		if (isset($_POST["name"]) ){
			$campaign->setName($_POST["name"]);
		}
			
		if (isset($_POST["created"]) ){
			$campaign->setCreated($_POST["created"]);
		}
			
		if (isset($_POST["status"]) ){
			$campaign->setStatus($_POST["status"]);
		}
			
		if (isset($_POST["campaign_type_id"]) ){
			$campaign->setCampaignTypeId($_POST["campaign_type_id"]);
		}
			
		if (isset($_POST["name_organization"]) ){
			$campaign->setNameOrganization($_POST["name_organization"]);
		}
			
		if (isset($_POST["from_email"]) ){
			$campaign->setFromEmail($_POST["from_email"]);
		}
			
		if (isset($_POST["from_name"]) ){
			$campaign->setFromName($_POST["from_name"]);
		}
			
		if (isset($_POST["get_variables"]) ){
			$campaign->setGetVariables($_POST["get_variables"]);
		}
			
		if (isset($_POST["subject"]) ){
			$campaign->setSubject($_POST["subject"]);
		}
			
		if (isset($_POST["user_id"]) ){
			$campaign->setUserId($_POST["user_id"]);
		}
			
		if (isset($_POST["project_id"]) ){
			$campaign->setProjectId($_POST["project_id"]);
		}
			
		if (isset($_POST["modified"]) ){
			$campaign->setModified($_POST["modified"]);
		}
				$campaign->save();

}

if (  isset($_POST["rows"]) && isset($_POST["page"]) && isset($_POST["sidx"]) &&  isset($_POST["sord"])   ){

	$aaa=new Campaign();
	$res=$aaa->getAjaxCampaignRows(1*$_POST["page"], $_POST["rows"], $_POST["sidx"] , $_POST["sord"]);

if (isset($_GET["callback"])) {echo htmlspecialchars($_GET["callback"]);} echo "".$res."";die;?>{

}<?php

}