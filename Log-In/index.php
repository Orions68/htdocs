<?php

?>
<!DOCTYPE html>
<html>

<head>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type">
<link href="styles/mainstyle.css" rel="stylesheet" type="text/css">
<title>Bienvenido al Sitio</title>
</head>

<body>
<div id="header">
<h1>Título del Sitio</h1>
<img src="imgs/DNI-Front.jpg" alt="DNI" id="logo">
</div>
<div id="menu">
<!-- <table>
	<tr>
		<td>
			<a href="index.php" id="links">
				Home
				<hr/>
			</a>
		</td>
	</tr>
	<tr>
		<td>
			<a href="register.php" id="links" target="_blank">
				Register
				<hr/>
			</a>
		</td>
	</tr>
	<tr>
		<td style="width: 398px">
			<a href="about.php" id="links" target="_blank">
				About/Contact
				<hr/>
			</a>
		</td>
	</tr>
</table> -->
<table>
<tr>
	<td>
		<button style="width:280px; height:90px;">Home</button>
		<hr/>
	</td>
</tr>
<tr>
	<td>
		<button onclick="window.open('register.php')" style="width:100%; height:90px;">Register</button>
		<hr/>
	</td>
</tr>
<tr>
	<td>
		<button onclick="window.open('about.php')" style="width:100%; height:90px;">About</button>
		<hr/>
	</td>
</tr>
</table>
</div>
<div id="login">
<p><strong>Si ya estás Registrado Entra aquí con tus Datos.</strong></p>
<form action="login.php" method="post" target="_blank">
<input type="text" name="user" placeholder="Nombre de Usuario" id="bigger">
<br>
<input type="password" name="pass" placeholder="Contraseña" id="bigger">
<br>
<input type="submit" value="Entra" id="button">
</form>
</div>
</body>

</html>