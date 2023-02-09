<?php
include "inc/fw.php";
include "inc/modal-dismiss.html";
$title = "Eliminando un Cliente";
include "inc/header.php";
if (isset($_POST["client"]))
{
    $id = $_POST["client"];
    $sql = "DELETE FROM delivery WHERE id=$id";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    echo "<script>toast ('0', 'Cliente Eliminado de la Base de Datos', 'El Cliente ha Sido Quitado de la Base de Datos.');</script>";
}
?>