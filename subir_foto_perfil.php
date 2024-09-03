<?php
session_start();
include 'conexion.php';

// Verificar si el usuario está autenticado
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

// Ruta de la foto por defecto
$default_picture = 'uploads/foto_default.png';

// Procesar el formulario cuando se envíe
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener el nombre de usuario de la sesión
    $username = $_SESSION['username'];

    // Manejo de la subida de foto
    if (isset($_FILES["profile_picture"])) {
        // Directorio para subir la imagen
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($_FILES["profile_picture"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Verificar si el archivo es una imagen real
        $check = getimagesize($_FILES["profile_picture"]["tmp_name"]);
        if ($check !== false) {
            $uploadOk = 1;
        } else {
            echo "El archivo no es una imagen.";
            $uploadOk = 0;
        }

        // Verificar si el archivo ya existe
        if (file_exists($target_file)) {
            echo "Lo siento, el archivo ya existe.";
            $uploadOk = 0;
        }

        // Permitir ciertos formatos de archivo
        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
            echo "Lo siento, solo se permiten archivos JPG, JPEG, PNG y GIF.";
            $uploadOk = 0;
        }

        // Verificar si $uploadOk es 0 debido a algún error
        if ($uploadOk == 0) {
            echo "Lo siento, tu archivo no fue subido.";
        } else {
            // Intentar mover el archivo a la carpeta de destino
            if (move_uploaded_file($_FILES["profile_picture"]["tmp_name"], $target_file)) {
                // Actualizar la ruta de la foto en la base de datos
                $stmt = $conn->prepare("UPDATE usuarios SET foto_perfil = ? WHERE nombre = ?");
                $stmt->bind_param("ss", $target_file, $username);
                if ($stmt->execute()) {
                    $_SESSION['profile_picture'] = $target_file; // Actualizar la ruta en la sesión
                    echo "Foto de perfil actualizada correctamente.";
                    // Redirigir a la página principal después de la actualización
                    header("Location: index.php");
                    exit();
                } else {
                    echo "Error: " . $stmt->error;
                }
                $stmt->close();
            } else {
                echo "Lo siento, hubo un error al subir tu archivo.";
            }
        }
    }

    // Manejo de la eliminación de foto
    if (isset($_POST['delete']) && $_POST['delete'] == '1') {
        // Actualizar la ruta de la foto en la base de datos
        $stmt = $conn->prepare("UPDATE usuarios SET foto_perfil = ? WHERE nombre = ?");
        $stmt->bind_param("ss", $default_picture, $username);
        if ($stmt->execute()) {
            $_SESSION['profile_picture'] = $default_picture; // Actualizar la ruta en la sesión
            echo "Foto de perfil eliminada correctamente.";
            // Redirigir a la página principal después de la eliminación
            header("Location: index.php");
            exit();
        } else {
            echo "Error: " . $stmt->error;
        }
        $stmt->close();
    }
}

// Cerrar la conexión
$conn->close();
?>
