<?php
include "inc/fw.php";

if (isset($_POST["email"]))
{
    $already = false;
    $name = $_POST["username"];
    $phone = $_POST["phone"];
    $bday = $_POST["bday"];
    $email = $_POST["email"];
    $pass = $_POST["pass"];
    // $hash = password_hash($pass, PASSWORD_DEFAULT, ["cost" => 20]); // Ojo con el costo de 10 a 20 el tiempo que tarda en codificar/decodificar es 1000 veces mayor, cost = 10 es por default.
    $encrypt = password_hash($pass, PASSWORD_DEFAULT);
    $hash = substr(md5(uniqid($name, true)), 16, 16);

    $stmt = $conn->prepare("SELECT email FROM user WHERE email='$email'");
    $stmt->execute();

    if ($stmt->fetch(PDO::FETCH_OBJ))
    {
        $already = true;
    }

    if (!$already)
    {
        $stmt = $conn->prepare("INSERT INTO user VALUES (:id, :name, :phone, :bday, :email, :pass, :hash, :activate);");
        $stmt->execute(array(':id' => null, ':name' => $name, ':phone' => $phone, ':bday' => $bday, ':email' => $email, ':pass' => $encrypt, ':hash' => $hash, ':activate' => 0));

        $subject = "DO NOT REPLAY";
		$message = "<h3>Gracias por registrarte. </h3><p>Por favor haz click en el botón Quiero Activar mi Cuenta.</p><a href='http://" . $_SERVER['SERVER_NAME'] . "/Register-Login/activate.php/" . $hash . "/" . $email . "'><div style='background-color:aquamarine; border:thin; font-size:32px; text-align:center;'>Quiero Activar mi Cuenta</div></a><br><br><small>Copyright © 2021 César Matelat <a href='mailto:matelat@gmail.com'>matelat@gmail.com</a></small>";
		$server_email = "matelat@gmail.com";
		$headers  = "From: $server_email" . "\r\n";
		$headers .= "X-Mailer: PHP/" . phpversion(). "\r\n";
		$headers .= 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/html; charset=UTF-8' . "\r\n";
		if(mail($email, $subject, $message, $headers))
		{
			echo 'Se ha Enviado un Mensaje a tu Dirección de E-mail. Verificalo, si no Aparece en la Bandeja de Entrada, mira en Correo no Deseado.';
			
			// $stmt = $conn->prepare("SELECT id FROM data WHERE user = '" . $user . "'");
			// $stmt->execute();
			// while($row = $stmt->fetch(PDO::FETCH_OBJ))
			// {
			// 	// chdir ("users");
			// 	// mkdir($row->id . "/pic", 0777, true);
			// }
		}
		else
		{
			echo "Error al enviar el mensaje si vuelves a intentarlo y vuelve a dar error, por favor escribe a matelat@gmail.com";
		}

        // echo "<script>if (!alert('Datos del Usuario: " . $name . " Agregados Correctamente.')) window.open('index.php', '_self')</script>";
    }
    else
    {
        echo "<script>if (!alert('El E-mail ya está registrado.')) window.open('index.php', '_self')</script>";
    }
}
?>