<?php

if (  isset($_POST["oper"]) && $_POST["oper"] == "edit" && isset($_POST["id"]) && $_POST["id"]*1 > 0    ){
		$company=new Company();
		$company->load($_POST["id"] * 1 );
	
				if (isset($_POST["id"]) ){
					$company->setId($_POST["id"]);
				}
					
				if (isset($_POST["name"]) ){
					$company->setName($_POST["name"]);
				}
					
				if (isset($_POST["status"]) ){
					$company->setStatus($_POST["status"]);
				}
					
				if (isset($_POST["created_date"]) ){
					$company->setCreatedDate($_POST["created_date"]);
				}
						$company->save();

}elseif (  isset($_POST["oper"]) && $_POST["oper"] == "add"    ){
		$company=new Company();
	
			if (isset($_POST["name"]) ){
				$company->setName($_POST["name"]);
			}
				
			if (isset($_POST["status"]) ){
				$company->setStatus($_POST["status"]);
			}
				
			if (isset($_POST["created_date"]) ){
				$company->setCreatedDate($_POST["created_date"]);
			}
					$company->save();

}

if (  isset($_POST["rows"]) && isset($_POST["page"]) && isset($_POST["sidx"]) &&  isset($_POST["sord"])   ){

	$aaa=new Company();
	$res=$aaa->getAjaxCompanyRows(1*$_POST["page"], $_POST["rows"], $_POST["sidx"] , $_POST["sord"]);

if (isset($_GET["callback"])) {echo htmlspecialchars($_GET["callback"]);} echo "".$res."";die;?>{

}<?php

}