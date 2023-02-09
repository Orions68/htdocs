<?php
$title = "Página de Contacto - Ticket.es";
include "includes/header.php";
?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
<script src="js/script2.js"></script>
<?php
include "includes/modal.html";
include "includes/nav.html";
?>
<section class='container-fluid pt-3'>
    <div class='row'>
        <div class='col-sm-1'></div>
            <div class='col-sm-10'>
                <div id='page_top'>
                    <br><br><br><br>
                    <?php
                    if (isset($_POST["callme"]))
                    {
                        $call = $_POST["callme"];
                        $date = $_POST["date"];
                        $latindate = explode("-", $date);
                        $date = $latindate[2] . "/" . $latindate[1] . "/" . $latindate[0];
                        $start = $_POST["starthour"];
                        $end = $_POST["endhour"];
                        echo "<h1>Nos Pondremos en Contacto Contigo por medio de $call, el día $date entre las Horas: $start y $end, Gracias.</h1>";
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
<script>screenSize();</script>
</body>
</html>