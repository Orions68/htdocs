<?php
$title = "Página de Contacto - Ticket.es"; // Página de contacto, llamada por el script contact.php.
include "includes/header.php";
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
                    if (isset($_POST["callme"])) // Si recibe datos por POST.
                    {
                        $call = $_POST["callme"];
                        $date = $_POST["date"];
                        $latindate = explode("-", $date);
                        $date = $latindate[2] . "/" . $latindate[1] . "/" . $latindate[0];
                        $start = $_POST["starthour"];
                        $end = $_POST["endhour"];
                        echo "<h1>Nos Pondremos en Contacto Contigo por medio de $call, el día $date entre las Horas: $start y $end, Gracias.</h1>"; // Nos pondremos en contacto contigo.
                    }
                    else
                    {
                        echo "<script>toast(2, 'Error Grave:', 'Haz Llegado Aquí por Error.');</script>";
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