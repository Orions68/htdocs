<?php
include "inc/fw.php";
$email = $_POST['email'];
?>
<!DOCTYPE html>
<html>

<head>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type">
<link href="styles/mainstyle.css" rel="stylesheet" type="text/css">
<title>Admin Site</title>
</head>

<body>
<div id="header">
<h1>Título del Sitio</h1>
<img src="imgs/DNI-Front.jpg" alt="DNI" id="logo">
</div>
<br>
<br>
<?php
$stmt = $conn->prepare("SET lc_time_names = 'es_ES'");
$stmt->execute();
$stmt = $conn->prepare("SELECT *, DATE_FORMAT(birth,'%d %M %Y') as birth FROM data WHERE email = '" . $email . "'");
$stmt->execute();
while ($row = $stmt->fetch(PDO::FETCH_OBJ))
{
	echo '<form action="xml.php" method="post" target="_blank">';
	echo '<input type="text" name="id" id="bigger" value="' . $row->id . '" style="width:440px;">';
	echo '<br>';
	echo '<input type="text" name="name" id="bigger" value="' . $row->name . '" style="width:440px;">';
	echo '<br>';
	echo '<input type="text" name="email" id="bigger" value="' . $row->email . '" style="width:440px;">';
	echo '<br>';
	echo '<input type="text" name="phone" id="bigger" value="' . $row->phone . '" style="width:440px;">';
	echo '<br>';
	echo '<input type="text" name="user" id="bigger" value="' . $row->user . '" style="width:440px;">';
	echo '<br>';
	echo '<input type="text" name="birth" id="bigger" value="' . $row->birth . '" style="width:440px;">';
	echo '<br>';

	echo '<input type="submit" value="Ver/Descargar Informe en Excel o CSV" id="button">';
	echo '</form>';
}
?>
<br><br>
<p><input name="close" style="width: 300px; height: 50px; font-size:32px;" type="button" value="Cierra esta Ventana" onclick="window.close()"></p>
</body>

</html>