<?php
include_once "inc/fw.php";
$activate = $_SERVER["REQUEST_URI"];
$urlArray = explode('/', $activate);
$hash = $urlArray[3];
$user = $urlArray[4];

echo $user;

$stmt = $conn->prepare("SELECT * FROM data WHERE user ='" . $user . "'");
$stmt->execute();

while ($row = $stmt->fetch(PDO::FETCH_OBJ))
{
	if ($row->hash == $hash)
	{		
		$stmt = $conn->prepare("UPDATE data SET hash = :hash, active = :active WHERE user ='" . $user . "'");
		$stmt->execute(array(':hash' => '', ':active' => 1));
		
		$_SESSION['user'] = $user;
		$_SESSION['id'] = $row->id;
		echo '<script>if (!alert("Gracias por activar tu cuenta. Por favor entra con tu nombre de usuario y contraseña.")) window.close()</script>';
	}
	else
	{
		if ($row->hash == "")
		{
			echo '<script>if (!alert("Tu cuenta ya está activada. Por favor entra con tu nombre de usuario y contraseña y borra el E-mail de confirmación.")) window.close()</script>';
		}
		else
		{
			echo '<script>if (!alert("Tus claves no coinciden, deberás registrarte denuevo")) window.close()</script>';
		}
	}
}
?>