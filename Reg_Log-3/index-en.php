<?php
$title = "User Registration";
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
                <div id="view1">
                <br><br><br><br>
                    <h1>User Registration & Log In.</h1>
                    <br>
                    <h2>User Registration.</h2>
                    <form action="register-en.php" method="post">
                        <label><input type="text" id="username" name="username" required> User Name</label>
                        <br><br>
                        <label><input type="password" id="pass" name="pass" required> Password</label>
                        <br><br>
                        <label><input type="password" id="pass2" name="pass2" required>  Repeat Password.</label>
                        <br><br>
                        <input type="button" value="Register" onclick="verify(this.form)">
                    </form>
                    <hr>
                    <br>
                </div>
                <div id="view2">
                    <br><br><br>
                    <h2>User Log In</h2>
                    <form action="login-en.php" method="post">
                        <label><input type="text" id="userlog" name="username" required> User Name</label>
                        <br><br>
                        <label><input type="password" name="pass" required> Password</label>
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
include "includes/footer-en.html";
include "includes/end.html";
?>
</body>
</html>