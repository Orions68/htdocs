<?php
include "includes/conn.php";
$title = "Página de Registro de Ticket.es";
include "includes/header.php";
include "includes/modal.html";
?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script> <!-- Script de Bootstrap. -->
<script src="js/script2.js"></script>
<?php
if (isset($_POST["username"]))
{
    $already = false;
    $name = htmlspecialchars($_POST["username"]);
    $phone = htmlspecialchars($_POST["phone"]);
    $email = htmlspecialchars($_POST["email"]);
    $pass = htmlspecialchars($_POST["pass"]);
    $hash = password_hash($pass, PASSWORD_DEFAULT);
    $bday = $_POST["bday"];
    $gender = $_POST["gender"];
    $path = "";
    $img = htmlspecialchars($_FILES["profile"]["name"]);
    $tmp = htmlspecialchars($_FILES["profile"]["tmp_name"]);

    $stmt = $conn->prepare("SELECT email, phone FROM clients");
    $stmt->execute();
    while($row = $stmt->fetch(PDO::FETCH_OBJ))
    {
        if ($email == $row->email || $phone == $row->phone)
        {
            $already = true;
            break;
        }
    }

    if (!$already)
    {
        $stmt = $conn->prepare("INSERT INTO clients VALUES (:id, :name, :phone, :email, :pass, :bday, :gender, :path, :active);");

        $stmt->execute(array(':id' => null, ':name' => $name, ':phone' => $phone, ':email' => $email, ':pass' => $hash, ':bday' => $bday, ':gender' => $gender, ':path' => $path, ':active' => 0));

        $id = $conn->lastInsertId(); // Asigno a la variable $id la última id guardada en la tabla.
        
        if ($img != "")
        {
            if (!is_dir("clients/" . $id)) // Si no existe el directorio con el nombre de la id.
            {
                mkdir("clients/" . $id, 0777, true); // Lo creo.
            }
            $path = "clients/" . $id . "/" . basename($img);
            move_uploaded_file($tmp, $path);
        }
        else
        {
            if ($gender == 0)
            {
                $path = "img/female.jpg";
            }
            else
            {
                $path = "img/male.jpg";
            }
        }
        $stmt = $conn->prepare("UPDATE clients SET path='$path' WHERE id='$id';"); // Preparo una consulta para Actualizar la tabla.
        $stmt->execute(); // La Ejecuto.

        $conn = null;
        echo "<script>toast(0, 'Espectador Agregado', 'El Espectador $name se ha Agregado, ya Puedes Comprar tus Entradas Online.');</script>";
    }
    else
    {
        $conn = null;
        echo "<script>toast(1, 'Ya Registrado', 'Los Datos de Espectador ya Están Registrados, Puedes Comprar Online, Verifica el Número de Teléfono y el E-mail.');</script>";
    }
}
?>