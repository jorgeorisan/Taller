<?php

$let="qwertyuiopasdfghjklzxcvbnm";
$let.=strtoupper($let);
$let.="0123456789";
for($i=0;$ii<1000;$ii++){
$ukey="";
$ukey.=substr($let,rand(0,strlen($let)),1);
$ukey.=substr($let,rand(0,strlen($let)),1);
$ukey.=substr($let,rand(0,strlen($let)),1);
$ukey.=substr($let,rand(0,strlen($let)),1);
$ukey.=substr($let,rand(0,strlen($let)),1);
$ukey.=substr($let,rand(0,strlen($let)),1);
$ukey.=substr($let,rand(0,strlen($let)),1);

echo $ukey."\n";
}





echo $ukey;