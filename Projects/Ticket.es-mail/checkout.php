<?php
include "includes/conn.php";
echo "<script>localStorage.clear();</script>"; // clear() Borra el contenido de localStorage.
if (isset($_POST["id0"]))
{
    $size = count($_POST); // Asigo a la variable $size el tamaño de lo que llega por POST.
    for ($i = 0; $i < $size / 3; $i++) // Hago un bulce hasta el tamaño de los datos recibidos / 3 ya que llegan 3 datos.
    {
        $id[$i] = $_POST["id" . $i]; // Asigno a la variable $id[$i] el valor de $_POST["id0"].
        $event[$i] = $_POST["event" . $i]; // El nombre del evento.
        $qtty[$i] = $_POST["qtty" . $i]; // La cantidad de Entradas.
    }
}
$title = "Por Fin Tengo las Entradas";
include "includes/header.php";
?>
<section class='container-fluid pt-3'>
    <div class='row'>
        <div class='col-sm-1'></div>
            <div class='col-sm-10'>
                <div id="page_top">
                    <?php
                    for ($i = 0; $i < $size / 3; $i++)
                    {
                        echo "<h1>" . $event[$i] . "</h1>";
                        echo "<br>";
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
<script src="js/script2.js"></script>
<script>screenSize()</script>
</body>
</html>