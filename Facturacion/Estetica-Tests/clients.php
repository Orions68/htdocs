<?php
include "includes/conn.php";
$title = "Facturando - Salón Joana";
include "includes/header.php";
?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script> <!-- Script de Bootstrap. -->
<script src="js/script.js"></script>
<script src="js/functions.js"></script>
<img alt="logo" src="img/logo.jpg" height="300" width="100%"/>
<br>
<?php
$already = false;
$email = $_POST['email'];
$stmt = $conn->prepare("SELECT id, name, email FROM clients");
$stmt->execute();
if ($stmt->rowCount() > 0)
{
	while ($row = $stmt->fetch(PDO::FETCH_OBJ))
	{
		if ($email == $row->email)
		{
			$_SESSION["client"] = $row->id;
			$already = true;
			$name = $row->name;
		}
	}
}
if (!$already)
{
	echo "<script>alert('El E-mail Introducido no Coincide con Ninguno de los Registrados, Se Generará una Factura a Consumidor Final.')</script>";
	$name = "Consumidor Final";
}
?>
<section class="container-fluid pt-3">
    <div class="row">
        <div class="col-md-1" style="width: 2%;"></div>
            <div class="col-md-10">
                <div id="view1">
					<br><br>
					<div style="font-size:x-large;">Factura a: <?php echo $name; ?></div>

					<label><select name="service" id="service">
						<option value="">Servicio</option>
					<?php
					$stmt = $conn->prepare('SELECT * FROM services');
					$stmt->execute();
					while($row = $stmt->fetch(PDO::FETCH_OBJ))
					{
						echo  '<option value="' . $row->id . "," . $row->service . "," . $row->price . '">' . $row->service . " - " . $row->price . "€" . '</option>';
					}
					?>
					</select> Selecciona el Servicio</label>
					<br><br>
					<label><select name="quantity" id="qtty">
						<option value="1">Cantidad: 1</option>
						<option value="2">Cantidad: 2</option>
						<option value="3">Cantidad: 3</option>
						<option value="4">Cantidad: 4</option>
						<option value="5">Cantidad: 5</option>
					</select> Selecciona la Cantidad</label>
					<br><br>
					<button type="button" onclick="add_service()" class="btn btn-info">Agregar Servicio</button>
					<br>
					<br>
					<form action="invoice.php" method="post">
					<input type="hidden" name="invoice" id="invoice">
					<input type="hidden" name="username" value="<?php echo $name; ?>">
					<br>
					<br>
					<input id="factura" type="submit" value="Facturar!" style="visibility: hidden; width: 160px; height: 80px;" class="btn btn-primary">
					</form>
					<br>
					<br>
					<div id="servic" style="font-size:xx-large"></div>
				</div>
            </div>
        <div class="col-md-1" style="width: 2%;"></div>
    </div>
</section>
<?php
include "includes/footer.html";
?>
<script>screenSize()</script>
</body>

</html>