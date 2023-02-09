<?php
// Conecta con la BD
    include 'includes/conexion.php';

// sql para insertar un registro
$sql = "UPDATE `usuario` SET `apellido`='González' WHERE `id`=2;";

if (mysqli_query($conexion, $sql)) {
  echo "Datos actualizados";
} else {
  echo "Error actualizando datos: " . mysqli_error($conexion);
}

//cierra la conexión con la BD
mysqli_close($conexion);
?>
