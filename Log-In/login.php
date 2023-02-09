<?php
include "inc/fw.php";

$user = $_POST['user'];
$pass = $_POST['pass'];
$inside = false;

$stmt = $conn->prepare("SELECT id, user, pass FROM data");
$stmt->execute();
while($row = $stmt->fetch(PDO::FETCH_OBJ))
{
	if ($row->user == $user && $row->pass == $pass)
	{
		if ($row->id == 1)
		{
			session_destroy();
			$_SESSION['admin'] = $user;
			$inside = true;
		}
		else
		{
			session_destroy();
			$_SESSION['user'] = $user;
			$inside = true;
		}
	}
}
if (!$inside)
{
	echo "<script>if (!alert('Lo Siento, el Nombre de Usuario : " . $user . " No está Registrado, o haz Escrito mal la Contraseña, Por Favor Intentalo de Nuevo.')) window.close()</script>";
}
?>
<!DOCTYPE html>
<html>

<head>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type">
<link href="styles/mainstyle.css" rel="stylesheet" type="text/css">
<title>Log-In</title>
</head>

<body>
<div id="header">
<h1>Título del Sitio</h1>
<img src="imgs/DNI-Front.jpg" alt="DNI" id="logo">
</div>
<br>
<br>
<?php
if (isset($_SESSION['admin']))
{
	echo '<form action="userdata.php" method="post" target="_blank">';
	echo '<input type="text" name="email" id="bigger" placeholder="E-mail del Usuario">';
	echo '<br>';
	echo '<input type="submit" value="Obtener Datos del Usuario" id="bigger" style=" height: 50px;">';
	echo '</form>';
	echo '<br>';
	echo '<p id="bigger">Copia de Respaldo de la Base de Datos.</p>';
	echo '<input type="button" value="Back-UP" onclick="window.open(' . "'db-backup.php', '_blank'" . ')" id="bigger" style=" height: 50px;">';
}
else
{
	echo '<p id="bigger">Bienvenido ' . $user . '</p>';
}
?>
<br><br>
<p><input name="close" style="width: 300px; height: 50px; font-size:32px;" type="button" value="Cierra esta Ventana" onclick="window.close()"></p>
</body>

</html>