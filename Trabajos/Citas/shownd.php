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
    $date = [];
    $time = [];
    $id = $_GET["id"];
    $sql = "SELECT name FROM clients WHERE id=$id";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_OBJ);
    $patient = $row->name;
    $sql = "SELECT * FROM dates WHERE client_id=$id ORDER BY date ASC, time ASC";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    if ($stmt->RowCount() > 0)
    {
        while ($row = $stmt->fetch(PDO::FETCH_OBJ))
        {
            $doc[$i] = $row->doctor_id;
            $date[$i] = $row->date;
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
        $ok = true;
    }
?>
<section class="container-fluid pt-3">
<div class="row">
    <div class="col-md-1"></div>
    <div class="col-md-10">
        <div id="view1">
            <br><br><br><br><br>
            <?php
            if ($ok)
            {
                echo "<h1>Citas de: $patient</h1>
                <br><br>
                <script>var doctor = [];</script>
                <script>var date = [];</script>
                <script>var time = [];</script>";

                for ($i = 0; $i < count($doc); $i++)
                {
                    echo "<script>doctor[" . $i . "] = '" . $doctor[$i]->name . "';
                    date[" . $i . "] = '" . $date[$i] . "';
                    time[" . $i . "] = '" . $time[$i] . "';</script>";
                }
            }
            else
            {
                echo "<h1>La Persona $patient No Tiene Ninguna Cita Programada.</h1>";
            }
            ?>
            <div id="table"></div>
            <br>
            <span id="page"></span>&nbsp;&nbsp;&nbsp;&nbsp;
            <button onclick="prev('patient')" id="prev" class="btn btn-danger" style="visibility: hidden;">Anteriores Resultados</button>&nbsp;&nbsp;&nbsp;&nbsp;
            <button onclick="next('patient')" id="next" class="btn btn-primary" style="visibility: hidden;">Siguientes Resultados</button><br>
            <script>change(1, 8, 'patient');</script>
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