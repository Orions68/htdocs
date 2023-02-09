<?php
include "includes/conn.php";
$title = "Agregando Producto";
include "includes/header.php";
include "includes/modal-dismiss.html";
// Este script recibe los datos de un nuevo producto que se agregará a la base de datos.
$product = $_POST['product'];
$price = $_POST['price'];
$stock = $_POST['stock'];
$kind = $_POST['kind'];
$brand = $_POST['brand'];
$description = $_POST["description"];
$path = htmlspecialchars($_FILES["img"]["name"]);
$tmp = htmlspecialchars($_FILES["img"]["tmp_name"]);
$img = "img/" . basename($path);
move_uploaded_file($tmp, $img);
$stmt = $conn->prepare('INSERT INTO products VALUES(:id, :product, :price, :stock, :img, :kind, :brand, :description)');
$stmt->execute(array(':id' => null, ':product' => $product, ':price' => $price, ':stock' => $stock, ':img' => $img, ':kind' => $kind, ':brand' => $brand, ':description' => $description));
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
                    <script>toast('0', 'El Producto : <?php echo $product;?>', 'Se ha agregado correctamente.');</script>
                    <br><br>
                </div>
            </div>
        <div class="col-md-1"></div>
    </div>
</section>
<?php
include "includes/footer.html";
?>