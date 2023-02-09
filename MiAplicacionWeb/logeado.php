<?php
session_start();
if (($_SESSION["usuario"]!="") and ($_SESSION["password"]<>"")){
    //incluir la cabecera
    include 'includes/headerS.php';
    print <<<AQUI
    <div class="container">
    <br>
    <div class="row justify-content-around row-cols-1 row-cols-md-2 g-4">
        <!-- Primera fila -->
       
            <div class="card" style="width: 25rem;">
            <img src="img/cuerpo/html5.png" class="card-img-top" alt="Dicujo de un programador">
                <div class="card-body">
                    <h5 class="card-title">HTML5</h5>
                    <p class="card-text">Es el lenguaje de marcado estándar para la creación de páginas web, con él crearás tu propia Web.</p>
                    <a href="#" class="btn btn-warning">¡Empezamos!</a>
                </div>
            </div>

            <div class="card" style="width: 25rem;">
            <img src="img/cuerpo/css3.png" class="card-img-top" alt="Dicujo de un programador">
                <div class="card-body">
                    <h5 class="card-title">CSS3</h5>
                    <p class="card-text"> Es el lenguaje utilizado para dar estilo a los elementos HTML de una web. Con él, le darás forma y color a tu Web.</p>
                    <a href="#" class="btn btn-warning">¡Empezamos!</a>
                </div>
            </div>
        

       
            <div class="card" style="width: 25rem;" >
            <img src="img/cuerpo/JS.png" class="card-img-top" alt="Dicujo de un programador">
                <div class="card-body">
                    <h5 class="card-title">JS</h5>
                    <p class="card-text">JavaScript es un lenguaje de programación interpretado y orientado a objetos que te premitirá agregar dinamismo a tu Web.</p>
                    <a href="#" class="btn btn-warning">¡Empezamos!</a>
                </div>
            </div>
      

    </div>   <!-- Cierra la primera fila -->
    <br>
    </div>


AQUI;
}
    // Inserta el pie de la página
    include 'includes/footer.php';

    
?>
