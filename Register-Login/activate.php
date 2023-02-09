<?php
include_once "inc/fw.php";
$activate = $_SERVER["REQUEST_URI"];
$urlArray = explode('/', $activate);
$hash = $urlArray[3];
$email = $urlArray[4];

$stmt = $conn->prepare("SELECT * FROM users WHERE email ='" . $email . "'");
$stmt->execute();

while ($row = $stmt->fetch(PDO::FETCH_OBJ))
{
	if ($row->hash == $hash)
	{		
		$stmt = $conn->prepare("UPDATE users SET hash = :hash, activate = :activate WHERE email ='" . $email . "'");
		$stmt->execute(array(':hash' => '', ':activate' => 1));
		
		$_SESSION['user'] = $email;
		$_SESSION['id'] = $row->id;
		echo '<script>if (!alert("Gracias por activar tu cuenta. Por favor entra con tu E-mail y contraseña.")) window.close()</script>';
	}
	else
	{
		if ($row->hash == "")
		{
			echo '<script>if (!alert("Tu cuenta ya está activada. Por favor entra con tu E-mail y contraseña, puedes borrar el mensaje de confirmación.")) window.close()</script>';
		}
		else
		{
			echo '<script>if (!alert("Tus claves no coinciden, deberás registrarte denuevo")) window.close()</script>';
		}
	}
}
?>