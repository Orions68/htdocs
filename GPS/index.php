<?php
if (json_decode(file_get_contents('php://input'), true))
{
	$_POST = json_decode(file_get_contents('php://input'), true);
}
if (isset($_POST["id"]))
{
	$id = $_POST["id"];
	$lat = $_POST["lat"];
	$lon = $_POST["lon"];
	$name = $id . ".txt";
	if (!file_exists($name))
	{
		$file = fopen($name, "w") or die("Unable to open file!");
		fwrite($file, $id);
		fwrite($file, ";");
		fwrite($file, $lat);
		fwrite($file, ":");
		fwrite($file, $lon);
	}
	else
	{
		$file = fopen($name, "a") or die("Unable to open file!");
		fwrite($file, ":");
		fwrite($file, $lat);
		fwrite($file, ":");
		fwrite($file, $lon);
	}
	fclose($file);
	$response["error"] = false;
	echo json_encode($response);
	exit();
}
$n = 0;
$files = glob('*.txt');
while ($n < count($files))
{
	$name = $files[$n];
	$file = fopen($name, "r") or die("Unable to open file!");
	$invoice = fread($file, filesize($name));
	$array[$n] = explode(";", $invoice);
	fclose($file);
	echo '<form name="data' . $n . '" method="post" action="client.php?id=' . $array[$n][0] . '" target="' . $array[$n][0] . '">';
	echo '<input type="hidden" name="invoice" value="' . $array[$n][1] . '">';
	echo '</form>';
	echo '<script type="text/javascript">document.forms["data' . $n . '"].submit();</script>';
	$n++;
}
?>
<!DOCTYPE html>
<html>
<head>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type">
<meta http-equiv="refresh" content="20" >
<link href="styles/style.css" rel="stylesheet" type="text/css">
<title>Esperando Datos</title>
</head>
<body>
<?php
if ($n == 0)
{
	echo '<h1 class="color">Esperando Datos</h1>';
}
else
{
	echo '<h1 class="badColor">Facturando...</h1>';
}
?>
<button onclick="window.open('index.html')" style="width:250px; height:128px">Abrir Sistema de Facturación</button>
</body>
</html>