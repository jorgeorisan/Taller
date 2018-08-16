<?php

if (  isset($_POST["oper"]) && $_POST["oper"] == "edit" && isset($_POST["id"]) && $_POST["id"]*1 > 0    ){
		$Test=new Test();
		$Test->load($_POST["id"] * 1 );
		$Test->save();

}elseif (  isset($_POST["oper"]) && $_POST["oper"] == "add"    ){
		$Test=new Test();
		$Test->save();

}

if (  isset($_POST["rows"]) && isset($_POST["page"]) && isset($_POST["sidx"]) &&  isset($_POST["sord"])   ){

	$aaa=new Test();
	$res=$aaa->getAjaxTestRows(1*$_POST["page"], $_POST["rows"], $_POST["sidx"] , $_POST["sord"]);

if (isset($_GET["callback"])) {echo htmlspecialchars($_GET["callback"]);} echo "".$res."";die;?>{

}<?php

}