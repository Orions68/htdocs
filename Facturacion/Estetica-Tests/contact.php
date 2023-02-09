<?php
$title = "Página de Contacto - Salón de Estética Joana"; // Pagina de contacto, con un formulario para seleccionar la forma de contacto.
include "includes/header.php";
?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
<script src="js/script.js"></script>
<?php
include "includes/modal.html";
include "includes/nav_index.html";
?>
<section class='container-fluid pt-3'>
    <div class='row'>
        <div class='col-sm-1'></div>
            <div class='col-sm-10'>
                <div id='view1'>
                    <br><br><br><br>
                    <h1>Página de Contacto de Salón de Estética Joana</h1>
                    <br>
                    <h3>Selecciona la Forma de Contacto, Nosotros nos Pondremos en Contacto Contigo</h3>
                    <br>
                    <h4>También puedes escribirnos a:</h4>
                    <small><a href="mailto:info@joana.es">Salón de Estética Joana</a></small>
                    <h3>O <img src="img/qr.webp" alt="Whatsapp" width="480"></h3>
                    <br><br>
                    <form action="connect.php" method="post">
                        <label><select name="callme" id="contact" onchange="changeit()" required>
                            <option value="">Selecciona</option>
                            <option value="Teléfono">Teléfono</option>
                            <option value="Whatsapp">Whatsapp</option>
                            <option value="E-mail">E-mail</option>
                        </select> Selecciona Modo de Contacto</label>
                        <br><br>
                        <label><input type="date" name="date" required> Fecha de Contacto</label>
                        <br><br>
                        <label><input type="time" name="starthour" required> Hora Aproximada de Contacto Desde</label>
                        <br><br>
                        <label><input type="time" name="endhour" required> Hora Aproximada de Contacto Hasta</label>
                        <br><br>
                        <label id="phone" style="visibility: hidden;"><input type="text" id="ph" name="phone"> Dame tu Número</label>
                        <br>
                        <label id="email" style="visibility: hidden;"><input type="email" id="em" name="email"> Dame tu E-mail</label>
                        <br><br>
                        <input type="submit" id="change" value="Contacto" class="btn btn-primary">
                        <br><br><br><br>
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