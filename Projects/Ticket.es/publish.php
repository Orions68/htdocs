<?php
include "includes/conn.php"; // Uso una conexión PDO a la base de datos.
$title = "Ticket.es - Entrada de Empresas";
include "includes/header.php";
include "includes/modal-emp.html";
if (isset($_POST["kind"])) // Si se reciben datos por POST.
{
    $id = $_SESSION["idc"]; // Cargo los datos del formulario en variable.
    $kind = $_POST["kind"];
    $place = $_POST["place"];
    $price = $_POST["price"];
    $start = $_POST["start"];
    $end = $_POST["end"];
    $hour = $_POST["hour"];
    $event = $_POST["title"];
    $desc = $_POST["description"];
    $places = $_POST["places"];
    $position = 0;
    $ok = false;

    $stmt = $conn->prepare("INSERT INTO events VALUES (:id, :id_empresa, :place, :price, :start, :end, :hour, :places, :sold, :position);"); // Preparo la consulta para insertar los datos en la tabla events.

        $stmt->execute(array(':id' => null, ':id_empresa' => $id, ':place' => $place, ':price' => $price, ':start' => $start, ':end' => $end, ':hour' => $hour, ':places' => $places, ':sold' => 0, ':position' => $position));

        $event_id = $conn->lastInsertId(); // Asigno a la variable $id la última id guardada en la tabla.
        
        if ($_FILES["files"]["name"] != "") // Se verifica si llegan imágenes, debería llegar al menos 1, ya que es required en el input type file.
        {
            $path = "companies/emp-" . $id . "/" . $event_id; // Se asigna a $path la ruta donde se guardarán las imágenes del evento a publicar.
            if (!is_dir($path)) // Si no existe el directorio.
            {
                mkdir($path, 0777, true); // Lo creo.
            }
            chdir ($path); // Cambio a la carpeta que acabo de crear.
            $array = $_FILES['files']['tmp_name']; // Cargo en un array los nombres provisorios de los archivos subidos.
            for($i = 0; $i < count($_FILES['files']['name']); $i++) // Hago un bucle a la cantidad de archivos subidos.
            {
                $file_name = $array[$i]; // Asigno a la variable $file_name el contenido del array en cada posición.
                if ($file_name != "") // Si el nombre de archivo contiene datos.
                {
                    if(move_uploaded_file($file_name, $_FILES['files']['name'][$i])) // Muevo los nombres al array de archivos recibidos.
                    {
                        $my_path[$i] = $path . "/" . basename($_FILES['files']['name'][$i]); // creo la ruta completa concatenando los nombres de las imágenes subidas a la ruta donde se guardan.
                        $ok = true; // Pongo la variable $ok a true.
                    }
                }
            }
        }
        $stmt = $conn->prepare("INSERT INTO details VALUES (:id, :id_event, :kind, :title, :description, :path);"); // Preparo una consulta para Insertar en la tabla details.
        switch (count($my_path)) // Tengo que insertar los datos según la cantidad de archivos subidos.
        {
            case 3: // Si se subieron 3 fotos.
                $stmt->execute(array(':id' => null, ':id_event' => $event_id, ':kind' => $kind, ':title' => $event, ':description' => $desc, ':path' => $my_path[0] . "¡" . $my_path[1] . "¡" . $my_path[2])); // La Ejecuto.
                break; // Ejecuto el Insert con las 3 rutas a las imágenes concatenadas y separadas por el ¡.
            case 2: // Si se subieron 2 fotos.
                $stmt->execute(array(':id' => null, ':id_event' => $event_id, ':kind' => $kind, ':title' => $event, ':description' => $desc, ':path' => $my_path[0] . "¡" . $my_path[1])); // La Ejecuto.
                break; // Ejecuto el Insert con las 2 rutas a las imágenes concatenadas y separadas por el ¡.
            default: // Si se subió 1 fotos.
                $stmt->execute(array(':id' => null, ':id_event' => $event_id, ':kind' => $kind, ':title' => $event, ':description' => $desc, ':path' => $my_path[0])); // La Ejecuto.
                break; // Ejecuto el Insert con la ruta a la imagen.
        }

        $conn = null;
        if ($ok) // Si todo ha ido bien.
        {
            echo "<script>toast(0, 'Evento Agregado', 'El Evento $kind: $event se ha Agregado, ya Puedes Poner a la Venta las Entradas Online.');</script>"; // Muestro el mensaje de OK.
        }
}
include "includes/footer.html";
?>