<?php // Script que destruye la sesión.
session_start();
session_destroy();
$title = "Gracias por Visitar Ticket.es";
include "includes/header.php";
include "includes/start.html";
?>
<section class="container-fluid pt-3">
    <div class="row">
        <div class="col-md-10">
            <div id="page_top">
                <br><br><br>
                <header>      
                    <!-- Jumbotron -->
                    <!-- Background image -->
                    <div class="mask" style="background-color: rgba(0, 0, 0, 0.6);">
                        <div class="d-flex justify-content-center align-items-center h-100"></div>
                            <div class="text-white">
                                    <h1 class="mb-3">Ticket.es</h1>
                            </div>
                    </div>
                    <div class="p-5 text-center bg-image" style="background-image: url('img/logo.jpg'); background-repeat: no-repeat; height: 320px;">
                    </div>
                    <div class="mask" style="background-color: rgba(0, 255, 0, 0.6);">
                        <div class="d-flex justify-content-center align-items-center h-100"></div>
                            <div class="text-white">
                                    <h1 class="mb-3">Eventos en Todo el País</h1>
                            </div>
                    </div>
                    <!-- Jumbotron -->
                    </header>
                    <h1>La Tienda de Espectaculos Más Completa del Mundo</h1>
                    <br>
                <h1>Gracias por Comprar tus Entradas con Nosotros</h1>
                <br>
                <h2>Esperamos Volver a Tenerte Pronto por Aquí</h2>
                <br>
                <h3>Recuerda que desde la página de inicio y sin necesidad de registrarte/loguearte puedes buscar todos los eventos que se están realizando en el Mundo.</h3>
            </div>
        </div>
    </div>
</section>
<?php
include "includes/footer.html";
?>