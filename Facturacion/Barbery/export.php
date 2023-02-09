<?php

include 'includes/conn.php';
include 'vendor/autoload.php';

// use PhpOffice\PhpSpreadsheet\Spreadsheet; // Se puede Usar así en PHP, Wordpress no lo admite.
$sheet = new PhpOffice\PhpSpreadsheet\Spreadsheet(); // Hay que usarlo así en Wordpress, también funciona en cualquier script de PHP.

	$date = $_POST['date']; // El Trimestre recibido desde admin.php.
	$year = $_POST['year']; // El Año recibido desde admin.php.
	$service = "";
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
		case 4:
			$query = "SELECT *, DATE_FORMAT(date,'%d %M %Y') as date FROM invoice WHERE date BETWEEN CAST('" . $year . "-10-01' AS DATE) AND CAST('" . $year . "-12-31' AS DATE) ORDER BY id ASC"; // Para el 4º Trimestre desde el 1/10 al 31/12
		break;
	}
	
	$stmt = $conn->prepare("SET lc_time_names = 'es_ES'");
	$stmt->execute();
	
	$statement = $conn->prepare($query);
	
	$statement->execute();
	
	$result = $statement->fetchAll();
	
if(isset($_POST["export"]))
{
//   $file = new Spreadsheet(); // Usado con USE. La palabra clave USE permite introducir variables locales en el ámbito local de una función anónima, en este caso crea una nueva instancia de la clase Spreadsheet().
	$file = $sheet; // Usado en Wordpress, también funciona en cualquier script de PHP.

	$active_sheet = $file->getActiveSheet();

	$active_sheet->setCellValue('A1', 'Nº de factura');
	$active_sheet->setCellValue('B1', 'Cliente');
	$active_sheet->setCellValue('C1', 'Servicio');
	$active_sheet->setCellValue('D1', 'Precio');
	$active_sheet->setCellValue('E1', 'Cantidad');
	$active_sheet->setCellValue('F1', 'Hora');
	$active_sheet->setCellValue('G1', 'Día');
	$active_sheet->setCellValue('H1', 'Base Imponible');
	$active_sheet->setCellValue('I1', 'I.V.A.');
	$active_sheet->setCellValue('J1', 'Total + I.V.A.');

	$count = 2;
	$total = 0;

	foreach($result as $row)
	{
		if ($row["client_id"] !== null)
		{
			$client = getClient($conn, $row["client_id"]);
		}
		else
		{
			$client = "Consumidor Final";
		}

		$serviceArray = explode(",", $row["service_id"]);
		$qttyArray = explode(",", $row["qtty"]);
		for ($i = 0; $i < count($serviceArray) - 1; $i++)
		{
			$service_price = getService($conn, $serviceArray[$i]);
			$preservice = explode(",", $service_price);
			if ($i == count($serviceArray) - 2)
			{
				$service .= $preservice[0];
				$price .= number_format((float)$preservice[1], 2, ',', '.') . " $";
				$qtty .= $qttyArray[$i];
			}
			else
			{
				$service .= $preservice[0] . "\n";
				$price .= number_format((float)$preservice[1], 2, ',', '.') . " $\n";
				$qtty .= $qttyArray[$i] . "\n";
			}
		}
		$active_sheet->setCellValue('A' . $count, $row["id"]);
		$active_sheet->setCellValue('B' . $count, $client);
		$active_sheet->setCellValue('C' . $count, $service);
		$active_sheet->setCellValue('D' . $count, $price);
		$active_sheet->setCellValue('E' . $count, $qtty);
		$active_sheet->getStyle('E' . $count)->getAlignment()->setHorizontal("right"); // Alineación del texto con la cadena 'right', Alinea a la Derecha.
		$active_sheet->setCellValue('F' . $count, $row["time"]);
		$active_sheet->setCellValue('G' . $count, $row["date"]);
		$active_sheet->setCellValue('H' . $count, $row["total"] * 100 / 121);
		$active_sheet->getStyle('H' . $count)->getNumberFormat()->setFormatCode('#,##0.00 $');
		$active_sheet->setCellValue('I' . $count, $row["iva"]);
		$active_sheet->getStyle('I' . $count)->getNumberFormat()->setFormatCode('#,##0.00 $');
		$active_sheet->setCellValue('J' . $count, $row["total"]);
		$active_sheet->getStyle('J' . $count)->getNumberFormat()->setFormatCode('#,##0.00 $');

		$count++;
		$service = "";
		$price = "";
		$qtty = "";
	}

	$active_sheet->setCellValue('I' . ($count + 2), "Total:");
	$active_sheet->setCellValue('J' . ($count + 2), "=SUM(J2:J" . ($count - 1) . ")");
	$active_sheet->getStyle('J' . ($count + 2))->getNumberFormat()->setFormatCode('#,##0.00 $');
	$active_sheet->setCellValue('A' . ($count + 4), "La Peluquería de Javier Borneo - C.U.I.T 20-22506157-3");

	if ($count <= 11)
	{
		for ($i = 1; $i < 14; $i++)
		{
			if ($i == 1)
			{
				$active_sheet->getRowDimension($i)->setRowHeight(20); // Cambia el tamaño Vertical de las filas usadas en la planilla.
			}
			else
			{
				$active_sheet->getRowDimension($i)->setRowHeight(50); // Cambia el tamaño Vertical de las filas usadas en la planilla.
			}
			$active_sheet->getColumnDimension(chr(64 + $i))->setWidth(23); // Cambia el tamaño Horizontal, chr(ASCII de la letra + $letter), si se usa desde la A se usa el número 64 código ASCII del carácter anterior a la A ya que $i = 1.
		}
	}
	else
	{
		for ($i = 1; $i < $count; $i++)
		{
			if ($i == 1)
			{
				$active_sheet->getRowDimension($i)->setRowHeight(18); // Cambia el tamaño Vertical de las filas usadas en la planilla.
			}
			else
			{
				$active_sheet->getRowDimension($i)->setRowHeight(50); // Cambia el tamaño Vertical de las filas usadas en la planilla.
				if ($i == $count - 1)
				{
					$active_sheet->getRowDimension($i + 3)->setRowHeight(50); // Cambia el tamaño Vertical de las filas usadas en la planilla.
					$active_sheet->getRowDimension($i + 5)->setRowHeight(50);
				}
			}
			if ($i < 11)
			{
				$active_sheet->getColumnDimension(chr(64 + $i))->setWidth(23);
			}
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
include "includes/header.php";
?>
  	<img alt="logo" src="img/logo.jpg" height="300" width="100%"/>
	<br>
    	<section class="container-fluid pt-3">
        <div id="pc"></div>
	    <div id="mobile"></div>
    		<br>
    		<h3 style="text-align: center;">Exporta las Facturas a Excel o CSV</h3>
    		<br>
          	<div class="row">
		  		<div class="col-md-1" style="width:3%;"></div>
            		<div class="col-md-10">
						<div class="row">
							<div class="col-md-7">
								Facturas: <?php echo " " . $date; ?>º Trimestre del año: <?php echo " " . $year; ?> La Peluquería de Javier Borneo - C.U.I.T. 20-22506157-3
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
							<th>Cliente</th>
							<th>Servicio</th>
							<th>Precio</th>
							<th>Cantidad</th>
							<th>Hora</th>
							<th>Día</th>
							<th>Base Imponible</th>
							<th>I.V.A.</th>
							<th>Total + I.V.A.</th>
							</tr>
						<?php

						foreach($result as $row)
						{            	
							if ($row["client_id"] !== null)
							{
								$client = getClient($conn, $row["client_id"]);
							}
							else
							{
								$client = "Consumidor Final";
							}
							$serviceArray = explode(",", $row["service_id"]);
							$qttyArray = explode(",", $row["qtty"]);
					
							for ($i = 0; $i < count($serviceArray) - 1; $i++)
							{
								$service_price = getService($conn, $serviceArray[$i]);
								$preservice = explode(",", $service_price);
								if ($i == count($serviceArray) - 2)
								{
									$service .= $preservice[0];
									$price .= number_format((float)$preservice[1], 2, ',', '.') . " $";
									$qtty .= $qttyArray[$i];
								}
								else
								{
									$service .= $preservice[0] . "<br>";
									$price .= number_format((float)$preservice[1], 2, ',', '.') . " $<br>";
									$qtty .= $qttyArray[$i] . "<br>";
								}
							}

							echo '<tr>
							<td>' . $row["id"] . '</td>
							<td>' . $client . '</td>
							<td>' . $service . '</td>
							<td style="text-align: right;">' . $price . '</td>
							<td style="text-align: right;">' . $qtty . '</td>
							<td>' . $row["time"] . '</td>
							<td>' . $row["date"] . '</td>
							<td>' . number_format((float)$row["total"] * 100 / 121, 2, ',', '.') . ' $</td>
							<td>' . number_format((float)$row["iva"], 2, ',', '.') . ' $</td>
							<td>' . number_format((float)$row["total"], 2, ',', '.') . ' $</td>
							</tr>';
							$service = "";
							$price = "";
							$qtty = "";
						}

						function getClient($conn, $client_id)
						{
							$sql_client = "SELECT name FROM clients WHERE id='$client_id'";
							$stmt = $conn->prepare($sql_client);
							$stmt->execute();
							$row_client = $stmt->fetch(PDO::FETCH_OBJ);
							return $row_client->name;
						}

						function getService($conn, $service_id)
						{
							$sql_service = "SELECT service, price FROM services WHERE id='$service_id'";
							$stmt = $conn->prepare($sql_service);
							$stmt->execute();
							$row_service = $stmt->fetch(PDO::FETCH_OBJ);
							return $row_service->service . "," . $row_service->price;
						}
						?>
					 </table>
					</div>
				<div class="col-md-1" style="width:3%;"></div>
			</div>
    	</section>
      <br />
      <br />
      <button class="btn btn-danger" onclick="window.close()">Cierra Esta Ventana</button>
  </body>
</html>