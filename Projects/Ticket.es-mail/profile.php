<?php
include "includes/conn.php";
$title = "Ticket.es - Perfil del Espectador";
include "includes/header.php";
include "includes/modal2.html";
include "includes/nav-esp.html";
?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
<script src="js/script2.js"></script>
<?php
    if (isset($_SESSION["id"])) // Verifico si la sesión no está vacia.
    {
        $id = $_SESSION["id"]; // Asigno a la variable $id el valor de la sesión id.
        $sql = "SELECT * FROM clients WHERE id='$id';"; // Preparo una consulta por la ID.
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_OBJ); // Asigno el resultado a la variable $row.
        $name = $row->name; // Asigno el contenido de $row a variables.
        $phone = $row->phone;
        $email = $row->email;
        $bday = $row->bday;
        $date = date('Y-m-d', strtotime($bday));
        $gender = $row->gender;
        $path = $row->path;
        $name1 = explode(" ", $name);
        echo "<span>Te Damos la Bienvenida $name1[0] </span>"; // Muestro la bienvenida en el NAV y el nombre del cliente.
        echo "<img src='" . $row->path . "' alt='Tú Imagen de Perfil' width='100' height='100'><a href='login.php' style='margin-left:50px;'>Compra Tus Entradas</a>";
        // Muestro la imagen del cliente y el enlace para volver al login(Comprar Pintura).
    }
    else
    {
        echo "<script>toast(1, 'Ha Habido un Error', 'Has Llegado Aquí por Error.');</script>"; // Error, has llegado por el camino equivocado.
    }
    // Muestro el formulario con los datos del cliente por si quiere modificar o eliminar su perfil.
    ?>
    </div>
</nav>
<section class="container-fluid pt-3">
    <div class="row">
        <div class="col-md-1"></div>
            <div class="col-md-10">
                <div id="page_top">
                <br><br><br><br>
                <div class="row">
                    <div class="col-md-6">
                        <h2>Aquí Podrás Modificar tus Datos.</h2>
                        <br>
                        <h3><span style="color: red; font-size: 1.5rem;">Atención: </span> por razones de seguridad la Contraseña no se muestra, si no quieres cambiarla deja ambas casillas en blanco y se mantendrá la contraseña que tenías.</h3>
                        <br>
                        <form action='modify.php' method='post' enctype='multipart/form-data' onsubmit='return verify(1)'>
                        <label><input type='text' name='username' value='<?php echo $name; ?>' required> Nombre Completo</label>
                        <br><br>
                        <label><input type='text' name='phone' value='<?php echo $phone; ?>' required> Teléfono</label>
                        <br><br>
                        <label><input type='email' name='email' value='<?php echo $email; ?>' required> E-mail</label>
                        <br><br>
                        <label><input type='password' name='pass' id='pass3' onkeypress="showEye(3)"> Contraseña</label>
                        <i onclick="spy(3)" class="far fa-eye" id="togglePassword3" style="margin-left: -140px; cursor: pointer; visibility: hidden;"></i>
                        <br><br>
                        <label><input type='password' id='pass4' onkeypress="showEye(4)"> Repite Contraseña</label>
                        <i onclick="spy(4)" class="far fa-eye" id="togglePassword4" style="margin-left: -205px; cursor: pointer; visibility: hidden;"></i>
                        <br><br>
                        <label><input type='date' name='bday' value='<?php echo $date; ?>' required> Fecha de Nacimiento</label>
                        <br><br>
                        <?php
                        if ($gender == 0)
                        {
                            echo "<label><input type='radio' name='gender' value='0' checked> Mujer</label>
                        <br><br>";
                        echo "<label><input type='radio' name='gender' value='1'> Varón</label>
                        <br><br>";
                        }
                        else
                        {
                            echo "<label><input type='radio' name='gender' value='0'> Mujer</label>
                        <br><br>";
                        echo "<label><input type='radio' name='gender' value='1' checked> Varón</label>
                        <br><br>";
                        }
                        ?>
                        <label><img src='<?php echo $path; ?>' alt='Tú Imagen de Perfil' width='100' height='100'><input type='file' name='profile'> Sube tu Imagen</label>
                        <input type='hidden' name='path' value='<?php echo $path; ?>'>
                        <br><br>
                        <input type='submit' value='Modificar'>
                        </form>
                    </div>
                    <div class="col-md-1"></div>
                    <div class="col-md-3">
                        <h2>O Eliminar tu Perfil</h2>
                        <br><br><br>
                        <form action="delete.php" method="post">
                            <input type="hidden" name="id" value="<?php echo $_SESSION['id']; ?>">
                            <input type="submit" value="Eliminar Mi Perfil">
                        </form>
                    </div>
                </div>
            </div>
        <div class="col-md-1"></div>
    </div>
</section>
<?php
include "includes/footer.html";
?>
<script>screenSize();</script>
<script>checkTitle()</script> <!-- Llamo a la función checkTitle() para esconder el botón del carro de la compra. -->
</body>
</html>