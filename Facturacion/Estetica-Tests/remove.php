<?php
include "includes/conn.php";
$title = "Quitar Servicio";
include "includes/header.php";
?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script> <!-- Script de Bootstrap. -->
<script src="js/script.js"></script>
<img alt="logo" src="img/logo.jpg" height="300" width="100%"/>
<br>
<section class="container-fluid pt-3">
    <div class="row">
        <div class="col-md-1"></div>
            <div class="col-md-10">
                <div id="view1">
                <br><br><br><br>
                <?php
                $id = $_POST['id'];
                $service = $_POST['service'];
                $stmt = $conn->prepare("DELETE FROM services WHERE id='$id'");
                $stmt->execute();
                echo "<script>toast(0, 'Servicio Quitado:', 'El Servicio " . $service . " ha Sido Quitado Correctamente.');</script>";
                ?>
                </div>
            </div>
        <div class="col-md-1"></div>
    </div>
</section>
</body>

</html>