<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de Registro Login con Contraseña Cifrada.</title>
    <link rel="stylesheet" href="styles/style.css">
</head>
<body>
    <h1>Registro de Usuario con E-mail y Cotraseña.</h1>
    <form action="register.php" method="post" onsubmit="return verify()">
    <label for="usename"><input type="text" name="username" required> Nombre de Usuario</label>
    <br><br>
    <label for="phone"><input type="text" name="phone" required> Teléfono</label>
    <br><br>
    <label for="bday"><input type="date" name="bday" required> Fecha de Nacimiento</label>
    <br><br>
    <label for="email"><input type="email" name="email" required> E-mail de Usuario</label>
    <br><br>
    <label for="pass"><input type="password" id="pass" name="pass" required> Contraseña</label>
    <br><br>
    <label for="pass2"><input type="password" id="pass2" name="pass2" required> Repite Contraseña</label>
    <br><br>
    <input type="submit" class="button" value="Regístrame!">
    </form>
    <br><br>
    <h2>Login de Usuario</h2>
    <form action="login.php" method="post">
    <label for="email"><input type="email" name="email" required> E-mail de Usuario</label>
    <br><br>
    <label for="pass"><input type="password" name="pass" required> Contraseña</label>
    <br><br>
    <input type="submit" class="button" name="login" value="Login">
    </form>
    <script src="js/script.js"></script>
</body>
</html>