<?php
// Datos de conexión
$host = "localhost";
$username = "root";
$password = "root";
$dbname = "mydb";

// Crear la conexión
$link = mysqli_connect($host, $username, $password, $dbname);

// Verificar la conexión
if($link === false){
    die("ERROR: No se pudo conectar a la base de datos. " . mysqli_connect_error());
}
?>
