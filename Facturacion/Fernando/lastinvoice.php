<?php
include "includes/conn.php";
$title = "Última Factura";
include "includes/header.php";

$sql = "SELECT * FROM invoice WHERE id=(SELECT COUNT(id) FROM invoice)";
$stmt = $conn->prepare($sql);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_OBJ);
$id = $row->id;
$client = $row->client;
$job = $row->job;
$material = $row->replacements;
$price = $row->prices;
$hand = $row->hand;
$total = $row->total;
$totaligic = $row->totaligic;
$date = $row->date;
$time = $row->time;
?>
<section class="container-fluid pt-3">
    <div class="row">
	<div id="pc"></div>
	<div id="mobile"></div>
        <div class="col-md-1" style="width: 2%;"></div>
            <div class="col-md-10">
                <div id="view1">
					<br><br>
					<?php
					echo '<div id="printable0">
					<h3>Fernando Ariel Filippelli - Y0575228N Camino La Unión 31 38270 Valle de Guerra</h3>
					<p>Factura Nº: ' . $id . ' a ' . $client . '</p>
					<div class="row">
                    <div class="column left" style="background-color:#aaa;">
					Trabajo
					</div>
                    <div class="column middle" style="background-color:#bbb;">
					Repuestos
					</div>
					<div class="column right" style="background-color:#c1c; text-align:right;">
					Total Repuestos
					</div>
					<div class="column moreright" style="background-color:#c8c; text-align:right;">
					Base Imponible Mano de Obra
					</div>
                    <div class="column moreright" style="background-color:#cac; text-align:right;">
					Parcial
					</div>
					<div class="column moreright" style="background-color:#ccc; text-align:right;">
					I.G.I.C.
					</div>
					<div class="column moreright" style="background-color:#cfc; text-align:right;">
					Total + I.G.I.C.
					</div></div>
                    <div class="row">
                    <div class="column left" style="background-color:#aaa;">' . $job . '
                    </div>
                    <div class="column middle" style="background-color:#bbb;">' . $material . '
                    </div>
                    <div class="column right" style="background-color:#c1c; text-align:right;">' . number_format((float)$price, 2, ',', '.') . ' €
                    </div>
                    <div class="column moreright" style="background-color:#c8c; text-align:right;">' . number_format((float)$hand, 2, ',', '.') . ' €
                    </div>
                    <div class="column moreright" style="background-color:#cac; text-align:right;">' . number_format((float)$total, 2, ',', '.') . ' €
                    </div>
                    <div class="column moreright" style="background-color:#ccc; text-align:right;">7%
                    </div>
                    <div class="column moreright" style="background-color:#cfc; text-align:right;"> ' . number_format((float)$totaligic, 2, ',', '.') . ' €</div>
                    </div>
					<div class="column total" style="text-align:right;">Total I.G.I.C. Incluido: ' . number_format((float)$totaligic, 2, ",", ".") . ' €</div>
					</div>
					<br><br>
                    <input type="button" onclick="printIt(null, 0)" value="Imprimir Ticket" style="width:160px; height:60px;">';
					?>
                    <br><br>
                    <input type="button" value="Cierra Esta Ventana" onclick="window.close()">
				</div>
            </div>
        <div class="col-md-1" style="width: 2%;"></div>
    </div>
</section>
<?php
include "includes/footer.html";
?>