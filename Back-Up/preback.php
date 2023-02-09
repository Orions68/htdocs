<?php
include "includes/modal.html";
$title = "Un Paso Más";
include "includes/header.php";
if (isset($_REQUEST["decision"]))
{
    $project = $_REQUEST["project"];
    $decision = $_REQUEST["decision"];
    if ($decision == "SI")
    {
        chdir($_SERVER['DOCUMENT_ROOT'] . "/" . $project);
        $images_dir = getcwd();
        $rootPath = realpath($images_dir);

        // Initialize archive object
        $zip = new ZipArchive();
        $zip->open('backup.zip', ZipArchive::CREATE | ZipArchive::OVERWRITE);

        // Create recursive directory iterator
        /** @var SplFileInfo[] $files */
        $files = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($rootPath), RecursiveIteratorIterator::LEAVES_ONLY);

        foreach ($files as $name => $file)
        {
            // Skip directories (they would be added automatically)
            if (!$file->isDir())
            {
                // Get real and relative path for current file
                $filePath = $file->getRealPath();
                $relativePath = substr($filePath, strlen($rootPath) + 1);

                // Add current file to archive
                $zip->addFile($filePath, $relativePath);
            }
        }

        // Zip archive will be created only after closing object
        $zip->close();
        echo '<script>if(!alert("Archivo backup.zip Guardado en la Carpeta del Proyecto.")) window.open("index.php", "_self");</script>';
    }
    else
    {
        $path = $_SERVER["DOCUMENT_ROOT"] . "/" . $project;
        chdir($path);
        $folder = "./";
        if ($path == $_SERVER["DOCUMENT_ROOT"] . "/")
        {
            $files = array_values(array_diff(scandir($folder), array('.', '..')));
        }
        else
        {
            $files = array_diff(scandir($folder), array('', '.'));
        }
        echo '
        <section class="container-fluid pt-3">
        <div id="pc"></div>
            <div id="mobile"></div>
            <div class="row">
                <div class="col-md-1"></div>
                    <div class="col-md-10">
                        <div id="view1">
                            <br><br><br>
                            <h1>Seleciona una Carpeta</h1>
                            <br><br>
                            <h2>Haz Seleccionado: ' . $project . '</h2>
                            <br><br>
                            <h3>Selecciona la Carpeta del Proyecto para Actualizar la Copia de Seguridad</h3>
                            <label><select id="folder" name="project" onchange="window.open(\'project.php?project=' . $project . '/\' + document.getElementById(this.id).value, \'_self\')">
                            <option value="">Selecciona de Aquí</option>';
                            for ($i = 0; $i < count($files); $i++)
                            {
                                echo '<option value="' . $files[$i] . '">' . $files[$i] . '</option>';
                            }
                            echo '</select>Selecciona la Carpeta</label>
                        </div>
                    </div>
                <div class="col-md-1"></div>
            </div>
        </section>
        ';
    }
}
?>