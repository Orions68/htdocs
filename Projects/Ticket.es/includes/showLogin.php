<?php // Esta función es llamada tanto de login de usuario como de login de empresa.
function show($conn, $sql, $pass, $who) // Función show(), recibe parametros, la conexión, la consulta, la contraseña y si es empresa o espectador.
{
    $ok = false; // Uso la variable $ok para controlar si hay resultados positivos o no.
    if ($pass == "") // Si la contraseña pasada esta vacía.
    {
        $ok = true; // Ya estaba logueado, pongo $ok a true.
        $stmt = $conn->prepare($sql); // Hago la consulta a la base de datos con la conexión y la consulta recibidas.
        $stmt->execute(); // La ejecuto.
        $row = $stmt->fetch(PDO::FETCH_OBJ); // Cargo el resultado en $row.
    }
    else // Si llega la contraseña.
    {
        $stmt = $conn->prepare($sql); // Hago la consulta a la base de datos con la conexión y la consulta recibidas.
        $stmt->execute(); // La ejecuto.
        if ($stmt->rowCount() > 0) // Si hubo resultados.
        {
            $row = $stmt->fetch(PDO::FETCH_OBJ); // Cargo el resultado en $row.
            if (password_verify($pass, $row->pass)) // Verifico la contraseña enviada con la de la base de datos descifrada.
            {
                $ok = true; // Si son iguales pongo $ok a true.
            }
        }
    }
    if ($ok) // Si $ok es true, todo ha ido bien.
    {
        $name = explode(" ", $row->name); // Exploto el nombre en la variable $row->name en la variable $name que será un array.
        echo "<span>Te Damos la Bienvenida " . $name[0] . " </span>"; // Muestro dentro del NAV un span con la bienvenida y el primer Nombre de la Empresa/Espectador.
        if ($who == "comp") // Si se logueó una empresa
        {
            echo "<a href='empresaprofile.php'><small style='margin-left:25px;'>Visita tu Perfil</small></a>"; // Muetro el enlace a su perfil de empresa.
            $_SESSION["idc"] = $row->id; // Asigno a la sesión idc(sesión de empresa) el contenido de $row["id"].
        }
        else // Si no, se logueó un espectador.
        {
            echo "<img src='" . $row->path . "' alt='Tú Imagen de Perfil' width='100' height='100'><a href='profile.php'><small style='margin-left:50px;'>Visita tu Perfil</small></a>";
            // Muetro el enlace a su perfil de espectador con la foto de perfil.
            $_SESSION["id"] = $row->id; // Asigno a la sesion id(sesión de espectador) el contenido de $row["id"].
        }
        return $ok; // Devuelvo true.
    }
    else // Si no hubo resultados, $ok es false.
    {
        return $ok; // Devuelvo false.
    }
}
?>