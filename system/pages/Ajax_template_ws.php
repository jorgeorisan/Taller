<?php

if (  isset($_POST["oper"]) && $_POST["oper"] == "edit" && isset($_POST["id"]) && $_POST["id"]*1 > 0    ){
		$template_ws=new template_ws();
		$template_ws->load($_POST["id"] * 1 );
		$template_ws->save();

}elseif (  isset($_POST["oper"]) && $_POST["oper"] == "add"    ){
		$template_ws=new template_ws();
		$template_ws->save();

}

if (  isset($_POST["rows"]) && isset($_POST["page"]) && isset($_POST["sidx"]) &&  isset($_POST["sord"])   ){

	$aaa=new template_ws();
	$res=$aaa->getAjaxtemplate_wsRows(1*$_POST["page"], $_POST["rows"], $_POST["sidx"] , $_POST["sord"]);

if (isset($_GET["callback"])) {echo htmlspecialchars($_GET["callback"]);} echo "".$res."";die;?>{

}<?php

}