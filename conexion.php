<?php
session_start();

// Conectar a la base de datos
$servername = "localhost";  // Cambia esto si tu servidor de base de datos es diferente
$username = "root";   // Cambia esto por tu usuario de la base de datos
$password = "root"; // Cambia esto por tu contraseña de la base de datos
$dbname = "mydb";

$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

$response = array('success' => false, 'message' => '');

if (isset($_POST['username']) && isset($_POST['password'])) {
    $input_username = $_POST['username'];
    $input_password = $_POST['password'];

    // Preparar y ejecutar la consulta
    $stmt = $conn->prepare("SELECT id, nombre, password FROM usuarios WHERE nombre = ?");
    $stmt->bind_param("s", $input_username);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($id, $nombre, $stored_password);
        $stmt->fetch();

        // Comparar directamente las contraseñas en texto plano
        if ($input_password === $stored_password) {
            $_SESSION['username'] = $nombre;
            $response['success'] = true;
            header("Location: index.php");
            exit;
        } else {
            $response['message'] = 'Contraseña incorrecta.';
        }
    } else {
        $response['message'] = 'Usuario no encontrado.';
    }

    $stmt->close();
}

$conn->close();

echo json_encode($response);
?>
