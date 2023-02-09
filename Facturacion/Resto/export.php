<?php
include 'inc/fw.php';
include 'inc/function.php';
include 'vendor/autoload.php';

	$date = $_POST['date']; // El Trimestre recibido desde admin.php.
	$year = $_POST['year']; // El Año recibido desde admin.php.
	$product = "";
	$price = "";
	$qtty = "";
	$letter = 0;
	
	switch($date)
	{
		case 1:
			$query = "SELECT *, DATE_FORMAT(date,'%d %M %Y') as date FROM invoice WHERE date BETWEEN CAST('" . $year . "-01-01' AS DATE) AND CAST('" . $year . "-03-31' AS DATE) ORDER BY id ASC"; // Para el 1º Trimestre desde el 1/1 al 31/3
		break;
		case 2:
			$query = "SELECT *, DATE_FORMAT(date,'%d %M %Y') as date FROM invoice WHERE date BETWEEN CAST('" . $year . "-04-01' AS DATE) AND CAST('" . $year . "-06-30' AS DATE) ORDER BY id ASC"; // Para el 2º Trimestre desde el 1/4 al 30/6
		break;
		case 3:
			$query = "SELECT *, DATE_FORMAT(date,'%d %M %Y') as date FROM invoice WHERE date BETWEEN CAST('" . $year . "-07-01' AS DATE) AND CAST('" . $year . "-09-30' AS DATE) ORDER BY id ASC"; // Para el 3º Trimestre desde el 1/7 al 30/9
		break;
		default:
			$query = "SELECT *, DATE_FORMAT(date,'%d %M %Y') as date FROM invoice WHERE date BETWEEN CAST('" . $year . "-10-01' AS DATE) AND CAST('" . $year . "-12-31' AS DATE) ORDER BY id ASC"; // Para el 4º Trimestre desde el 1/10 al 31/12
		break;
	}
	
	$stmt = $conn->prepare("SET lc_time_names = 'es_ES'");
	$stmt->execute();
	
	$statement = $conn->prepare($query); // Preparo la consulta para obtener todos los datos de la tabla de facturas (invoice), del trimestre seleccionado..
	
	$statement->execute(); // Ejecuto la consulta.
	
	$result = $statement->fetchAll(); // Asigno todos los resultados a la variable $result.
	
