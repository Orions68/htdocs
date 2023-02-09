<?php
include "inc/fw.php";
include "inc/modal-update.html";
$title = "Modificar/Eliminar un Artículo";
include "inc/header.php";

if (isset($_POST["id"]))
{
	if (!isset($_POST["price"]))
	{
		$id = $_POST['id'];
		$product = $_POST['product'];
		$stmt = $conn->prepare("DELETE FROM foods WHERE id=$id");
		$stmt->execute();
		echo "<script>toast(2, 'Producto Quitado:', 'El Producto " . $product . " ha Sido Quitado Correctamente.');</script>";
	}
	else
	{
		$product = $_POST['product'];
		$price = $_POST['price'];
		$kind = $_POST['kind'];
		$id = $_POST['id'];
        $stmt = $conn->prepare("UPDATE foods SET food='$product', food_price=$price, kind='$kind' WHERE id=$id");
		$stmt->execute();
		echo "<script>toast(0, 'Todo Ha Ido Bien:', 'Producto : " . $product . " Modificado correctamente.');</script>";
	}
}

?>
<section class="container-fluid pt-3">
<div id="pc"></div>
    <div id="mobile"></div>
    <div class="row">
        <div class="col-md-1" style="width: 2%;"></div>
            <div class="col-md-10">
                <div id="view1">
                    <br><br>
					<h1>Menú Para Modificar o Eliminar los Productos.</h1>
					<?php
                    $kind = 
					$stmt = $conn->prepare('SELECT * FROM foods ORDER BY kind ASC');
					$stmt->execute();
					while($row = $stmt->fetch(PDO::FETCH_OBJ))
					{
						echo '<br>
						<div style="border:4px solid blue;">
						<form action="" method="post">
						<input type="hidden" name="id" value="' . $row->id . '">
						<label><input type="text" name="product" value="' . $row->food . '" style="width: 480px;"> Producto</label>
						<br><br>
						<label><input type="number" step=".05" name="price" value="' . $row->food_price . '"> Precio</label>
						<br><br>
						<input type="hidden" name="kind" value="' . $row->kind . '">
						<input type="submit" value="Modificar" style="width:160px; height:60px;" class="btn btn-success">
						</form>
						<form action="" method="post">
						<input type="hidden" name="id" value="' . $row->id . '">
						<input type="hidden" name="product" value="' . $row->food . '">
						<br><br>
						<input type="submit" value="Borrar Producto." style="width:160px; height:60px;" class="btn btn-danger">
						</form>
						</div>';
					}
					?>
					<br><br>
					<button class="btn btn-danger" style="width:160px; height:80px;" onclick="window.close()">Cierra Esta Ventana</button>
					<br>
				</div>
            </div>
        <div class="col-md-1" style="width: 2%;"></div>
    </div>
</section>
<?php
include "inc/footer.html";
?>