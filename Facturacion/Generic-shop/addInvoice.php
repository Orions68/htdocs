<?php
// Este script guarda las facturas en la base de datos.
include "includes/conn.php";
$title = "Guardando la Factura";
include "includes/header.php";
include "includes/modal-dismiss.html";
$j = 0;
$product = [];
for ($i = 0; $i < (count($_POST) - 4) / 3; $i++) // Hago un bucle a la cantidad de artículos recibidos descontando los artículos individuales que son 4 y divido por 3 que son arrays.
{
    $id[$i] = $_POST["id" . $i]; // id, iva y qtty vienen como id0, id1, id2, etc.
    $iva[$i] = $_POST["iva". $i];
    $qtty[$i] = $_POST["qtty" . $i];

    $sql = "UPDATE products SET stock=stock - $qtty[$i] WHERE id=$id[$i]"; // Descuento de la base de datos el stock de los artículos comprados.
    $stmt = $conn->prepare($sql);
    $stmt->execute();

    $sql = "SELECT * FROM products WHERE id=$id[$i]";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    if ($stmt->rowCount() > 0)
    {
        while($row = $stmt->fetch(PDO::FETCH_OBJ))
        {
            if ($row->stock <= 5) // Si el stock de alguno de los productos comprados es menor o igual a 5.
            {
                $product[$j] = $row->product . " Queda en: " . $row->stock . " Artículos."; // Pongo en el array $product el nombre del producto y la cantidad que queda de él.
                $j++;
            }
        }
    }
}

if (count($product) > 0) // Si el array $product contiene algún dato.
{
    for ($i = 0; $i < count($product); $i++) // Hago un bucle a la cantidad de datos en $product.
    {
        echo "<script>toast('1', 'Cuidado el Stock de: ', " . $product[$i] . ");</script>"; // Muestro un aviso que quedan pocas unidades de los productos en el array $product.
    }
}

$name = $_POST['username'];
if (!empty($_SESSION["client"]))
{
    $client_id = $_SESSION["client"];
}
else
{
    $client_id = null;
}
$total = $_POST["total"];
$date = $_POST['date'];
$time = $_POST['time'];
$iva1 = 0;
$products = "";
$qtty1 = "";
for ($i = 0; $i < count($id); $i++)
{
    $products .= $id[$i] . ",";
    $qtty1 .= $qtty[$i] . ",";
    $iva1 += $iva[$i];
}
$stmt = $conn->prepare('INSERT INTO invoice VALUES(:id, :client_id, :product_id, :qtty, :total, :iva, :date, :time)');
$stmt->execute(array(':id' => null, ':client_id' => $client_id, ':product_id' => $products, ':qtty' => $qtty1, ':total' => $total, ':iva' => $iva1, ':date' => $date, ':time' => $time));
// Estas líneas agregan la factura a la base de datos.
?>
<img alt="logo" src="img/logo.webp" height="300" width="100%"/>
<br>
<section class="container-fluid pt-3">
    <div class="row">
	<div id="pc"></div>
	<div id="mobile"></div>
        <div class="col-md-1"></div>
            <div class="col-md-10">
                <div id="view1">
                    <br><br><br><br>
                    <script>toast('0', 'Factura de Monto: <?php echo number_format((float)$total, 2, ",", ".");?>', 'Almacenada Correctamente en la base de datos.');</script>
					<br><br>
				</div>
            </div>
        <div class="col-md-1"></div>
    </div>
</section>
<?php
include "includes/footer.html";
?>