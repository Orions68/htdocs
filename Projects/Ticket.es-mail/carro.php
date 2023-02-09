<?php
include "includes/conn.php";
$title = "Carro de la Compra de Ticket.es";
include "includes/header.php";
?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
<script src="js/script2.js"></script>
<?php
include "includes/modal.html";
if (isset($_SESSION["id"])) // Verifico que la sesión esté iniciada.
{
    include "includes/nav-esp.html";
    $id = $_SESSION["id"]; // Asigno a $id el valor de la sesión id.
    $sql = "SELECT * FROM clients WHERE id='$id';"; // Preparo la consulta buscando solo por la id.
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    if ($stmt->rowCount() > 0)
    {
        $row = $stmt->fetch(PDO::FETCH_OBJ);
        $name = explode(" ", $row->name);
        echo "<span>Te Damos la Bienvenida " . $name[0] . "</span>"; // Muestro dentro del NAV un span con la bienvenida y el Nombre de pila del espectador.
        echo " <img src='" . $row->path . "' alt='Tú Imagen de Perfil' width='100' height='100'><a href='profile.php'><small style='margin-left:50px;'>Visita tu Perfil</small></a>";
        // Muetro la imagen del espectador y el enlace a su perfil.
        echo "</div></nav>";
    }
}
else
{
    include "includes/nav.html";
}
?>
<section class='container-fluid pt-3'>
    <div class='row'>
        <div class='col-sm-1'></div>
            <div class='col-sm-10'>
                <div id='page_top'>
                    <br><br><br><br>
                    <?php
                    if (isset($_SESSION["id"]))
                    {
                        $id = $_SESSION["id"];
                        echo "<h2>Has Solicitado estás Entradas, Puedes Proceder al Pago.</h2>
                        <br>";
                    }
                    else
                    {
                        echo "<h2>Te Damos la Bienvenida Invitado, Aquí está tu compra, puedes proceder al pago sin necesidad de Registrarte.</h2>
                        <br>
                        <h3>Si te Registras Tendrás Prioridad Para Comprar Las Entradas Cuando Estas Tienen Más Demanda, Además Podrás Beneficiarte de Importantes Descuentos y Premios.</h3>";
                    }
                    ?>
                    <label>Lista de la compra:
                        <br>
                    <?php
                    if (isset($_POST["article0"])) // Si se recibe al menos un artículo.
                    {
                        echo "<textarea cols='50' rows='8'>";
                        for ($i = 0; $i < count($_POST) / 2; $i++) // Hago un bucle para saber cuantos artículos hay en el pedido, en la mitad del array $_POST ya que son dos datos por artículo.
                        {
                            $array_art[$i] = $_POST["article" . $i]; // Asigno al array_art el contenido en el array $_POST de los artículos.
                            $all_events = explode("-", $array_art[$i]);
                            $array_qtty[$i] = $_POST["qtty" . $i]; // Asigno al array_qtty el contenido en el array $_POST de la cantidad de artículos.
                            $sql = "SELECT sold, places FROM events WHERE id='$all_events[0]'";
                            $stmt = $conn->prepare($sql);
                            $stmt->execute();
                            if ($stmt->rowCount() > 0)
                            {
                                $row = $stmt->fetch(PDO::FETCH_OBJ);
                                $places = $row->places - $row->sold + $array_qtty[$i];
                                if ($places < 0)
                                {
                                    
                                }
                            }
                            echo $i + 1 . "- $array_art[$i], $array_qtty[$i]\n"; // Muestro el contenido de los arrays en la textarea.
                        }
                        ?>
                        </textarea>
                    </label>
                        <br><br>
                        <form action="payment.php" method="post">
                            <?php
                            for ($i = 0; $i < count($_POST) / 2; $i++)
                            {
                                echo "<input type='hidden' name='event" . $i . "' value='" . $_POST["article" . $i] . "'>";
                                echo "<input type='hidden' name='qtty" . $i . "' value='" . $_POST["qtty" . $i] . "'>";
                            }
                            ?>
                            <input type="submit" value="Proceder al Pago">
                        </form>
                        <?php
                    }
                    ?>
                </div>
            </div>
        <div class='col-sm-1'></div>
    </div>
</section>
<?php
include "includes/footer.html";
?>
<script>screenSize()</script>
<script>checkTitle()</script>
</body>
</html>