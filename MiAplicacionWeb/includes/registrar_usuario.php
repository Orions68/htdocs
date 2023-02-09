<?php
session_start();
 
if(isset($_POST["registrar"])){    // esperando al botón
    $u=htmlspecialchars($_POST["usuario"]);
    $c=htmlspecialchars($_POST["clave"]);
    $n=htmlspecialchars($_POST["nombre"]);
    $a=htmlspecialchars($_POST["apellidos"]);
    $e=htmlspecialchars($_POST["email"]);

       // Conecta con la BD
    include 'conexion.php';

    // sql para insertar un registro
        $sql = "INSERT INTO usuarios VALUES ( null, '$u', '$c', '$n', '$a', '$e')";
        echo $sql;

        if (mysqli_query($conexion, $sql)) {
            header('Location:../login.php');
        } else {
        echo "Error inténtelo más tarde: " . mysqli_error($conexion);
        header('Location:../index.php');
        session_destroy();

        }

        //cierra la conexión con la BD
        mysqli_close($conexion);

    
}

?>

