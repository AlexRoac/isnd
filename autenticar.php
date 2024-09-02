<?php
session_start();
include 'conexion.php';

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
            header("Location: index.php");
            exit;
        } else {
            $response['message'] = 'Contraseña incorrecta.';
        }
    } else {
        $response['message'] = 'Usuario no encontrado.';
    }

    $stmt->close();
    echo "<article class='post' style='position: fixed; z-index: 1; justify-content: center;'>";
    echo "    <header>";
    echo "        <div class='title'>";
    echo "            <h2>" . $response['message']  . "</h2>";
    echo "        </div>";
    echo "    </header>";
    echo "</article>";
}

$conn->close();
?>
