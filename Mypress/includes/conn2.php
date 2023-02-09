<?php
session_start();
ob_start();
try
{
	$conn = new PDO('mysql:host=localhost;dbname=friends', "root", "Anubis68");
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	$conn2 = new PDO('mysql:host=localhost;dbname=teatrosi_1999', "root", "Anubis68");
	$conn2->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch(PDOException $e)
{
	echo 'Error: ' . $e->getMessage();
}
?>