<?php
$title = "Ticket.es - Entrada de Espectador";
include "includes/header.php";
?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
<script src="js/script.js"></script>
<?php
include "includes/modal2.html";
if (empty($_SESSION["id"]))
{
    include "includes/nav.html";    
}
else
{
    include "includes/nav2.html";
}

?>
</div>
    </nav>
    <section class="container-fluid pt-3">
        <div class="row">
            <div class="col-md-1"></div>
                <div class="col-md-10">
                    <div id="page_top">
                    <br><br><br><br><br>
                    <h1>Se ha Efectuado el Pago, Gracias, Aquí Tienes tus Entradas</h1>
                    <br>
                    <?php
                    if (isset($_SESSION["id"]))
                    {
                        $id = $_SESSION["id"];
                        if (isset($_POST["id0"]))
                        {
                            invoice();
                            $sql = "SELECT MAX(accumulated) FROM invoice WHERE '$id'=id_cliente";
                            $stmt = $conn->prepare($sql);
                            $stmt->execute;
                            if ($stmt->rowCount() > 0)
                            {
                                $max = $stmt->fetch(PDO::FETCH_OBJ);
                                $group = discountRange($max, 10);
                            }
                            $sql = "SELECT number FROM discount WHERE discount.id_cliente='$id'";
                            $stmt = $conn->prepare($sql);
                            $stmt->execute();
                            if ($stmt->rowCount() > 0)
                            {
                                $number = $stmt->fetch(PDO::FETCH_OBJ);
                                if ($group > $number)
                                {
                                    $sql = "UPDATE discount SET number = number + 1 WHERE id='$id'";
                                    $stmt = $conn->prepare($sql);
                                    $stmt->execute();

                                    echo "Tenes descuento, hay que agregarlo a la base de datos.";
                                    echo "Aplico el descuento directamente como una sorpresa. Será un 10% de la cantidad que haya pagado.";
                                }
                            }
                        }
                    }
                    else
                    {
                        if (isset($_POST["id0"]))
                        {
                            invoice();
                        }
                    }
                    ?>
                    <p id="content" style="visibility: hidden;"></p>
                    <a href="img/code.png" download="Ticket.png"><img src="img/code.png" alt="QR, Entrada al Evento" id="img_id">Descarga el Código y Guárdalo para Mostrarlo a la Entrada al Evento.</a>
                    </div>
                </div>
            <div class="col-md-1"></div>
        </div>
    </section>
    <?php
function invoice()
{
    $access = [];
    echo "Has Comprado: ";
    for ($i = 0; $i < count($_POST) / 3; $i++)
    {
        $id[$i] = $_POST["id" . $i];
        $event[$i] = $_POST["event" . $i];
        $qtty[$i] = $_POST["qtty" . $i];
        if ($i == (count($_POST) / 3 - 1))
        {
            echo $id[$i] . " - " . $event[$i] . " - " . $qtty[$i];
            $access[$i] = $event[$i] . " - " . $qtty[$i];
        }
        else
        {
            echo $id[$i] . " - " . $event[$i] . " - " . $qtty[$i] . "<br>";
            $access[$i] = $event[$i] . " - " . $qtty[$i];
        }
    }
    echo " - Entradas.<br>";
}

function discountRange($qtty, $group)
{
    $i = 0;
    $counter = -1;
    while($qtty >= $i)
    {
        $i += $group;
        $counter++;
    }
    return $counter;
}
    ?>