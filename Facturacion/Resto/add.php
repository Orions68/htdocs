<?php
$title = "Pedidos del Restauramte";
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
                    <div>
                        <button onclick="window.open('adding.php?id=0')" style="width:220px; height:128px;" class="btn btn-primary">Agregar Platos</button>
                        <button onclick="window.open('adding.php?id=1')" style="width:220px; height:128px; margin-left:20%;" class="btn btn-success">Agregar Bebidas</button>
                        <button onclick="window.open('adding.php?id=2')" style="width:220px; height:128px; margin-left:20%;" class="btn btn-danger">Agregar Postres</button>
                        <br><br>
                        <button onclick="window.close()" style="width:112px; height:48px; float:right; margin-top:15%" class="btn btn-secondary">Cerrar</button>
                    </div>
                </div>
            </div>
        <div class="col-md-1"></div>
    </div>
</section>
<?php
include "inc/footer.html";
?>