if(isset($_POST["export"]))
{
	$file = new PhpOffice\PhpSpreadsheet\Spreadsheet(); // Hay que usarlo así en Wordpress, también funciona en cualquier script de PHP.

	$active_sheet = $file->getActiveSheet();

	$active_sheet->setCellValue('A1', 'Nº de factura');
	$active_sheet->setCellValue('B1', 'Mesa');
    $active_sheet->setCellValue('C1', 'Cliente');
	$active_sheet->setCellValue('D1', 'Producto');
	$active_sheet->setCellValue('E1', 'Precio');
	$active_sheet->setCellValue('F1', 'Cantidad');
	$active_sheet->setCellValue('G1', 'Día');
	$active_sheet->setCellValue('H1', 'Hora');
	$active_sheet->setCellValue('I1', 'Base Imponible');
	$active_sheet->setCellValue('J1', 'I.V.A.');
    $active_sheet->getStyle('J1')->getAlignment()->setHorizontal("center");
    $active_sheet->setCellValue('K1', 'Pago de I.V.A.');
	$active_sheet->setCellValue('L1', 'Total + I.V.A.');

	$count = 2;
	$total = 0;

	foreach($result as $row)
	{
		result($conn, $row, 0, 0); // Llama a la función result, le pasa la conexión, el resultado de la base de datos y un 0 para Excel.
		
		$active_sheet->setCellValue('A' . $count, $row["id"]);
        $active_sheet->getStyle('A' . $count)->getAlignment()->setHorizontal("left");
		$active_sheet->setCellValue('B' . $count, $table);
        $active_sheet->setCellValue('C' . $count, $client);
		$active_sheet->setCellValue('D' . $count, $product);
		$active_sheet->setCellValue('E' . $count, $price);
        $active_sheet->getStyle('E' . $count)->getNumberFormat()->setFormatCode('#,##0.00 $');
        $active_sheet->getStyle('E' . $count)->getAlignment()->setHorizontal("right"); // Alineación del texto con la cadena 'right', Alinea a la Derecha.
		$active_sheet->setCellValue('F' . $count, $qtty);
		$active_sheet->getStyle('F' . $count)->getAlignment()->setHorizontal("right"); // Alineación del texto con la cadena 'right', Alinea a la Derecha.
		$active_sheet->setCellValue('G' . $count, $row["date"]);
        $active_sheet->getStyle('G' . $count)->getAlignment()->setHorizontal("right"); // Alineación del texto con la cadena 'right', Alinea a la Derecha.
		$active_sheet->setCellValue('H' . $count, $row["time"]);
        $active_sheet->getStyle('H' . $count)->getAlignment()->setHorizontal("right"); // Alineación del texto con la cadena 'right', Alinea a la Derecha.
		$active_sheet->setCellValue('I' . $count, $row["total"]);
        $active_sheet->getStyle('I' . $count)->getNumberFormat()->setFormatCode('#,##0.00 $');
		$active_sheet->setCellValue('J' . $count, "21 %");
        $active_sheet->getStyle('J' . $count)->getAlignment()->setHorizontal("center");
        $active_sheet->setCellValue('K' . $count, $row["total"] * 1.21 - $row["total"]);
        $active_sheet->getStyle('K' . $count)->getNumberFormat()->setFormatCode('#,##0.00 $');
		$active_sheet->setCellValue('L' . $count, $row["totaliva"]);
		$active_sheet->getStyle('L' . $count)->getNumberFormat()->setFormatCode('#,##0.00 $');

		$count++;
		$product = "";
		$price = "";
		$qtty = "";
	}

	$active_sheet->setCellValue('K' . ($count + 2), "Total:");
	$active_sheet->setCellValue('L' . ($count + 2), "=SUM(L2:L" . ($count - 1) . ")");
	$active_sheet->getStyle('L' . ($count + 2))->getNumberFormat()->setFormatCode('#,##0.00 $');
	$active_sheet->setCellValue('A' . ($count + 4), "XXXXX - N.I.F. 20-42000000-3");

	for ($i = 1; $i < $count; $i++)
    {
        $active_sheet->getRowDimension($i)->setRowHeight(82); // Cambia el tamaño Vertical de las filas usadas en la planilla.

        if ($i == 1)
        {
            $active_sheet->getRowDimension($i)->setRowHeight(20); // Cambia el tamaño Vertical de las filas usadas en la planilla.
            $active_sheet->getColumnDimension(chr(64 + $i))->setWidth(15);
            $active_sheet->getColumnDimension(chr(64 + $i + 1))->setWidth(15);
            $active_sheet->getColumnDimension(chr(64 + $i + 2))->setWidth(30);
            $active_sheet->getColumnDimension(chr(64 + $i + 3))->setWidth(52); // Si es la Letra D le da el tamaño horizontal 40.
            $active_sheet->getColumnDimension(chr(64 + $i + 4))->setWidth(15);
            $active_sheet->getColumnDimension(chr(64 + $i + 5))->setWidth(15);
            $active_sheet->getColumnDimension(chr(64 + $i + 6))->setWidth(15);
            $active_sheet->getColumnDimension(chr(64 + $i + 7))->setWidth(15);
            $active_sheet->getColumnDimension(chr(64 + $i + 8))->setWidth(15);
            $active_sheet->getColumnDimension(chr(64 + $i + 9))->setWidth(15);
            $active_sheet->getColumnDimension(chr(64 + $i + 10))->setWidth(15);
            $active_sheet->getColumnDimension(chr(64 + $i + 11))->setWidth(15);
        }

        if ($i == $count - 1)
        {
            $active_sheet->getRowDimension($i + 3)->setRowHeight(40); // Cambia el tamaño Vertical de las filas usadas en la planilla.
            $active_sheet->getRowDimension($i + 5)->setRowHeight(40); // Cambia el tamaño Vertical de las filas usadas en la planilla.
        }
    }
		
	$writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($file, $_POST["file_type"]);

	$file_name = $date . 'º Trimestre de ' . $year . "." . $_POST["file_type"];

	$writer->save($file_name);

	header('Content-Type: application/x-www-form-urlencoded');

	header('Content-Transfer-Encoding: Binary');

	header("Content-disposition: attachment; filename=\"".$file_name."\"");

	readfile($file_name);

	unlink($file_name);

	exit;
}

