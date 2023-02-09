<?php
include "includes/conn.php";
$title = "Cita del Paciente";
include "includes/header.php";
include "includes/nav-index.html";
include "includes/nav-mob-index.html";
include "includes/modal-index.html";
?>
    <?php
    if (isset($_POST["time"])) // Si recibe por post la hora de la cita.
    {
        $date = $_POST["date"]; // Obtiene la fecha en la variable $date.
        $latin = explode("-", $date);
        $time = $_POST["time"]; // Obtiene la hora de la cita en la variable $time.
        $client_id = $_POST["client_id"]; // Obtiene la ID del paciente.
        $sql = "SELECT phone, email FROM clients WHERE id=$client_id";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_OBJ);
        $doctor_id = $_POST["doctor_id"]; // Obtiene la ID del profesional.
        $sql = "SELECT name FROM docs WHERE id=$doctor_id";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $name = $stmt->fetch(PDO::FETCH_OBJ);
        $sql = "INSERT INTO dates VALUES (:id, :doctor_id, :client_id, :date, :time);"; // Lo Inserto en la base de datos.
        $stmt = $conn->prepare($sql);
        $stmt->execute(array(':id' => null, ':doctor_id' => $doctor_id, ':client_id' => $client_id, ':date' => $date, ':time' => $time));
    ?>
        <section class="container-fluid pt-3">
            <div class="row">
                <div class="col-md-1"></div>
                <div class="col-md-10">
                <div id="view1">
                    <br><br><br><br><br>
                    <h1>Agrega al Calendario de Google de la Empresa el Calendario con el E-mail de la Persona, si ya esta creada la Persona, Agrega la Fecha y Hora de la Cita (una hora antes) y Comparte el Calendario con esa Persona Añadiendo su Dirección de E-mail.</h1>
                    <h1>Copia el Texto de Debajo y Pegalo en el Título del Calendario de Google de la Persona</h1>
                    <h1>Cita a las <?php echo $time; ?> Hs. en Molini Menchón Odontólogos con <?php echo $name->name; ?>.</h1>
                    <input id="whatsapp" type="hidden" value="<?php echo $result->phone; ?>">
                    <br><br>
                    <h2>La Persona con E-mail: <?php echo $result->email; ?></h2>
                    <h2>Tiene la Cita el día: <?php echo $latin[2] . "/" . $latin[1] . "/" . $latin[0] . " a las: " . $time; ?> Hs.</h2>
                    <h2>Con: <?php echo $name->name; ?></h2>
                    <br><br>
                    <button onclick="connect('<?php echo $date; ?>', '<?php echo $time; ?>', '<?php echo $name->name; ?>')" class="btn btn-success">Envía un Whatsapp al Paciente</button>
                    <br><br>
                    <button onclick="window.open('https://calendar.google.com/calendar/u/0/r', '_blank')" class="btn btn-secondary">Al Calendario a Programar la Cita</button>
                    <br><br>
                    <button onclick="window.open('index.php', '_self')" class="btn btn-danger">Volver al Inicio</button>
                </div>
                <div id="view2">
                    <br><br><br><br>
                </div>
                <div id="view3">
                    <br><br><br><br>
                </div>
                </div>
                <div class="col-md-1"></div>
            </div>
        </section>
<?php
    }
    else
    {
        echo "<script>toast(2, 'ERROR', 'Has Llegado Aquí por Error.');</script>";
    }
include "includes/footer.html";
?>