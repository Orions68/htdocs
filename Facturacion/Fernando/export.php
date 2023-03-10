<?php
include 'includes/conn.php';
include 'vendor/autoload.php';

$sheet = new PhpOffice\PhpSpreadsheet\Spreadsheet(); // Hay que usarlo así en Wordpress, también funciona en cualquier script de PHP.

	$date = $_POST['date']; // El Trimestre recibido desde admin.php.
	$year = $_POST['year']; // El Año recibido desde admin.php.
	$service = "";
	$replacements = "";
	
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
	$file = $sheet; // Usado en Wordpress, también funciona en cualquier script de PHP.

	$active_sheet = $file->getActiveSheet();

	$active_sheet->setCellValue('A1', 'Nº de factura');
	$active_sheet->setCellValue('B1', 'Cliente');
	$active_sheet->setCellValue('C1', 'Servicio');
	$active_sheet->setCellValue('D1', 'Repuestos');
	$active_sheet->setCellValue('E1', 'Precio');
    $active_sheet->setCellValue('F1', 'Mano de Obra');
	$active_sheet->setCellValue('G1', 'Hora');
	$active_sheet->setCellValue('H1', 'Día');
	$active_sheet->setCellValue('I1', 'Base Imponible');
	$active_sheet->setCellValue('J1', 'I.G.I.C.');
	$active_sheet->setCellValue('K1', 'Total + I.G.I.C.');

	$count = 2;
	$total = 0;

	foreach($result as $row)
	{
        $id = $row["id"];
        $client = $row["client"];
        $service = $row["job"];
        $replacements = $row["replacements"];
        $repArray = explode(",", $replacements);
        $replacements = "";
        $size = count($repArray);
        for ($i = 0; $i < $size - 1; $i++)
        {
            if ($i == $size - 2)
            {
                $replacements .= $repArray[$i];
            }
            else
            {
                $replacements .= $repArray[$i] . "\n";
            }
        }
        $prices = $row["prices"];
        $hand = $row["hand"];
        $total = $row["total"];
        $totaligic = $row["totaligic"];
        $mydate = $row["date"];
        $time = $row["time"];

		$active_sheet->setCellValue('A' . $count, $id);
		$active_sheet->setCellValue('B' . $count, $client);
		$active_sheet->setCellValue('C' . $count, $service);
		$active_sheet->setCellValue('D' . $count, $replacements);
		$active_sheet->setCellValue('E' . $count, $prices);
        $active_sheet->getStyle('E' . $count)->getNumberFormat()->setFormatCode('#,##0.00 €');
		$active_sheet->getStyle('E' . $count)->getAlignment()->setHorizontal("right"); // Alineación del texto con la cadena 'right', Alinea a la Derecha.
        $active_sheet->setCellValue('F' . $count, $hand);
		$active_sheet->setCellValue('G' . $count, $time);
        $active_sheet->getStyle('G' . $count)->getAlignment()->setHorizontal("right");
		$active_sheet->setCellValue('H' . $count, $mydate);
        $active_sheet->getStyle('H' . $count)->getAlignment()->setHorizontal("right");
		$active_sheet->setCellValue('I' . $count, $total);
		$active_sheet->getStyle('I' . $count)->getNumberFormat()->setFormatCode('#,##0.00 €');
		$active_sheet->setCellValue('J' . $count, "7%");
        $active_sheet->getStyle('J' . $count)->getAlignment()->setHorizontal("right");
		$active_sheet->setCellValue('K' . $count, $totaligic);
		$active_sheet->getStyle('K' . $count)->getNumberFormat()->setFormatCode('#,##0.00 €');

		$count++;
	}

	$active_sheet->setCellValue('J' . ($count + 2), "Total:");
	$active_sheet->setCellValue('K' . ($count + 2), "=SUM(K2:K" . ($count - 1) . ")");
	$active_sheet->getStyle('K' . ($count + 2))->getNumberFormat()->setFormatCode('#,##0.00 €');
	$active_sheet->setCellValue('A' . ($count + 4), "Fernando Ariel Filippelli - Y0575228N Camino La Unión 31 38270 Valle de Guerra");

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
			if ($i != 3 && $i != 4)
            {
			    $active_sheet->getColumnDimension(chr(64 + $i))->setWidth(18); // Cambia el tamaño Horizontal, chr(ASCII de la letra + $letter), si se usa desde la A se usa el número 64 código ASCII del carácter anterior a la A ya que $i = 1.
            }
            else
            {
                $active_sheet->getColumnDimension(chr(64 + $i))->setWidth(50); // Si es la Letra C le da el tamaño horizontal 52.
            }
		}
	}
	else
	{
		for ($i = 1; $i < $count; $i++)
		{
			if ($i == 1)
			{
				$active_sheet->getRowDimension($i)->setRowHeight(20); // Cambia el tamaño Vertical de las filas usadas en la planilla.
			}
			else
			{
				$active_sheet->getRowDimension($i)->setRowHeight(50); // Cambia el tamaño Vertical de las filas usadas en la planilla.
			}
            if ($i != 3 && $i != 4)
            {
			    $active_sheet->getColumnDimension(chr(64 + $i))->setWidth(18); // Cambia el tamaño Horizontal, chr(ASCII de la letra + $letter), si se usa desde la A se usa el número 64 código ASCII del carácter anterior a la A ya que $i = 1.
            }
            else
            {
                $active_sheet->getColumnDimension(chr(64 + $i))->setWidth(50); // Si es la Letra C le da el tamaño horizontal 52.
            }
			if ($i < 11)
			{
				$active_sheet->getColumnDimension(chr(64 + $i))->setWidth(18);
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
<section class="container-fluid pt-3">
    <br>
    <h3 style="text-align: center;">Exporta las Facturas a Excel o CSV</h3>
    <br>
    <div class="row">
        <div class="col-md-1" style="width:3%;"></div>
            <div class="col-md-10">
                <div class="row">
                    <div class="col-md-7">
                        Facturas: <?php echo " " . $date; ?>º Trimestre del año: <?php echo " " . $year; ?> Fernando Ariel Filippelli - Y0575228N Camino La Unión 31 38270 Valle de Guerra
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
                    <th>Repuestos</th>
                    <th>Precio</th>
                    <th>Mano de Obra</th>
                    <th>Hora</th>
                    <th>Día</th>
                    <th>Base Imponible</th>
                    <th>I.G.I.C.</th>
                    <th>Total + I.G.I.C.</th>
                    </tr>
                <?php

                foreach($result as $row)
                {
                    $client = $row["client"];
                    $service = $row["job"];
                    $replacements = $row["replacements"];
                    $prices = $row["prices"];
                    $repArray = explode(",", $replacements);
                    $priceArray = explode(",", $prices);
                    $size = count($repArray);
                    $replacements = "";
                    for ($i = 0; $i < $size - 1; $i++)
                    {
                        if ($i == $size - 2)
                        {
                            $replacements .= $repArray[$i];
                        }
                        else
                        {
                            $replacements .= $repArray[$i] . "<br>";
                        }
                    }
                    $hand = $row["hand"];
                    $total = $row["total"];
                    $totaligic = $row["totaligic"];
                    $mydate = $row["date"];
                    $time = $row["time"];

                    echo '<tr>
                    <td>' . $row["id"] . '</td>
                    <td>' . $client . '</td>
                    <td>' . $service . '</td>
                    <td>' . $replacements . '</td>
                    <td>' . $prices . '</td>
                    <td>' . $hand . '</td>
                    <td>' . $time . '</td>
                    <td>' . $mydate . '</td>
                    <td>' . number_format((float)$total, 2, ',', '.') . ' €</td>
                    <td>7%</td>
                    <td>' . number_format((float)$totaligic, 2, ',', '.') . ' €</td>
                    </tr>';
                }
                ?>
                </table>
            </div>
        <div class="col-md-1" style="width:3%;"></div>
    </div>
</section>
<br><br>
	<input type="button" value="Cierra Esta Ventana" onclick="window.close()">
<?php
include "includes/footer.html";
?>