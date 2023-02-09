<?php
session_start();

$title = "Gracias por Registrarte";
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
                <div id="view2">
                    <br><br><br><br>
                    <?php
                    if ($_POST)
                    {
                        $user = $_POST["username"];
                        $pass = $_POST["pass"];

                        $array = [];
                        array_push($array, $user, $pass);
                        if (empty($_SESSION["loggedin"]))
                        {
                            $_SESSION["loggedin"] = [];
                            array_push($_SESSION["loggedin"], $array);
                        }
                        else
                        {
                            array_push($_SESSION["loggedin"], $array);
                        }
                        echo "<h2>Hola $user Gracias por registrarte.</h2>";
                    }
                    ?>
                </div>
            </div>
        <div class="col-sm-1"></div>
    </div>
</section>
<?php
include "includes/footer.html";
include "includes/end.html";
?>
<script>view2.scrollIntoView();</script>
</body>
</html>