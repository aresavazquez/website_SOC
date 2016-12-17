
<?php 
$message = '';

/* A message le agregamos 
* lo que viene en la variable certification 
* y un espacio para que no salga todo encimado
*/
$message .= $_POST['certification'] . ' '; 
$message .= $_POST['office'] . ' '; 
$message .= $_POST['boss'] . ' '; 
$message .= $_POST['city'] . ' '; 
$message .= $_POST['certificationBoss'] . ' '; 
$message .= $_POST['brokerCertification'] . ' '; 
$message .= $_POST['position'] . ' '; 
$message .= $_POST['image'] . ' ';
$message .= $_POST['mail'] . ' '; 
$message .= $_POST['fon'] . ' ';

/*
Así con todas las variables
.
.
.
*/
mail("certificacionsoc@gmail.com", 'Datos Certificación Oficina', $message);

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
