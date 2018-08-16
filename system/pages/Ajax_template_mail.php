<?php

if (  isset($_POST["oper"]) && $_POST["oper"] == "edit" && isset($_POST["id"]) && $_POST["id"]*1 > 0    ){
		$template_mail=new template_mail();
		$template_mail->load($_POST["id"] * 1 );
		$template_mail->save();

}elseif (  isset($_POST["oper"]) && $_POST["oper"] == "add"    ){
		$template_mail=new template_mail();
		$template_mail->save();

}

if (  isset($_POST["rows"]) && isset($_POST["page"]) && isset($_POST["sidx"]) &&  isset($_POST["sord"])   ){

	$aaa=new template_mail();
	$res=$aaa->getAjaxtemplate_mailRows(1*$_POST["page"], $_POST["rows"], $_POST["sidx"] , $_POST["sord"]);

if (isset($_GET["callback"])) {echo htmlspecialchars($_GET["callback"]);} echo "".$res."";die;?>{

}<?php

}