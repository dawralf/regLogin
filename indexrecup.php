<?php session_start(); ?>
<html>
	<head>
		<title>Validar email</title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> <!-- Caracteres especiales -->
		<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css">
<!--capturamos el evento submit del formulario y evitamos que lo envie
 con event.preventDefault(), 
 en su lugar serializamos el formulario y lo enviamos
 por ajax al script validaremail.php-->
	<script>
  $(document).ready(function(){
    $("#frmRestablecer").submit(function(event){
      event.preventDefault();
      $.ajax({
        url:'validaremail.php',
        type:'post',
        dataType:'json',
        data:$("#frmRestablecer").serializeArray()
      }).done(function(respuesta){
        $("#mensaje").html(respuesta.mensaje);
        $("#email").val('');
      });
    });
  });
</script>
	
	</head>
	<body>
	
	<?php include "php/navbar.php"; ?>

<div class="container">
<div class="row">
<div class="col-md-6">
	
<form id="frmRestablecer" action="validaremail.php" method="post">
  <div class="panel panel-default">
    <div class="panel-heading"> Restaurar contraseña </div>
    <div class="panel-body">
      <div class="form-group">
        <label for="email"> Escribe el email asociado a tu cuenta para recuperar tu contraseña </label>
        <input type="email" id="email" class="form-control" name="email" placeholder="persona@ejemplo.com"required>
      </div>
      <div class="form-group">
        <input type="submit" class="btn btn-primary" value="Recuperar contraseña" >
      </div>
    </div>
  </div>
</form>
</div>
</div>
</div>
<div id="mensaje"></div>

		<script src="js/valida_login.js"></script>
	</body>
</html>
