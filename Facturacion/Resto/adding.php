<?php
$id = $_GET['id'];
switch ($id)
{
    case 0:
        $name = "Plato";
        break;
    case 1:
        $name = "Bebida";
        break;
    default:
        $name = "Postre";
}
$title = "Agregando Artículos";
include "inc/header.php";
?>
<section class="container-fluid pt-3">
<div id="pc"></div>
    <div id="mobile"></div>
    <div class="row">
        <div class="col-md-1"></div>
            <div class="col-md-10">
                <div id="view1">
                    <br><br><br><br>
                    <div class="login">
                        <h1>Agregando <?php echo $name; ?></h1>
                        <br>
                        <form action="added.php" method="post">
                        <label><input type="text" name="product" placeholder="Nombre" style="font-size:x-large;" required> Nombre del Artículo a Agregar</label>
                        <br><br>
                        <label><input type="number" step=".05" name="price" placeholder="Precio" style="font-size:x-large;" required> Precio</label>
                        <br><br>
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="submit" value="Agrego este Artículo" style="float:right; width:220px; height:128px;" class="btn btn-primary">
                        </form>
                    </div>
                </div>
            </div>
        <div class="col-md-1"></div>
    </div>
</section>
<?php
include "inc/footer.html";
?>