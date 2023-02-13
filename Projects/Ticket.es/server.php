<?php
if (json_decode(file_get_contents('php://input'), true)) // Esta linea es usada por IOS, la app para iPhone, android no la necesita, si el script está recibiendo datos, ya sea por GET o por POST.
{
        $_POST = json_decode(file_get_contents('php://input'), true); // Asigna los datos a la variable $_POST de tipo array.
}

if (isset($_POST["id"])) // Verifico si ha llegado algo por POST en el array $_POST["id"].
{
	$id = $_POST["id"]; // Si hay datos, asigna a la variable $id el contenido del array $_POST["id"].
	$data = $_POST["data"]; // Hace lo mismo con el contenido de $_POST["data"] en la variable $data.
	$client = $_POST["client"];
    if (!is_dir("Tickets/" . $client))
    {
        mkdir("Tickets/" . $client); // Crea la carpeta Tickets/id del cliente/id del evento.
    }
    if (!is_dir("Tickets/" . $client . "/" . $id))
    {
        mkdir("Tickets/" . $client . "/" . $id);
    }
	$name = "Tickets/" . $client . "/" . $id . "/tickets.txt"; // Asigna a la variable $name un nombre de archivo "Tickets/id cliente/id evento/tickets.txt".
	$file = fopen($name, "w") or die("Unable to open file!"); // Crea un archivo para escribir en él, con el nombre del contenido de la variable $name, dentro de la carpeta Tickets...
	fwrite($file, $id); // Escribe el contenido de la variable $id.
	fwrite($file, "¡"); // Escribe : en el archivo a continuación de la id, se separa por el caracter ¡ para poder hacer un split posteriormente.
	fwrite($file, $data); // Escribe los datos en el archivo a continuación.
	fclose($file); // Cierra el archivo, siempre que se abre un archivo para escritura, lectura o agregado hay que cerrarlo al final.
	$response["error"] = false; // Asigna al array $response["error"] el booleano false, será la respuesta a la llamada al servicio desde la app.;
	echo json_encode($response); // Devuelve un Jason con el array $response.
	exit(); // sale de la llamada de la app al servicio.
}
?>