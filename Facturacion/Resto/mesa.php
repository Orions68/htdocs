<?php
include "inc/fw.php";
$table = $_GET['table'];
if (isset($_POST['invoice']))
{
    $wait = $_POST["wait"];
	$invoice = $_POST['invoice'];
	$record = explode (":", $invoice);
	for ($i = 2; $i <= count($record); $i+=2)
	{
		switch($i)
		{
			case 2:
			$mesa10 = $record[0] . ';' . $record[1];
			break;
			case 4:
			$mesa11 = $record[2] . ';' . $record[3];
			break;
			case 6:
			$mesa12 = $record[4] . ';' . $record[5];
			break;
			case 8:
			$mesa13 = $record[6] . ';' . $record[7];
			break;
			case 10:
			$mesa14 = $record[8] . ';' . $record[9];
			break;
			case 12:
			$mesa15 = $record[10] . ';' . $record[11];
			break;
			case 14:
			$mesa16 = $record[12] . ';' . $record[13];
			break;
			case 16:
			$mesa17 = $record[14] . ';' . $record[15];
			break;
		}
	}
}
if (!isset($_POST["wait"]))
{
    $wait = 0;
}
$title = "Pedido de la Mesa:" . $table;
include "inc/header.php";
?>
<h2>Facturando : <?php echo $table ?></h2>
<br><br>
<section class="container-fluid pt-3">
<div id="view1">
<div id="pc"></div>
<div id="mobile"></div>
<div class="row">
	<div class="col-md-1"></div>
		<div class="col-md-10">
			<label><select name="plate" id="meal">
                <option value="">Selecciona un Plato</option>
			<?php
			$stmt = $conn->prepare('SELECT * FROM foods WHERE kind=0');
			$stmt->execute();
			while($row = $stmt->fetch(PDO::FETCH_OBJ))
			{
				echo  '<option value="' . $row->id . ',' . $row->food . ',' . $row->food_price . '">' . $row->food . ', ' . $row->food_price . '</option>';
			}
			?>
			</select> Plato seleccionado por el Cliente&nbsp;&nbsp;&nbsp;</label>
			<label><select name="qtty" id="qtty">
				<option value=1>1</option>
				<option value=2>2</option>
				<option value=3>3</option>
				<option value=4>4</option>
				<option value=5>5</option>
				<option value=6>6</option>
				<option value=7>7</option>
				<option value=8>8</option>
				<option value=9>9</option>
				<option value=10>10</option>
			</select> Cantidad de Platos&nbsp;&nbsp;</label>
			<button onclick="add_plate()" style="width:80px; height:60px;" class="btn btn-info">Agregar Plato</button>
		</div>
	<div class="col-md-1"></div>
</div>
<br><br><br>
<div class="row">
	<div class="col-md-1"></div>
		<div class="col-md-10">
			<label><select name="bever" id="bev">
            <option value="">Selecciona una Bebida</option>
			<?php
			$stmt = $conn->prepare('SELECT * FROM foods WHERE kind=1');
			$stmt->execute();
			while($row = $stmt->fetch(PDO::FETCH_OBJ))
			{
				echo  '<option value="' . $row->id . ',' . $row->food . ',' . $row->food_price . '">' . $row->food . ', ' . $row->food_price . '</option>';
			}
			?>
			</select> Bebida Seleccionada por el Cliente</label>
			<label><select name="qtty2" id="qtty2">
				<option value=1>1</option>
				<option value=2>2</option>
				<option value=3>3</option>
				<option value=4>4</option>
				<option value=5>5</option>
				<option value=6>6</option>
				<option value=7>7</option>
				<option value=8>8</option>
				<option value=9>9</option>
				<option value=10>10</option>
			</select> Cantidad de Bebidas</label>
			<button onclick="add_bebida()" style="width:80px; height:60px;" class="btn btn-info">Agregar Bebida</button>
		</div>
	<div class="col-md-1"></div>
</div>
<br><br><br>
<div class="row">
	<div class="col-md-1"></div>
		<div class="col-md-10">
			<label><select name="dessert" id="dess">
            <option value="">Selecciona un Postre</option>
			<?php
			$stmt = $conn->prepare('SELECT * FROM foods WHERE kind=2');
			$stmt->execute();
			while($row = $stmt->fetch(PDO::FETCH_OBJ))
			{
				echo  '<option value="' . $row->id . ',' . $row->food . ',' . $row->food_price . '">' . $row->food . ', ' . $row->food_price . '</option>';
			}
			?>
			</select> Postre Seleccionado por el Cliente&nbsp;</label>
			<label><select name="qtty3" id="qtty3">
				<option value=1>1</option>
				<option value=2>2</option>
				<option value=3>3</option>
				<option value=4>4</option>
				<option value=5>5</option>
				<option value=6>6</option>
				<option value=7>7</option>
				<option value=8>8</option>
				<option value=9>9</option>
				<option value=10>10</option>
			</select> Cantidad de Postres&nbsp;</label>
			<button onclick="add_postre()" style="width:80px; height:60px;" class="btn btn-info">Agregar Postre</button>
		</div>
	<div class="col-md-1"></div>
</div>
<br><br>
<form action='addInvoice.php' method="post">
    <label><select name="client" style="width: 600px;">
            <option value="0">Consumidor Final</option>
            <?php
            $sql = "SELECT id, name from delivery";
            $stmt = $conn->prepare($sql);
            $stmt->execute();
            if ($stmt->rowCount() > 0)
            {
                while ($row = $stmt->fetch(PDO::FETCH_OBJ))
                {
                    echo '<option value=' . $row->id . '>' . $row->name . '</option>';
                }
            }
            ?>
    </select> Nombre del Cliente a Facturar</label>
    <input type="hidden" name="table" value="<?php echo $table; ?>">
    <input type="hidden" name="invoice" id="invoice">
    <input type="hidden" name="wait" value="<?php echo $wait; ?>">
    <br><br>
    <input type="submit" style="width:128px; height:60px;" value="Facturar" class="btn btn-primary">
</form>
<br>
<br>
<h2 id="platos" style="font-size:xx-large"></h2>
<h4 id="plate"></h4>
</div>
</section>
<?php
if (isset($_POST['invoice']))
{
	for ($i = 2; $i <= count($record); $i+=2)
	{
		switch($i)
		{
			case 2:
			echo '<script>addData("' . $mesa10 . '")</script>';
			break;
			case 4:
			echo '<script>addData("' . $mesa11 . '")</script>';
			break;
			case 6:
			echo '<script>addData("' . $mesa12 . '")</script>';
			break;
			case 8:
			echo '<script>addData("' . $mesa13 . '")</script>';
			break;
			case 10:
			echo '<script>addData("' . $mesa14 . '")</script>';
			break;
			case 12:
			echo '<script>addData("' . $mesa15 . '")</script>';
			break;
			case 14:
			echo '<script>addData("' . $mesa16 . '")</script>';
			break;
			case 16:
			echo '<script>addData("' . $mesa17 . '")</script>';
			break;
			case 18:
			echo '<script>addData("' . $mesa18 . '")</script>';
			break;	
		}
	}
}
echo "<button style='float:right; width:128px; height:64px;' onclick='deleting(" . '"' . $table . '"' . ")'  class='btn btn-danger'>Anular Factura</button><br><br><br>";
?>
<?php
include "inc/footer.html";
?>