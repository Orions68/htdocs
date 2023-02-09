<?php
include "includes/conn.php";

if (isset($_POST["id"]))
{
    $id = $_POST["id"];
    $sql = "DELETE FROM clients WHERE id='$id'";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    if ($stmt->rowCount())
    {
        if (is_dir("clients/" . $id))
        {
            foreach(new RecursiveIteratorIterator(new RecursiveDirectoryIterator($id, FilesystemIterator::SKIP_DOTS), RecursiveIteratorIterator::CHILD_FIRST) as $path)
            {
                $path->isFile() ? unlink($path->getPathname()) : rmdir($path->getPathname());
            }
            chdir("clients");
            rmdir($id);
        }
        echo "<script>if (!alert('Se Ha Eliminado Tu Perfil, Gracias por Comprar Tus Entradas Aquí.')) window.open('index.php', '_self');</script>";
    }
    else
    {
        echo "<script>if (!alert('Llegaste Aquí por Error, No se ha Eliminado Ningún Perfil.')) window.open('index.php', '_self');</script>";
    }
}
?>