$title = "Exportando Facturas";
include "inc/header.php";
?>
    	<section class="container-fluid pt-3">
        <div id="pc"></div>
            <div id="mobile"></div>
    		<br>
    		<h3 style="text-align: center;">Exporta las Facturas a Excel o CSV</h3>
    		<br>
          	<div class="row">
			  <div id="pc"></div>
				<div id="mobile"></div>
		  		<div class="col-md-1" style="width:3%;"></div>
            		<div class="col-md-10">
                        <div id="view1">
						<div class="row">
							<div class="col-md-7">
								Facturas:<?php echo " " . $date; ?>º Trimestre del año:<?php echo " " . $year; ?> XXXXX - N.I.F. 20-42000000-3
							</div>
							<div class="col-md-2">
							<form method="post">
								<input type="hidden" name="date" value="<?php echo $date; ?>">
								<input type="hidden" name="year" value="<?php echo $year; ?>">
								<select name="file_type" class="form-control input-sm">
									<option value="Xlsx">Xlsx</option>
									<option value="Csv">Csv</option>
								</select>
							</div>
							<div class="col-md-3">
								<input type="submit" name="export" class="btn btn-primary btn-lg" value="Descarga el Informe" />
							</div>
						</div>
						</form>
						<br>
						<table>
							<tr>
							<th>Nº de factura</th>
							<th>Mesa</th>
                            <th>Cliente</th>
                            <th>Camarero</th>
							<th>Producto</th>
							<th>Precio</th>
							<th>Cantidad</th>
							<th>Hora</th>
							<th>Día</th>
							<th>Base Imponible</th>
							<th>I.V.A.</th>
                            <th>Pago de I.V.A.</th>
							<th>Total + I.V.A.</th>
							</tr>
						<?php

						foreach($result as $row) // Este foreach se ejecuta primero, pone en el array $row todos los resultados obtenidos de la base de datos.
						{
							result($conn, $row, 1, 0); // Llama a la fución result, le pasa la conexión, el resultado de la base de datos y un 1 para tabla.

							echo '<tr>
							<td>' . $row["id"] . '</td>
							<td>' . $table . '</td>
                            <td>' . $client . '</td>
                            <td>' . $wait . '</td>
							<td>' . $product . '</td>
							<td>' . $price . '</td>
							<td>' . $qtty . '</td>
							<td>' . $row["time"] . '</td>
							<td>' . $row["date"] . '</td>
							<td>' . number_format((float)$row["total"], 2, ',', '.') . ' $</td>
							<td>21 %</td>
                            <td>' . number_format((float)$row["total"] * 1.21 - $row["total"], 2, ',', '.') . ' $</td>
							<td>' . number_format((float)$row["totaliva"], 2, ',', '.') . ' $</td>
							</tr>';
							$product = "";
							$price = "";
							$qtty = "";
						}
						?>
					 </table>
					 <br>
					 <button class="btn btn-danger" style="width:160px; height:80px;" onclick="window.close()">Cierra Esta Ventana</button>
                    </div>
					</div>
				<div class="col-md-1" style="width:3%;"></div>
			</div>
    	</section>
<?php
include "inc/footer.html";
?>