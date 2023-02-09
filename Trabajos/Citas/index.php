<?php
include "includes/conn.php";
$title = "Citas a los Paciantes";
include "includes/header.php";
include "includes/nav-index.html";
include "includes/nav-mob-index.html";
?>
<section class="container-fluid pt-3">
<div class="row">
    <div class="col-md-1"></div>
    <div class="col-md-10">
        <div id="view1">
            <br><br><br><br><br>
            <h1>Página Para Reservar la Cita a los Pacientes</h1>
            <br>
            <h2 class="highlight" id="docname"></h2>
            <br><br>
            <label id="doc_label"><select id="doc" name="doc">
                <option value="">Selecciona un Profesional</option>
                <?php
                $sql = "SELECT id, name FROM docs";
                $stmt = $conn->prepare($sql);
                $stmt->execute();
                while($row = $stmt->fetch(PDO::FETCH_OBJ))
                {
                    echo '<option value="' . $row->id . "," . $row->name . '">' . $row->name . '</option>'; // Este select muestra los nombres de los médicos de la base de datos.
                }
                ?>
            </select> Selecciona el Nombre del Profesional
            <br></label><br><br>
            <label id="date_label"><input id="date" type="date" name="date" onchange="sendDate()">Selecciona la Fecha Para ver las Citas Disponibles
            <br><br></label>
            <?php
            if (isset($_POST["date"])) // Al seleccionar la fecha en el input type date se recarga el script pasandole la fecha y otros datos por post.
            {
                $doc_id = $_POST["doc_id"]; // Recibe la ID del médico, se separa en la función sendDate() de javascript.
                $doc = $_POST["doc"]; // Recibe el nombre del médico, se separa en la función sendDate() de javascript.
                $date = $_POST["date"]; // Recibe la fecha seleccionada.
                $latin = explode("-", $date); // Explota la fecha en la variable $latin, para mostrar la fecha en formato latino.
                echo '<script>let date_label = document.getElementById("date_label");
                let doc_label = document.getElementById("doc_label");
                date_label.style.display = "none";
                doc_label.style.display = "none";
                let docname = document.getElementById("docname");
                docname.innerHTML = "Cita con: ' . $doc . ' el día: ' . $latin[2] . "/" . $latin[1] . "/" . $latin[0] . '";</script>
                <form action="date.php" method="post">
                <label><select name="time" required>
                <option value="">Selecciona una Hora para La Cita</option>'; // Script se javascript, recoge las ID de date_label, de doc_label y los quita de la pantalla, y docname, que es donde muestra El profesional y la fecha de la cita.
                $i = 8; // Hora de comienzo de atención.
                $sql = "SELECT time FROM dates WHERE date='$date' AND doctor_id='$doc_id' ORDER BY time ASC";
                $stmt = $conn->prepare($sql);
                $stmt->execute(); // Busco en la base de datos las citas que tiene el profesional por su ID en el día seleccionado, ordenadas de menor a mayor.
                while ($row = $stmt->fetch(PDO::FETCH_OBJ)) // Mientras haya resultados.
                {
                    for ($i = $i; $i < 20; $i++) // Hago un bucle desde las 8 de la mañana hasta las 19 Hs.
                    {
                        if ($i < 10) // Si $i es menor que 10.
                        {
                            $i = "0" . $i; // Le agrego un cero delante.
                        }
                        if ($row->time != ($i . ":00:00")) // Si la hora de la cita en la columna de la base de datos es distinta al valor de $i más :00:00.
                        {
                            echo '<option value="' . $i . ":00:00" . '">' . $i . ":00:00" . '</option>'; // La pongo como opción para seleccionar.
                        }
                        else // Si ya está cogida esa cita.
                        {
                            $i++; // Incremento $i, ya que esa hora está dada.
                            break; // Rompo el bucle for y espero el siguiente resultado de la base de datos.
                        }
                    }
                }
                for ($i = $i; $i < 20; $i++) // Cuando no hay más resultados en la base de datos, hago un bucle desde el valor con el que terminó $i hasta las 20 Hs.
                {
                    if ($i < 10) // Si $i es menor que 10.
                    {
                        $i = "0" . $i; // Le agrego un cero delante.
                    }
                    echo '<option value="' . $i . ":00:00" . '">' . $i . ":00:00" . '</option>'; // Pongo como opción todos los valores que no están en la base de datos.
                }
                echo '</select> Selecciona la Hora de la Cita</label>
                <br><br>
                <label><select name="client_id" required>
                    <option value="">Selecciona un Paciente</option>'; // Cierro el select, selector de hora de la cita, muestro otro selector para seleccionar el paciente, OJO! en la primera opción hay que poner el value del option sin nada: value="", para que el required del select funcione.
                    $sql = "SELECT id, name FROM clients"; // Busco todos los pacientes en la base de datos.
                    $stmt = $conn->prepare($sql);
                    $stmt->execute();
                    while($row = $stmt->fetch(PDO::FETCH_OBJ)) // Mientras haya resultados.
                    {
                        echo '<option value="' . $row->id . '">' . $row->name . '</option>'; // Los pongo como opción en el selector.
                    }
                    echo '</select> Selecciona el Nombre del Paciente</label>
                    <input type="hidden" name="doctor_id" value="' . $doc_id . '">
                    <input type="hidden" name="date" value="' . $date . '">
                    <br><br>
                    <input type="submit" value="Reserva Esta Cita" class="btn btn-primary">
                    </form>'; // Cierro el select del paciente, agrego los input hidden, doctor_id y date, muestro el botón para enviar el formulario y cierro el formulario.
            }
            ?>
        </div>
        <div id="view2">
            <br><br><br><br>
            <h1>Registro de Pacientes.</h1>
            <br><br>
            <form action="register.php" method="post" target="_blank">
            <label><input type="text" name="client"> Nombre Completo</label>
            <br><br>
            <label><input type="text" name="phone"> Teléfono</label>
            <br><br>
            <label><input type="text" name="email"> E-mail</label>
            <br><br>
            <label><input type="text" name="obs"> Observaciones</label>
            <br><br>
            <input type="submit" value="Registrar al Paciente" class="btn btn-primary">
            </form>
        </div>
        <div id="view3">
            <br><br><br><br>
            <h1>Consulta las Citas de los Pacientes por Fecha o por Paciente</h1>
            <br><br>
            <label><input type="date" name="date" onchange="window.open('showdd.php?date=' + this.value, '_self')">Selecciona la Fecha para ver las Citas de ese Día</label>
            <br><br>
            <label><select name="patient" onchange="window.open('shownd.php?id=' + this.value, '_self')">
                <option value="">Seleciona un/a Paciente</option>
            <?php
                $sql = "SELECT id, name FROM clients";
                $stmt = $conn->prepare($sql);
                $stmt->execute();
                while ($row = $stmt->fetch(PDO::FETCH_OBJ))
                {
                    echo "<option value='$row->id'>$row->name</option>";
                }
            ?>
            </select>Selecciona la Persona</label>
        </div>
        </div>
        <div class="col-md-1"></div>
    </div>
</section>
<?php
include "includes/footer.html";
?>