<?php
include "includes/conn.php";
$title = "Guardando la Factura";
include "includes/header.php";
?>

<?php
for ($i = 0; $i < (count($_POST) - 4) / 3; $i++)
{
    $id[$i] = $_POST["id" . $i];
    // $price[$i] = $_POST["price" . $i];
    $qtty[$i] = $_POST["qtty" . $i];
    // $parcial[$i] = $price[$i] * $qtty[$i];
    $igic[$i] = $_POST["igic" . $i];
}
$name = $_POST['username'];
$total = $_POST["total"];
$date = $_POST['date'];
$time = $_POST['time'];
$igic1 = 0;
$service = "";
$qtty1 = "";
for ($i = 0; $i < count($id); $i++)
{
    $service .= $id[$i] . ",";
    $qtty1 .= $qtty[$i] . ",";
    $igic1 += $igic[$i];
}
$stmt = $conn->prepare('INSERT INTO invoice VALUES(:id, :client_id, :service_id, :qtty, :total, :igic, :date, :time)');
if (isset($_SESSION["client"]))
{
    $stmt->execute(array(':id' => null, ':client_id' => $_SESSION["client"], ':service_id' => $service, ':qtty' => $qtty1, ':total' => $total, ':igic' => $igic1, ':date' => $date, ':time' => $time));
}
else
{
    $stmt->execute(array(':id' => null, ':client_id' => null, 'service_id' => $service, ':qtty' => $qtty1, ':total' => $total, ':igic' => $igic1, ':date' => $date, ':time' => $time));
}
echo "<script>if (!alert('Factura de Monto: " . $total . " Agregada Correctamente.')) window.close()</script>";
?>
</body>

</html>