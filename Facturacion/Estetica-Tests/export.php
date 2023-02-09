<?php

include 'vendor/autoload.php';
include 'includes/conn.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;

	$date = $_POST['date']; // El Trimestre recibido desde admin.php
	$year = $_POST['year']; // El Año recibido desde admin.php
	
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
	  $file = new Spreadsheet();
	
	  $active_sheet = $file->getActiveSheet();
	
	  $active_sheet->setCellValue('A1', 'Nº de factura');
	  $active_sheet->setCellValue('B1', 'Cliente');
	  $active_sheet->setCellValue('C1', 'Servicio');
	  $active_sheet->setCellValue('D1', 'Precio');
	  $active_sheet->setCellValue('E1', 'Cantidad');
	  $active_sheet->setCellValue('F1', 'Hora');
	  $active_sheet->setCellValue('G1', 'Día');
	  $active_sheet->setCellValue('H1', 'Total');
	
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
		$service = getService($conn, $row["service_id"]);
	    $active_sheet->setCellValue('A' . $count, $row["id"]);
	    $active_sheet->setCellValue('B' . $count, $client);
		$active_sheet->setCellValue('C' . $count, $service);
		$active_sheet->setCellValue('D' . $count, $row["total"] / $row["qtty"]);
		$active_sheet->setCellValue('E' . $count, $row["qtty"]);
	    $active_sheet->setCellValue('F' . $count, $row["time"]);
	    $active_sheet->setCellValue('G' . $count, $row["date"]);
	    $active_sheet->setCellValue('H' . $count, $row["total"]);
	
	    $count++;
	    $total += $row["total"];
	  }
	  $active_sheet->setCellValue('G' . ($count + 1), "Total:");
	  $active_sheet->setCellValue('H' . ($count + 1), $total);
	  $active_sheet->setCellValue('A' . ($count + 2), "Salón de Estética de Joana - N.I.F. ---------");
	  		
	  $writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($file, $_POST["file_type"]);
	
	  $file_name = $date . 'º Trimestre de ' . $year;
	
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
    	<div class="container">
    		<br>
    		<h3 style="text-align: center;">Exporta las Facturas a Excel o CSV</h3>
    		<br>
        <div class="panel panel-default">
          <div class="panel-heading">
            <form method="post">
              <div class="row">
                <div class="col-md-6">Facturas: <?php echo " " . $date; ?>º Trimestre del año: <?php echo " " . $year . " Salón de Estética - Joana N.I.F. ---------";?></div>
                <div class="col-md-4">
                <input type="hidden" name="date" value="<?php echo $date; ?>">
                <input type="hidden" name="year" value="<?php echo $year; ?>">
                  <select name="file_type" class="form-control input-sm">
                    <option value="Xlsx">Xlsx</option>
                    <option value="Xls">Xls</option>
                    <option value="Csv">Csv</option>
                  </select>
                </div>
                <div class="col-md-2">
                  <input type="submit" name="export" class="btn btn-primary btn-lg" value="Descarga el Informe" />
                </div>
              </div>
            </form>
          </div>
          <div class="panel-body">
        		<div class="table-responsive">
        			<table class="table table-striped table-bordered">
                <tr>
                  <th>Nº de factura</th>
                  <th>Cliente</th>
                  <th>Servicio</th>
				  <th>Precio</th>
				  <th>Cantidad</th>
                  <th>Hora</th>
                  <th>Día</th>
                  <th>Total</th>
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
					$service = getService($conn, $row["service_id"]);
					echo '
					<tr>
						<td>' . $row["id"] . '</td>
						<td>' . $client . '</td>
						<td>' . $service . '</td>
						<td>' . $row["total"] / $row["qtty"] . '</td>
						<td>' . $row["qtty"] . '</td>
						<td>' . $row["time"] . '</td>
						<td>' . $row["date"] . '</td>
						<td>' . $row["total"] . '</td>
					</tr>
					';
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
					$sql_service = "SELECT service FROM services WHERE id='$service_id'";
					$stmt = $conn->prepare($sql_service);
					$stmt->execute();
					$row_service = $stmt->fetch(PDO::FETCH_OBJ);
					return $row_service->service;
				}
                ?>
              </table>
        		</div>
          </div>
        </div>
    	</div>
      <br />
      <br />
		<input type="button" value="Cierra Esta Ventana" onclick="window.close()">

  </body>
</html>