<?php
include "includes/conn.php";
$title = "Ver Citas por Fecha";
include "includes/header.php";
include "includes/nav-index.html";
include "includes/nav-mob-index.html";
include "includes/modal-index.html";

if (isset($_GET["date"]))
{
    $ok = false;
    $i = 0;
    $doc = [];
    $client = [];
    $time = [];
    $date = $_GET["date"];
    $latin = explode("-", $date);
    $sql = "SELECT * FROM dates WHERE date='$date' ORDER BY doctor_id ASC, time ASC";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    if ($stmt->RowCount() > 0)
    {
        while ($row = $stmt->fetch(PDO::FETCH_OBJ))
        {
            $doc[$i] = $row->doctor_id;
            $client[$i] = $row->client_id;
            $time[$i] = $row->time;
            $i++;
        }

        for ($i = 0; $i < count($doc); $i++)
        {
            $sql = "SELECT name FROM docs WHERE id=$doc[$i]";
            $stmt = $conn->prepare($sql);
            $stmt->execute();
            $doctor[$i] = $stmt->fetch(PDO::FETCH_OBJ);
        }

        for ($i = 0; $i < count($doc); $i++)
        {
            $sql = "SELECT name FROM clients WHERE id=$client[$i]";
            $stmt = $conn->prepare($sql);
            $stmt->execute();
            $patient[$i] = $stmt->fetch(PDO::FETCH_OBJ);
        }
        $ok = true;
    }
    else
    {
        echo "<br><br><br><h1>Todas las Citas del día $latin[2]/$latin[1]/$latin[0] están Libres.</h1>";
    }
?>
<section class="container-fluid pt-3">
<div class="row">
    <div class="col-md-1"></div>
    <div class="col-md-10">
        <div id="view1">
            <br><br><br>
            <?php
            if ($ok)
            {
                echo "<h1>Citas de la Fecha: $latin[2]/$latin[1]/$latin[0]</h1>
                <br><br>
                <script>var doctor = [];</script>
                <script>var patient = [];</script>
                <script>var time = [];</script>";

                for ($i = 0; $i < count($doc); $i++)
                {
                    echo "<script>doctor[" . $i . "] = '" . $doctor[$i]->name . "';
                    patient[" . $i . "] = '" . $patient[$i]->name . "';
                    time[" . $i . "] = '" . $time[$i] . "';</script>";
                }
            }
            ?>
            <div id="table"></div>
            <br>
            <span id="page"></span>&nbsp;&nbsp;&nbsp;&nbsp;
            <button onclick="prev('date')" id="prev" class="btn btn-danger" style="visibility: hidden;">Anteriores Resultados</button>&nbsp;&nbsp;&nbsp;&nbsp;
            <button onclick="next('date')" id="next" class="btn btn-primary" style="visibility: hidden;">Siguientes Resultados</button><br>
            <script>change(1, 8, 'date');</script>
        </div>
    </div>
    <div class="col-md-1"></div>
</div>
</section>
<?php
}
else
{
    echo '<script>toast(2, "ERROR", "Has Llegado Aquí por Error.");</script>';
}
include "includes/footer.html";
?>