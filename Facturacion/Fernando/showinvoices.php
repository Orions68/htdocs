<?php
include "includes/conn.php";
$title = "Facturas por Días";
include "includes/header.php";
include "includes/modal.html";

if (isset($_POST["date"]))
{
    $date = $_POST["date"];
    $i = 0;

    $stmt = $conn->prepare("SET lc_time_names = 'es_ES'");
	$stmt->execute();

    $sql = "SELECT *, DATE_FORMAT(date,'%d %M %Y') as date FROM invoice WHERE date='$date' ORDER BY time DESC";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    if ($stmt->rowCount() > 0)
    {
        while ($row = $stmt->fetch(PDO::FETCH_OBJ))
        {
            $id[$i] = $row->id;
            $client[$i] = $row->client;
            $job[$i] = $row->job;
            $material[$i] = $row->replacements;
            $price[$i] = $row->prices;
            $hand[$i] = $row->hand;
            $total[$i] = $row->total;
            $totaligic[$i] = $row->totaligic;
            $dates[$i] = $row->date;
            $time[$i] = $row->time;
            $i++;
        }

    }
}
    ?>
<section class="container-fluid pt-3">
    <div class="row">
    <div id="pc"></div>
	<div id="mobile"></div>
        <div class="col-md-1" style="width:3%;"></div>
            <div class="col-md-10">
                <div id="view1">
                <?php
                for ($j = 0; $j < $i; $j++)
                {
					echo '<div id="printable' . $j . '">
                    <h1>Facturas del Día: ' . $dates[$j] . '</h1>
					<h3>Fernando Ariel Filippelli - Y0575228N Camino La Unión 31 38270 Valle de Guerra</h3>
					<h4>Factura  Nº: ' . $id[$j] . ', a ' . $client[$j] . '</h4>
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
                    <div class="column left" style="background-color:#aaa;">' . $job[$j] . '
                    </div>
                    <div class="column middle" style="background-color:#bbb; text-align:right;">' . $material[$j] . '
                    </div>
                    <div class="column right" style="background-color:#c1c; text-align:right;">' . number_format((float)$price[$j], 2, ',', '.') . ' €
                    </div>
                    <div class="column moreright" style="background-color:#c8c; text-align:right;">' . number_format((float)$hand[$j], 2, ',', '.') . ' €
                    </div>
                    <div class="column moreright" style="background-color:#cac; text-align:right;">' . number_format((float)$total[$j], 2, ',', '.') . ' €
                    </div>
                    <div class="column moreright" style="background-color:#ccc; text-align:right;">7%
                    </div>
                    <div class="column moreright" style="background-color:#cfc; text-align:right;">' . number_format((float)$totaligic[$j], 2, ',', '.') . ' €
                    </div></div>
					<div class="column total" style="text-align:right;">Total I.G.I.C. Incluido: ' . number_format((float)$totaligic[$j], 2, ",", ".") . ' €</div>
                    </div>
                    <br><br>
                    <input type="button" onclick="printIt(null, ' . $j . ')" value="Imprimir Ticket" style="width:160px; height:60px;">';
                }
					?>
                <br><br>
                    <input type="button" value="Cierra Esta Ventana" onclick="window.close()">
				</div>
            </div>
        <div class="col-md-1"></div>
    </div>
</section>
<?php
include "includes/footer.html";
?>