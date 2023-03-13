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
            $date = $row->date;
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
                echo '<h1>Facturas del Día: ' . $date . '</h1>
                <br><br>';
                for ($j = 0; $j < $i; $j++)
                {
					echo '<div id="printable' . $j . '">
                        <h3>Fernando Ariel Filippelli - Y0575228N Camino La Unión 31 38270 Valle de Guerra</h3>
                        <h4>Factura  Nº: ' . $id[$j] . ', a ' . $client[$j] . ' Fecha: ' . $date . '</h4>
                        <div class="row">
                            <div class="column left" style="background-color:#aaa;">&nbsp;
                            Trabajo
                            </div>
                            <div class="column middle" style="background-color:#bbb;">
                            Repuestos
                            </div>
                            <div class="column right" style="background-color:#ccc;">
                            Total Repuestos
                            </div>
                            <div class="column oneright" style="background-color:#ddd;">
                            Base Imponible Mano de Obra
                            </div>
                            <div class="column moreright" style="background-color:#eee;">
                            Parcial
                            </div>
                            <div class="column moreright" style="background-color:#eef; text-align:center;">
                            I.G.I.C.
                            </div>
                            <div class="column final" style="background-color:#eff; text-align:right;">
                            Total + I.G.I.C.
                            </div>
                        </div>
                        <div class="row">
                            <div class="column left" style="background-color:#aaa;">&nbsp;' . $job[$j] . '
                            </div>
                            <div class="column middle" style="background-color:#bbb;">' . $material[$j] . '
                            </div>
                            <div class="column right" style="background-color:#ccc;">' . number_format((float)$price[$j], 2, ',', '.') . ' €
                            </div>
                            <div class="column oneright" style="background-color:#ddd;">' . number_format((float)$hand[$j], 2, ',', '.') . ' €
                            </div>
                            <div class="column moreright" style="background-color:#eee;">' . number_format((float)$total[$j], 2, ',', '.') . ' €
                            </div>
                            <div class="column moreright" style="background-color:#eef; text-align:center;">Exento
                            </div>
                            <div class="column final" style="background-color:#eff; text-align:right;">' . number_format((float)$totaligic[$j], 2, ',', '.') . ' €</div>
                        </div>
                        <div class="row">
                            <div class="column total">Total I.G.I.C. Incluido: ' . number_format((float)$totaligic[$j], 2, ",", ".") . ' €</div>
                        </div>
                    </div>
                    <a id="image' . $j . '" download="Factura Nº ' . $id[$j] . '.png"></a>
                    <br><br><br><br>
                    <div class="row">
                        <div class="col-md-4">
                            <button onclick="printIt(' . $j . ')" style="width:160px; height:80px;" class="btn btn-primary">Imprime la Factura</button>
                        </div>
                        <div class="col-md-4">
                        <button onclick="pdfDown(' . $j . ')" class="btn btn-secondary btn-lg">Descarga la Factura en PDF</button>
                        </div>
                        <div class="col-md-6">
                        <button onclick="window.open(\'saveIt.php?id=' . $id[$j] . '\', \'_blank\')" style="width:160px; height:80px;" class="btn btn-info">Guarda la Factura en Exel</button>
                            <script>capture(' . $j . ');</script>
                        </div>
                    </div><br><br><br>';
                }
				?>
                <br><br>
                <button class="btn btn-danger btn-lg" onclick="window.close()">Cierra Esta Ventana</button>
                <br><br><br><br><br>
				</div>
            </div>
        <div class="col-md-1"></div>
    </div>
</section>
<?php
include "includes/footer.html";
?>