<?php
include "includes/conn.php";
$title = "Facturación de La Peluquería de Javier Borneo";
include "includes/header.php";

$stmt = $conn->prepare("SET lc_time_names = 'es_ES'");
$stmt->execute();
$sql = "SELECT *, DATE_FORMAT(date,'%d %M %Y') as date FROM invoice ORDER BY id desc limit 1";
$stmt = $conn->prepare($sql);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_OBJ);
$id = $row->id;
$client = getClient($conn, $row->client_id);

$service_id = $row->service_id;
$services = explode(",", $service_id);
$service = "";
$price = "";
getService($conn, $services);

$qtties = $row->qtty;
$qttys = explode(",", $qtties);
$qtty = "";
for ($i = 0; $i < count($qttys); $i++)
{
    $qtty .= $qttys[$i] . "<br>";
}
$total = $row->total;
$iva = $row->iva;
$date = $row->date;
$time = $row->time;
?>
<img alt="logo" src="img/logo.jpg" height="300" width="100%"/>
<br>
<section class="container-fluid pt-3">
    <div class="row">
        <div class="col-md-1" style="width: 2%;"></div>
            <div class="col-md-10">
                <div id="view1">
					<br><br>
                    <h1>Última Factura</h1>
                    <br>
					<?php
					echo '<div id="printable0">
					<h3>La Peluquería de Javier Borneo - C.U.I.T. Nº 20-22506157-3</h3>
					<h4>Factura Nº: ' . $id . ' a: ' . $client . '</h4>
						<div class="row">
                            <div style="width: 1px;"></div>
                            <div class="column left" style="background-color:#d0d0d0;">
                            Servicio
                            </div>
                            <div class="column middle" style="background-color:#d8d8d8; text-align:right;">
                            Precio
                            </div>
                            <div class="column right" style="background-color:#dedede; text-align:right;">
                            Cantidad
                            </div>
                            <div class="column moreright" style="background-color:#e0e0e0; text-align:right;">
                            Base Imponible
                            </div>
                            <div class="column moreright" style="background-color:#e8e8e8; text-align:right;">
                            I.V.A.
                            </div>
                            <div class="column moreright" style="background-color:#efefef; text-align:right;">
                            Total
                            </div>
						</div>
						<div class="row">
                            <div style="width: 1px;"></div>
                            <div class="column left" style="background-color:#d0d0d0;">';
                            echo $service;
                            echo '</div>
                            <div class="column middle" style="background-color:#d8d8d8; text-align:right;">';
                            echo $price;
                            echo '</div>
                            <div class="column right" style="background-color:#dedede; text-align:right;">';
                            echo $qtty;
                            echo '</div>
                            <div class="column moreright" style="background-color:#e0e0e0; text-align:right;">';
                            echo number_format((float)$total * 100 / 121, 2, ',', '.') . " $";
                            echo '</div>
                            <div class="column moreright" style="background-color:#e8e8e8; text-align:right;">';
                            echo number_format((float)$iva, 2, ',', '.') . " $";
                            echo '</div>
                            <div class="column moreright" style="background-color:#efefef; text-align:right;">';
                            echo number_format((float)$total, 2, ',', '.') . " $";
                            echo '</div>
                        </div>
                        <div class="row">
					    <div class="column total" style="background-color:#000; text-align:right; color:white; margin-left:33.4%">Total I.V.A. Incluido: ' . number_format((float)$total, 2, ",", ".") . ' $</div></div>
					</div>
                    <a id="image0" download="Factura a: ' . $client . '.png"></a>
                    <br><br><br>
                    <div class="row">
                    <div class="col-md-4">
                    <button onclick="printIt(-1)" style="width:160px; height:80px;" class="btn btn-primary">Imprimir Ticket</button>
                    </div>
                    <div class="col-md-6">
                    <button onclick="window.open(\'saveIt.php?id=' . $id . '\', \'_blank\')" style="width:160px; height:80px;" class="btn btn-info">Guardar Factura en Exel</button>
                    <script>capture(0);</script>
                    </div>
                    </div>';
					?>
                    <br><br>
                    <button class="btn btn-danger" onclick="window.close()">Cierra Esta Ventana</button>
                    <br><br><br><br>
				</div>
            </div>
        <div class="col-md-1" style="width: 2%;"></div>
    </div>
</section>
<?php
include "includes/footer.html";

function getClient($conn, $id)
{
    if ($id == null)
    {
        $id = "Consumidor Final";
        return $id;
    }
    else
    {
        $sql = "SELECT name FROM clients WHERE id=$id";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $row_client = $stmt->fetch(PDO::FETCH_OBJ);
        $id = $row_client->name;
        return $id;
    }
}

function getService($conn, $services)
{
    global $service, $price;
    for ($i = 0; $i < count($services) - 1; $i++)
    {
        $sql = "SELECT service, price FROM services WHERE id='$services[$i]'";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $row_service = $stmt->fetch(PDO::FETCH_OBJ);
        $service .= $row_service->service . "<br>";
        $price .= $row_service->price . " $<br>";
    }
}
?>