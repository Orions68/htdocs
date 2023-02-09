<?php
include 'vendor/autoload.php';

if (isset($_POST["button"]))
{
    $b1 = $_POST["b1"];
    $b2 = $_POST["b2"];
    $b3 = $_POST["b3"];
    $sheet = new PhpOffice\PhpSpreadsheet\Spreadsheet();

    $file = $sheet; // Usado en Wordpress, también funciona en cualquier script de PHP.
        
    $active_sheet = $file->getActiveSheet();

    for ($i = 1; $i < 6; $i++)
    {
        $active_sheet->getRowDimension($i)->setRowHeight(18); // Cambia el tamaño Vertical de las filas usadas en la planilla.
        if ($i < 3) // Hay que modificar el tamaño solo de las letras que se usan en la planilla.
        {
            $active_sheet->getColumnDimension(chr(64 + $i))->setWidth(20); // Cambia el tamaño Horizontal, chr(ASCII de la letra + $i), si se usa desde la A se usa el número 64 código ASCII del carácter anterior ya que $i es = 1.
        }
    }

    $active_sheet->setCellValue('A1', "Número 1");
    $active_sheet->setCellValue('B1', $b1);
    $active_sheet->getStyle('B1')->getNumberFormat()->setFormatCode('#,##0.00 €');
    $active_sheet->setCellValue('A2', "Número 2");
    $active_sheet->setCellValue('B2', $b2);
    $active_sheet->getStyle('B2')->getNumberFormat()->setFormatCode('#,##0.00 €');
    $active_sheet->setCellValue('A3', "Número 3");
    $active_sheet->setCellValue('B3', $b3);
    $active_sheet->getStyle('B3')->getNumberFormat()->setFormatCode('#,##0.00 €');
    $active_sheet->setCellValue('A5', "Suma total:");
    // $active_sheet->setCellValue('B5', $active_sheet->getCell("B1")->getValue() + $active_sheet->getCell("B2")->getValue() + $active_sheet->getCell("B3")->getValue()); // Suma los valores de las celdas y lo pone en B5.
    $active_sheet->setCellValue('B5', "=SUM(B1:B3)"); // Pone la Fórmula SUMA de B1 a B3 en B5
    // $active_sheet->getStyle('B5')->getNumberFormat()->setFormatCode(PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_CURRENCY_EUR_SIMPLE); // Formato de la Clase = 0,00 €.
    $active_sheet->getStyle('B5')->getNumberFormat()->setFormatCode('#,##0.00 €'); // Formato Personalizado, Igual que el formato de la clase.

    $writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($file, "Xlsx");
    $file_name = 'Hoja de Prueba.Xlsx';
    $writer->save($file_name);

    header('Content-Type: application/x-www-form-urlencoded');

    header('Content-Transfer-Encoding: Binary');

    header("Content-disposition: attachment; filename=\"".$file_name."\"");

    readfile($file_name);

    unlink($file_name);

    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Testing Excel Cells Style</title>
</head>
<body>
    <h1>Suma las Cantidades Introducidas y Genera una Plantilla de Excel</h1>
    <br>
    <h2>Admite 2 Decimales</h2>
    <br>
    <form action="" method="post">
        <label><input type="number" name="b1" step=".01"> Introduce la Primera Cantidad</label>
        <br><br>
        <label><input type="number" name="b2" step=".01"> Introduce la Segunda Cantidad</label>
        <br><br>
        <label><input type="number" name="b3" step=".01"> Introduce la Tercera Cantidad</label>
        <br><br>
        <input type="submit" name="button" value="Guarda la Planilla Excel">
</body>
</html>