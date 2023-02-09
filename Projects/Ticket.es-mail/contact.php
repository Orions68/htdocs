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
                    <h1>Página de Contacto de Ticket.es</h1>
                    <br>
                    <h3>Selecciona la Forma de Contacto, Nosotros nos Pondremos en Contacto Contigo</h3>
                    <br>
                    <h4>También puedes escribirnos a:</h4>
                    <small><a href="mailto:info@ticket.es">Ticket.es</a></small>
                    <h3>O <img src="img/qr.webp" alt="Whatsapp" width="480"></h3>
                    <br><br>
                    <form action="connect.php" method="post">
                        <label><select name="callme" id="contact" onchange="changeit()">
                            <option value="">Selecciona</option>
                            <option value="Telepatía">Telepatía</option>
                            <option value="Señales">Señales de Humo</option>
                            <option value="Teléfono">Teléfono</option>
                            <option value="Whatsapp">Whatsapp</option>
                            <option value="E-mail">E-mail</option>
                            <option value="Correo">Correo Postal</option>
                        </select> Selecciona Modo de Contacto</label>
                        <br><br>
                        <label><input type="date" name="date"> Fecha de Contacto</label>
                        <br><br>
                        <label><input type="time" name="starthour"> Hora Aproximada de Contacto Desde</label>
                        <br><br>
                        <label><input type="time" name="endhour"> Hora Aproximada de Contacto Hasta</label>
                        <br><br>
                        <input type="submit" id="change" value="Contacto">
                    </form>
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