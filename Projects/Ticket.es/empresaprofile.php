<?php
include "includes/conn.php";
$title = "Ticket.es - Perfil de Empresa";
include "includes/header.php";
include "includes/modal2.html";
include "includes/nav-emp.html";

    if (isset($_SESSION["idc"])) // Verifico si la sesión no está vacia.
    {
        $id = $_SESSION["idc"]; // Asigno a la variable $id el valor de la sesión id.
        $sql = "SELECT * FROM company WHERE id=$id;"; // Preparo una consulta por la ID.
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_OBJ);
        $name = $row->name; // Asigno el contenido de $row a variables.
        $email = $row->email;
        $name1 = explode(" ", $name);
        echo "<span>Te Damos la Bienvenida $name1[0] </span>"; // Muestro la bienvenida en el NAV y el nombre del cliente.
        echo "<a href='empresalogin.php' style='margin-left:50px;'>Publica tus Eventos</a>";
        // Muestro el enlace para volver al login(Publica tus Eventos).
    }
    // Muestro el formulario con los datos de la empresa por si quiere modificar o eliminar su perfil, puede ver el historico de ventas de sus publicaciones.
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
                        <i onclick="spy(1)" class="far fa-eye" id="togglePassword1" style="margin-left: -205px; cursor: pointer; visibility: hidden;"></i>
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
                                    <input type="hidden" name="id" value="<?php echo $_SESSION['idc']; ?>">
                                    <input type="submit" value="Elimino Mi Perfil">
                                </form>
                            </div>
                        </div>
                        <br><br>
                        <div class="row">
                            <div class="col-md-6">
                                <h2>Tus Eventos</h2>
                                <br><br>
                                <?php // Muestro los datos de los eventos publicados y las entradas vendidas.
                                    $sql = "SELECT * FROM details INNER JOIN events, company WHERE company.id=$id AND events.id_empresa=company.id AND details.id_event=events.id ORDER BY details.kind;";
                                    $stmt = $conn->prepare($sql);
                                    $stmt->execute(); // Ejecuto la consulta hecha a la tabla details juntandola con events y company.
                                    if ($stmt->rowCount() > 0)
                                    {
                                        $ok = true;
                                        $i = 0;
                                        $kind = [];
                                        $title = [];
                                        $place = [];
                                        $start = [];
                                        $hour = [];
                                        $price = [];
                                        $places = [];
                                        $sold = [];

                                        while ($row = $stmt->fetch(PDO::FETCH_OBJ))
                                        {
                                            $kind[$i] = $row->kind;
                                            $title[$i] = $row->title;
                                            $place[$i] = $row->place;
                                            $start[$i] = $row->start;
                                            $hour[$i] = $row->hour;
                                            $price[$i] = $row->price;
                                            $places[$i] = $row->places;
                                            $sold[$i] = $row->sold;
                                            $i++;
                                        }
                                    }
                                    else
                                    {
                                        $ok = false;
                                        echo "<script>toast(1, 'Aun sin Datos', 'No Has publicado Eventos aun, Esperamos que Pronto Tengas una Larga Lista.');</script>"; // Error, has llegado por el camino equivocado.
                                    }
                                    if ($ok)
                                    {
                                        echo "<script>var kind = [];</script>";
                                        echo "<script>var title = [];</script>";
                                        echo "<script>var place = [];</script>";
                                        echo "<script>var start = [];</script>";
                                        echo "<script>var hour = [];</script>";
                                        echo "<script>var price = [];</script>";
                                        echo "<script>var places = [];</script>";
                                        echo "<script>var sold = [];</script>";
                                        for ($i = 0; $i < count($kind); $i++)
                                        {
                                            $my_start = explode("-", $start[$i]);
                                            $start[$i] = $my_start[2] . "/" . $my_start[1] . "/" . $my_start[0];

                                            echo "<script>kind[" . $i . "] = '" . $kind[$i] . "';</script>";
                                            echo "<script>title[" . $i . "] = '" . $title[$i] . "';</script>";
                                            echo "<script>place[" . $i . "] = '" . $place[$i] . "';</script>";
                                            echo "<script>start[" . $i . "] = '" . $start[$i] . "';</script>";
                                            echo "<script>hour[" . $i . "] = '" . $hour[$i] . "';</script>";
                                            echo "<script>price[" . $i . "] = '" . $price[$i] . "';</script>";
                                            echo "<script>places[" . $i . "] = '" . $places[$i] . "';</script>";
                                            echo "<script>sold[" . $i . "] = '" . $sold[$i] . "';</script>";
                                        }
                                        ?>
                                        <div id="table"></div>
                                        <br>
                                        <span id="page"></span>&nbsp;&nbsp;&nbsp;&nbsp;
                                        <button onclick="javascript:prev()" id="prev">Anteriores Resultados</button>&nbsp;&nbsp;&nbsp;&nbsp;
                                        <button onclick="javascript:next()" id="next">Siguientes Resultados</button><br>
                                        <script>change(1, 5, "comp");</script>
                                        <?php
                                    }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <div class="col-md-1"></div>
    </div>
</section>
<?php
include "includes/footer.html";
?>