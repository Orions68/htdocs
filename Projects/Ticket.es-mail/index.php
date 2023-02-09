<?php
require "includes/conn.php";
$title = "Bienvenidos a Ticket.es";
include "includes/header.php";
if (isset($_SESSION["id"]))
{
    include "includes/nav-esp.html";
    $id = $_SESSION["id"]; // Asigno a $id el valor de la sesión id.
    $sql = "SELECT name, path FROM clients WHERE id='$id';"; // Preparo la consulta buscando solo por la id.
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_OBJ);
    $name = explode(" ", $row->name);
    echo "<span>Te Damos la Bienvenida " . $name[0] . " </span>"; // Muestro dentro del NAV un span con la bienvenida y el E-mail del cliente .
    echo "<img src='" . $row->path . "' alt='Tú Imagen de Perfil' width='100' height='100'><a href='profile.php'><small style='margin-left:50px;'>Visita tu Perfil</small></a>";
    // Muetro la imagen del cliente y el enlace a su perfil.
    echo "</div></nav>";
}
else
{
    include "includes/nav.html";
}
include "includes/modal2.html";
include "includes/car.html"; // Carro de la compra.
include "includes/car_dialog.html"; // Diálogo cuando se agrega algo al carro.
?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
<script src="js/script.js"></script>
<script src="js/script2.js"></script>
<section class="container-fluid pt-3">
    <div class="row">
        <div class="col-sm-1"></div>
            <div class="col-sm-10">
                <div id="page_top">
                    <br><br><br><br><br>
                    <header>      
                    <!-- Jumbotron -->
                    <!-- Background image -->
                    <div class="mask" style="background-color: rgba(0, 0, 0, 0.6);">
                        <div class="d-flex justify-content-center align-items-center h-100"></div>
                            <div class="text-white">
                                    <h1 class="mb-3">Ticket.es</h1>
                            </div>
                    </div>
                    <div class="p-5 text-center bg-image" style="background-image: url('img/logo.jpg'); background-repeat: no-repeat; height: 480px;">
                    </div>
                    <div class="mask" style="background-color: rgba(0, 255, 0, 0.6);">
                        <div class="d-flex justify-content-center align-items-center h-100"></div>
                            <div class="text-white">
                                    <h1 class="mb-3">Eventos en Todo el País</h1>
                            </div>
                    </div>
                    <!-- Jumbotron -->
                    </header>
                    <h1>La Tienda de Espectaculos Más Completa del Mundo</h1>
                    <br>
                </div>

                <div id="page_event">
                    <br><br><br><br><br>
                    <h2>Usa Busca Eventos en el Menú para Saber que está Pasando en la Ciudad.</h2>
                    <br>
                    <h3>Te Presentamos Algunos Eventos Variados.</h3>
                    <?php
                        include "includes/showEvents.php";
                        fromIndex($conn);
                    ?>
                </div>
                <div id="view1">
                    <div class="row">
                        <div class="col-md-7">
                        <br><br><br><br>
                            <h3>Registro de Empresas</h3>
                            <br>
                            <form action="empresaregister.php" method="post" onsubmit="return verify(0)">
                                <label><input type="text" name="empresa" required> Nombre de la Empresa</label>
                                <br><br>
                                <label><input type="email" name="email" required> E-mail</label>
                                <br><br>
                                <label><input type="password" name="pass" id="pass0" onkeypress="showEye(0)" required> Contraseña</label>
                                <i onclick="spy(0)" class="far fa-eye" id="togglePassword0" style="margin-left: -140px; cursor: pointer; visibility: hidden;"></i>
                                <br><br>
                                <label><input type="password" id="pass1" onkeypress="showEye(1)" required> Repite Contraseña</label>
                                <i onclick="spy(1)" class="far fa-eye" id="togglePassword1" style="margin-left: -205px; cursor: pointer; visibility: hidden;"></i>
                                <br><br>
                                <input type="submit" value="Regístrame!">
                            </form>
                        </div>
                        <div class="col-md-5">
                            <br><br><br><br>
                            <h3>Entrada de Empresas</h3>
                            <br>
                            <form action="empresalogin.php" method="post">
                                <label><input type="email" name="email" required> E-mail</label>
                                <br><br>
                                <label><input type="password" name="pass" id="pass2" onkeypress="showEye(2)" required> Contraseña</label>
                                <i onclick="spy(2)" class="far fa-eye" id="togglePassword2" style="margin-left: -140px; cursor: pointer; visibility: hidden;"></i>
                                <br><br>
                                <input type="submit" value="Login">
                            </form>
                            <a href="empresarecover.php"><small>Olvidaste tu Contraseña</small></a>
                        </div>
                    </div>
                </div>
                <div id="view2">
                    <div class="row">
                        <div class="col-md-7">
                        <br><br><br><br>
                            <h3>Registro de Espectador</h3>
                            <br>
                            <form action="register.php" method="post" enctype="multipart/form-data" onsubmit="return verify(1)">
                                <label><input type="text" name="username" required> Nombre Completo</label>
                                <br><br>
                                <label><input type="text" name="phone" required> Teléfono</label>
                                <br><br>
                                <label><input type="email" name="email" required> E-mail</label>
                                <br><br>
                                <label><input type="password" name="pass" id="pass3" onkeypress="showEye(3)" required> Contraseña</label>
                                <i onclick="spy(3)" class="far fa-eye" id="togglePassword3" style="margin-left: -140px; cursor: pointer; visibility: hidden;"></i>
                                <br><br>
                                <label><input type="password" id="pass4" onkeypress="showEye(4)" required> Repite Contraseña</label>
                                <i onclick="spy(4)" class="far fa-eye" id="togglePassword4" style="margin-left: -205px; cursor: pointer; visibility: hidden;"></i>
                                <br><br>
                                <label><input type="date" name="bday" required> Fecha de Nacimiento</label>
                                <br><br>
                                <label><input type="radio" name="gender" value="0" checked> Mujer</label>
                                <br><br>
                                <label><input type="radio" name="gender" value="1"> Varón</label>
                                <br><br>
                                <label><input type="file" name="profile"> Foto de Perfil<small>(opcional)</small></label>
                                <br><br>
                                <input type="submit" value="Regístrame!">
                            </form>
                        </div>
                        <div class="col-md-5">
                            <br><br><br><br>
                            <h3>Entrada de Espectador</h3>
                            <br>
                            <form action="login.php" method="post">
                                <label><input type="email" name="email" required> E-mail</label>
                                <br><br>
                                <label><input type="password" name="pass" id="pass5" onkeypress="showEye(5)" required> Contraseña</label>
                                <i onclick="spy(5)" class="far fa-eye" id="togglePassword5" style="margin-left: -140px; cursor: pointer; visibility: hidden;"></i>
                                <br><br>
                                <input type="submit" value="Login">
                            </form>
                            <a href="recover.php"><small>Olvidaste tu Contraseña</small></a>
                        </div>
                    </div>
                </div>
                <div id="view3">
                    <br><br><br><br>
                    <h2>Busca Los Eventos</h2>
                    <br>
                    <form action="" method="post" id="form">
                    <label><select name="kind" id="kind" required onchange="document.getElementById('form').submit();">
                        <option value="">Selecciona un Evento</option>
                        <option value="Concierto">Conciertos</option>
                        <option value="Teatro">Obra de teatro</option>
                        <option value="Cine">Cine</option>
                        <option value="Clasico">Exposición de Arte Clásico</option>
                        <option value="Moderno">Exposición de Arte Moderno</option>
                        <option value="Parque">Parque Temático</option>
                        <option value="Circo">Circo</option>
                        <option value="Charla">Charlas</option>
                        <option value="Debate">Debates</option>
                    </select> Selecciona Clase de Evento</label>
                    </form>
                    <br><br>
                    <?php
                        include "includes/showKind.php";
                    ?>
                </div>
            </div>
        <div class="col-sm-1"></div>
    </div>
</section>
<?php
include "includes/footer.html";
function show($conn, $sql, $pass) // Función show(), recibe dos parametros, la conexión y la consulta.
{
    
}
?>
<script>screenSize();</script>
</body>
</html>