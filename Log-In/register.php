<?php
include "inc/fw.php";
$repited = false;
if (isset($_POST['user']))
{
	$name = $_POST['name'];
	$email = $_POST['email'];
	$phone = $_POST['phone'];
	$user = $_POST['user'];
	$pass = $_POST['pass'];
	$birth = $_POST['birth'];
	$hash = substr(md5(uniqid($user, true)), 16, 16);
	
	$stmt = $conn->prepare('SELECT user FROM data');
	$stmt->execute();
	while($row = $stmt->fetch(PDO::FETCH_OBJ))
	{
		if ($user == $row->user)
		{
			echo "<script>if (!alert('Lo Siento, el Nombre de Usuario : " . $user . " Está Siendo Usado, Por Favor Elige Otro.')) window.close()</script>";
			$repited = true;
		}
	}
	if (!$repited)
	{
		$stmt = $conn->prepare('INSERT INTO data VALUES(:id, :name, :email, :phone, :user, :pass, :birth, :hash, :active)');
		$stmt->execute(array(':id' => null, ':name' => $name, ':email' => $email, ':phone' => $phone, ':user' => $user, ':pass' => $pass, ':birth' => $birth, ':hash' => $hash, ':active' => 0));
		
		$subject = "DO NOT REPLAY";
		$message = "<h3>Gracias por registrarte. </h3><p>Por favor haz click en el botón Activar mi cuenta.</p><a href='http://" . $_SERVER['SERVER_NAME'] . "/log-in/activate.php/" . $hash . "/" . $user . "'><div style='background-color:aquamarine; border:thin; width:120px; height:30px; text-align:center;'>Activar mi cuenta</div></a><br /><br /><small>Copyright © 2021 César Matelat <a href='mailto:matelat@gmail.com'>matelat@gmail.com</a></small>";
		$server_email = "matelat@gmail.com";
		$headers  = "From: $server_email" . "\r\n";
		$headers .= "X-Mailer: PHP/" . phpversion(). "\r\n";
		$headers .= 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/html; charset=UTF-8' . "\r\n";
		if(mail($email, $subject, $message, $headers))
		{
			echo 'Se ha Enviado un Mensaje a tu Dirección de E-mail. Verificalo, si no Aparece en la Bandeja de Entrada, mira en Correo no Deseado.';
			
			$stmt = $conn->prepare("SELECT id FROM data WHERE user = '" . $user . "'");
			$stmt->execute();
			while($row = $stmt->fetch(PDO::FETCH_OBJ))
			{
				chdir ("users");
				mkdir($row->id . "/pic", 0777, true);
			}
		}
		else
		{
			echo "Error al enviar el mensaje si vuelves a intentarlo y vuelve a dar error, por favor escribe a matelat@gmail.com";
		}
		
		echo "<script>if (!alert('Usuario : " . $user . " Agregado Correctamente.')) window.close()</script>";
	}
}
?>
<!DOCTYPE html>
<html>

<head>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type">
<script src="inc/functions.js"></script>
<link href="styles/mainstyle.css" rel="stylesheet" type="text/css">
<title>Funcion y XML</title>
</head>

<body>
<div id="header">
<h1>Título del Sitio</h1>
<img src="imgs/DNI-Front.jpg" alt="DNI" id="logo">
</div>
<?php
if (isset($_POST['user']) && $repited)
{
?>
	<form method="post">
	<input type="text" name="name" placeholder="Nombre Completo" value="<?php echo $name ?>">
	<br><br>
	<input type="text" name="email" placeholder="E-mail" value="<?php echo $email ?>">
	<br><br>
	<input type="text" name="phone" placeholder="Teléfono" value="<?php echo $phone ?>">
	<br><br>
	<input type="text" name="user" placeholder="Nombre de Usuario">
	<br><br>
	<input type="password" name="pass" placeholder="Contraseña" value="<?php echo $pass ?>">
	<br><br>
	<input type="password" name="pass2" placeholder="Repite Contraseña" value="<?php echo $pass ?>">
	<br><br>
	<input type="date" name="birth" placeholder="Fecha de Nacimineto" value="<?php echo $birth ?>">
	<br><br>
	<input type="submit" class="button" value="Envía Datos" onclick="return verify(this.form)">
	</form>
<?php
}
else
{
?>
	<form method="post">
	<input type="text" name="name" placeholder="Nombre Completo">
	<br><br>
	<input type="text" name="email" placeholder="E-mail">
	<br><br>
	<input type="text" name="phone" placeholder="Teléfono">
	<br><br>
	<input type="text" name="user" placeholder="Nombre de Usuario">
	<br><br>
	<input type="password" name="pass" placeholder="Contraseña">
	<br><br>
	<input type="password" name="pass2" placeholder="Repite Contraseña">
	<br><br>
	<input type="date" name="birth" placeholder="Fecha de Nacimineto">
	<br><br>
	<input type="submit" class="button" value="Envía Datos" onclick="return verify(this.form)">
	</form>
<?php
}
?>
<br><br>
<p><input name="close" style="width: 300px; height: 50px; font-size:32px;" type="button" value="Cierra esta Ventana" onclick="window.close()"></p>
</body>

</html>