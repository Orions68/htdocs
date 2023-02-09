<?php
include "inc/fw.php";
include "inc/modal.html";
$title = "Formulario para Agregar un Cliente";
include "inc/header.php";
?>
<section class="container-fluid pt-3">
<div id="pc"></div>
    <div id="mobile"></div>
    <div class="row">
        <div class="col-md-1"></div>
            <div class="col-md-10">
                <div id="view1">
                    <div class="row">
                        <div class="col-md-5">
                        <h1>Registro de Clientes</h1>
                        <h3>La Contraseña y el C.U.I.T. Pueden Quedar en Blanco</h3>
                        <br>
                        <form action="addingUser.php" method="post" onsubmit="return verify()">
                        <label><input type="text" name="client" required> Nombre</label>
                        <br><br>
                        <label><input id="cuit" type="text" name="cuit"> C.U.I.T.</label>
                        <br><br>
                        <label><input type="text" name="email" required> E-mail</label>
                        <br><br>
                        <label><input id="pass" type="password" name="pass"> Contraseña</label>
                        <br><br>
                        <label><input id="pass2" type="password" name="pass2"> Repite Contraseña</label>
                        <br><br>
                        <label><input type="text" name="phone" required> Teléfono</label>
                        <br><br>
                        <label><input type="text" name="address" required> Dirección</label>
                        <br><br>
                        <h4>Por Favor Selecciona si el Cliente es Empresa o Particular</h4>
                        <label><input id="res" type="radio" name="kind" value="1" checked> Responsable Inscripto</label>
                        <br>
                        <label><input type="radio" name="kind" value="0"> Consumidor Final</label>
                        <br><br>
                        <input type="submit" class="btn btn-primary" value="Agrega">
                        </form>
                        </div>
                        <div class="col-md-1"></div>
                        <div class="col-md-6">
                            <h1>Modificar los Datos de un Cliente</h1>
                            <br>
                            <form action="modify.php" method="post">
                            <label><select name="client" required>
                                <option value=""> Selecciona un Cliente</option>
                                <?php
                                $sql = "SELECT id, name from delivery";
                                $stmt = $conn->prepare($sql);
                                $stmt->execute();
                                if ($stmt->rowCount() > 0)
                                {
                                    while ($row = $stmt->fetch(PDO::FETCH_OBJ))
                                    {
                                        echo '<option value=' . $row->id . '>' . $row->name . '</option>';
                                    }
                                }
                                ?>
                            </select> Modifica Los Datos de Este Cliente</label>
                            <br><br>
                            <input class="btn btn-secondary" type="submit" value="Modifica los Datos">
                            </form>
                            <br><hr><br>
                            <h1>Elimina un Cliente</h1>
                            <br>
                            <form action="deluser.php" method="post">
                            <label><select name="client" required>
                                <option value=""> Selecciona un Cliente</option>
                                <?php
                                $sql = "SELECT id, name from delivery";
                                $stmt = $conn->prepare($sql);
                                $stmt->execute();
                                if ($stmt->rowCount() > 0)
                                {
                                    while ($row = $stmt->fetch(PDO::FETCH_OBJ))
                                    {
                                        echo '<option value=' . $row->id . '>' . $row->name . '</option>';
                                    }
                                }
                                ?>
                            </select> Elimina Este Cliente</label>
                            <br><br>
                            <input class="btn btn-danger" type="submit" value="Elimina los Datos de Este Cliente">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        <div class="col-md-1"></div>
    </div>
</section>
<?php
include "inc/footer.html";
?>