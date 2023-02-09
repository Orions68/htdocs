<?php
$title = "Registro de Usuario";
include "includes/html.php";
include "includes/nav.html";
?>
<section class="container-fluid pt-3">
    <div class="row">
        <div class="col-sm-1"></div>
            <div class="col-sm-10">
                <div id="page_top">
                    <br><br><br><br><br><br>
                    <?php
                    include "includes/carrousel.html";
                    ?>
                </div>
                <div id="view1">
                <br><br><br><br>
                    <h1>Registro de Usuario y Login.</h1>
                    <br>
                    <h2>Registro de Usuario.</h2>
                    <form action="register.php" method="post">
                        <label><input type="text" id="username" name="username" required> Nombre de Usuario</label>
                        <br><br>
                        <label><input type="password" id="pass" name="pass" required> Contraseña</label>
                        <br><br>
                        <label><input type="password" id="pass2" name="pass2" required> Repite la Contraseña.</label>
                        <br><br>
                        <input type="button" value="Registrar" onclick="verify(this.form)">
                    </form>
                    <hr>
                    <br>
                </div>
                <div id="view2">
                    <br><br><br>
                    <h2>Login de Usuario</h2>
                    <form action="login.php" method="post">
                        <label><input type="text" id="userlog" name="username" required> Nombre de Usuario</label>
                        <br><br>
                        <label><input type="password" name="pass" required> Contraseña</label>
                        <br><br>
                        <input type="submit" value="Log In">
                    </form>
                    <hr>
                </div>
            </div>
        <div class="col-sm-1"></div>
    </div>
</section>
<?php
include "includes/footer.html";
include "includes/end.html";
?>
</body>
</html>