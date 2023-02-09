<?php
include "includes/conn.php";
include 'vendor/autoload.php';

if(isset($_REQUEST["id"]))
{
    $id = $_REQUEST["id"];

    $stmt = $conn->prepare("SET lc_time_names = 'es_ES'");
	$stmt->execute();

    $sql = ("SELECT *, DATE_FORMAT(date,'%d %M %Y') as date FROM invoice WHERE id=$id");
	
	$stmt = $conn->prepare($sql);
	$stmt->execute();
	$row = $stmt->fetch(PDO::FETCH_OBJ);

    $sheet = new PhpOffice\PhpSpreadsheet\Spreadsheet(); // Hay que usarlo así en Wordpress, también funciona en cualquier script de PHP.
    $active_sheet = $sheet->getActiveSheet();

	$active_sheet->setCellValue('A1', 'Nº de factura');
	$active_sheet->setCellValue('B1', 'Cliente');
	$active_sheet->setCellValue('C1', 'Servicio');
	$active_sheet->setCellValue('D1', 'Repuestos');
	$active_sheet->setCellValue('E1', 'Precio');
    $active_sheet->setCellValue('F1', 'Mano de Obra');
	$active_sheet->setCellValue('G1', 'Día');
	$active_sheet->setCellValue('H1', 'Hora');
	$active_sheet->setCellValue('I1', 'Base Imponible');
	$active_sheet->setCellValue('J1', 'I.G.I.C.');
    $active_sheet->getStyle('J1')->getAlignment()->setHorizontal("center");
	$active_sheet->setCellValue('K1', 'Total + I.G.I.C.');

	$count = 2;

    $id = $row->id;
    $client = $row->client;
    $service = $row->job;
    $material = $row->replacements;
    $prices = $row->prices;
    $hand = $row->hand;
    $total = $row->total;
    $totaligic = $row->totaligic;
    $mydate = $row->date;
    $time = $row->time;

    $active_sheet->setCellValue('A' . $count, $id);
    $active_sheet->getStyle('A' . $count)->getAlignment()->setHorizontal("left");
    $active_sheet->setCellValue('B' . $count, $client);
    $active_sheet->setCellValue('C' . $count, $service);
    $active_sheet->setCellValue('D' . $count, $material);
    $active_sheet->setCellValue('E' . $count, $prices);
    $active_sheet->getStyle('E' . $count)->getNumberFormat()->setFormatCode('#,##0.00 €');
    $active_sheet->getStyle('E' . $count)->getAlignment()->setHorizontal("right"); // Alineación del texto con la cadena 'right', Alinea a la Derecha.
    $active_sheet->setCellValue('F' . $count, $hand);
    $active_sheet->getStyle('F' . $count)->getNumberFormat()->setFormatCode('#,##0.00 €');
    $active_sheet->setCellValue('G' . $count, $mydate);
    $active_sheet->getStyle('G' . $count)->getAlignment()->setHorizontal("right");
    $active_sheet->setCellValue('H' . $count, $time);
    $active_sheet->getStyle('H' . $count)->getAlignment()->setHorizontal("right");
    $active_sheet->setCellValue('I' . $count, $total);
    $active_sheet->getStyle('I' . $count)->getNumberFormat()->setFormatCode('#,##0.00 €');
    $active_sheet->setCellValue('J' . $count, "Exento");
    $active_sheet->getStyle('J' . $count)->getAlignment()->setHorizontal("center");
    $active_sheet->setCellValue('K' . $count, $totaligic);
    $active_sheet->getStyle('K' . $count)->getNumberFormat()->setFormatCode('#,##0.00 €');

	$active_sheet->setCellValue('J' . ($count + 2), "Total:");
	$active_sheet->setCellValue('K' . ($count + 2), $totaligic);
	$active_sheet->getStyle('K' . ($count + 2))->getNumberFormat()->setFormatCode('#,##0.00 €');
	$active_sheet->setCellValue('A' . ($count + 4), "Fernando Ariel Filippelli - Y0575228N Camino La Unión 31 38270 Valle de Guerra");

    for ($i = 1; $i < $count; $i++)
    {
        $active_sheet->getRowDimension($i)->setRowHeight(40); // Cambia el tamaño Vertical de las filas usadas en la planilla.

        if ($i == 1)
        {
            $active_sheet->getRowDimension($i)->setRowHeight(20); // Cambia el tamaño Vertical de las filas usadas en la planilla.
            $active_sheet->getColumnDimension(chr(64 + $i))->setWidth(15);
            $active_sheet->getColumnDimension(chr(64 + $i + 1))->setWidth(40); // Si es la Letra C le da el tamaño horizontal 52.
            $active_sheet->getColumnDimension(chr(64 + $i + 2))->setWidth(57); // Si es la Letra C le da el tamaño horizontal 52.
            $active_sheet->getColumnDimension(chr(64 + $i + 3))->setWidth(15); // Si es la Letra C le da el tamaño horizontal 52.
            $active_sheet->getColumnDimension(chr(64 + $i + 4))->setWidth(15);
            $active_sheet->getColumnDimension(chr(64 + $i + 5))->setWidth(15);
            $active_sheet->getColumnDimension(chr(64 + $i + 6))->setWidth(15);
            $active_sheet->getColumnDimension(chr(64 + $i + 7))->setWidth(15);
            $active_sheet->getColumnDimension(chr(64 + $i + 8))->setWidth(15);
            $active_sheet->getColumnDimension(chr(64 + $i + 9))->setWidth(15);
            $active_sheet->getColumnDimension(chr(64 + $i + 10))->setWidth(15);
        }

        if ($i == $count - 1)
        {
            $active_sheet->getRowDimension($i + 3)->setRowHeight(40); // Cambia el tamaño Vertical de las filas usadas en la planilla.
            $active_sheet->getRowDimension($i + 5)->setRowHeight(40); // Cambia el tamaño Vertical de las filas usadas en la planilla.
        }
    }
		
	$writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($sheet, "Xlsx");

	$file_name = "Factura Nº $id - $mydate.Xlsx";

	$writer->save($file_name);

	header('Content-Type: application/x-www-form-urlencoded');

	header('Content-Transfer-Encoding: Binary');

	header("Content-disposition: attachment; filename=\"".$file_name."\"");

	readfile($file_name);

	unlink($file_name);

	exit;
}
?>