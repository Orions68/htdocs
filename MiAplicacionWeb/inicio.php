<?php
session_start();
 if(empty($_SESSION["usuario"])){
     $_SESSION["usuario"]= "";
     $_SESSION["password"]= "";
 }
 //incluir la cabecera
 include 'includes/header.php';
?>

<!--  El Carrusel  -->
<div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
  <div class="carousel-indicators">
    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
  </div>
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img src="img/01.jpg" class="d-block w-100" alt="...">
      <div class="carousel-caption d-none d-md-block">
        <h5>Primera diapositiva</h5>
        <p>Pon aquí tu texto</p>
      </div>
    </div>
    <div class="carousel-item">
      <img src="img/02.jpg" class="d-block w-100" alt="...">
      <div class="carousel-caption d-none d-md-block">
        <h5>Segunda diapositiva</h5>
        <p>Pon aquí tu texto.</p>
      </div>
    </div>
    <div class="carousel-item">
      <img src="img/03.jpg" class="d-block w-100" alt="...">
      <div class="carousel-caption d-none d-md-block">
        <h5>Tercera diapositiva</h5>
        <p>Pon aquí tu texto.</p>
      </div>
    </div>
  </div>
  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Anterior</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Siguiente</span>
  </button>
</div>

<!-- Inicio del contenedor principal -->



<?php   
    // Inserta el pie de la página
    include 'includes/footer.php';
?>