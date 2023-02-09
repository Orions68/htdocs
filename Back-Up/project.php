<?php
include "includes/modal.html";
$title = "Selección del Proyecto";
include "includes/header.php";
if (isset($_REQUEST["project"]))
{
    $path = false;
    $project = $_REQUEST["project"];
    $array = explode("/", $project);
    $size = count($array);
    echo $size;
    if ($array[$size - 1] == "..")
    {
        $project = "";
        for ($i = 0; $i < $size - 1; $i++)
        {
            if ($i == $size - 2 || $size - 2 == 0)
            {
                if (!$path)
                {
                    $project = "";
                    echo "Acá estoy en el principio: $project";
                }
                else
                {
                    $project = substr($project, 0, -1);
                    echo "Acá estoy con Ruta: $project";
                }
            }
            else
            {
                $path = true;
                $project .= $array[$i] . "/";
            }
        }
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
                        <h1>Es esta la Carpeta del Proyecto?</h1>
                        <br><br>
                        <h2>Haz Seleccionado: ' . $project . '</h2>
                        <br><br>
                        <label><select id="disyunt" name="isit" onchange="window.open(\'preback.php?decision=\' + document.getElementById(this.id).value + \'&project=' . $project . '\', \'_self\')">
                        <option value="">Selecciona SI o NO</option>
                        <option value="SI">SI</option>
                        <option value="NO">NO</option>
                    </div>
                </div>
            <div class="col-md-1"></div>
        </div>
    </section>
    ';
}
include "includes/footer.html";
?>