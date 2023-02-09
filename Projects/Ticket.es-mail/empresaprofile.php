<?php
include "includes/conn.php";
$title = "Ticket.es - Perfil de Empresa";
include "includes/header.php";
include "includes/modal2.html";
include "includes/nav-emp.html";
?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
<script src="js/script2.js"></script>
<?php
    if (isset($_SESSION["id"])) // Verifico si la sesión no está vacia.
    {
        $id = $_SESSION["id"]; // Asigno a la variable $id el valor de la sesión id.
        $sql = "SELECT * FROM company WHERE id='$id';"; // Preparo una consulta por la ID.
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_OBJ);
        $name = $row->name; // Asigno el contenido de $row a variables.
        $email = $row->email;
        $name1 = explode(" ", $name);
        echo "<span>Te Damos la Bienvenida $name1[0] </span>"; // Muestro la bienvenida en el NAV y el nombre del cliente.
        echo "<a href='empresalogin.php' style='margin-left:50px;'>Publica tus Eventos</a>";
        // Muestro la imagen del cliente y el enlace para volver al login(Comprar Pintura).
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
                        <form action='empresamodify.php' method='post' enctype='multipart/form-data' onsubmit='return verify(0)'>
                        <label><input type='text' name='username' value='<?php echo $name; ?>' required> Nombre Completo</label>
                        <br><br>
                        <label><input type='email' name='email' value='<?php echo $email; ?>' required> E-mail</label>
                        <br><br>
                        <label><input type='password' name='pass' id='pass0' onkeypress="showEye(0)"> Contraseña</label>
                        <i onclick="spy(0)" class="far fa-eye" id="togglePassword0" style="margin-left: -140px; cursor: pointer; visibility: hidden;"></i>
                        <br><br>
                        <label><input type='password' id='pass1' onkeypress="showEye(1)"> Repite Contraseña</label>
                        <i onclick="spy(1)" class="far fa-eye" id="togglePassword1" style="margin-left: -140px; cursor: pointer; visibility: hidden;"></i>
                        <br><br>
                        <input type='submit' value='Modificar'>
                        </form>
                    </div>
                    <div class="col-md-1"></div>
                    <div class="col-md-3">
                        <h2>O Eliminar tu Perfil</h2>
                        <br><br><br>
                        <form action="empresadelete.php" method="post">
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
</body>
</html>