<?php
$title = "Sistema de Facturación";
include "includes/header.php";
include "includes/nav-index.html";
include "includes/nav-mob-index.html";
?>
<section class="container-fluid pt-3">
    <div class="row">
        <div class="col-md-1"></div>
            <div class="col-md-10">
                <div id="view1" style="margin-bottom: 50%;">
                    <br><br><br><br>
                    <h1>Facturación de Obra</h1>
                    <br><br>
                    <form id="form" action="invoice.php" method="post">
                        <label><input type="text" name="client"> Datos del Cliente, Si lo Dejas en Blanco se Facturará a Consumidor Final</label>
                        <br><br>
                        <label><input type="text" name="job" required> Breve Descripción del Trabajo</label>
                        <br><br>
                        <label><select id="qtty" name="qtty" onchange="prices(document.getElementById('qtty').value)">
                            <option value="">Selecciona la cantidad de Repuestos</option>
                            <option value="1">Uno</option>
                            <option value="2">Dos</option>
                            <option value="3">Tres</option>
                            <option value="4">Cuatro</option>
                            <option value="5">Cinco</option>
                            <option value="6">Seis</option>
                            <option value="7">Siete</option>
                            <option value="8">Ocho</option>
                            <option value="9">Nueve</option>
                            <option value="10">Diez</option>
                        </select> Cantidad de Repuestos Usados</label>
                        <br><br>
                        <div id="prices"></div>
                        <br>
                        <label><input type="number" name="hand" step=".5" required> Mano de Obra</label>
                        <br><br>
                        <label><input type="date" name="date" required> Fecha de la Obra</label>
                        <br><br>
                        <label><input type="time" name="time" required> Hora de la Obra</label>
                        <br><br>
                        <input type="submit" value="Agrego esta Factura">
                    </form>
                </div>
                <div id="view2">
                    <br><br><br>
                    <div class="row">
						<div class="col-md-5">
                        <h1>Acá Vas a Ver Las Facturas Para Sacar la Relación del Trimestre</h1>
                        <br>
                        <br>
                        <h4>Selecciona el Trimestre y el Año para Descargar un Informe de las Facturas del Trimestre que Necesites y Haz Click en Ver Informe.</h4>
                        <br>
                        <form action="export.php" method="post" target="_blank">
                            <label>
                                <select name="date">
                                    <option value="1">1º Trimestre</option>
                                    <option value="2">2º Trimestre</option>
                                    <option value="3">3º Trimestre</option>
                                    <option value="4">4º Trimestre</option>
                                </select> Selecciona el Trimestre a consultar
                            </label>
                            <br><br>
                            <label><input type="number" id="year" name="year" min="2023" max="3000" step="1"> Selecciona el Año</label>
                            <br><br>
                            <input type="submit" value="Ver Informe" class="btn btn-info">
                        </form>
                        <script>
                            var date = document.getElementById("year");
                            const d = new Date();
                            let year = d.getFullYear();
                            date.value = year;
                        </script>
                        <br><br>
                        <div>
							<button onclick="window.open('showtotal.php', '_blank')" class="btn btn-primary" style="height: 64px;">Mostrar el Total de Ventas del Año</button>
						</div>
						</div>
						<div class="col-md-1"></div>
						<div class="col-md-6">
                            <br>
							<h2>Ver Facturas por Día de Facturación</h2>
							<br>
							<h4>Selecciona el Día, el Mes y el Año a Consultar</h4>
							<br>
							<form action="showinvoices.php" method="post" target="_blank">
								<label><input type="date" name="date"></label>
									<br><br>
									<input type="submit" value="Busca esa fecha" class="btn btn-info btn-lg">
							</form>
							<br><br>
                            <form action="lastinvoice.php" method="post" target="_blank">
                                <br><br>
                                <input type="submit" value="Muestra la Última Factura" class="btn btn-info btn-lg">
							</form>
							<br><br>
							<div>
								<button onclick="window.open('db-backup.php', '_blank')" class="btn btn-secondary" style="height: 64px;">Copia de Respaldo de la Base de Datos</button>
							</div>
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