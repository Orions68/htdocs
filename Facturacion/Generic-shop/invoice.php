<?php
session_start();
setlocale(LC_TIME, 'es_ES.UTF-8');
date_default_timezone_set("Europe/Madrid");
// date_default_timezone_set("America/Argentina/Buenos_Aires");
for ($i = 0; $i < (count($_POST) - 1) / 4; $i++) // Hago un bucle hasta el tamaño del POST -1 ya que vienen 5 valores pero necesito obtener 4 y divido la cantidad por 4, para obtener la cantidad de elementos en los arrays.
{
	$id[$i] = $_POST["id" . $i]; // En $id[$i] pongo los valores recibidos en $_POST["id0"], $_POST["id1"], etc.
	$product[$i] = $_POST["product" . $i];
	$price[$i] = $_POST["price" . $i];
	$qtty[$i] = $_POST["qtty" . $i];
}
$name = $_POST["username"]; // En $name pongo el valor de $_POST["username"].
$date = date("Y-m-d"); // Obtengo la fecha del día de la facturación.
$time = date("H:i:s"); // Obtengo la hora de la facturación.
$total = 0; // Uso $total para obtener el total de la factura.
$iva = [];
$title = "Facturación de XXXXX";
include "includes/header.php";
?>
<img alt="logo" src="img/logo.webp" height="300" width="100%"/>
<br>
<section class="container-fluid pt-3">
    <div class="row">
	<div id="pc"></div>
	<div id="mobile"></div>
        <div class="col-md-1" style="width: 2%;"></div>
            <div class="col-md-10">
                <div id="view1">
					<br><br>
					<?php
					echo '<div id="printable">';
					echo "<h3>XXXXX</h3>";
					echo "<p>Factura a: " . $name . "</p>";
					echo '<div class="row">';
					echo '<div class="column left" style="background-color:#aaa;">';
					echo "Artículo";
					echo '</div>';
					echo '<div class="column middle" style="background-color:#bbb; text-align:right;">';
					echo "Precio";
					echo '</div>';
					echo '<div class="column right" style="background-color:#ccc; text-align:right;">';
					echo "Cantidad";
					echo '</div>';
					echo '<div class="column moreright" style="background-color:#c1c; text-align:right;">';
					echo "Parcial";
					echo '</div>';
					echo '<div class="column moreright" style="background-color:#c8c; text-align:right;">';
					echo "I.V.A.";
					echo '</div>';
					echo '<div class="column moreright" style="background-color:#cfc; text-align:right;">';
					echo "Total";
					echo '</div>';
					echo '</div>';
					$j = 0;
					for ($i = 0; $i < count($product); $i++)
					{
						echo '<div class="row">';
						echo '<div class="column left" style="background-color:#aaa;">';
						echo $product[$i];
						echo '</div>';
						echo '<div class="column middle" style="background-color:#bbb; text-align:right;">';
						echo number_format((float)$price[$i], 2, ',', '.') . " €";
						echo '</div>';
						echo '<div class="column right" style="background-color:#ccc; text-align:right;">';
						echo $qtty[$i];
						echo '</div>';
						echo '<div class="column moreright" style="background-color:#c1c; text-align:right;">';
						echo number_format((float)$qtty[$i] * $price[$i], 2, ',', '.') . " €";
						echo '</div>';
						echo '<div class="column moreright" style="background-color:#c8c; text-align:right;">';
						$iva[$j] = $qtty[$i] * $price[$i] * .21;
						$total += $qtty[$i] * $price[$i] + $iva[$j];
						echo number_format((float)$qtty[$i] * $price[$i] * .21, 2, ',', '.') . " €";
						echo '</div>';
						echo '<div class="column moreright" style="background-color:#cfc; text-align:right;">';
						// echo number_format((float)$qtty[$i] * $price[$i] + $record[$i + 3] * $record[$i + 2] * .21, 2, ',', '.') . " €";
						echo number_format((float)$qtty[$i] * $price[$i] * 1.21, 2, ',', '.') . " €";
						echo '</div>';
						echo '</div>';
						$j++;
					}
					echo '<div class="column total" style="background-color:#000; text-align:right; color:white; margin-left:32%">Total I.V.A. Incluido: ' . number_format((float)$total, 2, ",", ".") . ' €</div>';
					echo '</div>';
					echo '<br>';
					echo '<br>';
					echo '<br>';
					echo '<br>';
					echo '<form action="addInvoice.php" method="post">';
					$j = 0;
					for ($i = 0; $i < count($product); $i++)
					{
						echo '<input type="hidden" name="id' . $j . '" value="' . $id[$i] . '">';
						echo '<input type="hidden" name="qtty' . $j . '" value="' . $qtty[$i] . '">';
						echo '<input type="hidden" name="iva' . $j . '" value="' . $iva[$j] . '">';
						$j++;
					}
					echo '<input type="hidden" name="username" value="' . $name . '">';
					echo '<input type="hidden" name="total" value="' . $total . '">';
					echo '<input type="hidden" name="date" value="' . $date . '">';
					echo '<input type="hidden" name="time" value="' . $time . '">';
					echo "<div class='row'>";
					echo "<div class='col-md-1'>";
					echo '<input type="button" onclick="printIt(this.form)" value="Imprimir Ticket" style="width:160px; height:60px;">';
					echo "</div>";
					echo "<div class='col-md-4' style='width: 30%;'></div>";
					echo "<div class='col-md-1'>";
					echo '<input type="submit" value="Generar Ticket" style="width:160px; height:60px;">';
					echo "</div>";
					echo "</div>";
					echo '</form>';
					?>
				</div>
            </div>
        <div class="col-md-1" style="width: 2%;"></div>
    </div>
</section>
<?php
include "includes/footer.html";
?>