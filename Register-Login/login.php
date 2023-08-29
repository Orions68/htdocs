<?php
include "inc/fw.php";
if (isset($_POST["email"]))
{
    $email = $_POST["email"];
    $pass = $_POST["pass"];
    $ok = false;
    
    $stmt = $conn->prepare("SELECT pass, activate FROM user WHERE email='$email'"); // This is Correct.
    $stmt->execute();

    $row = $stmt->fetch(PDO::FETCH_OBJ);
    if ($row->activate == 1)
    {
        if (password_verify($pass, $row->pass)) // Compara la contraseña, encriptandola, con la contraseña encriptada guardada en la base de datos.
        {
            $ok = true; // Si coinciden la contraseña está bien.
        }
        if ($ok)
        {
            echo "<h1 style='color:blue;'>Tus datos son correctos.</h1>";
        }
        else
        {
            echo "<h1 style='color:red;'>Lo Siento, Tus datos NO son correctos.</h1>";
        }
    }
    else
    {
        echo "<h1 style='color:red;'>No has activado tu cuenta aun, revisa tu correo electrónico, te hemos enviado un E-mail, haz click en el botón Quiero Activar mi Cuenta. Gracias.";
    }
}
?>