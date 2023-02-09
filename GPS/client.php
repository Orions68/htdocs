<?php
include "includes/fw.php";
$id = $_GET['id'];
if (isset($_POST['invoice']))
{
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
?>
<!DOCTYPE html>
<html>
<head>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type">
<script src="inc/functions.js"></script>
<title><?php echo $id ?></title>
</head>
<body>
<img alt="logo" src="pics/logo.png" height="150" width="75%"/>
<br>
<div>Facturando : <?php echo $id ?></div>
<?php
echo '<form action="invoice.php?table=' . $id . '" method="post">';
?>
<input type="text" id="meal" name="plate" list="meales" placeholder="Plato" style="width:480px; height:80px; font-size:x-large;">
<datalist id="meales" >
<?php
$stmt = $conn->prepare('SELECT * FROM meal');
$stmt->execute();
while($row = $stmt->fetch(PDO::FETCH_OBJ))
{
	echo  '<option value="' . $row->meal . ',' . $row->price_meal . '"/>';
}
?>
</datalist>
<input type="number" id="quantity" name="quantity" min="0" max="99" placeholder="Cantidad" list="quantities" style="width:240px; height:80px; font-size:x-large;">
<datalist id="quantities">
	<option value=1>
	<option value=2>
    <option value=3>
</datalist>
<button type="button" onclick="add_plate()" style="width:80px; height:60px;">Agregar</button>
<br>
<br>
<input type="text" id="bev" name="bever" list="beverages" placeholder="Bebidas" style="width:480px; height:80px; font-size:x-large;">
<datalist id="beverages" >
<?php
$stmt = $conn->prepare('SELECT * FROM drink');
$stmt->execute();
while($row = $stmt->fetch(PDO::FETCH_OBJ))
{
	echo  '<option value="' . $row->drink . ',' . $row->price_drink . '"/>';
}
?>
</datalist>
<input type="number" id="quantity2" name="quantity" min="0" max="99" placeholder="Cantidad" list="quantities" style="width:240px; height:80px; font-size:x-large;">
<datalist id="quantities">
	<option value=1>
	<option value=2>
    <option value=3>
</datalist>
<button type="button" onclick="add_bebida()" style="width:80px; height:60px;">Agregar</button>
<br>
<br>
<input type="text" id="dess" name="dessert" list="postre" placeholder="Postres" style="width:480px; height:80px; font-size:x-large;">
<datalist id="postre" >
<?php
$stmt = $conn->prepare('SELECT * FROM dessert');
$stmt->execute();
while($row = $stmt->fetch(PDO::FETCH_OBJ))
{
	echo  '<option value="' . $row->dessert . ',' . $row->price_dessert . '"/>';
}
?>
</datalist>
<input type="number" id="quantity3" name="quantity" min="0" max="99" placeholder="Cantidad" list="quantities" style="width:240px; height:80px; font-size:x-large;">
<datalist id="quantities">
	<option value=1>
	<option value=2>
    <option value=3>
</datalist>
<button type="button" onclick="add_postre()" style="width:80px; height:60px;">Agregar</button>
<input type="hidden" name="invoice" id="plate1" >
<br>
<br>
<input type="submit" style="width:128px; height:60px;" value="Facturar">
<?php echo '</form>'; ?>
<br>
<br>
<div id="platos" style="font-size:xx-large"></div>
<p id="plate"></p>
<?php
if (isset($_POST['invoice']))
{
	for ($i = 2; $i <= count($record); $i+=2)
	{
		switch($i)
		{
			case 2:
			echo '<script>addData("' . $mesa10 . '")';
			echo '</script>';
			break;
			case 4:
			echo '<script>addData("' . $mesa11 . '")';
			echo '</script>';
			break;
			case 6:
			echo '<script>addData("' . $mesa12 . '")';
			echo '</script>';
			break;
			case 8:
			echo '<script>addData("' . $mesa13 . '")';
			echo '</script>';
			break;
			case 10:
			echo '<script>addData("' . $mesa14 . '")';
			echo '</script>';
			break;
			case 12:
			echo '<script>addData("' . $mesa15 . '")';
			echo '</script>';
			break;
			case 14:
			echo '<script>addData("' . $mesa16 . '")';
			echo '</script>';
			break;
			case 16:
			echo '<script>addData("' . $mesa17 . '")';
			echo '</script>';
			break;
			case 18:
			echo '<script>addData("' . $mesa18 . '")';
			echo '</script>';
			break;	
		}
	}
}
echo "<button style='float:right; width:128px; height:64px;' onclick='deleting(" . '"' . $table . '"' . ")'>Anular Factura</button>";
?>
</body>
</html>