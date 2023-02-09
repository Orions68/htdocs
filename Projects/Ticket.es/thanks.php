<?php
include "includes/conn.php"; // Incluyo la conexión con la Base de Datos.
if (isset($_POST["id"])) // Si llegan datos por POST.
{
    $id = $_POST["id"]; // Asigno a la variable $id lo que llegó por $_POST["id"].
    $accept = $_POST["accept"]; // A la variable $accept lo que llegó en $_POST["accept"].
    $who = $_POST["who"]; // A la Variable $who, $_POST["who"], quien aceptó los terminos, Empresa o Espectador.
    if ($who == "comp") // Si $who es comp
    {
        $sql = "UPDATE company SET active=1 WHERE id='$id'"; // Hago la consulta update en la base de datos de la activación de la empresa.
    }
    else // Si mo.
    {
        $sql = "UPDATE clients SET active=1 WHERE id='$id'"; // Hago la consulta update en la base de datos de la activación del espectador.
    }
    if ($accept) // Si se aceptó la politica de Ticket.es.
    {
        $stmt = $conn->prepare($sql); // Preparo la consulta.
        $stmt->execute(); // Ejecuto la consulta.
        if ($stmt->rowCount() > 0) // Si se actualiza el campo.
        {
            if ($who == "comp") // Si vengo de empresa.
            {
                echo "<script>window.open('empresalogin.php', '_self')</script>"; // Abro empresalogin.php.
            }
            else // Si no.
            {
                echo "<script>window.open('login.php', '_self')</script>"; // Abro login.php.
            }
        }
    }
    else // Si no se aceptó la política de Ticket.es.
    {
        echo "<script>window.open('endsession.php', '_self')</script>"; // Redirijo a endsession.php, cierra sesión.
    }
}
?>