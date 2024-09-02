<?php

$servername = "162.241.2.36";
$username = "issmarco_socialisnd";
$password = "F5dUOIwy(chr";
$database = "issmarco_socialisnd";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $database);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}
?>
