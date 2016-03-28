<?php
if(isset($_POST['email'])) {
    $email_to = "jorgearmandou@gmail.com";
    $email_subject = "mensajes de páguina artecoser";
    function died($error){
        echo "Lo sentimos, hubo un error en sus datos el mensaje no pudo ser enviado en este momento. ";
        
        echo "Detalle de Error.<br /><br />";
        echo $error."<br><br>";
        echo "Corrija estos errores e intentelo de nuevo.<br><br>";
        die();
    }
    //se valida q los campos del formulario esn llenos
    if(!isset($_POST['nombre']) || 
       !isset($_POST['email']) || 
       !isset($_POST['mensaje'])) {
        
        died('Falta información.');
    }
//    asiganar variables de html
    $nombre = strip_tags($_POST['nombre']);
    $email  = strip_tags($_POST['email']);
    $mensaje = strip_tags($_POST['mensaje']);
    $error_message ="";
    //variables de metadatos de archivos
    $nameFile = $_FILES['archivos']['name'];
    $sizeFile = $_FILES['archivos']['size'];
    $typeFile = $_FILES['archivos']['type'];
    $tempFile = $_FILES['archivos']['tmp_name'];
    
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
    
        //encabezados de correo
    $headers = "MIME-VERSION: 1.0\r\n";
    $headers .= "Content-type: multipart/mixed;";
    $headers .= "boundary=\"=C=T=E=C=\"\r\n";
    $headers .= 'From: '.$email."\r\n".
        'Reply-To: '.$email."\r\n" .
        'X-Mailer: PHP/' . phpversion();
    
    //cuerpo del mensaje al correo
    $email_mensaje = "--=C=T=E=C=\r\n";
    $email_mensaje .= "Content-type: text/plain";
    $email_mensaje .= "charset=utf-8\r\n";
    $email_mensaje .= "Content-Transfer-Encoding: 8bit\r\n";
    $email_mensaje .= "\r\n";
    $email_mensaje = "Página artecoser.\n\n";
    
    function clean_string($string){
        $bad = array("content-type","bcc:","to:","cc:","href");
        return str_replace($bad,"",$string);
    }
    
         
    
    $email_mensaje .= "Nombre: ".clean_string($nombre)."\n";
    $email_mensaje .= "Email: ".clean_string($email)."\n";
    $email_mensaje .= "Mensaje: ".clean_string($mensaje)."\n";
    $email_mensaje .= "\r\n";
    
    //adjuntando archivo
    $email_mensaje .= "--=C=T=E=C=\r\n";
    $email_mensaje .= "Content-Type: application/octet-stream;";
    $email_mensaje .= "name=" . $nameFile . "\r\n";
    $email_mensaje .= "Content-Transfer-Encoding: base64\r\n";
    $email_mensaje .= "Content-Disposition: attachment;";
    $email_mensaje .= "filename=" . $nameFile . "\r\n";
    $email_mensaje .= "\r\n";
    
    
    // lectura de archivo
    $fp = fopen($tempFile, "rb");
    $file = fread($fp, $sizeFile);
    $file = chunk_split(base64_encode($file));
    
    $email_mensaje .= "$file\r\n";
    $email_mensaje .= "\r\n";
    $email_mensaje .= "--=C=T=E=C=--\r\n";

        //enviar correo
    @mail($email_to, $email_subject, $email_mensaje, $headers);
    ?>
<!--    mensaje de salida-->
   <script type="text/javascript">alert('Gracias por usar nuestros servicios nos contactaremos con tigo lo mas pronto posible')</script>
    <?php
    header("Location: http://www.puertocolombiaensamble.com/html/formulario.html");
    ?>
    <?php
}
?>