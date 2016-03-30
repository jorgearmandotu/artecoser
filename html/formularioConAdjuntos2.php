<?php
    function died($error){
        echo "<p style = 'background-color: #4C8CCA'>Lo sentimos, hubo un error en sus datos el mensaje no pudo ser enviado en este momento <br>Detalle de Error <br>".$error." <br>Corrija estos errores e intentelo de nuevo)</p>";
        die();
    }

     function clean_string($string){
        $bad = array("content-type","bcc:","to:","cc:","href");
        return str_replace($bad,"",$string);
        }
    
    function form_mail($sPara, $sAsunto, $sTexto, $sDe)
    {
        
        
        
        
        $bHayFicheros = 0;
        $scabeceraTexto = "";
        $sAdjuntos = "";
        $sCuerpo = $sTexto;
        $sSeparador = uniqid("_separador_de_datos_");
        
        $sCabeceras = "MIME-version: 1.0\n";
        
    
        //recojemos campos de texto
        $nombre = strip_tags($_POST['nombre']);
        $email  = strip_tags($_POST['email']);
        $mensaje = strip_tags($_POST['mensaje']);
        $error_message ="";
        
        //    verificamos cooreo valido
        $email_exp = '/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/';
        if(!preg_match($email_exp,$email)){
            $error_message .= 'La direccion de correo no es válida.<br>';
        }
        //validar cadenas
        $string_exp = "/^[a-zñÑáéíóú\d_\s]{4,28}$/i";
        if(!preg_match($string_exp,$nombre)){
            $error_message .= 'El formato del nombre no es válido<br>';
        }
        if (strlen($mensaje) < 2){
            $error_message .= 'El formato del mensaje no es valido.<br>';
        }
        if(strlen($error_message) > 0){
            died($error_message);
        }
        
       
    
        
        
        //recorremos los ficheros
        foreach($_FILES as $vAdjunto)
        {
            if ($bHayFicheros == 0)
            {
                //hay ficheros
                $bHayFicheros = 1;
                //cabeceras generales del mail
                $sCabeceras .= "Content-type: multipart/mixed;";
                $sCabeceras .= "boundary=\"".$sSeparador."\"\n";
                //cabeceras del texto
                $sCabeceraTexto = "--".$sSeparador."\n";
                $sCabeceraTexto .= "Content-type: text/plain;charset=iso-8859-1\n";
                $sCabeceraTexto .= "Content-transfer-encoding: 7BIT\n\n";
                $sCuerpo .= $sCabeceraTexto;//.$sCuerpo 
                
                
            }
            
           //se valida el tamaño del archivo
            if($vAdjunto["size"]>1090000) 
                died("El tamaño de archivo es muy grande");
             //se añade el fichero
            if($vAdjunto["size"]>0)
            {
                $sAdjuntos .= "\n\n--".$sSeparador."\n";
                $sAdjuntos .= "Content-type: ".$vAdjunto["type"].";name=\"".$vAdjunto["name"]."\"\n";
                $sAdjuntos .= "Content-Transfer-Encoding: BASE64\n";
                $sAdjuntos .= "Content-disposition: attachment;filename=\"".$vAdjunto["name"]."\"\n\n";
                
                $oFichero = fopen($vAdjunto["tmp_name"], 'rb');
                $sContenido = fread($oFichero, filesize($vAdjunto["tmp_name"]));
                $sAdjuntos .= chunk_split(base64_encode($sContenido));
                fclose($oFichero);
            }
            
        }
        

        
        //se introduce la informcion al email
        
        $sCuerpo .= "\nNombre: ".clean_string($nombre)."\n";//sCuerpo  al inicio
        $sCuerpo .= "Email: ".clean_string($email)."\n";
        $sCuerpo .= "Mensaje: \n".clean_string($mensaje)."\n";
        
        // si hay fichero se añaden al cuerpo
        if ($bHayFicheros)
        {
            $sCuerpo .= $sAdjuntos."\n\n--".$sSeparador."--\n";
        }
        // se añade la cabecera de destinatario
        
    if ($sDe){$sCabeceras .= "From: ".$sDe."\n";
            
             }
        //envio de email
        return(mail($sPara, $sAsunto, $sCuerpo, $sCabeceras));
        echo "'\n\nnviado";
        
    }
    
    if (form_mail("artecoser78@hotmail.com","Paguina ArteCoser",$sDe,strip_tags($_POST["email"]))){
        echo ' <script type="text/javascript">alert("Gracias por usar nuestros servicios nos contactaremos con tigo lo mas pronto posible")</script>';
    }else{
        '<script type="text/javascript">alert("hubo un error inesperado intentalo mas tarde")</srcipt>';
    }
?>