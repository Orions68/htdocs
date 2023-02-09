<?php
include "includes/conn.php";
$title = "Modificar/Eliminar un Artículo";
include "includes/header.php";
include "includes/modal-update.html";

if (isset($_POST["id"]))
{
	if (!isset($_POST["price"]))
	{
		$id = $_POST['id'];
		$product = $_POST['product'];
		$stmt = $conn->prepare("DELETE FROM products WHERE id=$id");
		$stmt->execute();
		echo "<script>toast(2, 'Producto Quitado:', 'El Producto " . $product . " ha Sido Quitado Correctamente.');</script>";
	}
	else
	{
		$product = $_POST['product'];
		$price = $_POST['price'];
		$stock = $_POST['stock'];
		$kind = $_POST['kind'];
		$brand = $_POST['brand'];
		$id = $_POST['id'];
		$description = $_POST["description"];
		$path = htmlspecialchars($_FILES["img"]["name"]);
		if ($path != "")
		{
			$tmp = htmlspecialchars($_FILES["img"]["tmp_name"]);
			$img = "img/" . basename($path);
			move_uploaded_file($tmp, $img);
			$stmt = $conn->prepare("UPDATE products SET product='$product', price=$price, stock=stock + $stock, img='$img', kind='$kind', brand='$brand', description='$description' WHERE id=$id");
		}
		else
		{
			$stmt = $conn->prepare("UPDATE products SET product='$product', price=$price, stock=stock + $stock, kind='$kind', brand='$brand', description='$description' WHERE id=$id");
		}
		$stmt->execute();
		echo "<script>toast(0, 'Todo Ha Ido Bien:', 'Producto : " . $product . " Modificado correctamente.');</script>";
	}
}

?>
<img alt="logo" src="img/logo.webp" height="300" width="100%"/>
<br>
<section class="container-fluid pt-3">
    <div class="row">
        <div class="col-md-1" style="width: 2%;"></div>
            <div class="col-md-10">
                <div id="view1">
                    <br><br>
					<h1>Menú Para Modificar o Eliminar los Productos.</h1>
					<?php
					$stmt = $conn->prepare('SELECT * FROM products');
					$stmt->execute();
					while($row = $stmt->fetch(PDO::FETCH_OBJ))
					{
						echo '<br>
						<div style="border:4px solid blue;">
						<form action="" method="post" enctype="multipart/form-data">
						<input type="hidden" name="id" value="' . $row->id . '">
						<label><input type="text" name="product" value="' . $row->product . '" style="width: 480px;"> Producto</label>
						<br><br>
						<label><input type="number" name="price" value="' . $row->price . '"> Precio</label>
						<br><br>
						<label><input type="number" name="stock" value="' . $row->stock . '"> Stock</label>
						<br><br>
						<label><select name="kind" required>
							<option value="' . $row->kind . '">' . $row->kind . '</option>
							<option value="Producto1">Producto1</option>
							<option value="Producto2">Producto2</option>
							<option value="Producto3">Producto3</option>
							<option value="Producto4">Producto4</option>
							<option value="Producto5">Producto5</option>
							<option value="Producto6">Producto6</option>
							<option value="Producto7">Producto7</option>
							</select> Grupo</label>
						<br><br>
						<label><select name="brand" required>
							<option value="' . $row->brand . '">' . $row->brand . '</option>
							<option value="Marca1">Marca1</option>
							<option value="Marca2">Marca2</option>
							<option value="Marca3">Marca3</option>
							<option value="Marca4">Marca4</option>
							<option value="Marca5">Marca5</option>
							<option value="Marca6">Marca6</option>
							<option value="Marca7">Marca7</option>
						</select> Fabricante</label>
						<br><br>
						<label><input type="text" name="description" value="' . $row->description . '"> Descripción</label>
						<br><br>
						<label><input type="file" name="img"> Foto del Producto Ofrecido</label>
						<br><br>
						<input type="submit" value="Modificar" style="width:160px; height:60px;" class="btn btn-success">
						</form>
						<form action="" method="post">
						<input type="hidden" name="id" value="' . $row->id . '">
						<input type="hidden" name="product" value="' . $row->product . '">
						<br><br>
						<input type="submit" value="Borrar Producto." style="width:160px; height:60px;" class="btn btn-danger">
						</form>
						</div>';
					}
					?>
					<br><br>
					<input type="button" value="Cierra esta Ventana" onclick="window.close()">
					<br>
				</div>
            </div>
        <div class="col-md-1" style="width: 2%;"></div>
    </div>
</section>
<?php
include "includes/footer.html";
?>