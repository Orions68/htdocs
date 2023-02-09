<?php
include "includes/conn.php";

if (isset($_POST["id"]))
{
    $id = $_POST["id"];
    $sql = "DELETE FROM company WHERE id='$id'";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    if ($stmt->rowCount())
    {
        if (is_dir("companies/emp-" . $id))
        {
            foreach(new RecursiveIteratorIterator(new RecursiveDirectoryIterator("emp-" . $id, FilesystemIterator::SKIP_DOTS), RecursiveIteratorIterator::CHILD_FIRST) as $path)
            {
                $path->isFile() ? unlink($path->getPathname()) : rmdir($path->getPathname());
            }
            chdir("companies");
            rmdir("emp-" . $id);
        }
        echo "<script>if (!alert('Se Ha Eliminado Tu Perfil, Gracias por Publicar Tus Eventos Aquí.')) window.open('index.php', '_self');</script>";
    }
    else
    {
        echo "<script>if (!alert('Llegaste Aquí por Error, No se ha Eliminado Ningún Perfil.')) window.open('index.php', '_self');</script>";
    }
}
?>