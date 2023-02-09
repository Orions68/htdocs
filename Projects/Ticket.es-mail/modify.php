<?php
include "includes/conn.php";
$title = "Ticket.es - Modificando los datos del Espectador";
include "includes/header.php";
include "includes/modal.html";
?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
<script src="js/script2.js"></script>
<?php
if (isset($_POST["username"])) // Si llegan datos por post.
{
    $ok = true; // Uso la variable $ok para verificar que no se repita el DNI ni el E-mail.
    $id = $_SESSION["id"]; // Asigno a la variable $id el valor de la sesión id.
    $name = htmlspecialchars($_POST["username"]); // Asigno a variables lo recibido por post.
    $phone = htmlspecialchars($_POST["phone"]);
    $email = htmlspecialchars($_POST["email"]);
    $pass = htmlspecialchars($_POST["pass"]);
    if ($pass != "")
    {
        $hash = password_hash($pass, PASSWORD_DEFAULT);
    }
    $bday = $_POST["bday"];
    $gender = $_POST["gender"];
    $path = htmlspecialchars($_POST["path"]);
    if (!is_dir("clients/" . $id)) // Verifico si no existe la carpeta.
    {
        mkdir("clients/" . $id, 0777, true); // Si no existe la creo.
    }

    if ($_FILES["profile"]["name"] != "")
    {
        $path = "clients/" . $id . "/" . basename($_FILES['profile']['name']); // Asigno a la variable $path la ruta con la ID/Nombre de la foto.
        move_uploaded_file($_FILES['profile']['tmp_name'], $path); // Muevo el archivo a la ruta $path.
    }

    $sql = "SELECT id, email, phone FROM clients"; // Preparo la consulta de la ID, Teléfono y E-mail de toda la tabla clients.
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    while($row = $stmt->fetch(PDO::FETCH_OBJ)) // Mientras reciba datos al asignar a la variable $row el resultado asociado a $stmt.
    {
        if ($id != $row->id)
        {
            if ($row->email == $email || $row->phone == $phone) // Si el email o el teléfono enviados por post están en la tabla.
            {
                $ok = false; // $ok es false.
            }
        }
    }
    if ($ok) // Si $ok está a true, no hubo coincidencias.
    {
        $sql = "SELECT phone, email FROM clients WHERE id='$id'"; // Preparo la consulta a la ID del cliente.
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_OBJ); // Asigno el resultado a la variable $row.
        if ($row->email != $email) // Verifico que el E-mail enviado por post es distinto que el de la tabla.
        {
            if ($row->phone != $phone)
            {
                if ($pass != "")
                {
                    $sql = "UPDATE clients SET name='$name', phone='$phone', email='$email', pass='$hash', bday='$bday', gender='$gender', path='$path' WHERE id='$id';"; // Preparo la consulta modificando todo.
                }
                else
                {
                    $sql = "UPDATE clients SET name='$name', phone='$phone', email='$email', bday='$bday', gender='$gender', path='$path' WHERE id='$id';"; // Preparo la consulta modificando todo.
                }
            }
            else
            {
                if ($pass != "")
                {
                    $sql = "UPDATE clients SET name='$name', email='$email', pass='$hash', bday='$bday', gender='$gender', path='$path' WHERE id='$id';"; // Preparo la consulta modificando todo.
                }
                else
                {
                    $sql = "UPDATE clients SET name='$name', email='$email', bday='$bday', gender='$gender', path='$path' WHERE id='$id';"; // Preparo la consulta modificando todo.
                }
            }
        }
        else // Si el E-mail está repetido, el cliente no cambió su E-mail.
        {
            if ($row->phone != $phone)
            {
                if ($pass != "")
                {
                    $sql = "UPDATE clients SET name='$name', phone='$phone', pass='$hash', bday='$bday', gender='$gender', path='$path' WHERE id='$id';"; // Preparo la consulta modificando todo.
                }
                else
                {
                    $sql = "UPDATE clients SET name='$name', phone='$phone', bday='$bday', gender='$gender', path='$path' WHERE id='$id';"; // Preparo la consulta modificando todo.
                }
            }
            else
            {
                if ($pass != "")
                {
                    $sql = "UPDATE clients SET name='$name', pass='$hash', bday='$bday', gender='$gender', path='$path' WHERE id='$id';"; // Preparo la consulta modificando todo menos los datos repetidos.
                }
                else
                {
                    $sql = "UPDATE clients SET name='$name', bday='$bday', gender='$gender', path='$path' WHERE id='$id';"; // Preparo la consulta modificando todo menos los datos repetidos.
                }
            }
        }

        $stmt = $conn->prepare($sql);
        $stmt->execute();
        if ($stmt->rowCount() > 0) // Ejecuto la consulta y compruebo si se modifico el campo.
        {
            echo "<script>toast(0, 'Todo ha ido Bien', 'Se han Modificado tus Datos $name, Vuelve a Iniciar Sesión con tus Nuevos Datos.');</script>";
            // Muestro el aviso que todo ha ido bien.
        }
        else // Si hubo algún error.
        {
            echo "<script>toast(1, 'Algo Ha Fallado', 'No se Han Podido Modificar tus Datos $name.');</script>";
            // Muestro el error de mysql, algo ha fallado
        }
    }
    else
    {
        echo "<script>toast(1, 'Ya Registrado:', 'El E-mail $email o el Teléfono $phone, ya Están Registrados en Este Sitio. Si no Recuerdas tu Contraseña haz Click en el Enlace Olvidaste tu Contraseña en la Pantalla de Login de Espectador.');</script>"; // Muestro el error, el E-mail ya está registrado.
    }
}
?>
</body>
</html>