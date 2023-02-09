<?php
include "includes/conn.php";
$activate = $_SERVER["REQUEST_URI"];
$urlArray = explode('/', $activate);
$hash = $urlArray[3];
$email = $urlArray[4];
$who = $urlArray[5];
$name = "";

if ($who)
{
	$name = "clients";
}
else
{
	$name = "company";
}

$stmt = $conn->prepare("SELECT * FROM " . $name . " WHERE email = '$email'");
$stmt->execute();

while ($row = $stmt->fetch(PDO::FETCH_OBJ))
{
	if ($row->hash == $hash)
	{
		$stmt = $conn->prepare("UPDATE " . $name . " SET hash = :hash, active = :active WHERE email = '$email'");
		$stmt->execute(array(':hash' => '', ':active' => 1));
		echo "<script>if (!alert('Gracias por activar tu cuenta.')) window.location = 'http://localhost/Ticket.es-mail/index.php'</script>";
	}
	else
	{
		if ($row->hash == "")
		{
			echo "<script>if (!alert('Tu cuenta ya está activada. Por favor entra con tu nombre de usuario y contraseña y borra el E-mail de confirmación.')) window.location = 'http://localhost/Ticket.es-mail/index.php'</script>";
		}
		else
		{
			echo "<script>if (!alert('Tus claves no coinciden, deberás registrarte denuevo')) window.location = 'http://localhost/Ticket.es-mail/index.php'</script>";
		}
	}
}
?>