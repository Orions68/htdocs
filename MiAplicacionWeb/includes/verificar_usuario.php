<?php   
session_start();

if(isset($_POST["login"])){

    $u=htmlspecialchars($_POST["usuario"]);
    $c=htmlspecialchars($_POST["clave"]);

    // Conecta con la BD
    include 'conexion.php';

    // sql para consultar una tabla (según tu BD)
      $sql = "SELECT nick, pass FROM usuarios where nick='$u' and pass='$c' ";
      $resultado = mysqli_query($conexion, $sql);  
    
    if (mysqli_num_rows($resultado) > 0) {
      // Salida de datos para cada fila
      $_SESSION["usuario"]=$u;
      $_SESSION["password"]=$c;
      echo "<br><h1>Bienvenido: $u</h1>";
      header('Location:../logeado.php');
    } else {
        echo "<br><h1>Usuario o contraseña incorrecta</h1>";
        header('Location:../index.php');  
        session_destroy();
    } 
    
    mysqli_close($conexion);
 
 }

?>