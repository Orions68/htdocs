<?php
include "includes/conn.php";
$title = "Guardando la Factura";
include "includes/header.php";
?>

<?php
$name = $_POST['username'];
for ($i = 0; $i < (count($_POST) - 4) / 3; $i++)
{
    $id[$i] = $_POST["id" . $i];
    $price[$i] = $_POST["price" . $i];
    $qtty[$i] = $_POST["qtty" . $i];
    $parcial[$i] = $price[$i] * $qtty[$i];
}
$total = $_POST["total"];
$igic = $_POST["igic"];
$date = $_POST['date'];
$time = $_POST['time'];
$stmt = $conn->prepare('INSERT INTO invoice VALUES(:id, :client_id, :service_id, :qtty, :total, :igic, :date, :time)');
if (isset($_SESSION["client"]))
{
    for ($i = 0; $i < count($id); $i++)
    {
        $stmt->execute(array(':id' => null, ':client_id' => $_SESSION["client"], ':service_id' => $id[$i], ':qtty' => $qtty[$i], ':total' => $parcial[$i], ':igic' => $igic, ':date' => $date, ':time' => $time));
    }
}
else
{
    for ($i = 0; $i < count($id); $i++)
    {
        $stmt->execute(array(':id' => null, ':client_id' => null, 'service_id' => $id[$i], ':qtty' => $qtty[$i], ':total' => $parcial[$i], ':igic' => $igic, ':date' => $date, ':time' => $time));
    }
}
echo "<script>if (!alert('Factura de Monto: " . $total. " Agregada Correctamente.')) window.close()</script>";
?>
</body>

</html>