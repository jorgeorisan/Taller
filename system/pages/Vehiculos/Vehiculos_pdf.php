<?php 


// reference the Dompdf namespace
use Dompdf\Dompdf;
use Dompdf\Options;


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
    // instantiate and use the dompdf class
    $options = new Options();
    $options->set('isHtml5ParserEnabled', true);
    $options->set('isRemoteEnabled', true);
    $dompdf = new Dompdf($options);
    $html = make_url("Vehiculos","print",array('id'=>$id,"page"=>$page,"pdf"=>"si"));

    $dompdf->load_html( file_get_contents( $html ) );
    $dompdf->render();
    $pdf = $dompdf->output();
    
    //$request['params']['to']='jororisan@gmail.com';
    //$request['params']['send']='true';
    if( ! isset($request['params']['send']))
        $dompdf->stream($pdfname);
    
    if(isset($request['params']['send']) && isset($request['params']['to'])){
        $file = ROOT_DIR ."/documentos/".$pdfname;
        file_put_contents($file, $pdf);  
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
        $sContenido = fread($oFichero, filesize($file)); 
        $sAdjuntos .= chunk_split(base64_encode($sContenido)); 
        fclose($oFichero); 
        
    
        $sTexto = $sAdjuntos."\n\n----_Separador-de-mensajes_----\n"; 
        if(mail($to, 'Orden de Reparacion', $sTexto, $sCabeceras)){
            echo "<script>swal('Enviado con Exito')";
        }else{
            echo "<script>swal('Error al Enviar')";
        }
    }
        
    


    //header("Location: http://138.128.161.42/~systemmyg/example.pdf");
    die();


?>