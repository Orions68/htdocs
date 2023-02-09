<?php
include "inc/fw.php";
$name = $_POST['product'];
$price = $_POST['price'];
$id = $_POST['kind'];

$stmt = $conn->prepare('INSERT INTO foods VALUES(:id, :food, :food_price, :kind)');
$stmt->execute(array(':id' => null, ':food' => $name, ':food_price' => $price, ':kind' => $id));
echo "<script>if (!alert('Artículo : " . $name . " Agregado Correctamente.')) window.close('_self')</script>";
$title = "Artículo Agregado";
include "inc/header.php";
?>
<section class="container-fluid pt-3">
    <div id="pc"></div>
    <div id="mobile"></div>
    <div class="row">
        <div class="col-md-1"></div>
            <div class="col-md-10">
                <div id="view1">
                </div>
            </div>
        <div class="col-md-1"></div>
    </div>
</section>
<?php
include "inc/footer.html";
?>