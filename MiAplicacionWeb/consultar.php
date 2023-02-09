<?php
// Conecta con la BD
    include 'includes/conexion.php';

// sql para consultar una tabla
//  $sql = "SELECT id, nombre, apellido FROM cliente where nombre like 'a%' ";
  $resultado = mysqli_query($conexion, $sql);  

if (mysqli_num_rows($resultado) > 0) {
  // Salida de datos para cada fila
  while($row = mysqli_fetch_assoc($resultado)) {
    echo "id: " . $row["id"]. " - Nombre: " . $row["nombre"]. " " . $row["apellido"]. "<br>";
  }
} else {
  echo "Sin resultados";
}

//cierra la conexión con la BD
mysqli_close($conexion);
?>


