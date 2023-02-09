<?php
include "includes/conn.php";
$title = "Citas de Clientes";
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
                    <br><br>
					<?php
					$date = $_POST['date'];
					$stmt = $conn->prepare("SELECT email, time FROM clients WHERE date='$date' ORDER BY time ASC");
					$stmt->execute();
					if ($stmt->rowCount() > 0)
					{
						while ($row = $stmt->fetch(PDO::FETCH_OBJ))
						{
							echo '<h3>El Cliente: ' . $row->email . ' Tiene la Cita a las: ' . $row->time . ' Hs.</h3>';
						}
					}
					else
					{
						echo "<h4>No hay citas ese día.</h4>";
					}
					?>
					<br><br>
					<input type="button" value="Cierra esta Ventana" onclick="window.close()">
				</div>
            </div>
        <div class="col-md-1"></div>
    </div>
</section>
</body>

</html>