<?php
include "includes/conn.php";
$title = "Página de Registro de Empresas de Ticket.es";
include "includes/header.php";
include "includes/modal.html";
?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script> <!-- Script de Bootstrap. -->
<script src="js/script2.js"></script>
<?php
if (isset($_POST["empresa"]))
{
    $already = false;
    $name = htmlspecialchars($_POST["empresa"]);
    $email = htmlspecialchars($_POST["email"]);
    $pass = htmlspecialchars($_POST["pass"]);
    $hash = password_hash($pass, PASSWORD_DEFAULT);
    $hash1 = hash("crc32", $email, false);
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
        $stmt = $conn->prepare("INSERT INTO company VALUES (:id, :name, :email, :pass, :hash, :active);");

        $stmt->execute(array(':id' => null, ':name' => $name, ':email' => $email, ':pass' => $hash, ':hash' => $hash1, ':active' => 0));
        $id = $conn->lastInsertId(); // Asigno a la variable $id la última id guardada en la tabla.
        if (!is_dir("companies/emp-" . $id)) // Si no existe el directorio con el nombre emp- y el número de la id en la carpeta companies.
        {
            mkdir("companies/emp-" . $id, 0777, true); // Lo creo.
        }
        $conn = null;
        $subject = "DO NOT REPLAY";
		$message = "<h3>Gracias por registrarte en Ticket.es. </h3><p>Por favor haz click en el botón Activar mi cuenta.</p><a href='http://" . $_SERVER['SERVER_NAME'] . "/Ticket.es-mail/activate.php/" . $hash1 . "/" . $email . "/" . 0 . "'><div style='background-color:aquamarine; border:thin; width:120px; height:50px; text-align:center;'>Activar mi cuenta</div></a><br /><br /><small>Copyright © 2022 César Matelat <a href='mailto:info.ticket.es@gmail.com'>info.ticket.es@gmail.com</a></small>";
		$server_email = "info.ticket.es@gmail.com";
		$headers  = "From: $server_email" . "\r\n";
		$headers .= "X-Mailer: PHP/" . phpversion() . "\r\n";
		$headers .= 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/html; charset=UTF-8' . "\r\n";
		if(mail($email, $subject, $message, $headers))
		{
			echo "<script>toast(0, 'Empresa Agregada', 'Se ha Enviado un Mensaje a tu Dirección de E-mail. Por Favor Verificalo, si no Aparece en la Bandeja de Entrada, mira en Correo no Deseado.')</script>";
		}
		else
		{
			echo "<script>toast(2, 'Error de Envío', 'Error al enviar el mensaje si vuelves a intentarlo y vuelve a dar error, por favor escribe a matelat@gmail.com)</script>";
		}
    }
    else
    {
        $conn = null;
        echo "<script>toast(1, 'Ya Registrada', 'Esa Empresa ya Está Registrada, Puedes Publicar online, Si Tienes Dudas Verifica el E-mail.');</script>";
    }
}
?>