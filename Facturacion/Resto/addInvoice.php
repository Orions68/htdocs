<?php
include "inc/fw.php";

if (isset($_POST["table"]))
{
    $table = $_POST['table'];
    if (file_exists($table . ".txt"))
    {
        unlink($table . ".txt");
    }
    $client = $_POST["client"];
    $invoice = $_POST['invoice'];
    $wait = $_POST["wait"];
    $date = date("Y-m-d");
    $time = date("H:i:s");
    $article = "";
    $qtty1 = "";
    $prices = "";
    $part = "";
    $total = 0;
    $j = 0;

    $record = explode (",", $invoice);
    for ($i = 0; $i < count($record) - 1; $i+=4)
    {
        $id[$j] = $record[$i];
        $product[$j] = $record[$i + 1];
        $price[$j] = $record[$i + 2];
        $qtty[$j] = $record[$i + 3];
        $partial[$j] = $price[$j] * $qtty[$j];
        $total += $partial[$j];
        $j++;
    }

    $totaliva = $total * 1.21;

    for ($i = 0; $i < count($id); $i++)
    {
        $article .= $id[$i] . ",";
        $qtty1 .= $qtty[$i] . ",";
        $prices .= $price[$i] . ",";
        $part .= $partial[$i] . ",";
    }
}
include "inc/modal-invoice.html";
$title = "Guardando Factura";
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
                    $stmt = $conn->prepare('INSERT INTO invoice VALUES(:id, :client, :wait_id, :tabl, :article, :price, :qtty, :partial, :total, :totaliva, :date, :time)');
                    $stmt->execute(array(':id' => null, ':client' => $client, ':wait_id' => $wait, ':tabl' => $table, ':article' => $article, ':price' => $prices, ':qtty' => $qtty1, ':partial' => $part, ':total' => $total, ':totaliva' => $totaliva, ':date' => $date, ':time' => $time));
                    echo "<script>toast('0', 'Facturado', 'Factura de monto: " . $totaliva . " Alamacenada en la Base de Datos Correctamente.');</script>";
                    ?>
                </div>
            </div>
        <div class="col-md-1"></div>
    </div>
</section>
<?php
include "inc/footer.html";
?>