<?php
include "inc/fw.php";
include "inc/modal.html";
$title = "Modificando los Datos de un Cliente";
include "inc/header.php";
if (isset($_POST["client"]))
{
    $id = $_POST["client"];
    $sql = "SELECT * FROM delivery WHERE id=$id";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_OBJ);
}
?>
<section class="container-fluid pt-3">
<div id="pc"></div>
    <div id="mobile"></div>
    <div class="row">
        <div class="col-md-1"></div>
            <div class="col-md-10">
                <div id="view1">
                    <h1>Modificando los Datos del Cliente <?php echo $row->name; ?></h1>
                    <br>
                    <form action="modifyuser.php" method="post" onsubmit="return verify()">
                    <?php
                    echo '<label><input type="text" name="client" value="' . $row->name . '" required> Nombre Completo</label><br><br>
                    <label><input id="cuit" type="text" name="cuit" value="' . $row->cuit . '"> C.U.I.T.</label><br><br>
                    <label><input type="text" name="email" value="' . $row->email . '" required> E-mail</label><br><br>
                    <label><input id="pass" type="password" name="pass"> Contraseña</label><br><br>
                    <label><input id="pass2" type="password" name="pass2"> Repite Contraseña</label><br><br>
                    <label><input type="text" name="phone" value="' . $row->phone . '" required> Teléfono</label><br><br>
                    <label><input type="text" name="address" value="' . $row->address . '" required> Dirección</label><br><br>
                    <h4>Por Favor Selecciona si el Cliente es Empresa o Particular</h4>';
                    if ($row->kind == 1)
                    {
                        echo '<label><input id="res" type="radio" name="kind" value="1" checked> Responsable Inscripto</label>
                        <br>
                        <label><input type="radio" name="kind" value="0"> Consumidor Final</label>
                        <br><br>';
                    }
                    else
                    {
                        echo '<label><input id="res" type="radio" name="kind" value="1"> Responsable Inscripto</label>
                        <br>
                        <label><input type="radio" name="kind" value="0" checked> Consumidor Final</label>
                        <br><br>';
                    }
                    echo '<input type="submit" class="btn btn-primary" value="Modificar los Datos del Cliente">
                    </form>
                    ';
                    ?>
                </div>
            </div>
        <div class="col-md-1"></div>
    </div>
</section>