<?php session_start(); ?>
<html>
	<head>
		<title>Validar email</title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> <!-- Caracteres especiales -->
		<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css">
	</head>
	<body link="red" vlink="red" alink="red"> >
<?php

include "php/navbar.php";

$email = $_POST['email'];
 
if( $email != "" ){
   $conexion = new mysqli('localhost', 'root', '', 'reglogin');
   $sql = " SELECT * FROM user WHERE email = '$email' ";
   $resultado = $conexion->query($sql);
   if($resultado->num_rows > 0){
      $usuario = $resultado->fetch_assoc();
      $linkTemporal = generarLinkTemporal( $usuario['id'], $usuario['username'] );
      if($linkTemporal){
        enviarEmail( $email, $linkTemporal );
        
      
      echo '<p class="alert alert-info">Un correo ha sido enviado a su cuenta de email con las instrucciones para restablecer la contrasena</p>';
      }
   }
   else
      echo '<p class="alert alert-info" >No existe una cuenta asociada a ese correo</p>';
}
else
	  echo '<p class="alert alert-info">Debes introducir el email de la cuenta</p>';


function generarLinkTemporal($idusuario, $username){
   // Se genera una cadena para validar el cambio de contraseña
   $cadena = $idusuario.$username.rand(1,9999999).date('Y-m-d');
   $token = sha1($cadena);
 
   $conexion = new mysqli('localhost', 'root', '', 'reglogin');
   // Se inserta el registro en la tabla tblreseteopass
   $sql = "INSERT INTO tblreseteopass (idusuario, username, token, creado) VALUES($idusuario,'$username','$token',NOW());";
   $resultado = $conexion->query($sql);
   if($resultado){
      // Se devuelve el link que se enviara al usuario
      $enlace = 'restablecer.php?idusuario='.sha1($idusuario).'&token='.$token;
      return $enlace;
   }
   else
      return FALSE;
}


function enviarEmail( $email, $linkTemporal ){
   echo $mensaje = '<html>
     <head>
        <title>Restablece tu contraseña</title>
     </head>
     <body>
       <p class="alert alert-info">Hemos recibido una petición para restablecer la contraseña de tu cuenta.</p>
       <p class="alert alert-info">Si hiciste esta petición, haz clic en el siguiente enlace, si no hiciste esta petición puedes ignorar este correo.</p>
       <p class="alert alert-info">
         <strong>Enlace para restablecer tu contraseña:<br></strong>
         <a href="'.$linkTemporal.'"> Restablecer contraseña </a>
       </p>
     </body>
    </html>';
   
   $cabeceras = 'MIME-Version: 1.0' . "\r\n";
   $cabeceras .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
   $cabeceras .= 'From: Codedrinks <mimail@codedrinks.com>' . "\r\n";
  /* // Se envia el correo al usuario
   mail($email, "Recuperar contraseña", $mensaje, $cabeceras);
*/
}
?>

</body>
</html>
