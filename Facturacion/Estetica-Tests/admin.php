<?php
$title = "Administración - Salón de Estética";
include "includes/header.php";
$year = date('Y');
?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script> <!-- Script de Bootstrap. -->
<script src="js/script.js"></script>
<script src="js/functions.js"></script>
<?php
include "includes/nav_admin.html";
?>
<img alt="logo" src="img/logo.jpg" height="300" width="100%"/>
<br>
<section class="container-fluid pt-3">
    <div class="row">
        <div class="col-md-1"></div>
            <div class="col-md-10">
				<div id="view1">
					<br><br><br><br>
					<h1>Joanna - Salón de Estética Integral.</h1>
					<br>
					<h2>Consola de Administración.</h2>
					<br>
					<h3>Sistema de Facturación</h3>
					<br>
					<h4>Facturar al cliente: </h4>
					<form action="clients.php" method="post" target="_blank">
					<br>
					<label><input type="text" name="email" placeholder="E-mail"> E-mail del Cliente</label>
					<input type="submit" value="Factura al Cliente" class="btn btn-success">
					</form>
				</div>
				<div id="view2">
					<br><br><br><br><br>
					<h2>Ver Totales y Facturas</h2>
					<br>
					<h4>Selecciona el Trimestre y el Año para Descargar un Informe de las Facturas del Trimestre que Necesites y Haz Click en Ver Informe.</h4>
					<br>
					<form action="export.php" method="post" target="_blank">
					<label><select name="date">
						<option value="1">1º Trimestre</option>
						<option value="2">2º Trimestre</option>
						<option value="3">3º Trimestre</option>
						<option value="4">4º Trimestre</option>
					</select> Selecciona el Trimestre a consultar</label>
					<br><br>
					<label><input type="number" name="year" min="2000" max="3000" step="1" value="<?php echo $year; ?>"> Selecciona el Año</label>
					<br><br>
					<input type="submit" value="Ver Informe" class="btn btn-info">
					</form>
					<br>
					<br>
					<div>
					<button onclick="showAll()" class="btn btn-primary" style="height: 64px;">Mostrar el Total de las Ventas del Año</button>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					<button onclick="back_up()" class="btn btn-secondary" style="height: 64px;">Copia de Respaldo de la Base de Datos</button>
					</div>
				</div>
				<div id="view3">
					<br><br><br><br><br>
					<div class="row">
						<div class="col-md-6">
							<h2>Consultar las Fechas de las Citas de los Clientes.</h2>
							<br>
							<form action="turnview.php" method="post" target="_blank">
							<label><input type="date" name="date" required> Selecciona la Fecha de la Cita</label>
							<br><br>
							<input type="submit" value="Ver las Citas del Día" class="btn btn-info" style="height: 64px;">
							</form>
						</div>
						<div class="col-md-6">
							<h2>Reservar una Cita</h2>
							<br>
							<form action="request.php" method="post" target="_blank">
							<label><input type="email" name="invited" required> E-mail del Cliente</label>
							<br><br>
							<label><input type="date" name="date" required> Selecciona la Fecha de la Cita</label>
							<br><br>
							<input type="submit" value="Reserva" class="btn btn-info" style="height: 64px;">
							</form>
						</div>
					</div>
				</div>
				<div id="view4">
					<br><br><br><br><br>
					<div class="row">
						<div class="col-md-6">
							<h2>Agregar Servicios:</h2>
							<br>
							<form action="added.php" method="post" enctype="multipart/form-data" target="_blank">
							<label><input type="text" name="service" placeholder="Servicio"> Servicio Ofrecido</label>
							<br><br>
							<label><input type="number" step=".05" name="price" placeholder="Precio"> Precio del Servicio</label>
							<br><br>
							<label><input type="file" name="img"> Foto del Servicio Ofrecido</label>
							<br><br>
							<input type="submit" value="Agregar Servicio" class="btn btn-info">
							</form>
						</div>
						<div class="col-md-6">
							<h2>Modificar/Quitar Servicios:</h2>
							<br>
							<br>
							<input type="button" value="Modificar/Quitar Servicio" onclick="window.open('modrem.php', '_blank')" class="btn btn-danger">
						</div>
					</div>
				</div>
			</div>
        <div class="col-md-1"></div>
    </div>
</section>
<?php
include "includes/footer.html";
?>
<script>screenSize();</script>
</body>
</html>