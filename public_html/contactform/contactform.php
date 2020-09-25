<?php
	require("_lib/SMTP.php");
	require("_lib/PHPMailer.php");
	require("_lib/Exception.php");

if  (isset($_POST["nombre"]) && !empty($_POST["nombre"]) &&
	isset($_POST["email"]) && !empty($_POST["email"]) &&
	isset($_POST["subject"]) && !empty($_POST["subject"]) &&
	isset($_POST["mensaje"]) && !empty($_POST["mensaje"])){
	
	
	    $nombre=transformar_campo($_POST["nombre"]);
	    $email=transformar_campo($_POST["email"]);
        $subject=transformar_campo($_POST["subject"]);
        $mensaje=transformar_campo($_POST["mensaje"]);
        
		$contenido=crear_contenido($nombre,$email,$mensaje);
		
		
		enviar_mail($email,"KiTool - ".$subject." - ".$nombre,$contenido);
		
		return print("");

}else{
	return  print ("No se puede enviar");
	
	}


	function transformar_campo($campo){
	
	$campo=trim($campo); //quitar espacios en principio y final
	$campo=stripcslashes($campo); //quitar convinaciones de formato con barras invertidas
	$campo=htmlspecialchars($campo); //permite el uso de html
	
		return $campo;
	}
	
	function crear_contenido($nombre,$email,$mensaje){
	$contenido="<img src='http://kitool.com/images/top.png' />";
	$contenido=$contenido."<br><br>Hola, Gracias por contactarnos<br><br>Ha cargado la siguiente información:";
	$contenido=$contenido."<br>- Nombre: ".$nombre."<br>- Email: ".$email."<br>- Mensaje: "
	.$mensaje."<br><br>Lo estaremos contactando a la brevedad.<br>Saludos<br><br><b>Equipo de Kitool</b><br>info@kitool.com<br><a href='http://kitool.com'>kitool.com</a>";
	
	  return $contenido;
	}
	
	function enviar_mail($destino,$subject,$contenido){
	
	$mail = new PHPMailer(true);
	//validación por SMTP:
	$mail->IsSMTP();
  $mail->SMTPDebug =0;
	$mail->Debugoutput ='html';
	$mail->Host = "smtp.office365.com"; // SMTP a utilizar
	$mail->Port = 587; // Puerto a utilizar
  $mail->SMTPSecure = "ssl";
	$mail->SMTPAuth = true;
	$mail->CharSet='UTF-8';
	$mail->Username = "ejemplo@hotmail.com.ar"; // Correo completo a utilizar
	$mail->Password = "passw"; // Contraseña                                   +

  //configurar el from del mail
  $mail->setFrom('ejemplo@hotmail.com.ar','Raul'); // Desde donde enviamos (Para mostrar)


  //$mail->AddAddress($destino); // Esta es la dirección a donde enviamos
	$mail->AddAddress("cristianrojs92@gmail.com");
  $mail->IsHTML(true); // El correo se envía como HTML
  $mail->Subject = $subject; // Este es el titulo del email.
	
  $mail->Body = $contenido; // Mensaje a enviar
    
	$exito=$mail->Send(); // Envía el correo.
	
	if(!$exito) {
        echo '<div id="errormessage">Mensaje no enviado<br>';
        echo 'Mailer Error: ' . $mail->ErrorInfo.'</div>';
     } else {
         echo '<div id="sendmessage" class="alert alert-success" role="alert">Tu mensaje ha sido enviado correctamente. Gracias!</div>';
     }
	 
 
   }
	
	
?>