<?php
session_start();

// Conectar a la base de datos
$servername = "162.241.2.36";
$username = "issmarco_socialisnd";
$password = "F5dUOIwy(chr";
$database = "issmarco_socialisnd";

$conn = new mysqli($servername, $username, $password, $database);

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
    echo "<article class='post' style='position: fixed; z-index: 1; justify-content: center;'>";
	echo "    <header>";
	echo "        <div class='title' >";
    echo "            <h2>" . $response['message']  . "</a></h2>";
    echo "        </div>";
    echo "    </header>";
    echo "</article>";
}

$conn->close();
?>
