<?php // Script para eliminar un perfil de empresa.
include "includes/conn.php";

if (isset($_POST["id"])) // Si se recibe la id de la empresa.
{
    $id = $_POST["id"];
    $sql = "DELETE FROM company WHERE id=$id";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    if ($stmt->rowCount()) // Lo borró de la base de datos.
    {
        if (is_dir("companies/emp-" . $id)) // Si existe su carpeta con las fotos de los evemtos.
        {
            foreach(new RecursiveIteratorIterator(new RecursiveDirectoryIterator("emp-" . $id, FilesystemIterator::SKIP_DOTS), RecursiveIteratorIterator::CHILD_FIRST) as $path)
            {
                $path->isFile() ? unlink($path->getPathname()) : rmdir($path->getPathname()); // Busco todos los archivos recursivamente para eliminarlos todos.
            }
            chdir("companies"); // Cambia a la carpeta companies.
            rmdir("emp-" . $id); // Elimina la carpeta de la empresa(su ID).
        }
        session_destroy(); // Destruyo la sesión.
        echo "<script>if (!alert('Se Ha Eliminado Tu Perfil, Gracias por Publicar Tus Eventos Aquí.')) window.open('index.php', '_self');</script>"; // Muestro alerta, se ha eliminado.
    }
}
else // Si no llegaron datos por POST.
{
    echo "<script>if (!alert('Llegaste Aquí por Error, No se ha Eliminado Ningún Perfil.')) window.open('index.php', '_self');</script>"; // Muestro alerta, nada se ha eliminado.
}
?>