<?php
include "includes/conn.php";
if (!empty($_SESSION["invoice"])) // Verifico si la session invoice está iniciada.
{
    unset($_SESSION["invoice"]); // Si está la limpio.
}
include "includes/car.html"; // Carro de la compra.
$title = "Ticket.es - Entrada de Espectador";
include "includes/header.php";
include "includes/mod-esp-log.html";
include "includes/car_dialog.html"; // Diálogo cuando se agrega algo al carro.
include "includes/showLogin.php";
$ok = false;
include "includes/nav-esp.html";
    if (isset($_POST["email"])) // Verifico si llegan datos por post.
    {
        $email = htmlspecialchars($_POST["email"]); // Asigno los datos por post a variables con el filtro htmlspecialchars().
        $pass = htmlspecialchars($_POST["pass"]);

        $sql = "SELECT * FROM clients WHERE email='$email';"; // Preparo la consulta con el email y la contraseña.
        $ok = show($conn, $sql, $pass, "viewer"); // Asigno el resultado de la función show() a la variable $ok, a show le paso la conexion, la consulta, la contraseña y quien se loguea.
        if (!$ok) // Si $ok está a false.
        {
            echo "<script>toast(1, 'Hay un Error', 'No Se han Encontrado Datos de $email, Vuelve al Inicio e Intenta Iniciar Sesión con tus Datos.');</script>";
            // Hubo un error, no se ha encontrado el cliente en la tabla.
        }
        else // Si se encontró.
        {
            echo "</div></nav>";
            include "includes/disc-esp.php";
        }
    }
    else // Si no hay datos por post.
    {
        if (isset($_SESSION["id"])) // Verifico que la sesión esté iniciada.
        {
            $id = $_SESSION["id"]; // Asigno a $id el valor de la sesión id.
            $sql = "SELECT * FROM clients WHERE id=$id;"; // Preparo la consulta buscando solo por la id.
            $ok = show($conn, $sql, "", "viewer"); // Asigno a la variable $ok el resultado de la función show().
            echo "</div></nav>";
            include "includes/disc-esp.php";
        }
        else
        {
            echo "<script>toast(2, 'Error Grave:', 'Haz Llegado Aquí por Error.');</script>";
        }
    }
    if (!$ok) // Si $ok está a false.
    {
        echo "<script>toast(1, 'Hay un Error', 'No Se han Encontrado Datos de $email, Vuelve al Inicio e Intenta Iniciar Sesión con tus Datos.');</script>";
        // Hubo un error, no se ha encontrado el cliente en la tabla.
    }
    else // Si se encontró.
    {
        $id = $_SESSION["id"];
        $sql = "SELECT active FROM clients WHERE id=$id;"; // Preparo la consulta de la columna active.
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        if ($stmt->rowCount() > 0) // Si hay resultados.
        {
            $row = $stmt->fetch(PDO::FETCH_OBJ); // Asigno a la variable $row el resultado.
            if (!$row->active)
            {
                echo "<script>toast_disc();</script>";
            }
        }
    ?>
    <section class="container-fluid pt-3">
        <div class="row">
            <div class="col-md-1"></div>
                <div class="col-md-10">
                    <div id="page_top">
                        <br><br><br><br><br>
                        <h2>Usa Busca Eventos en el Menú para Saber que está Pasando en la Ciudad.</h2>
                        <br>
                        <h3>Te Presentamos Algunos Eventos Variados.</h3>
                        <?php
                            include "includes/showEvents.php";
                            fromIndex($conn);
                        ?>
                    </div>
                </div>
            <div class="col-md-1"></div>
        </div>
    </section>
    <?php
    }
include "includes/footer.html";
?>