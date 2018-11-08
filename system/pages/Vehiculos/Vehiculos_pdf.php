<?php 
include SYSTEM_DIR . "/lib/Pdfcrowd.php";
//ponemos el pizarron


if(isset($request['params']['id'])   && $request['params']['id']>0){
    $id=$request['params']['id'];
    $page=$request['params']['page'];
}else{
    
}
   
if(!$page) informError(true,make_url("Vehiculos","index"));

switch ($page) {
    case 'orden':
        $html = make_url("Vehiculos","print",array('id'=>$id,"page"=>$page));
        $pdfname = 'orden_reparacion.pdf';
        break;
    
    default:
        # code...
        break;
}
try
{
    // create the API client instance
    $client = new jfLib_Pdfcrowd();
    // run the conversion and write the result to a file
   
    $client->convertUrlToFile($html ,  ROOT_DIR ."/documentos/".$pdfname);
    $file = ROOT_DIR ."/documentos/".$pdfname;
   
    if (is_file($file)) {
        header("Content-Type: application/force-download");
        header("Content-Disposition: attachment; filename=\"$pdfname\"");
        readfile($file);
    }else{
        echo 'no es un archivo';
    }
    if(isset($request['params']['send']) && isset($request['params']['to'])){
        $to=$request['params']['to'];
        $bHayFicheros = 0; 
        $sCabeceraTexto = ""; 
        $sAdjuntos = "";

        $sCabeceras = "From:no-reply@geohti.com\n"; 
        
        $sCabeceras .= "MIME-version: 1.0\n"; 
        $sCabeceras .= "Content-type: multipart/mixed;"; 
        $sCabeceras .= "boundary=\"--_Separador-de-mensajes_--\"\n";
        $sCabeceraTexto = "----_Separador-de-mensajes_--\n"; 
        $sCabeceraTexto .= "Content-type: text/plain;charset=iso-8859-1\n"; 
        $sCabeceraTexto .= "Content-transfer-encoding: 7BIT\n";

        $sAdjuntos .= "\n\n----_Separador-de-mensajes_--\n"; 
        $sAdjuntos .= "Content-type: application/pdf ;name=\"".$pdfname."\"\n";; 
        $sAdjuntos .= "Content-Transfer-Encoding: BASE64\n"; 
        $sAdjuntos .= "Content-disposition: attachment;filename=\"".$pdfname."\"\n\n";

        $oFichero = fopen($file, 'r'); 
        $sContenido = fread($oFichero, filesize($pdfname)); 
        $sAdjuntos .= chunk_split(base64_encode($sContenido)); 
        fclose($oFichero); 
        
        $message = file_get_contents(SYSTEM_DIR.'/lib/Templates/emailpresupuesto.html');
        $message = str_replace("__TOKEN__", $token, $message);
        $message = str_replace("__URL__",   $link , $message); 
        $message = str_replace("__EMAIL__",   $email , $message); 
        

        $sTexto .= $sAdjuntos."\n\n----_Separador-de-mensajes_----\n"; 
        return(mail($to, 'Orden de Reparacion', $sTexto, $sCabeceras)); 
    }
        
    


    //header("Location: http://138.128.161.42/~systemmyg/example.pdf");
    die();
}
catch(\Pdfcrowd\Error $why)
{
    // report the error
    error_log("Pdfcrowd Error: {$why}\n");

    // handle the exception here or rethrow and handle it at a higher level
    throw $why;
}

?>