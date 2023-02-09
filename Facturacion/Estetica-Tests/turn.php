<?php
include "includes/conn.php";
$id = $_POST['id'];
$date = $_POST['date'];
$time = $_POST['time'];

$stmt = $conn->prepare("SELECT name FROM clients WHERE id='$id'");
$stmt->execute();
if ($stmt->rowCount() > 0)
{
	$row = $stmt->fetch(PDO::FETCH_OBJ);
	$name = $row->name;
	$stmt = $conn->prepare("UPDATE clients SET date='$date', time='$time' WHERE id='$id'");
	$stmt->execute();
	echo "<script>if (!alert('Cita del Cliente: " . $name . " Registrada.')) window.open('profile.php', '_self')</script>";
}
$title = "Citas - Salón de Estética Joana";
include "includes/header.php";
include "includes/nav_profile.php";

echo "Tu Cita es el día: " . $data . " a las: " . $time . " Hs.";
echo "<br>";
?>
</body>

</html>