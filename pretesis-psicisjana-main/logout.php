<?php
// Inicializa la sesión
session_start();
 
// Desarmar todas las variables de sesión
$_SESSION = array();
 
// Destruye la sesión.
session_destroy();
 
// Rediricciona a la página de inicio de sesión
header("location: login.php");
exit;
?>