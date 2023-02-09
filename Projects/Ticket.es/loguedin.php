<?php
function logued($conn)
{
    if (!isset($_SESSION["id"])) // Si no hay un espectador logueado
    {
        include "includes/navdirect.html"; // Se muestra el menú general.
        include "includes/car.html"; // Carro de la compra.
        include "includes/car_dialog.html"; // Diálogo cuando se agrega algo al carro.
    }
    else
    {
        include "includes/nav-esp.html"; // Se muestra el menu de Espectador logueado.

        $id_esp = $_SESSION["id"];
        $sql = "SELECT * FROM clients WHERE id='$id_esp';";
        $stmt = $conn->prepare($sql);
        $stmt->execute();

        if ($stmt->rowCount() > 0)
        {
            $row = $stmt->fetch(PDO::FETCH_OBJ);
            $name = explode(" ", $row->name);
            echo "<span>Te Damos la Bienvenida " . $name[0] . " </span>"; // Muestro dentro del NAV un span con la bienvenida y el E-mail del cliente .
            echo "<img src='" . $row->path . "' alt='Tú Imagen de Perfil' width='100' height='100'><a href='profile.php'><small style='margin-left:50px;'>Visita tu Perfil</small></a>"; // Muetro la imagen del cliente y el enlace a su perfil.
        }
            echo "</div></nav>"; // Esto cierra el último div y el nav del menú de Espectador logueado.
            include "includes/car.html"; // Carro de la compra.
            include "includes/car_dialog.html"; // Diálogo cuando se agrega algo al carro.
    }
}
?>