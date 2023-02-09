<?php
session_start();
setlocale(LC_TIME, 'es_ES.UTF-8');
date_default_timezone_set("Europe/London");
$invoice = $_POST['invoice'];
$name = $_POST["username"];
$date = date("Y-m-d");
$time = date("H:i:s");
$total = 0;
$igic = 0;
$title = "Facturación de Salón Joana";
include "includes/header.php";
?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script> <!-- Script de Bootstrap. -->
<script src="js/script.js"></script>
<script src="js/functions.js"></script>
<img alt="logo" src="img/logo.jpg" height="300" width="100%"/>
<br>
<section class="container-fluid pt-3">
    <div class="row">
        <div class="col-md-1" style="width: 2%;"></div>
            <div class="col-md-10">
                <div id="view1">
					<br><br>
					<?php
					echo '<div id="printable">';
					echo "<p>Salón de Estética Joana</p>";
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
						echo "I.G.I.C.";
						echo '</div>';
						echo '<div class="column moreright" style="background-color:#cfc; text-align:right;">';
						echo "Total";
						echo '</div>';
						echo '</div>';

					$record = explode (",", $invoice);
					for ($i = 0; $i < count($record) - 3; $i+=4)
					{
						echo '<div class="row">';
						echo '<div class="column left" style="background-color:#aaa;">';
						echo $record[$i + 1];
						echo '</div>';
						echo '<div class="column middle" style="background-color:#bbb; text-align:right;">';
						echo number_format((float)$record[$i + 2], 2, '.', '') . "€";
						echo '</div>';
						echo '<div class="column right" style="background-color:#ccc; text-align:right;">';
						echo $record[$i + 3];
						echo '</div>';
						echo '<div class="column moreright" style="background-color:#c1c; text-align:right;">';
						$total += $record[$i + 3] * $record[$i + 2];
						echo number_format((float)$record[$i + 3] * $record[$i + 2], 2, '.', '') . "€";
						echo '</div>';
						echo '<div class="column moreright" style="background-color:#c8c; text-align:right;">';
						$igic += $record[$i + 3] * $record[$i + 2] * .07;
						echo number_format((float)$record[$i + 3] * $record[$i + 2] * .07, 2, '.', '') . "€";
						echo '</div>';
						echo '<div class="column moreright" style="background-color:#cfc; text-align:right;">';
						echo number_format((float)$record[$i + 3] * $record[$i + 2] + $record[$i + 3] * $record[$i + 2] * .07, 2, '.', '') . "€";
						echo '</div>';
						echo '</div>';
					}
					echo '<div class="column total" style="background-color:#000; text-align:right; color:white; margin-left:32%">Total I.V.A. Incluido: ' . $total + $igic . '€</div>';
					echo '</div>';
					echo '<br>';
					echo '<br>';
					echo '<br>';
					echo '<br>';
					echo '<form action="addInvoice.php" method="post">';
					$j = 0;
					for ($i = 0; $i < count($record) - 3; $i+=4)
					{
						echo '<input type="hidden" name="id' . $j . '" value="' . $record[$i] . '">';
						echo '<input type="hidden" name="price' . $j . '" value="' . $record[$i + 2] . '">';
						echo '<input type="hidden" name="qtty' . $j . '" value="' . $record[$i + 3] . '">';
						$j++;
					}
					echo '<input type="hidden" name="username" value="' . $name . '">';
					echo '<input type="hidden" name="total" value="' . $total . '">';
					echo '<input type="hidden" name="igic" value="' . $igic . '">';
					echo '<input type="hidden" name="date" value="' . $date . '">';
					echo '<input type="hidden" name="time" value="' . $time . '">';
					echo '<input type="button" onclick="printIt(this.form)" value="Imprimir Ticket" style="width:160px; height:60px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
					echo '<input type="submit" value="Generar Ticket" style="width:160px; height:60px;">';
					echo '</form>';
					?>
				</div>
            </div>
        <div class="col-md-1" style="width: 2%;"></div>
    </div>
</section>
</body>

</html>