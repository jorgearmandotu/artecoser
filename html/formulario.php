<?php
if(isset($_POST['email'])) {
    $email_to = "jorgearmandou@gmail.com";
    $email_subject = "mensajes de páguina artecoser";
    
    
    function died($error){
        echo "<p style=background-color: blue>Lo sentimos, hubo un error en sus datos el mensaje no pudo ser enviado en este momento. /n";
        
        echo "Detalle de Error.<br /><br />";
        echo $error."<br><br>";
        echo "Corrija estos errores e intentelo de nuevo.<br><br></p>";
        die();
    }
    //se valida q los campos del formulario esn llenos
    if(!isset($_POST['nombre']) || 
       !isset($_POST['email']) || 
       !isset($_POST['mensaje'])) {
        
        died('Falta información.');
    }
//    asiganar variables de html
    $nombre = $_POST['nombre'];
    $email  = $_POST['email'];
    $mensaje = $_POST['mensaje'];
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
    
    //cuerpo del mensaje al correo
    $email_mensaje = "Página artecoser.\n\n";
    
    function clean_string($string){
        $bad = array("content-type","bcc:","to:","cc:","href");
        return str_replace($bad,"",$string);
    }
    
    $email_mensaje .= "Nombre: ".clean_string($nombre)."\n";
    $email_mensaje .= "Email: ".clean_string($email)."\n";
    $email_mensaje .= "Mensaje: ".clean_string($mensaje)."\n";
    
    //encabezados de correo
    $headers = 'From: '.$email."\r\n".
        'Reply-To: '.$email."\r\n" .
        'X-Mailer: PHP/' . phpversion();
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