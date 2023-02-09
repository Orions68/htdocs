<?php
include "includes/conn.php";
include "includes/modal.html";

if (isset($_SESSION["id"]))
{
    if (isset($_GET["discount"]))
    {
        $ok = true;
        $id = $_SESSION["id"];
        $discount = $_GET["discount"];
        $code = $_GET["code"];
        $sql = "SELECT COUNT(count) FROM counter";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_OBJ);
        if ($row->count >= $code)
        {
            $sql = "SELECT code FROM discount";
            $stmt = $conn->prepare($sql);
            $stmt->execute();
            while ($row = $stmt->fetch(PDO::FETCH_OBJ))
            {
                if ($row->code == $code)
                {
                    $ok = false;
                    break;
                }
            }
            if ($ok)
            {
                $sql = "INSERT INTO discount VALUES (null, '$id', '$discount', '$code')";
                $stmt = $conn->prepare($sql);
                $stmt->execute();
                $_SESSION["discount"] = $discount;
                echo "<script>toast(0, 'Cupón de Descuento:', 'Has Escaneado un Cupón de Descuento de un $discount%, Se ha Validado tu Descuento, Gracias.');</script>";
            }
            else
            {
                echo "<script>toast(1, 'Código Repetido:', 'Ese Código ya ha Sido Utilizado, Si Crees que Hay Algún Error por Favor ponte en Contacto con Ticket.es a Través de Nuestras Formas de Contacto.');</script>";
            }
        }
        else
        {
            echo "<script>toast(2, 'Error Grave:', 'Has Escaneado un Cupón de Descuento Falsificado, Daremos Parte a la Policía, Si Has Sido Victima de una Estafa, te Rogamos que Colabores con la Policía, Para Aclarar el Caso.');</script>";
        }
    }
}
else
{
    if (isset($_GET["discount"]))
    {
        $discount = $_GET["discount"];
        $code = $_GET["code"];
    ?>
    <section class="container-fluid pt-3">
    <div class="row">
        <div class="col-md-1"></div>
            <div class="col-md-10">
                <div id="page_top">
                <br><br><br><br>
                <h1>Has Escaneado un Código de Descuento, para Poder Usarlo Debes Entrar al Sistema con tus Credenciales</h1>
                <br>
                <h2>Por Favor Entra con tu E-mail y Contraseña.</h2>
                <br>
                <form action="login.php" method="post">
                    <input type="hidden" name="discount" value="<?php echo $discount; ?>">
                    <input type="hidden" name="code" value="<?php echo $code; ?>">
                        <label><input type="email" name="email"> Tu E-mail</label>
                        <br><br>
                        <label><input type="password" name="pass"> Contraseña</label>
                        <br><br>
                        <input type="submit" value="Aprovechar este Descuento">
                    </form>
                </div>
            </div>
        <div class="col-md-1"></div>
    </div>
    </section>
    <?php
    }
}
?>