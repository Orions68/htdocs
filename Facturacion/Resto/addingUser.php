<?php
include "inc/fw.php";
include "inc/modal-dismiss.html";
$title = "Agregando un Cliente para Delivery/Facturación";
include "inc/header.php";
$name = htmlspecialchars($_POST['client']);
$kind = $_POST["kind"];
$cuit = htmlspecialchars($_POST['cuit']);
$pass = htmlspecialchars($_POST['pass']);
$hash = password_hash($pass, PASSWORD_DEFAULT);
$email = htmlspecialchars($_POST['email']);
$phone = htmlspecialchars($_POST['phone']);
$address = htmlspecialchars($_POST['address']);
$ok = false;

if ($cuit != "")
{
    $sql = "SELECT id FROM delivery WHERE phone='" . $phone . "' OR email='" . $email . "' OR cuit='" . $cuit . "';";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    if ($stmt->rowCount() > 0)
    {
        echo "<script>toast ('1', 'Cliente ya Registrado', 'El Teléfono, E-mail o C.U.I.T. ya Están Registrados en la Base de Datos. Si Hay Algúna Modificación en los Datos Usa Modificar o Eliminar Clientes.');</script>";
    }
    else
    {
        $ok = true;
    }
}
else
{
    $ok = true;
}
if ($ok)
{
    $stmt = $conn->prepare('INSERT INTO delivery VALUES(:id, :kind, :name, :cuit, :email, :pass, :phone, :address)');
    if ($cuit != "")
    {
        $stmt->execute(array(':id' => null, ':kind' => $kind, ':name' => $name, ':cuit' => $cuit, ':email' => $email, ':pass' => $hash, ':phone' => $phone, ':address' => $address));
    }
    else
    {
        $stmt->execute(array(':id' => null, ':kind' => $kind, ':name' => $name, ':cuit' => null, ':email' => $email, ':pass' => $hash, ':phone' => $phone, ':address' => $address));
    }
    echo "<script>toast ('0', 'Cliente : " . $name . " Agregado Correctamente.', 'Si el Cliente es Responsable Inscripto Podrás enviarle las Facturas.');</script>";
}
?>
<section class="container-fluid pt-3">
<div id="pc"></div>
    <div id="mobile"></div>
    <div class="row">
        <div class="col-md-1"></div>
            <div class="col-md-10">
                <div id="view1">
                </div>
            </div>
        <div class="col-md-1"></div>
    </div>
</section>
<?php
include "inc/footer.html";
?>