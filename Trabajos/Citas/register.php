<?php
include "includes/conn.php";
if (isset($_POST["client"]))
{
    $name = $_POST["client"];
    $phone = $_POST["phone"];
    $email = $_POST["email"];
    $obs = $_POST["obs"];
    $sql = "SELECT phone FROM clients WHERE phone='$phone'";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    if ($stmt->RowCount() > 0)
    {
        echo "<script>if (!alert('Error El Teléfono: " . $phone . " ya Está Registrado.')) window.close('_self');</script>";
    }
    else
    {
        $sql = "SELECT email FROM clients WHERE email='$email'";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        if ($stmt->RowCount() > 0)
        {
            echo "<script>if (!alert('Error El E-mail: " . $email . " ya Está Registrado.')) window.close('_self');</script>";
        }
        else
        {
            $sql = "INSERT INTO clients VALUES (:id, :name, :phone, :email, :obs)";
            $stmt = $conn->prepare($sql);
            $stmt->execute(array(':id' => null, ':name' => $name, ':phone' => $phone, ':email' => $email, ':obs' => $obs));
            echo '<script>if (!alert("Paciente ' . $name . ' Ha Ingresado al Sistema Correctamente.")) window.close("_self");</script>';
        }
    }
}
?>