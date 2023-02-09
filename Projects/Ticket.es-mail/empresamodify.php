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
    $email = htmlspecialchars($_POST["email"]);
    $pass = htmlspecialchars($_POST["pass"]);
    if ($pass != "")
    {
        $hash = password_hash($pass, PASSWORD_DEFAULT);
    }

    $sql = "SELECT id, email FROM company"; // Preparo la consulta de la ID y E-mail de toda la tabla company.

    $stmt = $conn->prepare($sql);
    $stmt->execute();
    while($row = $stmt->fetch(PDO::FETCH_OBJ)) // Mientras reciba datos al asignar a la variable $row el resultado asociado a $stmt.
    {
        if ($id != $row->id)
        {
            if ($row->email == $email) // Si el email enviado por post está en la tabla.
            {
                $ok = false; // $ok es false.
            }
        }
    }
    if ($ok) // Si $ok está a true, no hubo coincidencias.
    {
        $sql = "SELECT email FROM company WHERE id='$id'"; // Preparo la consulta a la ID del cliente.
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_OBJ);
        if ($row->email != $email) // Verifico que el E-mail enviado por post es distinto que el de la tabla.
        {
            if ($pass != "")
            {
                $sql = "UPDATE company SET name='$name', email='$email', pass='$hash' WHERE id='$id';"; // Preparo la consulta modificando todo.
            }
            else
            {
                $sql = "UPDATE company SET name='$name', email='$email' WHERE id='$id';"; // Preparo la consulta modificando todo.
            }
        }
        else // Si el E-mail está repetido, el cliente no cambió su E-mail.
        {
            if ($pass != "")
            {
                $sql = "UPDATE company SET name='$name', pass='$hash' WHERE id='$id';"; // Preparo la consulta modificando solo Nombre y Contraseña.
            }
            else
            {
                $sql = "UPDATE company SET name='$name' WHERE id='$id';"; // Preparo la consulta modificando solo Nombre y Contraseña.
            }
        }

        $stmt = $conn->prepare($sql);
        $stmt->execute();
        if ($stmt->rowCount() > 0)
        {
            echo "<script>toast(0, 'Todo ha ido Bien', 'Se han Modificado tus Datos $name, Vuelve a Iniciar Sesión con tus Nuevos Datos.');</script>";
            // Muestro el aviso que todo ha ido bien.
        }
        else // Si hubo algún error.
        {
            echo "<script>toast(1, 'Algo Ha Fallado', 'No se Han Podido Modificar tus Datos $name.);</script>";
            // Muestro el error de mysql, algo ha fallado
        }
    }
    else
    {
        echo "<script>toast(1, 'Ya Registrado:', 'El E-mail $email ya Está Registrado en Este Sitio. Si no Recuerdas tu Contraseña haz Click en el Enlace Olvidaste tu Contraseña en la Pantalla de Login de Empresa.');</script>"; // Muestro el error, el E-mail ya está registrado.
    }
}
?>
</body>
</html>