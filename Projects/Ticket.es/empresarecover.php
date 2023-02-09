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
    $hash = substr(md5(uniqid($email, true)), 8, 8);
    $pass = password_hash($hash, PASSWORD_DEFAULT);
    $ok = false;
    $sql = "SELECT email FROM company;"; // Preparo una consulta de todos los email de empresas de la base de datos.
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    while($row = $stmt->fetch(PDO::FETCH_OBJ)) // Asigno a la variable $row el contenido de la consulta.
    {
        if ($row->email == $email) // Si el E-mail está en la base de datos.
        {
            $ok = true; // $ok es true.
            break; // Rompo el bucle, si se encuentra el E-mail en los primeros resultados no hace falta seguir buscando, el E-mail es clave unica.
        }
    }
    if (!$ok) // Si $ok es false.
    {
        echo "<script>toast(2, 'Hay un Error', 'Lo Siento no Existe Ningúna Empresa con E-mail: $email, Vuelve a Intentarlo con la Dirección con la que Registraste la Empresa.');</script>"; // Error.
    }
    else // Si $ok es true, el E-mail está en la base de datos.
    {
        $sql = "UPDATE company SET pass='$pass' WHERE email='$email'"; // Hago un update de la contraseña de ese E-mail.
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        echo "<script>toast(0, 'Todo ha Ido Bien', 'Se ha cambiado tu Contraseña a: $hash, Selecciónala y Cópiala, Después Vuelve a Iniciar Sesión con los Nuevos Datos. Te Recomendamos que Cambies la Contraseña, Gracias por Publicar tus Eventos Aquí.');</script>";
    }
}
?>
<section class="container-fluid pt-3">
    <div class="row">
        <div class="col-md-1"></div>
            <div class="col-md-10">
                <div id="page_top">
                <br><br><br><br>
                    <h1>Vas a Modificar tu Contraseña por una Provisoria</h1>
                    <br><br>
                    <h2>Por Favor Después de Loguearte Modifícala Entrando en tu Perfil</h2>
                    <br><br>
                    <form action="" method="post">
                        <label><input type="email" name="email"> Danos el E-mail con el que Registraste la Empresa</label>
                        <br><br>
                        <input type="submit" value="Recuperar la Contraseña">
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