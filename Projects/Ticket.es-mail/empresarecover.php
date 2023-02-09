<?php
include "includes/conn.php";
$title = "Ticket.es - Recupera tu Contraseña";
include "includes/header.php";
include "includes/modal.html";
include "includes/nav.html";
?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
<script src="js/script2.js"></script>
<?php
if (isset($_POST["email"]))
{
    $email = htmlspecialchars($_POST["email"]);
    $hash = substr(md5(uniqid($email, true)), 16, 16);
    $ok = false;
    $sql = "SELECT email FROM company;"; // Preparo una consulta de todos los email de empresas de la base de datos.
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    while($row = $stmt->fetch(PDO::FETCH_OBJ))
    {
        if ($row->email == $email)
        {
            $ok = true;
            break;
        }
    }
    if (!$ok)
    {
        echo "<script>toast(2, 'Hay un Error', 'Lo Siento no Existe Ningúna Empresa con E-mail: $email, Vuelve a Intentarlo con la Dirección con la que Registraste la Empresa.');</script>";
    }
    else
    {
        $subject = "Ticket.es - Recuperación de Contraseña";
		$message = "<h3>Aquí está tu Contraseña Provisoria: " . $hash . ". </h3><p>Por favor Logueate con la nueva contraseña y cambiala por tu propia contraseña segura.</p><br><br><small>Copyright © 2022 César Matelat <a href='mailto:info.ticket.es@gmail.com'>info.ticket.es@gmail.com</a></small>";
		$server_email = "info.ticket.es@gmail.com";
		$headers  = "From: $server_email" . "\r\n";
		$headers .= "X-Mailer: PHP/" . phpversion(). "\r\n";
		$headers .= 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/html; charset=UTF-8' . "\r\n";
		if(mail($email, $subject, $message, $headers))
		{
			echo "<script>toast(0, 'Todo ha Ido Bien', 'Te Hemos Enviado una Contraseña Provisoria a: $email, Vuelve a Iniciar Sesión con los Nuevos Datos y Modifica la Contraseña, Gracias por Publicar tus Eventos Aquí.');</script>";
		}
		else
		{
			echo "Error al enviar el mensaje si vuelves a intentarlo y vuelve a dar error, por favor escribe a info.ticket.es@gmail.com";
		}
    }
}
?>
<section class="container-fluid pt-3">
    <div class="row">
        <div class="col-md-1"></div>
            <div class="col-md-10">
                <div id="page_top">
                <br><br><br><br>
                    <h1>Te Vamos a Enviar a tu E-mail una Contraseña Provisoria</h1>
                    <br><br>
                    <h2>Por Favor Después de Loguearte Modifícala Entrando en tu Perfil</h2>
                    <br><br>
                    <form action="" method="post">
                        <label><input type="email" name="email"> Danos el E-mail con el que Registraste la Empresa</label>
                        <br><br>
                        <input type="submit" value="Restaurar la Contraseña">
                    </form>
                </div>
            </div>
        <div class="col-md-1"></div>
    </div>
</section>
<?php
include "includes/footer.html";
?>
<script>screenSize();</script>
</body>
</html>