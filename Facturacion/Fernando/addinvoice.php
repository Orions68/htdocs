<?php
include "includes/conn.php";
if (isset($_POST["hand"]))
{
    $total = 0;
    $client = $_POST["client"];
    if ($client == "")
    {
        $client = "Consumidor Final";
    }
    $job = $_POST["job"];
    $material = $_POST["material"];
    $price = $_POST["price"];
    $hand = $_POST["hand"];
    $total = $_POST["total"];
    $totaligic = $_POST["totaligic"];
    $date = $_POST["date"];
    $time = $_POST["time"];
    $sql = "INSERT INTO invoice VALUES(:id, :client, :job, :replacements, :prices, :hand, :total, :totaligic, :date, :time)";
    $stmt = $conn->prepare($sql);
    $stmt->execute(array(':id' => null, ':client' => $client, ':job' => $job, ':replacements' => $material, ':prices' => $price, ':hand' => $hand, ':total' => $total, ':totaligic' => $totaligic, ':date' => $date, ':time' => $time));
    echo "<script>if (!alert('Factura de Monto " . $totaligic . " Agregada a la Base de Datos.')) window.open('index.php', '_self');</script>";
}
?>