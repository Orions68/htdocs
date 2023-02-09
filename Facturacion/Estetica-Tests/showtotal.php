<?php
include "includes/conn.php";
$title = "Total Facturado Hasta Ahora en el Año";
include "includes/header.php";
$final = 0;
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
					$stmt = $conn->prepare('SELECT total FROM invoice');
					$stmt->execute();
					if ($stmt->rowCount() > 0)
					{
						while($row = $stmt->fetch(PDO::FETCH_OBJ))
						{
							$final += $row->total;
						}
					}
					else
					{
						echo "<h3>Sin Datos Aun.</h3>";	
					}
					if ($final != 0)
					{
						echo "<h2>La Facturación de todo el año hasta ahora es : " . $final . " €.</h2>";
					}
					?>
					<br>
					<br>
					<input type="button" value="Cierra Esta Ventana" onclick="window.close()">
				</div>
            </div>
        <div class="col-md-1"></div>
    </div>
</section>
</body>
</html>