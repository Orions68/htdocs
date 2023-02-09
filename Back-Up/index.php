<?php
include "includes/modal.html";
$title = "Auto Actualizador de Proyectos en Back-Up";
include "includes/header.php";

$folder = $_SERVER['DOCUMENT_ROOT'];
chdir($folder);
$files = array_values(array_diff(scandir($folder), array('.', '..')));
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
                    <h1>Selecciona la Carpeta del Proyecto para Actualizar la Copia de Seguridad a un Archvio .zip</h1>
                    <br><br>
                    <label><select id="folder" name="project" onchange="window.open(\'project.php?project=\' + document.getElementById(this.id).value, \'_self\')">
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
include "includes/footer.html";
?>