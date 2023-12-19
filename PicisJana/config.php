<?php
/* Credenciales de la base de datos. Suponiendo que está ejecutando MySQL
servidor con configuración predeterminada (usuario 'root' sin contraseña) */
define('DB_SERVER', 'localhost:3307');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'login_system');
 
/* Intento de conexión a la base de datos MySQL */
$conection_db = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
 

// Verifica la conexión
if($conection_db === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
?>