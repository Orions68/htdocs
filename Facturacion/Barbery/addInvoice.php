<?php
include "includes/conn.php";
$title = "Guardando la Factura";
include "includes/header.php";
include "includes/modal-invoice.html";

setlocale(LC_TIME, 'es_ES.UTF-8');
date_default_timezone_set("America/Argentina/Buenos_Aires");
$invoice = $_POST['invoice'];
$name = $_POST["client"];
$date = date("Y-m-d");
$time = date("H:i:s");
$total = 0;
$iva = [];
$service = "";
$qtty1 = "";
$iva1 = 0;
$total = 0;
$j = 0;
$record = explode (",", $invoice);
for ($i = 0; $i < count($record) - 3; $i+=4)
{
    $iva[$j] = $record[$i + 3] * $record[$i + 2] * .21;
    $total += $record[$i + 3] * $record[$i + 2] + $iva[$j];
    $service .= $record[$i] . ",";
    $iva1 += $iva[$j];
    $qtty1 .= $record[$i + 3] . ",";
    $j++;
}
$stmt = $conn->prepare('INSERT INTO invoice VALUES(:id, :client_id, :service_id, :qtty, :total, :iva, :date, :time)');
if (isset($_SESSION["client"]))
{
    $stmt->execute(array(':id' => null, ':client_id' => $_SESSION["client"], ':service_id' => $service, ':qtty' => $qtty1, ':total' => $total, ':iva' => $iva1, ':date' => $date, ':time' => $time));
}
else
{
    $stmt->execute(array(':id' => null, ':client_id' => null, ':service_id' => $service, ':qtty' => $qtty1, ':total' => $total, ':iva' => $iva1, ':date' => $date, ':time' => $time));
}
echo "<script>toast('0', 'Factura de Monto: " . $total . "', 'Almacenada Correctamente en la base de datos.');</script>";
include "includes/footer.html";
?>