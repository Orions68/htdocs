<?php // Script para eliminar un perfil de espectador.
include "includes/conn.php";

if (isset($_POST["id"])) // Si se recibe la id del espectador.
{
    $id = $_POST["id"];
    $sql = "DELETE FROM clients WHERE id=$id";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    if ($stmt->rowCount()) // Lo borró de la base de datos.
    {
        if (is_dir("clients/" . $id)) // Si existe su carpeta con la foto de perfil.
        {
            foreach(new RecursiveIteratorIterator(new RecursiveDirectoryIterator($id, FilesystemIterator::SKIP_DOTS), RecursiveIteratorIterator::CHILD_FIRST) as $path)
            {
                $path->isFile() ? unlink($path->getPathname()) : rmdir($path->getPathname()); // Busco todos los archivos recursivamente para eliminarlos todos.
            }
            chdir("clients"); // Cambia a la carpeta clients.
            rmdir($id); // Elimina la carpeta del espectador(su ID).
        }
        session_destroy(); // Destruyo la sesión
        echo "<script>if (!alert('Se Ha Eliminado Tu Perfil, Gracias por Comprar Tus Entradas Aquí.')) window.open('index.php', '_self');</script>"; // Muestro una alerta, se ha eliminado.
    }
}
else // Si no llegaron datos por POST.
{
    echo "<script>if (!alert('Llegaste Aquí por Error, No se ha Eliminado Ningún Perfil.')) window.open('index.php', '_self');</script>"; // Nada se ha eliminado.
}
?>