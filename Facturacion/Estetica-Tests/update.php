<?php
include "includes/conn.php";
$title = "Modificando un Servicio - Salón Joana";
include "includes/header.php";
include "includes/modal_index.html";
?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script> <!-- Script de Bootstrap. -->
<script src="js/script.js"></script>
<section class="container-fluid pt-3">
    <div class="row">
        <div class="col-md-1"></div>
            <div class="col-md-10">
                <div id="view1">
                    <br><br><br><br>
					<?php
						$service = $_POST['service'];
						$price = $_POST['price'];
						$id = $_POST['id'];
						$stmt = $conn->prepare("UPDATE services SET service='$service', price='$price' WHERE id='$id'");
						$stmt->execute();
						
						echo "<script>toast(0, 'Todo Ha Ido Bien:', 'Servicio : " . $service . " Modificado correctamente.');</script>";
					?>
				</div>
            </div>
        <div class="col-md-1"></div>
    </div>
</section>
</body>
</html>