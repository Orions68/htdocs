<?php
if (json_decode(file_get_contents('php://input'), true))
{
	$_POST = json_decode(file_get_contents('php://input'), true);
}
if (isset($_POST['id']) || isset($_GET['id']))
{
	include "inc/fw.php";

	$id = $_REQUEST["id"];
    $id = (int)$id;
	$products = array();
    $stmt = $conn->prepare("SELECT * FROM foods WHERE kind=$id");
	$stmt->execute();
	while($row = $stmt->fetch(PDO::FETCH_OBJ))
	{
		$temp = array();
        $temp['id'] = $row->id;
        $temp['products'] = $row->food;
        $temp['price_products'] = $row->food_price;
		array_push($products, $temp);
	}
	echo json_encode($products);
	exit();
}
$title = "Enviando Datos a Android";
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