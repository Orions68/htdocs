<?php
include "includes/conn.php";
$title = "Agregando Servicio";
include "includes/header.php";
?>
<?php
$service = $_POST['service'];
$price = $_POST['price'];
$path = htmlspecialchars($_FILES["img"]["name"]);
$tmp = htmlspecialchars($_FILES["img"]["tmp_name"]);
$img = "img/" . basename($path);
move_uploaded_file($tmp, $img);
$stmt = $conn->prepare('INSERT INTO services VALUES(:id, :service, :price, :img)');
$stmt->execute(array(':id' => null, ':service' => $service, ':price' => $price, ':img' => $img));
echo "<script>if (!alert('Servicio : " . $service. " Agregado Correctamente.')) window.open('admin.php', '_self')</script>";
?>
</body>

</html>