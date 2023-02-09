<?php echo `whoami`;
$string = "C:\Hola\Chau\mevoy";
$string2 = "C:\Hola";
$path = substr($string, strlen($string2) + 1);
echo $path;

?>