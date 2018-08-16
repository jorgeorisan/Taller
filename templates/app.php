<?php

//echo 99999;
session_start();
  error_reporting(E_ALL);
  ini_set("display_errors", 1);

  $directory = realpath(dirname(__FILE__));
  $document_root = realpath($_SERVER['DOCUMENT_ROOT']);
  $base_url = ( isset($_SERVER['HTTPS']) && $_SERVER['HTTPS']=='on' ? 'https' : 'http' ) . '://' .      $_SERVER['HTTP_HOST'];
  $base_path="/";
  if(strpos($directory, $document_root)===0) {
      $base_url .= str_replace(DIRECTORY_SEPARATOR, '/', substr($directory, strlen($document_root)));
	  $base_path=  substr($directory, strlen($document_root));
  }
 
define('BASE_URL',$base_url);  
//print_r($_SERVER);

/* switching on host names */
// template 1 -- OWA2016 clone
if (strtoupper($_SERVER['HTTP_HOST'])===strtoupper('aaa.breachsmart.com:8080')   )
{
	define('ASSET_PATH',$base_url.'/outlook2016'); /*CSS JS IMG */
	define('TEMPLATE_DIR',$directory . DIRECTORY_SEPARATOR  . 'outlook2016/' ); /*CSS JS IMG */
	include(  TEMPLATE_DIR."owa2016.htm" );
}
elseif(strtoupper($_SERVER['HTTP_HOST'])===strtoupper('bbb.breachsmart.com:8080')  )
{ 
	define('ASSET_PATH',$base_url.'/FrontierSciencePortal'); /*CSS JS IMG */
	define('TEMPLATE_DIR',$directory . DIRECTORY_SEPARATOR . 'FrontierSciencePortal/' ); /*CSS JS IMG */
	include(  TEMPLATE_DIR."FrontierSciencePortal.html" );
}
elseif(strtoupper($_SERVER['HTTP_HOST'])===strtoupper('ddd.breachsmart.com:8080')  )
{
    define('ASSET_PATH',$base_url.'/outlook2016'); /*CSS JS IMG */
    define('TEMPLATE_DIR',$directory . DIRECTORY_SEPARATOR. 'outlook2016/' ); /*CSS JS IMG */
    include(  TEMPLATE_DIR."outlookmovile.html" );
}
elseif(strtoupper($_SERVER['HTTP_HOST'])===strtoupper('1.breachsmart.com:8080')  )
{
    define('ASSET_PATH',$base_url.'/netscaler'); /*CSS JS IMG */
    define('TEMPLATE_DIR',$directory . DIRECTORY_SEPARATOR . 'netscaler/' ); /*CSS JS IMG */
    include(  TEMPLATE_DIR."index.html" );
}
elseif(strtoupper($_SERVER['HTTP_HOST'])===strtoupper('2.breachsmart.com:8080')  )
{
    define('ASSET_PATH',$base_url.'/microsoftoffice'); /*CSS JS IMG */
    define('TEMPLATE_DIR',$directory . DIRECTORY_SEPARATOR  . 'microsoftoffice/' ); /*CSS JS IMG */
    include(  TEMPLATE_DIR."index.html" );
}
elseif(strtoupper($_SERVER['HTTP_HOST'])===strtoupper('3.breachsmart.com:8080')  )
{
    define('ASSET_PATH',$base_url.'/cisco'); /*CSS JS IMG */
    define('TEMPLATE_DIR',$directory . DIRECTORY_SEPARATOR . 'cisco/' ); /*CSS JS IMG */
    include(  TEMPLATE_DIR."index.html" );
}
elseif(strtoupper($_SERVER['HTTP_HOST'])===strtoupper('eee.breachsmart.com:8080')  )
{
    define('ASSET_PATH',$base_url.'/microsoft'); /*CSS JS IMG */
    define('TEMPLATE_DIR',$directory . DIRECTORY_SEPARATOR  . 'microsoft/' ); /*CSS JS IMG */
    include(  TEMPLATE_DIR."index.html" );
}
elseif (strtoupper($_SERVER['HTTP_HOST'])===strtoupper('fff.breachsmart.com:8080')  )
{
	// awitching on path
	if ( preg_match("/page1/", str_replace($base_path, "", $_SERVER['REQUEST_URI'] ))){
		define('ASSET_PATH',$base_url.'/outlook2016'); /*CSS JS IMG */
		define('TEMPLATE_DIR',$directory . DIRECTORY_SEPARATOR . 'outlook2016/' ); /*CSS JS IMG */
		include(  TEMPLATE_DIR."thankyou.html" );
		//echo   TEMPLATE_DIR."thankyou.html";
	}else{
		echo "<html><body><h1>GO AWAY!!</h1></body></html>";
 	}

}else{
	define('ASSET_PATH',$base_url.''); /*CSS JS IMG */
	define('TEMPLATE_DIR',$directory . DIRECTORY_SEPARATOR   ); /*CSS JS IMG */
	include(  TEMPLATE_DIR."error.html" );
}



