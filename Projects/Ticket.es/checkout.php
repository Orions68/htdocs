<?php // Script de después de pagar por Paypal, genera los Códigos QR a través de la API de Google.
include "includes/conn.php";
echo "<script>localStorage.clear();</script>"; // clear() Borra el contenido de localStorage.
if (isset($_POST["id0"])) // Si se recibió al menos una compra.
{
    $size = (count($_POST)) / 4; // Asigno a la variable $size el tamaño de lo que llega por POST dividido 4 ya que son cuatro datos por evento.
    $seats = []; // Declaro la Variable $seats como un array.

    for ($i = 0; $i < $size; $i++) // Hago un bulce hasta el tamaño de los datos recibidos.
    {
        $seats[$i] = ""; // Le asigno un valor vacio al array $seats para poder concatenar los números de entrada.
        $id[$i] = $_POST["id" . $i]; // Asigno a la variable $id[$i] el valor de $_POST["id0"], la ID del evento.
        $event[$i] = $_POST["event" . $i]; // El nombre del evento.
        $price[$i] = $_POST["price" . $i]; // El precio de cada entrada.
        $qtty[$i] = $_POST["qtty" . $i]; // La cantidad de entradas.
        $total[$i] = $price[$i] * $qtty[$i]; // Calculo el total a pagar mutiplicando la cantidad de entradas compradas por el precio, para cada evento.
        $sql = "SELECT sold FROM events WHERE id='$id[$i]'"; // Obtengo la cantidad de entradas vendidas.
        $stmt = $conn->prepare($sql); // Preparo la Consulta.
        $stmt->execute(); // La ejecuto.
        $row = $stmt->fetch(PDO::FETCH_OBJ); // Asigno a la variable $row los resultados.
        $counter = $qtty[$i]; // Asigno a la variable $counter la cantidad de entradas compradas por el espectador.
        while ($counter > 0) // Mientras $counter sea mayor que 0
        {
            $seats[$i] .= $row->sold + $counter . ","; // Concateno los números de entrada en el array $seats.
            $counter--; // Decremento la variable $counter.
        }
    }
}
else
{
    echo "<script>if (!alert('Nada, has llegado aquí por error.')) window.open('index.php');</script>"; // Si entras sin datos, error.
}
$title = "Por Fin Tengo las Entradas"; // Título de la página.
include "includes/header.php";
include "loguedin.php"; // Incluyo el script loguedin.php, para saber si es un espectador logueado, si no está logueado muestro el menú general.
logued($conn); // Llamo a la función logued($conn) del script loguedin.php pasandole la conexión con la base de datos, para mostrar el menú de espectador si está logueado.
if (isset($_SESSION["id"])) // Si está iniciada la session de espectador.
{
    $id_esp = $_SESSION["id"]; // Asigo a la variable $id_esp la id de la sesión de espectador, uso esa variable ya que se usa la varibla $id para las id de los eventos.
}
?>
<script src="js/script2.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<section class='container-fluid pt-3'>
    <div class='row'>
        <div class='col-sm-1'></div>
            <div class='col-sm-10'>
                <div id="page_top">
                    <br><br><br><br>
                    <h1>Preparando tus Entradas</h1>
                    <h2>Todo está Listo.</h2>
                    <h3>Todas tus entradas estarán disponibles en tu perfil de ususario. Solo para los usuarios registrados.</h3>
                    <form action="exit.php" method="post">
                    <?php
                    for ($i = 0; $i < $size; $i++)
                    {
                        if (isset($_SESSION["id"])) // Si hay un espectador logueqado.
                        {
                            $good_url = urlencode('https://ticket-es.000webhostapp.com/server.php?client=' . $id_esp . '&id=' . $id[$i] . '&title=' . $event[$i] . '&qtty='. $qtty[$i] . "&seats=" . $seats[$i]);
                            // A la variable $good_url le asigno la url, urlencode, que se enviará al servicio que recoge las entradas a medida que van entrando al evento los espectadores.
                        }
                        else // Si no, la URL envía cliente=0 como id de espectador.
                        {
                            $good_url = urlencode('https://ticket-es.000webhostapp.com/server.php?client=0&id=' . $id[$i] . '&title=' . $event[$i] . '&qtty='. $qtty[$i] . "&seats=" . $seats[$i]);
                        }
                        echo "<input type='hidden' id='code" . $i . "' name='qr' value='" . $good_url . "'>"; // Pongo la URL en un input hidden, para poder obtener el valor.
                        echo '<input type="hidden" id="here' . $i . '" name="code' . $i . '">
                            <input type="hidden" name="id' . $i . '" value="' . $id[$i] . '">
                            <input type="hidden" name="event' . $i . '" value="' . $event[$i] . '">
                            <input type="hidden" name="price' . $i . '" value="' . $price[$i] . '">
                            <input type="hidden" name="qtty' . $i . '" value="' . $qtty[$i] . '">';
                        // En el anlace pongo la dirección del Código QR y lo muestro tambien en una img, se supone que se tiene que descargar al usar la propiedad download
                        // en el enlace <a> pero no es así, al menos en firefox.
                    }
                    echo '<input class="btn btn-primary" style="width: 240px; height: 120px;" type="submit" id="btn" style="visibility: hidden;" value="Aquí están tus Entradas">';
                    echo "<script>QRGen($i);</script>"; // Llamo a la función que obtiene el código QR desde el servicio que ofrece Google, le paso la cantidad de códigos a generar.
                    ?>
                    </form>
                </div>
            </div>
        <div class='col-sm-1'></div>
    </div>
</section>
<?php
include "includes/footer.html";
?>
<script>screenSize()</script>
</body>
</html>