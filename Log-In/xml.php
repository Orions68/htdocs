<?php
include 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;

	$id = $_POST['id'];
	$name = $_POST['name'];
	$email = $_POST['email'];
	$phone = $_POST['phone'];
	$user = $_POST['user'];
	$birth = $_POST['birth'];
	
if (isset($_POST['export']))
{
	$file = new Spreadsheet();
		
	$active_sheet = $file->getActiveSheet();
	
	$active_sheet->setCellValue('A1', 'Nº de Orden');
	$active_sheet->setCellValue('B1', 'Nombre');
	$active_sheet->setCellValue('C1', 'E-mail');
	$active_sheet->setCellValue('D1', 'Teléfono');
	$active_sheet->setCellValue('E1', 'Usuario');
	$active_sheet->setCellValue('F1', 'Nacimiento');
	
	$count = 2;
	
	$active_sheet->setCellValue('A' . $count, $id);
	$active_sheet->setCellValue('B' . $count, $name);
	$active_sheet->setCellValue('C' . $count, $email);
	$active_sheet->setCellValue('D' . $count, $phone);
	$active_sheet->setCellValue('E' . $count, $user);
	$active_sheet->setCellValue('F' . $count, $birth);
	$count++;
	
	$writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($file, $_POST["file_type"]);
		
	$file_name = $name . '.' . strtolower($_POST["file_type"]);
	
	$writer->save($file_name);
	
	header('Content-Type: application/x-www-form-urlencoded');
	
	header('Content-Transfer-Encoding: Binary');
	
	header("Content-disposition: attachment; filename='" . $file_name . "'");
	
	readfile($file_name);
	
	unlink($file_name);
	
	exit;
}

?>
<!DOCTYPE html>
<html>

<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta content="es" http-equiv="Content-Language">
<meta content="text/html; charset=utf-8" http-equiv="Content-Type">
<link rel="stylesheet" href="inc/bootstrap.min.css" />
<title>Descarga XML</title>
</head>

<body>
<div class="container">
    		<br />
    		<h3 align="center">Guarda la lista de los Cumpleaños.</h3>
    		<br />
        <div class="panel panel-default">
        <div class="panel-heading">
            <form method="post">
              <div class="row">
                <div class="col-md-6">Cumpleaños de Clientes</div>
                <div class="col-md-4">
                <input type="hidden" name="id" value="<?php echo $id; ?>">
                <input type="hidden" name="name" value="<?php echo $name; ?>">
                <input type="hidden" name="email" value="<?php echo $email; ?>">
                <input type="hidden" name="phone" value="<?php echo $phone; ?>">
                <input type="hidden" name="user" value="<?php echo $user; ?>">
                <input type="hidden" name="birth" value="<?php echo $birth; ?>">
                  <select name="file_type" class="form-control input-sm">
                    <option value="Xlsx">Xlsx</option>
                    <option value="Xls">Xls</option>
                    <option value="Csv">Csv</option>
                  </select>
                </div>
                <div class="col-md-2">
                  <input type="submit" name="export" class="btn btn-primary btn-sm" value="Descarga el Informe" />
                </div>
              </div>
            </form>
          </div>
          <div class="panel-body">
        		<div class="table-responsive">
        			<table class="table table-striped table-bordered">
		                <tr>
		                  <th>Nº de Orden</th>
		                  <th>Nombre</th>
		                  <th>E-mail</th>
		                  <th>Telefono</th>
		                  <th>Usuario</th>
		                  <th>Nacimiento</th>
		                </tr>
		                <?php
		                  echo '
		                  <tr>
		                  	<td>' . $id . '</td>
		                    <td>' . $name . '</td>
		                    <td>' . $email . '</td>
		                    <td>' . $phone . '</td>
		                    <td>' . $user . '</td>
		                    <td>' . $birth . '</td>
		                  </tr>
		                  ';
		                ?>
		            </table>
        		</div>
          </div>
    </div>
    </div>
    <br />
    <br />
    <script src="inc/jquery.min.js"></script>
	<input type="button" value="Cierra Esta Ventana" onclick="window.close()">

</body>

</html>