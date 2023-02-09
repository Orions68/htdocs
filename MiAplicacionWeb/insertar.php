<?php
// Conecta con la BD
    include 'includes/conexion.php';

// sql para insertar un registro
 $sql = "INSERT INTO usuario VALUES (null, 'Candy', '1234', 'candy@gmail.com');";
 
if (mysqli_query($conexion, $sql)) {
  echo "Usuario insertado con éxtito";
} else {
  echo "Error insertando usuario: " . mysqli_error($conexion);
}

//cierra la conexión con la BD
mysqli_close($conexion);
?>
