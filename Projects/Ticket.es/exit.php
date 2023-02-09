<?php // Este script guarda las facturas en la base de datos.
include "includes/conn.php";
if (isset($_POST["id0"])) // Si se recibió al menos una compra.
{
    $size = (count($_POST)) / 6; // Asigno a la variable $size el tamaño de lo que llega por POST dividido 6 ya que son seis datos por evento.
    $total = [];

    for ($i = 0; $i < $size; $i++) // Hago un bulce hasta el tamaño de los datos recibidos.
    {
        $id[$i] = $_POST["id" . $i]; // Asigno a la variable $id[$i] el valor de $_POST["id0"], la ID del evento.
        $event[$i] = $_POST["event" . $i]; // El nombre del evento.
        $price[$i] = $_POST["price" . $i]; // El precio de cada entrada.
        $qtty[$i] = $_POST["qtty" . $i]; // La cantidad de entradas.
        $qr[$i] = $_POST["code" . $i]; // Los códigos QR.
        $total[$i] = $price[$i] * $qtty[$i]; // El total a pagar por cada evento comprada.
        $sql = "UPDATE events SET sold=sold + $qtty[$i] WHERE id='$id[$i]'"; // Hago una actualización de las entradas vendidas.
        $stmt = $conn->prepare($sql);
        $stmt->execute();
    }
}
else
{
    echo "<script>if (!alert('Nada, has llegado aquí por error.')) window.open('index.php');</script>"; // Si no llegan datos por POST, error.
}
$title = "Ahora Sí, Mis Entradas"; // Título de la página.
include "includes/header.php";
include "loguedin.php"; // Incluyo el script loguedin.php, para saber si es un espectador logueado, si no está logueado muestro el menú general.
logued($conn); // Llamo a la función logued($conn) del script loguedin.php pasandole la conexión con la base de datos, para mostrar el menú de espectador si está logueado.
if (isset($_SESSION["id"])) // Si está iniciada la session de espectador.
{
    $id_esp = $_SESSION["id"]; // Asigo a la variable $id_esp la id de la sesión de espectador, uso esa variable ya que se usa la varibla $id para las id de los eventos.
}
?>
<script src="js/script2.js"></script>
<section class='container-fluid pt-3'>
    <div class='row'>
        <div class='col-sm-1'></div>
            <div class='col-sm-10'>
                <div id="page_top">
                    <br><br><br><br>
                    <?php
                    if (empty($_SESSION["invoice"])) // Variable de sesión usada por si al usuario se le ocurre recargar la página, para que no se vuelvan a almacenar los datos en la base de datos.
                    {
                        $_SESSION["invoice"] = 1; // La primera vez que entra a la página está vacía, le asigno el valor 1.
                        $amnt = 0; // Esta variable se inicializa a 0 se usa para obtener la cantidad de entradas compradas por el espectador logueado.
                        $date = date("Y-m-d H:i:s"); // Esta es la fecha y hora en que se compró la entrada.
                        $sql = "INSERT INTO invoice VALUES (:id, :id_cliente, :id_event, :qtty, :accumulated, :payed, :date, :path);"; // Consulta para guardar la factura en invoice.
                        $stmt = $conn->prepare($sql); // La Preparo en la variable $stmt.
                        for ($i = 0; $i < $size; $i++) // Hago un bucle del tamaño de los datos recibidos
                        {
                            echo "<h1>" . $event[$i] . "</h1>"; // Título del evento.
                            echo "<a href='" . $qr[$i] . "' target='_blank' download><img src='" . $qr[$i] . "' width='240' heigth='160'>Descarga el Código y Guárdalo para Mostrarlo a la Entrada al Evento.</a>";
                            echo "<br><br>";
                            if (isset($_SESSION["id"])) // Si está logueado el espectador, guardo la factura con su ID.
                            {
                                $sql = "SELECT id FROM invoice WHERE id_cliente='$id_esp' ORDER BY id DESC LIMIT 1;"; // Esta consulta obtiene la última id del espectador logueado.
                                $stmt1 = $conn->prepare($sql); // Uso $stmt1, para no sobreescribir mi statement anterior.
                                $stmt1->execute();
                                $row = $stmt1->fetch(PDO::FETCH_COLUMN);
                                if ($row > 0) // Si hay datos, es que ya había comprado entradas.
                                {
                                    $sql = "SELECT accumulated FROM invoice WHERE id='$row'"; // Esta consulta obtiene la cantidad de entradas acumuladas que compró el espectador.
                                    $stmt1 = $conn->prepare($sql);
                                    $stmt1->execute();
                                    $amnt = $stmt1->fetch(PDO::FETCH_COLUMN); // Le asigno la cantidad de entradas compradas a la variable $amnt.
                                }
                        
                                $accum = $amnt + $qtty[$i]; // Asigno a la variable $accum la suma de las entradas que ya tenía compradas más la que acaba de comprar.
                                $stmt->execute(array(':id' => null, ':id_cliente' => $id_esp, ':id_event' => $id[$i], ':qtty' => $qtty[$i], ':accumulated' => $accum, ':payed' => $total[$i], ':date' => $date, ':path' => $qr[$i]));
                                // Guardo la factura en la base de datos con la cantidad de entradas compradas actualizadas.
                            }
                            else // Si no, la factura tendrá cliente=null como id de epectador, consumidor final.
                            {
                                $stmt->execute(array(':id' => null, ':id_cliente' => null, ':id_event' => $id[$i], ':qtty' => $qtty[$i], ':accumulated' => 0, ':payed' => $total[$i], ':date' => $date, ':path' => $qr[$i]));
                                // Guardo la factura del consumidor final, ya que Hacienda somos todos, pero sin importar la cantidad de entradas comrpadas, accumulated = 0 y cliente = null.
                            }
                        }
                    }
                    else // Si se recarga la página la variable de sesión está iniciada.
                    {
                        echo "<script>if (!alert('No hace falta que recargues la página, puedes navegar con los enlaces en el Menú, Gracias.')) window.open('index.php', '_self');</script>";
                        // Aviso que se debe navegar por los enlaces del menú y redirijo a index.php donde se hace unset($_SESSION["invoice"]).
                    }
                    ?>
                    <h1>Gracias por tu Compra</h1>
                    <h2>Esperamos que Vuelvas Pronto</h2>
                    <button class="btn btn-primary" onclick="window.open('index.php#page_event')">Muestrame la Salida</button>
                </div>
            </div>
        <div class='col-sm-1'></div>
    </div>
</section>
<script>screenSize()</script>
</body>
</html>