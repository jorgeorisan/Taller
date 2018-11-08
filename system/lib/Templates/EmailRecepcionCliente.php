<html>
        <head>
          <title>Confirmación de recepción de vehículo</title>
          <style>
                body {
                    background-color: #ffffff;
                    padding: 30px;
                    margin: 0px;
                }

                h1 {
                    color: white;
                    text-align: center;
                }

                p {
                    font-family: verdana;
                    font-size: 14px;
                    margin:10px;
                    text-align: justify;
                }
                .divRojo
                {
                    display:block; 
                    width: 100%; 
                    background-color: #cc3300; 
                    color: #ffffff; 
                    font-size: 16px; 
                    padding: 10px; 
                    text-align: center; 
                    height: 40px; 
                }
           </style>
        </head>
        <body>
        <div style="margin:0px auto; display: block; width:90%;">
          <div style="display:block; width: 100%; background-color: #cc3300; color: #ffffff; font-size: 20px; padding: 20px;; text-align: center;">Confirmación de Recepción de vehículo</div>
          <p><b>Estimado '. $nombreCliente .'</b></p>
          <p>Espero se encuentre muy bien, reciba un cordial saludo, el motivo de mi correo es agradecer la confianza que deposita en '. $nombreTaller . 
          ' para hacer la reparación de su auto, aprovecho el medio para ponerme  a sus órdenes soy  el encargado  del área de seguimiento.
          </p>
          <p>Sabemos lo importante que es para usted tener su auto en marcha por lo que daremos nuestro mejor esfuerzo para alcanzar los estándares de satisfacción que espera de nosotros, 
          por tal motivo emplearemos todas nuestras áreas correspondientes para entregarle su auto lo antes posible así mismo le hago saber que basado a las políticas de la compañía aseguradora 
          que le está atendiendo su expediente será mandado el día de mañana a través del portal  vía web para su revision y autorización, el tramite completo tarda un tiempo no mayor a 72horas 
          hábiles, posteriormente nos harán llegara la piezas que se necesitan para la correcta reparación de su auto y podernos poner en contacto con usted.</p>
          <p>Me despido de usted no sin antes enviar un cordial saludo.</p>
          <p><b>'.$propTaller.'</b><br>
               Gerente General<br>
               Tel: '.$telTaller.' y 6718-4039<br>
               Cel. 5521-338595<br>
               Mail: '.$correolTaller.'</p>
               <img src="http://sgtamyg.geohti.com/'. $logoTaller .'" width="200px">
          <div class="divRojo">
          Fotos del Inventario
          </div>
          <div style="display:block; width: 100%; margin: 0px auto; text-align:center;">'.$fotosInventarioCorreo.'</div>
          <div style="display:block; width: 100%; background-color: #cc3300; color: #ffffff; font-size: 16px; padding: 10px; text-align: center; height: 40px; vertical-align: bottom;">
          '.$nombreTaller.'<br>
          <small>'.$dirTaller.'</small>
          </div>
          </div>
        </body>
        </html>