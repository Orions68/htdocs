<?php
$date = date("Y-m-d");
$time = "08:25:30";
$today = strtotime($date);
echo strtotime("0:0");
echo "<br>";
echo $today;
echo "<br>";
$now = strtotime($time);
echo $now - $today;
echo '<h4 style="color: black;">No hay resultados en ese rango de edad.</h4>';
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Testing Things</title>
    <link rel="stylesheet" href="css/style.css">
    <script src="javascript/js/script.js"></script>
</head>
<body>
    <div id="clase0">Este es el Primero</div>
    <div id="clase1">Este es el Segundo</div>
    <div id="clase2">Este es el Tercero</div>
    <div id="clase3">Este es el Cuarto</div>
    <div id="clase4">Este es el Quinto</div>
    <div id="clase5">Este es el Sexto</div>
    <div id="clase6">Este es el Septimo</div>
    <div id="clase7">Este es el Ocatvo</div>
    <div id="clase8">Este es el Noveno</div>
    <div id="clase9">Este es el Decimo</div>
    <script>giveStyle();</script>
</body>
</html>