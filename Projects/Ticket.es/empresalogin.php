<?php
include "includes/conn.php";
$title = "Ticket.es - Entrada de Empresas";
include "includes/header.php";
include "includes/mod-emp-log.html";
include "includes/showLogin.php";
echo '<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
<script src="js/script2.js"></script>';

$ok = false;
include "includes/nav-emp.html";
    if (isset($_POST["email"])) // Verifico si llegan datos por post.
    {
        $email = htmlspecialchars($_POST["email"]); // Asigno los datos por post a variables con el filtro htmlspecialchars().
        $pass = htmlspecialchars($_POST["pass"]);

        $sql = "SELECT * FROM company WHERE email='$email';"; // Preparo la consulta con el email.
        $ok = show($conn, $sql, $pass, "comp"); // Asigno el resultado de la función show() a la variable $ok, a show le paso la conexion, la consulta, la contraseña y quien se loguea.
        if (!$ok) // Si $ok está a false.
        {
            echo "<script>toast(1, 'Hay un Error', 'No Se han Encontrado Datos de $email, Vuelve al Inicio e Intenta Iniciar Sesión con el E-mail con el que Registraste la Empresa.');</script>";
            // Hubo un error, no se ha encontrado el cliente en la tabla.
        }
        else
        {
            echo "</div></nav>";
            include "includes/disc-emp.php";
        }
    }
    else // Si no hay datos por post.
    {
        if (isset($_SESSION["idc"])) // Verifico que la sesión esté iniciada.
        {
            $id = $_SESSION["idc"]; // Asigno a $id el valor de la sesión id.
            $sql = "SELECT * FROM company WHERE id='$id';"; // Preparo la consulta buscando solo por la id.
            $ok = show($conn, $sql, "", "comp"); // Asigno a la variable $ok el resultado de la función show().
            echo "</div></nav>";
            include "includes/disc-emp.php";
        }
        else
        {
            echo "<script>toast(2, 'Error Grave:', 'Haz Llegado Aquí por Error.');</script>";
        }
    }
    if (!$ok) // Si $ok está a false.
    {
        echo "<script>toast(1, 'Hay un Error', 'No Se han Encontrado Datos de $email, Vuelve al Inicio e Intenta Iniciar Sesión con el E-mail con el que Registraste la Empresa.');</script>";
        // Hubo un error, no se ha encontrado el cliente en la tabla.
    }
    else // Si se encontró.
    {
        $id = $_SESSION["idc"];
        $sql = "SELECT active FROM company WHERE id='$id';"; // Preparo la consulta de la columna active.
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        if ($stmt->rowCount() > 0) // Si hay resultados.
        {
            $row = $stmt->fetch(PDO::FETCH_OBJ); // Asigno a la variable $row el resultado.
            if (!$row->active)
            {
                echo "<script>toast_disc();</script>";
            }
        }
    ?>
    <section class="container-fluid pt-3">
        <div class="row">
            <div class="col-md-1"></div>
                <div class="col-md-10">
                    <div id="page_top">
                    <br><br><br>
                        <h2>Publica Tus Eventos</h2>
                        <br>
                        <form action="publish.php" method="post" enctype="multipart/form-data">
                        <label><select name="kind" required>
                            <option value="">Selecciona un Evento</option>
                            <option value="Concierto">Conciertos</option>
                            <option value="Teatro">Obra de Teatro</option>
                            <option value="Cine">Cine</option>
                            <option value="Clásico">Exposición de Arte Clásico</option>
                            <option value="Moderno">Exposición de Arte Moderno</option>
                            <option value="Parque">Parque Temático</option>
                            <option value="Circo">Circos</option>
                            <option value="Charla">Charlas</option>
                            <option value="Debate">Debates</option>
                            <option value="Deportes">Deportes</option>
                        </select> Selecciona Clase de Evento</label>
                        <br><br>
                            <label><input type="text" name="place" required> Donde Será</label>
                            <br><br>
                            <label><input type="date" name="start" required> Fecha de Inicio</label>
                            <br><br>
                            <label><input type="date" name="end" required> Fecha de Finalización</label>
                            <br><br>
                            <label><input type="time" name="hour" required> Hora del Evento</label>
                            <br><br>
                            <label><input type="text" name="price" required> Precio</label>
                            <br><br>
                            <label><input type="text" name="title" required> Título del Evento</label>
                            <br><br>
                            <label><input type="text" name="description" required> Descripción</label>
                            <br><br>
                            <label><input type="text" name="places" required> Aforo</label>
                            <br><br>
                            <label><input type="file" name="files[]" multiple id="files" onchange="checkFiles(this.files)" required> Sube Hasta 3 Fotos<small>(Mínimo una Obligatoria)</small></label>
                            <br><br>
                            <input type="submit" value="Publica Mi Evento">
                        </form>
                    </div>
                </div>
            <div class="col-md-1"></div>
        </div>
    </section>
    <?php
    }
include "includes/footer.html";
?>
<script>screenSize();</script>
</body>
</html>