<?php
// Iniciar sesión si aún no ha sido iniciada
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Parámetros de conexión
$serverName = "localhost\\SQLEXPRESS";  // Cambia esto si tu servidor o instancia es diferente
$connectionOptions = array(
    "Database" => "DB_Instituto",  // Nombre de tu base de datos
    "Uid" => "pichiya",  // Usuario de SQL Server
    "PWD" => "12345678"  // Contraseña del usuario de SQL Server
);

// Conectar a la base de datos
$conn = sqlsrv_connect($serverName, $connectionOptions);
if ($conn === false) {
    die(print_r(sqlsrv_errors(), true));  // Detener si hay un error en la conexión
}
?>
