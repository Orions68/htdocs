<?php
session_start();

$title = "User Log In";
include "includes/html.php";
include "includes/nav-en.html";
?>
<section class="container-fluid pt-3">
    <div class="row">
        <div class="col-sm-1"></div>
            <div class="col-sm-10">
                <div id="page_top">
                <br><br><br><br><br><br>
                    <?php
                    include "includes/carrousel-en.html";
                    ?>
                </div>
                <div id="view2">
                    <br><br><br><br>
                    <?php
                    $user_ok = false;
                    $pass_ok = false;
                    $user = $_POST["username"];
                    $pass = $_POST["pass"];
                    if (!empty($_SESSION["loggedin"]))
                    {
                        foreach ($_SESSION["loggedin"] as $key)
                        {
                            if ($user == $key[0])
                            {
                                $user_ok = true;
                                if ($pass == $key[1])
                                {
                                    $pass_ok = true;
                                    break;
                                }
                            }
                        }
                        if (!$user_ok)
                        {
                            echo "<h2>Sorry, the user $user doesn't exist in the \"Data Base\"</h2>";
                        }
                        else if ($user_ok && $pass_ok)
                        {
                            echo "<h2>Wellcome $user</h2>";
                        }
                        else
                        {
                            echo "<h2>The username or password is not correct.</h2>";
                        }
                    }
                    else
                    {
                        echo "<h3 style='color: red'>There is still no data in the \"Data Base\".</h3>";
                    }
                    ?>
                </div>
            </div>
        <div class="col-sm-1"></div>
    </div>
</section>
<?php
include "includes/footer-en.html";
include "includes/end.html";
?>
<script>view2.scrollIntoView();</script>
</body>
</html>