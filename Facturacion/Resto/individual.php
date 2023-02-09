<?php
include "inc/fw.php";
$title = "Facturas por Días";
include "inc/header.php";
include "inc/modal.html";

if (isset($_POST["date"]))
{
    $date = $_POST["date"];
    $mydate = explode("-", $date);
    $mdate = $mydate[2] . "/" . $mydate[1] . "/" . $mydate[0];
    $product = "";
	$price = "";
	$qtty = "";

    $stmt = $conn->prepare("SET lc_time_names = 'es_ES'");
	$stmt->execute();

    $sql = "SELECT *, DATE_FORMAT(date,'%d %M %Y') as date FROM invoice WHERE date='$date'";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetchAll();
    ?>
<section class="container-fluid pt-3">
    <div class="row">
    <div id="pc"></div>
	<div id="mobile"></div>
        <div class="col-md-1" style="width:3%;"></div>
            <div class="col-md-10">
                <div id="view1">
                <br><br>
                <h3 style="text-align: center;">Facturas del Día <?php echo $mdate; ?></h3>
                <br>
                <table>
                    <tr>
                    <th>Nº de factura</th>
                    <th>Camarero</th>
                    <th>Mesa</th>
                    <th>Cliente</th>
                    <th>Producto</th>
                    <th>Precio</th>
                    <th>Cantidad</th>
                    <th>Hora</th>
                    <th>Día</th>
                    <th>Base Imponible</th>
                    <th>I.V.A.</th>
                    <th>Pago de I.V.A.</th>
                    <th>Total + I.V.A.</th>
                    <th style="color: red;">BORRAR</th>
                    </tr>
                    
<?php
    foreach($result as $row)
	{
        $eacharticle = [];
        $table = $row["tabl"];
        $wait = $row["wait_id"];
        if ($wait == 0)
        {
            $wait = "La Casa";
        }
        else
        {
            $sql = "SELECT name FROM wait WHERE id=$wait";
            $stmt = $conn->prepare($sql);
            $stmt->execute();
            $pro = $stmt->fetch(PDO::FETCH_OBJ);
            $wait = $pro->name;
        }
        $client = $row["client"];
        if ($client == 0)
        {
            $client = "Consumidor Final";
        }
        else
        {
            $sql = "SELECT name FROM delivery WHERE id=$client";
            $stmt = $conn->prepare($sql);
            $stmt->execute();
            $cli = $stmt->fetch(PDO::FETCH_OBJ);
            $client = $cli->name;
        }
        $productArray = explode(",", $row["article"]);
        $qttyArray = explode(",", $row["qtty"]);
        for ($i = 0; $i < count($productArray) - 1; $i++)
        {
            $eacharticle[$i] = explode(":", $productArray[$i]);
            $product_price = getProduct($conn, $eacharticle[$i][1]);
            $preproduct = explode(",", $product_price);
            if ($i == count($productArray) - 2)
            {
                $product .= $preproduct[0];
                $price .= $preproduct[1] . " $";
                $qtty .= $qttyArray[$i];
            }
            else
            {
                $product .= $preproduct[0] . "<br>";
                $price .= number_format((float)$preproduct[1], 2, ',', '.') . " $<br>";
                $qtty .= $qttyArray[$i] . "<br>";
            }
        }

        echo '<tr>
        <td>' . $row["id"] . '</td>
        <td>' . $wait . '</td>
        <td>' . $table . '</td>
        <td>' . $client . '</td>
        <td>' . $product . '</td>
        <td>' . $price . '</td>
        <td>' . $qtty . '</td>
        <td>' . $row["time"] . '</td>
        <td>' . $row["date"] . '</td>
        <td>' . number_format((float)$row["total"], 2, ',', '.') . ' $</td>
        <td>21%</td>
        <td>' . number_format((float)$row["total"] * .21, 2, ',', '.') . ' $</td>
        <td>' . number_format((float)$row["totaliva"], 2, ',', '.') . ' $</td>
        <td><form action="delinvoice.php" method="post">
            <input type="hidden" name="id" value="' . $row["id"] . '">
            <input type="submit" value="Quitar" class="btn btn-danger">
            </form>
        </td>
        </tr>';
        $product = "";
		$price = "";
		$qtty = "";
	}
    ?>
                    </table>
                        </div>
                    </div>
                <div class="col-md-1" style="width:3%;"></div>
            </div>
        </section>
        <br>
        <br>
	    <button class="btn btn-danger" style="width:160px; height:80px;" onclick="window.close()">Cierra Esta Ventana</button>
        <br>
<?php
}
include "inc/footer.html";

function getProduct($conn, $product_id)
{
    $sql_product = "SELECT food, food_price FROM foods WHERE id='$product_id'";
    $stmt = $conn->prepare($sql_product);
    $stmt->execute();
    $row_product = $stmt->fetch(PDO::FETCH_OBJ);
    return $row_product->food . "," . $row_product->food_price;
}
?>