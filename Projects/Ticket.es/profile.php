<?php
include "includes/conn.php";
if (!empty($_SESSION["invoice"])) // Verifico si la session invoice está iniciada.
{
    unset($_SESSION["invoice"]); // Si está la limpio.
}
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
        <div class="col-md-1" style="width: 2%;"></div>
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
                    <div class="col-md-1" style="border: 1px solid grey; width: 1%;"></div>
                    <div class="col-md-5">
                        <div class="row">
                            <div class="col-md-6">
                                <h2>O Eliminar tu Perfil</h2>
                                <br><br><br>
                                <form action="delete.php" method="post">
                                    <input type="hidden" name="id" value="<?php echo $_SESSION['id']; ?>">
                                    <input type="submit" value="Elimino Mi Perfil">
                                </form>
                            </div>
                        </div>
                        <br><br>
                        <div class="row">
                            <div class="col-md-6">
                                <h2>Tus Entradas</h2>
                                <br><br>
                                <?php
                                    $sql = "SELECT *, invoice.path AS ruta FROM invoice INNER JOIN events, details, clients WHERE invoice.id_cliente='$id' AND invoice.id_event=events.id AND details.id_event=events.id GROUP BY invoice.id ORDER BY details.kind;";
                                    $stmt = $conn->prepare($sql);
                                    $stmt->execute();
                                    if ($stmt->rowCount() > 0)
                                    {
                                        $ok = true;
                                        $i = 0;
                                        $kind = [];
                                        $title = [];
                                        $qtty = [];
                                        $payed = [];
                                        $date = [];
                                        $start = [];
                                        $hour = [];
                                        $ruta = [];

                                        while ($row = $stmt->fetch(PDO::FETCH_OBJ))
                                        {
                                            $kind[$i] = $row->kind;
                                            $title[$i] = $row->title;
                                            $qtty[$i] = $row->qtty;
                                            $payed[$i] = $row->payed;
                                            $date[$i] = $row->date;
                                            $start[$i] = $row->start;
                                            $hour[$i] = $row->hour;
                                            $ruta[$i] = $row->ruta;
                                            $i++;
                                        }
                                    }
                                    else
                                    {
                                        $ok = false;
                                        echo "<script>toast(1, 'Aun sin Datos', 'No Has Comprado Ninguna Entrada aun, Esperamos que Pronto Tengas una Larga Lista.');</script>"; // Error, has llegado por el camino equivocado.
                                    }
                                    if ($ok)
                                    {
                                        echo "<script>var kind = [];</script>";
                                        echo "<script>var title = [];</script>";
                                        echo "<script>var qtties = [];</script>";
                                        echo "<script>var payed = [];</script>";
                                        echo "<script>var date = [];</script>";
                                        echo "<script>var start = [];</script>";
                                        echo "<script>var hour = [];</script>";
                                        echo "<script>var ruta = [];</script>";
                                        for ($i = 0; $i < count($kind); $i++)
                                        {
                                            $my_date = explode("-", $date[$i]);
                                            $just_date = explode(" ", $my_date[2]);
                                            $date[$i] = $just_date[0] . "/" . $my_date[1] . "/" . $my_date[0] . " " . $just_date[1] . "Hs.";

                                            $my_start = explode("-", $start[$i]);
                                            $start[$i] = $my_start[2] . "/" . $my_start[1] . "/" . $my_start[0];

                                            echo "<script>kind[" . $i . "] = '" . $kind[$i] . "';</script>";
                                            echo "<script>title[" . $i . "] = '" . $title[$i] . "';</script>";
                                            echo "<script>qtties[" . $i . "] = '" . $qtty[$i] . "';</script>";
                                            echo "<script>payed[" . $i . "] = '" . $payed[$i] . "';</script>";
                                            echo "<script>date[" . $i . "] = '" . $date[$i] . "';</script>";
                                            echo "<script>start[" . $i . "] = '" . $start[$i] . "';</script>";
                                            echo "<script>hour[" . $i . "] = '" . $hour[$i] . "';</script>";
                                            echo "<script>ruta[" . $i . "] = '" . $ruta[$i] . "';</script>";
                                        }
                                        ?>
                                        <div id="table"></div>
                                        <br>
                                        <span id="page"></span>&nbsp;&nbsp;&nbsp;&nbsp;
                                        <button onclick="javascript:prev()" id="prev">Anteriores Resultados</button>&nbsp;&nbsp;&nbsp;&nbsp;
                                        <button onclick="javascript:next()" id="next">Siguientes Resultados</button><br>
                                        <script>change(1, 5, "viewer");</script>
                                        <?php
                                    }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <div class="col-md-1" style="width: 2%;"></div>
    </div>
</section>
<?php
include "includes/footer.html";
?>
<script>screenSize();</script>
<script>checkTitle()</script> <!-- Llamo a la función checkTitle() para esconder el botón del carro de la compra. -->
</body>
</html>