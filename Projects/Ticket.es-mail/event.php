<?php
include "includes/conn.php";
$title = "Ticket.es - Resultados de Eventos"; // Título de la página
include "includes/header.php"; // El Header HTML 5.
$ok = false;
include "includes/modal.html"; // Este diálogo muestra los errores.
include "includes/modal-carrousel.html"; // Este diálogo muestra las Imágenes de los eventos.

if (!isset($_SESSION["id"])) // Si no hay un espectador logueado
{
    include "includes/navdirect.html"; // Se muestra el menú general.
    include "includes/car.html"; // Carro de la compra.
    include "includes/car_dialog.html"; // Diálogo cuando se agrega algo al carro.
}
else
{
    include "includes/nav-esp.html"; // Se muestra el menu de Espectador logueado.

    $id = $_SESSION["id"];
    $sql = "SELECT * FROM clients WHERE id='$id';";
    $stmt = $conn->prepare($sql);
    $stmt->execute();

    $row = $stmt->fetch(PDO::FETCH_OBJ);
    $name = explode(" ", $row->name);
    echo "<span>Te Damos la Bienvenida " . $name[0] . " </span>"; // Muestro dentro del NAV un span con la bienvenida y el E-mail del cliente .
    echo "<img src='" . $row->path . "' alt='Tú Imagen de Perfil' width='100' height='100'><a href='profile.php'><small style='margin-left:50px;'>Visita tu Perfil</small></a>"; // Muetro la imagen del cliente y el enlace a su perfil.
    echo "</div></nav>"; // Esto cierra el último div y el nav del menú de Espectador logueado.
    include "includes/car.html"; // Carro de la compra.
    include "includes/car_dialog.html"; // Diálogo cuando se agrega algo al carro.
}
?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
<script src="js/script.js"></script>
<script src="js/script2.js"></script>
<?php
if (isset($_REQUEST["kind"])) // Si llegan datos por POST.
{
    $kind = $_REQUEST["kind"];
    if (!isset($_REQUEST["place"]))
    {
        $place = "";
    }
    else
    {
        $place = $_REQUEST["place"];
    }
    include "includes/showEvents.php";
    fromEvents($conn, $kind, $place);
}
else
{
    echo "<script>toast(2, 'Error:', 'Has Llegado Aquí por error.');</script>"; // Si se entra sin enviar datos por POST, error.
}
?>
<section class="container-fluid pt-3">
    <div class="row">
        <div class="col-md-10">
            <div id="page_top">
                <br><br><br><br><br>
                <?php
                    if ($ok)
                    {
                        echo "<script>var kind = '';</script>";
                        echo "<script>kind = '" . $kind . "';</script>";
                        echo "<script>var id = [];</script>";
                        echo "<script>var evento = [];</script>";
                        echo "<script>var path = [];</script>";
                        echo "<script>var desc = [];</script>";
                        echo "<script>var price = [];</script>";
                        echo "<script>var where = [];</script>";
                        echo "<script>var start = [];</script>";
                        echo "<script>var end = [];</script>";
                        echo "<script>var hour = [];</script>";
                        for ($i = 0; $i < count($event); $i++)
                        {
                            echo "<script>id[" . $i . "] = '" . $id[$i] . "';</script>";
                            echo "<script>evento[" . $i . "] = '" . $event[$i] . "';</script>";
                            echo "<script>path[" . $i . "] = '" . $path[$i] . "';</script>";
                            echo "<script>desc[" . $i . "] = '" . $desc[$i] . "';</script>";
                            echo "<script>price[" . $i . "] = '" . $price[$i] . "';</script>";
                            echo "<script>where[" . $i . "] = '" . $where[$i] . "';</script>";
                            echo "<script>start[" . $i . "] = '" . $start[$i] . "';</script>";
                            echo "<script>end[" . $i . "] = '" . $end[$i] . "';</script>";
                            echo "<script>hour[" . $i . "] = '" . $hour[$i] . "';</script>";
                        }
                        ?>
                        <div id="TableList"></div>
                        <br>
                        <span id="page"></span>&nbsp;&nbsp;&nbsp;&nbsp;
                        <button onclick="javascript:prev()" id="prev">Anteriores Resultados</button>&nbsp;&nbsp;&nbsp;&nbsp;
                        <button onclick="javascript:next()" id="next">Siguientes Resultados</button><br>
                        <script>change(1, 5);</script>
                        <?php
                    }
                ?>
            </div>
        </div>
    </div>
</section>
<?php
include "includes/footer.html";
?>
<script>screenSize();</script>
</body>
</html>