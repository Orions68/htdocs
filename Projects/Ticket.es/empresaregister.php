<?php
include "includes/conn.php";
$title = "Página de Registro de Empresas de Ticket.es";
include "includes/header.php";
include "includes/modal.html";

if (isset($_POST["empresa"]))
{
    $already = false;
    $name = htmlspecialchars($_POST["empresa"]);
    $email = htmlspecialchars($_POST["email"]);
    $pass = htmlspecialchars($_POST["pass"]);
    $hash = password_hash($pass, PASSWORD_DEFAULT);

    $stmt = $conn->prepare("SELECT email FROM company");
    $stmt->execute();
    while($row = $stmt->fetch(PDO::FETCH_OBJ))
    {
        if ($email == $row->email)
        {
            $already = true;
            break;
        }
    }

    if (!$already)
    {
        $stmt = $conn->prepare("INSERT INTO company VALUES (:id, :name, :email, :pass, :active);");

        $stmt->execute(array(':id' => null, ':name' => $name, ':email' => $email, ':pass' => $hash, ':active' => 0));
        $id = $conn->lastInsertId(); // Asigno a la variable $id la última id guardada en la tabla.
        if (!is_dir("companies/emp-" . $id)) // Si no existe el directorio con el nombre emp- y el número de la id en la carpeta companies.
        {
            mkdir("companies/emp-" . $id, 0777, true); // Lo creo.
        }
        $conn = null;
        echo "<script>toast(0, 'Empresa Agregada', 'La Empresa $name se ha Agregado, ya Puedes Publicar tus Eventos Online.');</script>";
    }
    else
    {
        $conn = null;
        echo "<script>toast(1, 'Ya Registrada', 'Esa Empresa ya Está Registrada, Puedes Publicar online, Si Tienes Dudas Verifica el E-mail.');</script>";
    }
}
?>