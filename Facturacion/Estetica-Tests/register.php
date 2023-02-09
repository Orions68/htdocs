<?php
include "includes/conn.php";
$title = "Página de Registro de Clientes del Salón de Estética de Joana";
include "includes/header.php";
include "includes/modal_index.html";
?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script> <!-- Script de Bootstrap. -->
<script src="js/script.js"></script>
<?php
if (isset($_POST["username"])) // Si se reciben los datos por POST.
{
    $already = false; // Uso esta variable para comprobar que no se repita ni el E-mail ni el Teléfono.
    $name = htmlspecialchars($_POST["username"]);
    $address = htmlspecialchars($_POST["address"]);
    $phone = htmlspecialchars($_POST["phone"]);
    $email = htmlspecialchars($_POST["email"]);
    $pass = htmlspecialchars($_POST["pass"]);
    $bday = htmlspecialchars($_POST["bday"]);
    $date = "";
    $time = "";
    $hash = password_hash($pass, PASSWORD_DEFAULT);
    $stmt = $conn->prepare("SELECT phone, email FROM clients"); // Busco los E-mail y Teléfonos
    $stmt->execute();
    while($row = $stmt->fetch(PDO::FETCH_OBJ))
    {
        if ($phone == $row->phone || $email == $row->email) // Si está cuaquiera de los tres.
        {
            $already = true; // Pongo $already a true.
            break; // Salgo de la busqueda.
        }
    }

    if (!$already) // Si no están en la base de datos ni E-mail ni Teléfono.
    {
        $stmt = $conn->prepare("INSERT INTO clients VALUES (:id, :name, :address, :phone, :email, :pass, :bday, :date, :time);");

        $stmt->execute(array(':id' => null, ':name' => $name, ':address' => $address, ':phone' => $phone, ':email' => $email, ':pass' => $hash, ':bday' => $bday, ':date' => $date, ':time' => $time));

        $conn = null;
        echo "<script>toast(0, 'Cliente Agregado', 'Te damos la Bienvenida $name, Gracias por Registarte como Cliente en el Salón de Estética de Joana.');</script>";
        // Inserto los datos y aviso.
    }
    else // Si hay alguna repetido.
    {
        $conn = null;
        echo "<script>toast(1, 'Ya Registrado', 'Alguno de tus Datos de Cliente ya Están Registrados, si Tienes Cualquier Duda con tu Cuenta no Dudes en Contactarnos.');</script>";
        // El Alumno ya está registrado.
    }
}
?>