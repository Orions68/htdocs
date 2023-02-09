<?php
include "inc/modal.html";
$title = "Ver Facturas por Mesas";
include "inc/header.php";
?>
<section class="container-fluid pt-3">
<div id="pc"></div>
    <div id="mobile"></div>
    <div class="row">
        <div class="col-md-1"></div>
            <div class="col-md-10">
                <div id="view1">
                    <br><br>
                    <div class="row">
						<div class="col-md-5">
						<h2>Ver Totales y Facturas</h2>
						<br>
						<h4>Selecciona el Trimestre y el Año para Descargar un Informe de las Facturas del Trimestre que Necesites y Haz Click en Ver Informe.</h4>
						<br>
						<form action="export.php" method="post" target="_blank">
							<label>
								<select name="date">
									<option value=1>1º Trimestre</option>
									<option value=2>2º Trimestre</option>
									<option value=3>3º Trimestre</option>
									<option value=4>4º Trimestre</option>
								</select> Selecciona el Trimestre a consultar
							</label>
							<br><br>
							<label><input type="number" id="year" name="year" min="2022" max="3000" step="1"> Selecciona el Año</label>
							<br><br>
							<input type="submit" value="Ver Informe" class="btn btn-info btn-lg">
						</form>
						<script>
							var date = document.getElementById("year");
							const d = new Date();
							let year = d.getFullYear();
							date.value = year;
						</script>
						<br>
						<br>
						<div>
							<button onclick="window.open('showtotal.php', '_blank')" class="btn btn-primary" style="height: 64px;">Mostrar el Total de Ventas del Año</button>
						</div>
						</div>
						<div class="col-md-1"></div>
						<div class="col-md-6">
                        <h1>Busqueda de Facturas por la Fecha, por la Mesa o por la Mesa y Fecha</h1>
					<form action="showtable.php" method="post" onsubmit="return verifyShow()">
                    <label><input id="date" type="date" name="date"> Selecciona la Fecha</label>
					<br>
					<br>
					<label><select id="table" name="table">
                        <option value="">Selecciona una Mesa</option>
						<option value="Entrada 1">Entrada 1</option>
						<option value="Entrada 2">Entrada 2</option>
						<option value="Entrada 3">Entrada 3</option>
						<option value="Entrada 4">Entrada 4</option>
						<option value="Barra 1">Barra 1</option>
						<option value="Barra 2">Barra 2</option>
						<option value="Barra 3">Barra 3</option>
						<option value="Patio 1">Patio 1</option>
						<option value="Patio 2">Patio 2</option>
						<option value="Patio 3">Patio 3</option>
						<option value="Patio 4">Patio 4</option>
						<option value="Patio 5">Patio 5</option>
						<option value="Vereda 1">Vereda 1</option>
						<option value="Vereda 2">Vereda 2</option>
						<option value="Vereda 3">Vereda 3</option>
						<option value="Mesa 1">Mesa 1</option>
						<option value="Mesa 2">Mesa 2</option>
						<option value="Mesa 3">Mesa 3</option>
						<option value="Mesa 4">Mesa 4</option>
						<option value="Mesa 5">Mesa 5</option>
						<option value="Mesa 6">Mesa 6</option>
						<option value="Mesa 7">Mesa 7</option>
						<option value="Mesa 8">Mesa 8</option>
						<option value="Tablón 1">Tablón 1</option>
						<option value="Tablón 2">Tablón 2</option>
						<option value="Mesa 9">Mesa 9</option>
						<option value="Mesa 10">Mesa 10</option>
						<option value="Mesa 11">Mesa 11</option>
						<option value="Mesa 12">Mesa 12</option>
						<option value="Mesa 13">Mesa 13</option>
					<select> Selecciona la Mesa</label>
					<br><br>
					<input class="btn btn-primary" type="submit" value="Ver Facturas" style="width:128px; height:64px;">
                    </form>
							<br><br>
                            <div>
                                <button onclick="window.open('invoice.php', '_blank')" class="btn btn-success" style="height: 64px;">Ver Última Factura</button>
                            </div>
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
include "inc/footer.html";
?>