<?php
session_start();
setlocale(LC_TIME, 'es_ES.UTF-8');
date_default_timezone_set("Europe/London");
if (isset($_POST["job"]))
{
    $material = "";
    $price = "";
    $prices = 0;
    $client = $_POST["client"];
    if ($client == "")
    {
        $client = "Consumidor Final";
    }
    $job = $_POST["job"];
    for ($i = 0; $i < (count($_POST) - 6) / 2; $i++)
    {
        $material .= $_POST["material" . $i] . ", ";
        $price .= $_POST["price" . $i] . ", ";
    }
    $price_array = explode(",", $price);
    for ($i = 0; $i < count($price_array) - 1; $i++)
    {
        $prices += $price_array[$i];
    }
    $hand = $_POST["hand"];
    $date = $_POST["date"];
    $time = $_POST["time"];
    $totaligic = $hand + $prices;
    $hand -= $hand * .07;
    $total = $prices + $hand;
}
$title = "Facturación de Fernando";
include "includes/header.php";
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
					<p>Factura a: ' . $client . '</p>
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
                    <div class="column middle" style="background-color:#bbb; text-align:right;">' . $material . '
                    </div>
                    <div class="column right" style="background-color:#c1c; text-align:right;">' . number_format((float)$prices, 2, ',', '.') . '
                    </div>
                    <div class="column moreright" style="background-color:#c8c; text-align:right;">' . number_format((float)$hand, 2, ',', '.') . ' €
                    </div>
                    <div class="column moreright" style="background-color:#cac; text-align:right;">' . number_format((float)$total, 2, ',', '.') . ' €
                    </div>
                    <div class="column moreright" style="background-color:#ccc; text-align:right;">7%
                    </div>
                    <div class="column moreright" style="background-color:#cfc; text-align:right;"> ' . number_format((float)$totaligic, 2, ',', '.') . ' €</div>
                    </div>
					<div class="column total" style="background-color:#000; text-align:right; color:white; margin-left:54.5%">Total I.G.I.C. Incluido: ' . number_format((float)$totaligic, 2, ",", ".") . ' €</div>
					</div>
					<br>
					<br>
				    <br>
					<br>
					<form action="addInvoice.php" method="post">
					<input type="hidden" name="client" value="' . $client . '">
					<input type="hidden" name="job" value="' . $job . '">
                    <input type="hidden" name="material" value="' . $material . '">
                    <input type="hidden" name="price" value="' . $prices . '">
                    <input type="hidden" name="hand" value="' . $hand . '">
                    <input type="hidden" name="total" value="' . $total . '">
                    <input type="hidden" name="totaligic" value="' . $totaligic . '">
					<input type="hidden" name="date" value="' . $date . '">
					<input type="hidden" name="time" value="' . $time . '">
					<div class="row">
					<div class="col-md-1">
					
					</div>
					<div class="col-md-4" style="width: 30%;"></div>
					<div class="col-md-1">
					<input type="submit" value="Generar Ticket" style="width:160px; height:60px;">
					</div>
					</div>
					</form>';
					?>
				</div>
            </div>
        <div class="col-md-1" style="width: 2%;"></div>
    </div>
</section>
<?php
include "includes/footer.html";
?>