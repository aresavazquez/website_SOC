<?php 
$message = '';

/* A message le agregamos 
* lo que viene en la variable certification 
* y un espacio para que no salga todo encimado
*/
$message .="Certificacion:" . $_POST['certification'] . ' ';
$message .="Nombre:" .  $_POST['name'] . ' '; 
$message .="Antiguedad: " .  $_POST['years'] . ' '; 
$message .="Tipo de Evaluacion: " .  $_POST['tipo_evaluation'] . ' '; 
$message .="Firmas: " .  $_POST['signature'] . ' '; 
$message .="Oficina: " .  $_POST['office'] . ' '; 
$message .="Titular de la Oficina: " .  $_POST['titular'] . ' '; 
$message .="Ciudad: " .  $_POST['city'] . ' ';
$message .="Mail: " .  $_POST['mail'] . ' '; 
$message .="Telefono: " .  $_POST['fon'] . ' '; 

/*
Así con todas las variables
.
.
.
*/
mail("certificacionsoc@gmail.com", 'Datos Certificación Broker', $message);

// mail("avazquez@socasesores.com", $_MESSAGE["subject"], $_MESSAGE["message"]); // sirve para mandar los datos a un correo
// mail($_POST["ares@digitaldealers.mx"], $_POST["subject"], $_POST["message"]); // manda un correo al mail registrado
// var a = "message"; // var no se usa en php
?>

<!DOCTYPE html>
<html>
  	<head>
 		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
		<link rel="stylesheet" type="text/css" href="css/certificacion.css">
		<link rel="stylesheet" type="text/css" href="css/responsive.css">
 		<title>Certificación</title>
 	</head>
 	<body>
 		<div class="res-form">
 			<a href="certificacion.html" class="close"><img src="img/im-universidad/close2.png"></a>
 			<div>
				<p>Tus datos se han registrado correctamente.<br>
				En breve nos pondremos en contacto contigo.</p>
			</div>	
		</div>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/1.17.0/TweenMax.min.js"></script>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    	<script type="text/javascript" src="./js/certificacion.js"></script>
 	</body>
 </html>
