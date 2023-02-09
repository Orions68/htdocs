<?php
if (isset($_POST["invoice"]))
{
    session_start();
    setlocale(LC_TIME, 'es_ES.UTF-8');
    date_default_timezone_set("Europe/London");
    $invoice = $_POST['invoice'];
    $name = $_POST["username"];
    $date = date("Y-m-d");
    $time = date("H:i:s");
    $total = 0;
	$igic = [];
    $title = "Facturación con Impuestos discriminados";
    include "includes/header.php";
}
else
{
    exit();
}
?>
<section class="container-fluid pt-3">
    <div class="row">
        <div class="col-md-1" style="width: 2%;"></div>
            <div class="col-md-10">
                <div id="view1">
					<br><br>
					<?php
					echo '<div id="printable">';
					echo "<h3>Facturación de Cualquier Negocio</h3>";
					echo "<p>Factura a: " . $name . "</p>";
						echo '<div class="row">';
						echo '<div class="column left" style="background-color:#d0d0d0;">';
						echo "Artículo";
						echo '</div>';
						echo '<div class="column middle" style="background-color:#d8d8d8; text-align:right;">';
						echo "Precio";
						echo '</div>';
						echo '<div class="column right" style="background-color:#dfdfdf; text-align:right;">';
						echo "Cantidad";
						echo '</div>';
						echo '<div class="column moreright" style="background-color:#e0e0e0; text-align:right;">';
						echo "Parcial";
						echo '</div>';
						echo '<div class="column moreright" style="background-color:#e8e8e8; text-align:right;">';
						echo "I.G.I.C.";
						echo '</div>';
						echo '<div class="column moreright" style="background-color:#efefef; text-align:right;">';
						echo "Total";
						echo '</div>';
						echo '</div>';
						$j = 0;
					$record = explode(",", $invoice);
					for ($i = 0; $i < count($record) - 3; $i+=4)
					{
						echo '<div class="row">';
						echo '<div class="column left" style="background-color:#d0d0d0;">';
						echo $record[$i + 1];
						echo '</div>';
						echo '<div class="column middle" style="background-color:#d8d8d8; text-align:right;">';
						echo number_format((float)$record[$i + 2], 2, '.', '') . " €";
						echo '</div>';
						echo '<div class="column right" style="background-color:#dfdfdf; text-align:right;">';
						echo $record[$i + 3];
						echo '</div>';
						echo '<div class="column moreright" style="background-color:#e0e0e0; text-align:right;">';
						$total += $record[$i + 3] * $record[$i + 2];
						echo number_format((float)$record[$i + 3] * $record[$i + 2], 2, '.', '') . " €";
						echo '</div>';
						echo '<div class="column moreright" style="background-color:#e8e8e8; text-align:right;">';
						$igic[$j] = $record[$i + 3] * $record[$i + 2] * .07;
						echo number_format((float)$record[$i + 3] * $record[$i + 2] * .07, 2, '.', '') . " €";
						echo '</div>';
						echo '<div class="column moreright" style="background-color:#efefef; text-align:right;">';
						echo number_format((float)$record[$i + 3] * $record[$i + 2] + $record[$i + 3] * $record[$i + 2] * .07, 2, '.', '') . " €";
						echo '</div>';
						echo '</div>';
						$j++;
					}
					for ($k = $j - 1; $k >= 0; $k--)
					{
						$total += $igic[$k];
					}
					echo '<div class="column total" style="background-color:#000; text-align:right; color:white; margin-left:32%">Total I.G.I.C. Incluido: ' . $total . ' €</div>
					</div>
					<br><br><br><br>
					<form action="addInvoice.php" method="post" target="_blank">';
					$j = 0;
					for ($i = 0; $i < count($record) - 3; $i+=4)
					{
						echo '<input type="hidden" name="id' . $j . '" value="' . $record[$i] . '">';
						// echo '<input type="hidden" name="price' . $j . '" value="' . $record[$i + 2] . '">';
						echo '<input type="hidden" name="qtty' . $j . '" value="' . $record[$i + 3] . '">';
						echo '<input type="hidden" name="igic' . $j . '" value="' . $igic[$j] . '">';
						$j++;
					}
					echo '<input type="hidden" name="username" value="' . $name . '">';
					echo '<input type="hidden" name="total" value="' . $total . '">';
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