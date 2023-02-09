<?php
include "inc/fw.php";
include "inc/function.php";
$table = $_POST['table'];
$date = $_POST['date'];
$latin = explode("-", $date);
$title = "Facturas de $table";
include "inc/header.php";
?>
<section class="container-fluid pt-3">
<div id="pc"></div>
    <div id="mobile"></div>
    <div class="row">
        <div class="col-md-1"></div>
            <div class="col-md-10">
                <div id="view1">
					<?php
                    if ($table == "")
                    {
                        echo "<h1>Facturas de Fecha: " . $latin[2] . '/' . $latin[1] . '/' . $latin[0] . "</h1>";
                        $stmt = $conn->prepare("SELECT *, DATE_FORMAT(date,'%d %M %Y') as date FROM invoice WHERE date='$date' ORDER BY date DESC, time DESC");
                    }
                    else
                    {
                        if ($date == "")
                        {
                            echo "<h1>Facturas de: $table</h1>";
                            $stmt = $conn->prepare("SELECT *, DATE_FORMAT(date,'%d %M %Y') as date FROM invoice WHERE tabl='$table' ORDER BY date DESC, time DESC");
                        }
                        else
                        {
                            echo "<h1>Facturas de: $table con Fecha: " . $latin[2] . '/' . $latin[1] . '/' . $latin[0] . "</h1>";
                            $stmt = $conn->prepare("SELECT *, DATE_FORMAT(date,'%d %M %Y') as date FROM invoice WHERE tabl='$table' AND date='$date' ORDER BY date DESC, time DESC");
                        }
                    }
                    $stmt_date = $conn->prepare("SET lc_time_names = 'es_ES'");
                    $stmt_date->execute();
                    $stmt->execute();
                    if ($stmt->rowCount() > 0)
                    {
                        $j = 0;
                        while($row = $stmt->fetch(PDO::FETCH_OBJ))
                        {
                            $id = $row->id;
                            $total = $row->total;
                            $totaliva = $row->totaliva;
                            // $partial = explode(",", $row->partial);
                            $wait = $row->wait_id;
                            if ($wait == 0)
                            {
                                $wait = "Fonda 13";
                            }
                            else
                            {
                                $sql = "SELECT name FORM wait WHERE id=$wait";
                                $stmt = $conn->prepare($sql);
                                $stmt->execute();
                                $row = $stmt->fetch(PDO::FETCH_OBJ);
                                $wait = $row->name;
                            }
                            echo '<div id="printable' . $j . '">
                                <h3><br>Fonda 13 - A25000000-2 Calle Santa María de Oro 47, 7600 Mar del Plata</h3>
                                <br><h2>Factura Nº ' . $id . ' Mesa: ' . $row->tabl . ' Atendida por: ' . $wait . '</h2>
                                <h2>Fecha : ' . $row->date . ' - ' . $row->time . '</h2>
                                <div class="row">
                                    <div style="width: 1px;"></div>
                                    <div class="column last" style="background-color:#d0d0d0;">
                                    <h4>Cliente</h4>
                                    </div>
                                    <div class="column left" style="background-color:#d8d8d8;">
                                    <h3>Artículo</h3>
                                    </div>
                                    <div class="column right" style="background-color:#dedede;">
                                    <h3>Precio</h3>
                                    </div>
                                    <div class="column middle" style="background-color:#e0e0e0;">
                                    <h4>Cantidad</h4>
                                    </div>
                                    <div class="column right" style="background-color:#e8e8e8;">
                                    <h3>Parcial</h3>
                                    </div>
                                    <div class="column right" style="background-color:#eeeeee;">
                                    <h4>Total</h4>
                                    </div>
                                    <div class="column right" style="background-color:#f0f0f0; text-align: center;">
                                    <h4>I.V.A.</h4>
                                    </div>
                                    <div class="column last" style="background-color:#f8f8f8;">
                                    <h4>Pago de I.V.A.</h4>
                                    </div>
                                </div>';

                                result($conn, $row, 1, 1); // Llama a la función result, le pasa la conexión y el resultado de la base de datos.

                                echo '<div class="row">
                                    <div style="width: 1px;"></div>
                                    <div class="column last" style="background-color:#d0d0d0;">
                                    <h5>' . $client . '</h5>
                                    </div>
                                    <div class="column left" style="background-color:#d8d8d8;">
                                    <h5>' . $product . '</h5>
                                    </div>
                                    <div class="column right" style="background-color:#dedede;">
                                    <h5>' . $price . '</h5>
                                    </div>
                                    <div class="column middle" style="background-color:#e0e0e0;">
                                    <h5>' . $qtty . '</h5>
                                    </div>
                                    <div class="column right" style="background-color:#e8e8e8;">
                                    <h5>' . $partial . '</h5>
                                    </div>
                                    <div class="column right" style="background-color:#eeeeee;">
                                    <h5>' . number_format((float)$total, 2, ",", ".") . ' $</h5>
                                    </div>
                                    <div class="column right" style="background-color:#f0f0f0; text-align: center;">
                                    <h5>21 %</h5>
                                    </div>
                                    <div class="column last" style="background-color:#f8f8f8;">
                                    <h5>' . number_format((float)$total * .21, 2, ",", ".") . ' $</h5>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="column total">Total I.V.A. Incluido: ' . number_format((float)$totaliva, 2, ",", ".") . ' $
                                </div></div>
                            </div>
                        <a id="image' . $j . '" download="Factura de: ' . $table . '.png"></a>
                        <br><br><br>
                        <div class="row">
                            <div class="col-md-4">
                            <button onclick="printIt(' . $j . ')" style="width:160px; height:80px;" class="btn btn-primary">Imprimir Ticket</button>
                            </div>
                            <div class="col-md-6">
                            <button onclick="window.open(\'saveIt.php?id=' . $id . '\', \'_blank\')" style="width:160px; height:80px;" class="btn btn-info">Guardar Factura en Excel</button>
                            <script>capture(' . $j . ');</script>
                            </div>
                        </div>
                                    <br><br>';
                                    $product = "";
                                    $price = "";
                                    $qtty = "";
                                    $partial = "";
                            echo '<br><br><br><br>';
                            $j++;
                        }
                    }
					?>
                    <br><br>
                    <button class="btn btn-danger" style="width:160px; height:80px;" onclick="window.close()">Cierra Esta Ventana</button>
				</div>
            </div>
        <div class="col-md-1"></div>
    </div>
</section>
<?php
include "inc/footer.html";
?>